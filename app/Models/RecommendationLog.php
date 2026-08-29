<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecommendationLog extends Model
{
    protected $fillable = [

        'user_id',
        'template_id',
        'category_input',
        'theme_input',
        'color_input',
        'score',
        'ranking'

    ];

    protected $casts = [

        'score' => 'float'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}