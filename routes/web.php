<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;
use Resend\Laravel\Facades\Resend;
use App\Mail\MyGestscolEmail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

#region Routes pour les visiteurs
// Redirection vers la page d'accueil
Route::get('/', function () {
    return redirect(route("home"));
});
#endregion

#region Routes pour les utilisateurs authentifiés
Route::middleware('auth')->group(function () {
    #region Routes pour tous les utilisateurs
    // Affichage du profil de l'utilisateur
    Route::get('/profile', [ProfileController::class, 'show'])
    ->name('profile.show')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Profile', route('profile.show')));

    // Modification du profil de l'utilisateur
    Route::get('/profile/edit', [ProfileController::class, 'edit'])
    ->name('profile.edit')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('profile.show')
    ->push('Mot de passe', route('profile.edit')));

    // Modification du mot de passe de l'utilisateur
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Suppression du profil de l'utilisateur
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Affichage de la page d'accueil
    Route::get('/home', [ProfileController::class, 'index'])
    ->name('home')
    ->breadcrumbs(fn (Trail $trail) => $trail->push('Accueil', route('home')));
    #endregion

    #region Routes pours les Etudiants
    // Affichage du trombinoscope du Groupe
    Route::get('/group', [ProfileController::class, 'group'])
    ->name('group')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Mon Groupe', route('group')));

    // Affichage du trombinoscope de la Promo
    Route::get('/promo', [ProfileController::class, 'promo'])
    ->name('promo')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Ma Promo', route('promo')));

    // Liste des Absences
    Route::get('/absences', [ProfileController::class, 'absences'])
    ->name('absences')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Mes Absences', route('absences')));

    // Confirmer la présence
    Route::get('/presence/{cour}', [ProfileController::class, 'presence'])
    ->name('presence')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Présence'));

    Route::post('/absence/justify', [profileController::class, 'justifier_absence'])
    ->name('absence.justify')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('absences')
    ->push('Justifier son Absence'));

    Route::post('/absence/justify/store', [profileController::class, 'justifier_absence_store'])
    ->name('absence.justify.store')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('absence.justify')
    ->push('Justifier son Absence'));

    Route::post('/absence/justify/accept', [profileController::class, 'justifier_absence_accept'])
    ->name('absence.justify.accept')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('absences')
    ->push('Accepter un Justificatif'));

    #endregion

    #region Routes pour les Professeurs
    // Affichage de tous les trombinoscopes
    Route::get('/trombinoscope', function() { return view('trombinoscope');})
    ->name('trombinoscope')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Trombinoscope', route('trombinoscope')));

    // Appel
    Route::get('/appel/{cour}', [ProfileController::class, 'appel'])
    ->name('appel')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Appel'));

    Route::get('/appel/verif/{idcour}', [ProfileController::class, 'appel_verif'])
    ->name('appel.verif')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Appel'));

    Route::post('/appel/store', [ProfileController::class, 'appel_store'])
    ->name('appel.store')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Appel'));

    Route::post('/appel/update', [ProfileController::class, 'appel_update'])
    ->name('appel.update')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Appel'));

    Route::post('/appel/user/present/{user}', [ProfileController::class, 'appel_user_present'])
    ->name('appel.user.present')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Appel'));


    // Méthodes Fetch pour la page d'appel pour actualiser les élèves et afficher le QR Code
    Route::get("qrcode/{unique}", [ProfileController::class, "generate"])->name("qrcode");
    Route::get('/users/{cour}', [ProfileController::class, 'users'])->name('users');

    //  Lorsque qu'un étudiant scanne le QR Code il arrive sur cette page
    Route::post('/scan', [ProfileController::class, 'scan'])
    ->name('scan')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Scan', route('scan')));
    #endregion

    #region Routes pour les Administrateurs
    // Affichage de la page de tous les étudiants
    Route::get('/users', [UserController::class, 'index'])
    ->name('users.index')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Utilisateurs', route('users.index')));
    Route::get('/users-export', [UserController::class, 'export'])
    ->name('users.export')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Utilisateurs', route('users.index')));
    Route::post('/users-import', [UserController::class, 'import'])
    ->name('users.import')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Utilisateurs', route('users.index')));


    Route::get('/create', [ProfileController::class, 'createindex'])
    ->name('create.index')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Page d\'index de création', route('create.index')));
    Route::get('/create/{param}', [ProfileController::class, 'create'])
    ->name('create.param');
    Route::put('/group', [ProfileController::class, 'group_store'])
    ->name('create.group.store')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Créer un Groupe', route('create.index')));
    Route::put('/diplome', [ProfileController::class, 'diplome_store'])
    ->name('create.diplome.store')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Créer un Diplome', route('create.index')));
    Route::put('/parcour', [ProfileController::class, 'parcour_store'])
    ->name('create.parcour.store')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Créer un Parcour', route('create.index')));
    #endregion

    #region Routes pour le Footer de tous les utilisateurs
    // Affichage des Mentions Légales
    Route::get('/mentions', function() { return view('mentions');})
    ->name('mentions')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Mentions Légales', route('mentions')));

    // Affichage de la Politique de gestion des cookies
    Route::get('/politique_cookies', function() { return view('politique_cookies');})
    ->name('politique_cookies')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Politique de Cookies', route('politique_cookies')));

    // Affichage de la page gestion de cookies
    Route::get('/cookies', function() { return view('cookies');})
    ->name('cookies')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Cookies', route('cookies')));

    // Affichage de la page Plan du site
    Route::get('/sitemap', function() { return view('plan');})
    ->name('plan')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Plan du site', route('plan')));

    // Affichage de la page Accessibilité
    Route::get('/accessibilite', function() { return view('accessibilite');})
    ->name('accessibilite')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('Accessibilité', route('accessibilite')));

    // Route vers le site de l'entreprise Copyright
    Route::get('/integraweb', function() { return redirect('https://ericwagner.fr'); })
    ->name('integraweb')
    ->breadcrumbs(fn (Trail $trail) => $trail->parent('home')
    ->push('IntegraWeb', route('integraweb')));
    #endregion
    Route::fallback(function () {
        return view('errors.404');
    });
});
#endregion

Route::get('/mail/preview', function() {

    $nom = "WAGNER";
    $prenom = "Eric";
    $promo = "MMI3";
    $parcours = "CN";
    $group = "CN1 AV";
    $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);

    // Resend::emails()->send([
    //     'from' => 'No-Reply <no-reply@resend.dev>',
    //     'to' => ["ericwagner.lightskraft@gmail.com"],
    //     'subject' => 'No-Reply: Your new account is ready!',
    //     'html' => view("mail.test-email", [
    //         'nom' => $nom,
    //         'prenom' => $prenom,
    //         'promo' => $promo,
    //         'parcours' => $parcours,
    //         'group' => $group,
    //         'password' => $password
    //     ])->render(),
    // ]);

    return view('mail.test-email', compact('nom', 'prenom', 'promo', 'parcours', 'group', 'password'));
});

require __DIR__.'/auth.php';