<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected  $collection = 'pessoas';

    protected $fillable = [
        'id',
        'apelido',
        'nome',
        'nascimento',
        'stack'
    ];

}
