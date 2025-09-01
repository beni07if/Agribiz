<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    use HasFactory;
    protected $table = 'privacy_policies';
    // protected $fillable = ['question', 'answer'];
    protected $fillable = [
        'id', 
        'title', 
        'description'
    ];
}