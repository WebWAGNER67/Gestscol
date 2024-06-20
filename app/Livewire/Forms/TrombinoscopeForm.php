<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class TrombinoscopeForm extends Form
{
    public $diplome = '';

    public $group = '';

    public function rules()
    {
        return [
            'diplome' => 'nullable|string',
            'group' => 'nullable|string',
        ];
    }
}
