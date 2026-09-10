<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motif extends Model
{
    protected $fillable = [
        'name',
        'nama',
        'category',
        'kategori',
        'theme',
        'color',
        'image_name',
        'path_file',
        'image_front',
        'image_back',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getNamaAttribute()
    {
        return $this->attributes['nama'] ?? $this->attributes['name'] ?? null;
    }

    public function getNameAttribute()
    {
        return $this->attributes['name'] ?? $this->attributes['nama'] ?? null;
    }

    public function getKategoriAttribute()
    {
        return $this->attributes['kategori'] ?? $this->attributes['category'] ?? null;
    }

    public function getCategoryAttribute()
    {
        return $this->attributes['category'] ?? $this->attributes['kategori'] ?? null;
    }

    public function getPathFileAttribute()
    {
        return $this->attributes['path_file'] ?? $this->attributes['image_front'] ?? null;
    }

    public function getImageFrontAttribute()
    {
        return $this->attributes['image_front'] ?? $this->attributes['path_file'] ?? null;
    }
}
