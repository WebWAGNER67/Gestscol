<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // trier les users avec le name, par groupe, par parcours, par diplome
        return User::select("nom", "prenom", "email", "image", "role", "groups.label as group", "statut", "civilites.label as civilite", "parcours.label as parcours", "diplomes.code as diplome", "code_diplome")
        ->join('groups', 'users.group_id', '=', 'groups.id')
        ->join('civilites', 'users.civilite_id', '=', 'civilites.id')
        ->join('parcours', 'users.parcour_id', '=', 'parcours.id')
        ->join('diplomes', 'users.diplome_id', '=', 'diplomes.id')
        ->orderBy('nom')
        ->orderBy('group_id')
        ->orderBy('parcour_id')
        ->orderBy('diplome_id')
        ->get();
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["nom", "prenom", "email", "image", "role", "group", "statut", "civilite", "parcours", "diplome", "code_edt"];
    }
}
