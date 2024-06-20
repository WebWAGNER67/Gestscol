<?php

namespace App\Livewire;

use App\Livewire\Forms\TrombinoscopeForm;
use App\Models\Diplome;
use App\Models\Formation;
use App\Models\Group;
use App\Models\User;
use Livewire\Component;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Trombinoscope extends Component
{

    public TrombinoscopeForm $form;

    public function render()
    {
        $groups = Group::all();
        $diplomes = Diplome::all();

        if($this->getErrorBag()->isEmpty())
        {
            $users = User::orderBy('nom', 'asc')
                ->when(!empty($this->form->diplome), function (Builder $query) {
                    $query->where('diplome_id', '=', $this->form->diplome);
                })
                ->when(!empty($this->form->group), function (Builder $query) {
                    $query->where('group_id', '=', $this->form->group);
                })
                ->get();

        }

        return view('livewire.trombinoscope', [
            'groups' => $groups,
            'diplomes' => $diplomes,
            'users' => $users,
        ]);
    }

    public function submit()
    {
        $this->form->validate();
    }
}