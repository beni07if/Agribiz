<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Landingpage extends Model
{
    use HasFactory;
    protected $table = 'landingpages';
    // protected $fillable = ['question', 'answer'];
    protected $fillable = [
        'id', 
        'tagline', 
        'title_about_agribiz', 
        'desc_about_agribiz',
        'image_about_agribiz',
        'key_main_feature_title',
        'key_main_feature_desc',
        'key_feature_group_title',
        'key_feature_group_desc',
        'key_feature_company_title',
        'key_feature_company_desc',
        'key_feature_shareholder_title',
        'key_feature_shareholder_desc',
        'key_feature_sra_title',
        'key_feature_sra_desc',
    ];
}