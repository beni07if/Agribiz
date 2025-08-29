<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Policy extends Model
{
    use HasFactory;
    protected $table = 'policies';
    // protected $fillable = ['question', 'answer'];
    protected $fillable = [
        'id', 
        'title', 
        'description',
        'version',
        'date_update'
    ];
}