<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = [
        'cours',
        'user_id',
        'status',
        'justification_file'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
