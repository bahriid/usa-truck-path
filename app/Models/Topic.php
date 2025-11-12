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

    /**
     * Get the embed URL for videos (handles YouTube and Vimeo).
     */
    public function getEmbedUrl()
    {
        if (!$this->video_url) {
            return null;
        }

        // Handle Vimeo URLs
        if ($this->source_from === 'vimeo') {
            return $this->convertVimeoUrl($this->video_url);
        }

        // Handle YouTube URLs
        if ($this->source_from === 'youtube') {
            return $this->convertYouTubeUrl($this->video_url);
        }

        // For other sources, return as-is
        return $this->video_url;
    }

    /**
     * Convert Vimeo URL to embed format.
     */
    private function convertVimeoUrl($url)
    {
        // If already in player format, return as-is
        if (strpos($url, 'player.vimeo.com') !== false) {
            return $url;
        }

        // Extract video ID from various Vimeo URL formats
        // Format: https://vimeo.com/123456789 or vimeo.com/123456789
        preg_match('/vimeo\.com\/(\d+)/', $url, $matches);

        if (isset($matches[1])) {
            $videoId = $matches[1];
            return "https://player.vimeo.com/video/{$videoId}";
        }

        // If can't parse, return original
        return $url;
    }

    /**
     * Convert YouTube URL to embed format.
     */
    private function convertYouTubeUrl($url)
    {
        // If already in embed format, return as-is
        if (strpos($url, 'youtube.com/embed/') !== false) {
            return $url;
        }

        // Extract video ID from various YouTube URL formats
        // Format: https://www.youtube.com/watch?v=VIDEO_ID or https://youtu.be/VIDEO_ID
        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\?\/]+)/', $url, $matches);

        if (isset($matches[1])) {
            $videoId = $matches[1];
            return "https://www.youtube.com/embed/{$videoId}";
        }

        // If can't parse, return original
        return $url;
    }
}
