<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'site_settings';

    // The primary key associated with the table.
   

    // The attributes that are mass assignable.
    protected $fillable = [
        'whatsapp_no',
        'site_title',
        'site_description',
        'site_keywords',
        'main_logo',
        'sticky_logo',
        'footer_logo',
        'site_favicon',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'youtube_url',
        'contact_email',
        'contact_phone',
        'address',
        'google_analytics_code',
        'row_id',
        'cash_app',
        'zelle',
    ];

    // If you want to automatically set the timestamps on create and update:
    public $timestamps = true;

    // Define any accessors or mutators if needed, for example, for handling logo URLs.
}
