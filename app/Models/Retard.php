<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retard extends Model
{
    use HasFactory;

    protected $fillable = [
        'cour',
        'date',
        'time_arrived',
        'user_id'
    ];
}
