<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'nom',
        'variete',
        'description',
        'origine',
        'gout',
        'conservation',
        'saison',
        'usage',
        'conditionnement',
        'image',
        'prix',
        'bienfaits',
        'deleted_by'
    ];

    protected $casts = [
        'conditionnement' => 'array',
        'bienfaits' => 'array',
        'prix' => 'decimal:2'
    ];

    protected $dates = [
        'deleted_at'
    ];
}
