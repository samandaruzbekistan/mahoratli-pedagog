<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubeVideo extends Model
{
    use HasFactory;

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    protected $fillable = [
        'title',
        'frame_url',
        'section_id',
    ];
}
