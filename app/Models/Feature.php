<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use HasFactory;
    protected $table = 'landingpages';
    // protected $fillable = ['question', 'answer'];
    protected $fillable = [
        'id', 
        'feature_group_title',
        'feature_group_desc',
        'feature_group_img',
        'feature_company_title',
        'feature_company_desc',
        'feature_company_img',
        'feature_shareholder_title',
        'feature_shareholder_desc',
        'feature_shareholder_img'
        'feature_sra_title',
        'feature_sra_desc',
        'feature_sra_img',
    ];
}