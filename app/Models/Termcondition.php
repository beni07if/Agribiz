<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Termcondition extends Model
{
    use HasFactory;
    protected $table = 'termconditions';
    // protected $fillable = ['question', 'answer'];
    protected $fillable = [
        'id', 
        'title', 
        'description',
        'agreement',
        'description2',
        'version',
        'date_update'
    ];
}