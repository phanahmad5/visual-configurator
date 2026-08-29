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
        return $this->preview_front;
    }

    public function getDesignFrontPathAttribute()
    {
        return $this->preview_front;
    }

    public function getDesignBackPathAttribute()
    {
        return $this->preview_back;
    }

    public function getDesignPathAttribute()
    {
        return $this->preview_front;
    }
}
