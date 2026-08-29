<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motif extends Model
{
    protected $fillable = [
        'name',
        'category',
        'theme',
        'color',
        'image_front',
        'image_back',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getNamaAttribute()
    {
        return $this->name;
    }

    public function getKategoriAttribute()
    {
        return $this->category;
    }

    public function getPathFileAttribute()
    {
        return $this->image_front;
    }
}
