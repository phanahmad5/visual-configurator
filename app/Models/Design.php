<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
   protected $fillable = [
    'user_id',
    'name',
    'product_type',
    'shirt_color',
    'canvas_data',
    'export_image',
];

protected $casts = [
    'canvas_data' => 'array',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}