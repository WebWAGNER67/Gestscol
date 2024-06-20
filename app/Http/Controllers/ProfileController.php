<?php
namespace App\Http\Controllers;

#region Imports
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Response;
use App\Http\Requests\ProfileUpdateRequest;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Livewire\Calendar;
use App\Models\Absence;
use App\Models\Appel;
use App\Models\Diplome;
use App\Models\Group;
use App\Models\Parcour;
use App\Models\Retard;
use App\Models\User;
use DateTime;
#endregion

class ProfileController extends Controller
{

    #region Initialisatoin de toutes les variables
    public $api;
    private $sessionID;
    private $projects;
    private $project;
    private $ressources;
    private $events;
    public $joursSemaine;
    #endregion

    #region Initialisation de l'API ADE
    public function __construct(ApiController $api)
    {
        $this->api = $api;
        $this->joursSemaine = [
            [
                'lettre' => 'D',
                'abreviation' => 'Dim',
                'nomComplet' => 'Dimanche'
            ],
            [
                'lettre' => 'L',
                'abreviation' => 'Lun',
                'nomComplet' => 'Lundi'
            ],
            [
                'lettre' => 'M',
                'abreviation' => 'Mar',
                'nomComplet' => 'Mardi'
            ],
            [
                'lettre' => 'M',
                'abreviation' => 'Mer',
                'nomComplet' => 'Mercredi'
            ],
            [
                'lettre' => 'J',
                'abreviation' => 'Jeu',
                'nomComplet' => 'Jeudi'
            ],
            [
                'lettre' => 'V',
                'abreviation' => 'Ven',
                'nomComplet' => 'Vendredi'
            ],
            [
                'lettre' => 'S',
                'abreviation' => 'Sam',
                'nomComplet' => 'Samedi'
            ]
        ];
        $this->sessionID = $this->api->connect();
        $this->projects = $this->api->getProject($this->sessionID, 1, 4);
        $this->project = $this->api->setProject(1);
    }

    public function initApi()
    {
        $resources = [
            ['sessionId', $this->sessionID],
            ['name', Auth::user()->code_diplome],
            ['detail', 13]
        ];
        $this->ressources = $this->api->getRessources(...$resources);
        $xmlData = $this->ressources->body();
        $matches = [];
        if (preg_match('/<resource id="([^"]+)"/', $xmlData, $matches)) {
            $id = $matches[1];
        }

        return $id;
    }

    public function evenements()
    {

        $days = $this->initDays();
        $id = $this->initApi();

        $events = [
            ['resources', $id],
            ['detail', 8],
            ['startDate', $days[0]->format('m/d/Y')],
            ['endDate', $days[6]->format('m/d/Y')]
        ];
        $xml1 = $this->api->getEvent(...$events);
        $xml = simplexml_load_string($xml1);
        $evenements = [];
        foreach ($xml->event as $event) {
            $evenements[] = json_decode(json_encode($event), true);
        }
        // Sort the events by startHour and date
        usort($evenements, function ($a, $b) {
            return $a['@attributes']['startHour'] <=> $b['@attributes']['startHour'];
        });
        usort($evenements, function ($a, $b) {
            $dateA = DateTime::createFromFormat('d/m/Y', $a['@attributes']['date']);
            $dateB = DateTime::createFromFormat('d/m/Y', $b['@attributes']['date']);
            return $dateA <=> $dateB;
        });

        return $evenements;
    }

    public function AllEvenements()
    {

        $id = $this->initApi();

        $AllEvents = [
            ['resources', $id],
            ['detail', 8]
        ];
        $xml2 = $this->api->getEvent(...$AllEvents);
        $xml3 = simplexml_load_string($xml2);
        $AllEvenements = [];
        foreach ($xml3->event as $event) {
            $AllEvenements[] = json_decode(json_encode($event), true);
        }


        // Sort the events by startHour and date
        usort($AllEvenements, function ($a, $b) {
            return $a['@attributes']['startHour'] <=> $b['@attributes']['startHour'];
        });
        usort($AllEvenements, function ($a, $b) {
            $dateA = DateTime::createFromFormat('d/m/Y', $a['@attributes']['date']);
            $dateB = DateTime::createFromFormat('d/m/Y', $b['@attributes']['date']);
            return $dateA <=> $dateB;
        });

        return $AllEvenements;
    }
    #endregion

    #region paramètres utilisateur
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function show(Request $request): View
    {
        return view('profile.show', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    #endregion

    #region Fonctions pour l'affichage de l'emploi du temps
    public function initHours()
    {
        $hours = [];
        for ($i = 8; $i <= 18; $i++) {
            for ($j = 0; $j <= 30; $j += 30) {
                $hour = $i < 10 ? "0$i" : "$i";
                $minute = $j === 0 ? '00' : '30';
                $time = "$hour"."h"."$minute";
                if ($time === "08h00" || $time === "18h30") {
                    $time = "";
                }
                $hours[] = $time;
                if (
                    $time === "13h00" || $time === "13h30" || $time === "09h00" ||
                    $time === "10h00" || $time === "11h00" || $time === "12h00" ||
                    $time === "14h30" || $time === "15h30" || $time === "16h30" ||
                    $time === "17h30"
                ) {
                    $index = array_search($time, $hours);
                    unset($hours[$index]);
                }
            }
        }

        return $hours;
    }

    public function initDays()
    {

        $first_day = Carbon::createFromFormat('d-m-Y', now()->format('d-m-Y'))->startOfWeek();
        $last_day = $first_day->clone()->endOfWeek();


        $days = [];

        while ($first_day < $last_day) {
            $days[] = $first_day->clone();
            $first_day->addDay();
        }
        return $days;
    }

    public function nextEvent()
    {
        $now = Carbon::now()->addHour();
        $AllEvenements = $this->AllEvenements();
        $nextEvent = null;
        foreach ($AllEvenements as $event) {
            $eventStartDateTime = Carbon::createFromFormat('d/m/Y H:i', $event['@attributes']['date'] . ' ' . $event['@attributes']['startHour']);
            $eventEndDateTime = Carbon::createFromFormat('d/m/Y H:i', $event['@attributes']['date'] . ' ' . $event['@attributes']['endHour']);

            if ($eventStartDateTime->isAfter($now) && $eventEndDateTime->isAfter($now)) {
                $nextEvent = $event;
                break;
            }
        }
        return $nextEvent;
    }

    public function currentEvent()
    {
        $now = Carbon::now()->addHour();
        $AllEvenements = $this->AllEvenements();
        $currentEvent = null;
        foreach ($AllEvenements as $event) {
            $eventStartDateTime = Carbon::createFromFormat('d/m/Y H:i', $event['@attributes']['date'] . ' ' . $event['@attributes']['startHour']);
            $eventEndDateTime = Carbon::createFromFormat('d/m/Y H:i', $event['@attributes']['date'] . ' ' . $event['@attributes']['endHour']);

            if ($eventStartDateTime->isBefore($now) && $eventEndDateTime->isAfter($now)) {
                $currentEvent = $event;
            }
        }
        return $currentEvent;
    }

    public function EvenementsByDate()
    {
        $evenements = $this->evenements();
        $evenementsByDate = array_reduce($evenements, function ($carry, $evenement) {
            $date = $evenement['@attributes']['date'];
            if (!isset($carry[$date])) {
                $carry[$date] = [];
            }
            $carry[$date][] = $evenement;
            return $carry;
        }, []);

        return $evenementsByDate;
    }
    #endregion

    #region Page d'accueil qui appel toutes les fonctions liées à l'emploi du temps et aux cours
    public function index()
    {

        $user_connected = Auth::user();

        // si l'utilisateur est dans le groupe canada pas récupérer les cours
        if ($user_connected->group->label === 'CANADA') {
            return view('home', [
                'user_connected' => $user_connected,
            ]);
        } else {
            $current_day = Carbon::createFromFormat('d-m-Y', now()->format('d-m-Y'));
            $current_hour = Carbon::createFromFormat('H:i', now()->format('H:i'));
            $current_hour = $current_hour->addHour();
            $list_appel = Appel::all();
            $evenementsByDate = $this->EvenementsByDate();
            $nextEvent = $this->nextEvent();
            $currentEvent = $this->currentEvent();
            return view('home', [
                'days' => $this->initDays(),
                'joursSemaine' => $this->joursSemaine,
                'sessionID' => $this->sessionID,
                'evenementsByDate' => $evenementsByDate,
                'user_connected' => $user_connected,
                'current_day' => $current_day,
                'nextEvent' => $nextEvent,
                'currentEvent' => $currentEvent,
                'hours' => $this->initHours(),
                'current_hour' => $current_hour,
                'list_appel' => $list_appel,
            ]);
        }

    }
    #endregion

    #region Fonction pour l'affichage des différents trombinoscopes
    public function group()
    {
        $user_connected = Auth::user();
        $users = User::orderBy('name', 'asc')->where('diplome_id', $user_connected->diplome_id)
            ->where('parcour_id', $user_connected->parcour_id)
            ->paginate(15);
        $content = "Mon Groupe " . $user_connected->diplome->code . " " . $user_connected->parcour->label;

        return view('eleve', [
            'users' => $users,
            'content' => $content,
        ]);
    }

    public function promo()
    {
        $user_connected = Auth::user();
        $users = User::orderBy('name', 'asc')->where('diplome_id', $user_connected->diplome_id)
            ->paginate(15);

        $content = "Ma Promo " . $user_connected->diplome->code;

        return view('eleve', [
            'users' => $users,
            'content' => $content,
        ]);
    }
    #endregion

    #region Fonctions pour la gestion de l'appel
    public function eventId($eventId)
    {

        $id = $this->initApi();

        $event = [
            ['resources', $id],
            ['detail', 8],
            ['eventId', $eventId]
        ];
        $xml3 = $this->api->getEvent(...$event);
        $xml4 = simplexml_load_string($xml3);

        return json_decode(json_encode($xml4), true);
    }

    public function appel($idcour) {
        $users = $this->users($idcour);
        $present_fait = false;
        $appel = Appel::where('cours', $idcour)->first();
        if ($appel) {
            $present_fait = true;
            $absences = Absence::where('cours', $idcour)->get();
            $retards = Retard::where('cour', $idcour)->get();
            foreach ($users as $user)
            {
                if($absences->contains('user_id', $user->id))
                {
                    $user->present = false;
                }
                else
                {
                    if($retards->contains('user_id', $user->id)) {
                        $user->present = false;
                        $user->retard_time = $retards['0']->time_arrived;
                    } else {
                        $user->present = true;
                    }
                }
            }
        }

        foreach ($users as $user)
        {
            User::where('id', $user->id)->update(['presence' => false]);
        }

        return view('appel', compact('idcour', 'users', 'present_fait'));
    }

    public function appel_verif($idcour) {
        $users = $this->users($idcour);
        return view('appel_verif', compact('idcour', 'users'));
    }

    public function appel_store(Request $request) {
        $data = $request->all();

        $used_qrcode = false;
        if (isset($data['generatedQRCode'])) {
            $used_qrcode = true;
        }

        if ($used_qrcode) {
            return redirect()->route('appel.verif', ['idcour' => $data['idcour']]);
        } else {
            $users = array_filter($data, function ($key) {
                return strpos($key, 'present_') === 0;
            }, ARRAY_FILTER_USE_KEY);
            $users = array_map(function ($key) {
                return substr($key, 8);
            }, array_keys($users));
            $users = array_map(function ($key) {
                return str_replace('_', ' ', $key);
            }, $users);
            $users = array_map(function ($key) {
                $parts = explode(' ', $key);
                $parts[0] = ucfirst($parts[0]);
                $parts[1] = strtoupper($parts[1]);
                return implode(' ', $parts);
            }, $users);

            $usernames = $this->users($data['idcour']);

            $foundUsers = [];

            foreach ($users as $user) {
                // Inverser le format du nom d'utilisateur dans $users
                $reversedUser = implode(' ', array_reverse(explode(' ', $user)));

                $found = $usernames->contains(function ($username) use ($user, $reversedUser) {
                    // Comparaison avec le nom d'utilisateur inversé pour correspondre aux formats
                    return $username->name == $reversedUser;
                });

                if ($found) {
                    $foundUsers[] = $user;
                }
            }

            $usernames = $usernames->map(function ($username) use ($foundUsers) {
                // Inverser le format du nom d'utilisateur dans $foundUsers
                $reversedFoundUsers = array_map(function ($user) {
                    return implode(' ', array_reverse(explode(' ', $user)));
                }, $foundUsers);

                // Comparaison avec le nom d'utilisateur inversé pour correspondre aux formats
                $username->present = in_array($username->name, $reversedFoundUsers);

                return $username;
            });

            $appel = new Appel();
            $appel->cours = $data['idcour'];
            $appel->save();
            foreach ($usernames as $username) {
                if (!$username->present) {
                    // dump($username->name . '  ' . $username->present);
                    Absence::create([
                        'user_id' => $username->id,
                        'cours' => $data['idcour'],
                        'status' => 'unjustify'
                    ]);
                }
            }
            return redirect()->route('home')->with('status', "L'appel a bien été enregistré.");
        }

    }

    public function appel_update(Request $request)
    {
        $data = $request->all();

        $user_retard = array_filter($data, function ($key) {
            return strpos($key, 'retard_') === 0;
        }, ARRAY_FILTER_USE_KEY);
        $users = array_filter($data, function ($key) {
            return strpos($key, 'retard_') === 0;
        }, ARRAY_FILTER_USE_KEY);
        $users = array_map(function ($key) {
            return substr($key, 7);
        }, array_keys($users));
        $users = array_map(function ($key) {
            return str_replace('_', ' ', $key);
        }, $users);
        $users = array_map(function ($key) {
            $parts = explode(' ', $key);
            $parts[0] = ucfirst($parts[0]);
            $parts[1] = strtoupper($parts[1]);
            return implode(' ', $parts);
        }, $users);

        $usernames = $this->users($data['idcour']);

        $foundUsers = [];

        foreach ($users as $user) {
            // Inverser le format du nom d'utilisateur dans $users
            $reversedUser = implode(' ', array_reverse(explode(' ', $user)));

            $found = $usernames->contains(function ($username) use ($user, $reversedUser) {
                // Comparaison avec le nom d'utilisateur inversé pour correspondre aux formats
                return $username->name == $reversedUser;
            });

            if ($found) {
                $foundUsers[] = $user;
            }
        }

        $usernames = $usernames->map(function ($username) use ($foundUsers) {
            // Inverser le format du nom d'utilisateur dans $foundUsers
            $reversedFoundUsers = array_map(function ($user) {
                return implode(' ', array_reverse(explode(' ', $user)));
            }, $foundUsers);

            // Comparaison avec le nom d'utilisateur inversé pour correspondre aux formats
            $username->retard = in_array($username->name, $reversedFoundUsers);

            return $username;
        });

        // dd($usernames, $user_retard);
        // suppression de l'absence de la personne en retard
        foreach ($usernames as $username) {
            if ($username->retard) {
                $absence = Absence::where('user_id', $username->id)->where('cours', $data['idcour'])->first();
                $user = strtolower($username->prenom . '_' . $username->nom);
                if (isset($absence)) {
                    if ($user_retard['retard_' . $user] != null) {
                        $absence->delete();

                        Retard::create([
                            'user_id' => $username->id,
                            'cour' => $data['idcour'],
                            'date' => Carbon::createFromFormat('d-m-Y', now()->format('d-m-Y')),
                            'time_arrived' => $user_retard['retard_' . $user]
                        ]);
                    }
                } else {
                    Retard::where(['cour'=> $data['idcour'], 'user_id' => $username->id])->update(['time_arrived' => $user_retard['retard_'.$user]]);
                }
            }
        }
        return redirect()->route('home')->with('status', "Mise à jour de la liste des présents effectuée avec succès.");
    }

    public function appel_user_present($user) {
        User::where('id', $user)->update(['presence' => true]);
    }

    public function generate($unique) {
        // Générez le contenu du QR code (l'URL avec l'ID unique)
        $qrcode = QrCode::size(200)->generate(env('APP_URL') . "/presence/$unique");

        // Créez une réponse HTTP avec le contenu du QR code
        $response = new Response($qrcode);

        return $response;
    }

    public function presence($idcour)
    {
        $user = Auth::user();

        return view('presence',
            [
                'user' => $user,
                'idcour' => $idcour
            ]);
    }

    public function scan() {
        $user = Auth::user();

        User::where('id', $user->id)->update(['presence' => true]);

        return redirect()->route('home');
    }

    public function users($idcour) {

        $event = $this->eventId($idcour);
        foreach ($event['resources']['resource'] as $resource)
        {
            if ($resource['@attributes']['category'] === 'trainee')
            {
                $groupe = $resource['@attributes']['name'];
            }
        }

        $parcour = Parcour::where('label', $groupe)->first();
        $diplome = Diplome::where('code', $groupe)->first();

        if ($parcour && User::where('parcour_id', $parcour->id)->exists())
        {
            $users = User::where('parcour_id', Parcour::where('label', $groupe)->first()->id)
                ->get();
        }
        elseif (User::where('code_diplome', $groupe)->exists())
        {
            $users = User::where('code_diplome', $groupe)
                ->get();
        }
        elseif ($diplome && User::where('diplome_id', $diplome->id)->exists())
        {
            $users = User::where('diplome_id', Diplome::where('name', $groupe)->first()->id)
                ->get();
        }

        return $users;
    }
    #endregion

    #region Fonctions pour l'affichage des absences
        public function absences()
        {
            $user = Auth::user();

            if($user->role == 'eleve') {
                $absences = Absence::where('user_id', $user->id)->paginate(15);
                $titre = 'Mes Absences';
            } else {
                $absences = Absence::orderBy('user_id')->paginate(15);
                $titre = 'Toutes les Absences';
            }

            $coursAbsences = [];
            foreach ($absences as $absence)
            {
                $event = $this->eventId($absence->cours);
                $event['status'] = $absence->status;
                $event['id_absence'] = $absence->id;
                $event['name'] = $absence->user->name;
                $event['justification_file'] = $absence->justification_file;
                $coursAbsences[] = $event;
            }
            // Sort the events by startHour and date
            usort($coursAbsences, function ($a, $b) {
                return $b['@attributes']['startHour'] <=> $a['@attributes']['startHour'];
            });
            usort($coursAbsences, function ($a, $b) {
                $dateA = DateTime::createFromFormat('d/m/Y', $a['@attributes']['date']);
                $dateB = DateTime::createFromFormat('d/m/Y', $b['@attributes']['date']);
                return $dateB <=> $dateA;
            });

            return view('absences', compact('coursAbsences', 'absences', 'titre'));
        }

        public function justifier_absence(Request $request)
        {
            $data = $request->all();
            $id_absence = $data['id_absence'];

            return view('justify_absence', compact('id_absence'));
        }

        public function justifier_absence_store(Request $request)
        {
            $request->validate([
                'import_file' => [
                    'required',
                    'file',
                    'mimes:pdf',
                ]
            ]);
            $data = $request->all();
            $file = $data['import_file'];
            $id_absence = $data['id_absence'];
            if (!file_exists(public_path('justificatifs/attente'))) {
                mkdir(public_path('justificatifs/attente'), 0777, true);
            }

            $absence = Absence::where('id', $id_absence)->first();

            $dateHeure = now()->format('Ymd-His');
            $prenom = strtolower($absence->user->prenom);
            $nom = strtolower($absence->user->nom);
            $nomAbsent = $prenom . '_' . $nom;
            $idCours = $absence->cours;
            $cours = $this->eventId($idCours);
            $titreCours = $cours['@attributes']['name'];
            $nouveauNom = "{$dateHeure}-{$id_absence}-{$nomAbsent}-{$titreCours}.pdf";

            $file->move(public_path('justificatifs/attente'), $nouveauNom);
            $absence->status = 'waiting';
            $absence->justification_file = asset('justificatifs/attente/' . $nouveauNom);
            $absence->save();

            return redirect()->route('absences');
        }

        public function justifier_absence_accept(Request $request)
        {
            $this->authorize('AcceptJustificatif', \App\Models\User::class);
            $data = $request->all();

            $absence = Absence::where('id', $data['id_absence'])->first();
            $absence->status = 'justify';
            $absence->save();

            return redirect()->route('absences');
        }
    #endregion

    public function create($param)
    {
        $this->authorize('createAll', \App\Models\User::class);
        if ($param === 'group') {
            return view('create.group');
        } elseif ($param === 'diplome') {
            return view('create.diplome');
        } elseif ($param === 'parcour') {
            return view('create.parcour');
        }
    }
    public function createindex()
    {
        $this->authorize('createAll', \App\Models\User::class);
        $groups = Group::all();
        $diplomes = Diplome::all();
        $parcours = Parcour::all();
        return view('create.index', compact('groups', 'diplomes', 'parcours'));
    }

    public function group_store(Request $request)
    {
        $this->authorize('createAll', \App\Models\User::class);
        $data = $request->all();
        Group::create($data);

        return redirect()->route('create.index');
    }

    public function diplome_store(Request $request)
    {
        $this->authorize('createAll', \App\Models\User::class);
        $data = $request->all();
        Diplome::create($data);

        return redirect()->route('create.index');
    }

    public function parcour_store(Request $request)
    {
        $this->authorize('createAll', \App\Models\User::class);
        $data = $request->all();
        Parcour::create($data);

        return redirect()->route('create.index');
    }
}