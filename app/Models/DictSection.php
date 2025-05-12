<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictSection extends Model
{
    use HasFactory;

    public function dicts()
    {
        return $this->hasMany(Dict::class, 'dict_section_id');
    }
}
