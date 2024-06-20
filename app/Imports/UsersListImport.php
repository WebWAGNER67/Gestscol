<?php

namespace App\Imports;

use App\Models\Civilite;
use App\Models\Diplome;
use App\Models\Group;
use App\Models\Parcour;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Mail;
use Resend\Laravel\Facades\Resend;
use App\Mail\MyGestscolEmail;

class UsersListImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $user = User::where('email', $row['email'])->first();
            if ($user)
            {
                $parcour = Parcour::where('label', $row['parcours'])->first();
                $group = Group::where('label', $row['group'])->first();
                $diplome = Diplome::where('code', $row['diplome'])->first();
                $civilite = Civilite::where('label', $row['civilite'])->first();
                if ($user->image == $row['image'] &&
                    $user->group_id == $group->id &&
                    $user->role == $row['role'] &&
                    $user->statut == $row['statut'] &&
                    $user->civilite_id == $civilite->id &&
                    $user->parcour_id == $parcour->id &&
                    $user->diplome_id == $diplome->id &&
                    $user->code_diplome == $row['code_edt']) {
                        return redirect()->route('users.index')->with('error', 'Aucune modification n\'a été effectuée');
                } else {
                    $user->update([
                        'image' => $row['image'],
                        'group_id' => $group->id,
                        'statut' => $row['statut'],
                        'civilite_id' => $civilite->id,
                        'parcour_id' => $parcour->id,
                        'diplome_id' => $diplome->id,
                        'code_diplome' => $row['code_edt'],
                    ]);
                }
            }
            else
            {
                $mdp = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
                $parcour = Parcour::where('label', $row['parcours'])->first();
                $group = Group::where('label', $row['group'])->first();
                $diplome = Diplome::where('code', $row['diplome'])->first();
                $civilite = Civilite::where('label', $row['civilite'])->first();

                if (
                    $row['nom'] &&
                    $row['prenom'] &&
                    $row['email'] &&
                    $row['role'] &&
                    $row['group'] &&
                    $row['statut'] &&
                    $row['civilite'] &&
                    $row['parcours'] &&
                    $row['diplome'] &&
                    $row['code_edt']
                ) {
                    User::create([
                        'name' => $row['nom'] . " " . $row['prenom'],
                        'nom' => $row['nom'],
                        'prenom' => $row['prenom'],
                        'email' => $row['email'],
                        'password' => Hash::make($mdp),
                        'image' => $row['image'],
                        'role' => $row['role'],
                        'group_id' => $group->id,
                        'statut' => $row['statut'],
                        'civilite_id' => $civilite->id,
                        'parcour_id' => $parcour->id,
                        'diplome_id' => $diplome->id,
                        'code_diplome' => $row['code_edt'],
                    ]);
                    // Resend::emails()->send([
                    //     'from' => 'No-Reply <no-reply@resend.dev>',
                    //     'to' => [$row['email']],
                    //     'subject' => 'No-Reply: Your new account is ready!',
                    //     'html' => view("mail.test-email", [
                    //         'nom' => $row['nom'],
                    //         'prenom' => $row['prenom'],
                    //         'parcours' => $row['parcours'],
                    //         'group' => $row['group'],
                    //         'password' => $mdp
                    //     ])->render(),
                    // ]);
                    Mail::to($row['email'])->send(new MyGestscolEmail($row['nom'], $row['prenom'], $row['promo'], $row['parcours'], $row['group'], $mdp));
                }
            }
        }
    }
}