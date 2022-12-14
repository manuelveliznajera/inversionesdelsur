<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frecuency extends Model
{
    use HasFactory;
    protected $table = 'frecuencies';

    protected $fillable = ['name', 'days'];
}
