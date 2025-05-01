<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'quiz_id');
    }
}
