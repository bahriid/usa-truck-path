<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'chapter_id', 'type', 'tier', 'title', 'duration',
        'source_from', 'video_url', 'local_video', 'description', 'pdf', 'voice'
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
