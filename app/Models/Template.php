<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
        'name',
        'category',
        'theme',
        'color',
        'preview_front',
        'preview_back',
        'image_path',
        'design_path',
        'design_data',
        'description',
        'is_active',
    ];

    protected $casts = [
        'design_data' => 'array',
        'is_active'   => 'boolean',
    ];

    public function recommendationLogs()
    {
        return $this->hasMany(RecommendationLog::class);
    }

    public function getImagePathAttribute()
    {
        return $this->preview_front ?? $this->attributes['image_path'] ?? null;
    }

    public function getDesignFrontPathAttribute()
    {
        return $this->preview_front ?? $this->attributes['design_path'] ?? null;
    }

    public function getDesignBackPathAttribute()
    {
        return $this->preview_back ?? $this->attributes['design_path'] ?? null;
    }

    public function getDesignPathAttribute()
    {
        return $this->attributes['design_path'] ?? $this->preview_front ?? null;
    }
}
