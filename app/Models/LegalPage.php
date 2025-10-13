<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalPage extends Model
{
    protected $fillable = [
        'privacy_policy', 
        'terms_and_conditions'
    ];
}
