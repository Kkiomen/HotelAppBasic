<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDescription extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'product_id',
        'imageUrl',
        'accepted',
        'subject',
        'product_name',
        'category',
        'attributes',
        'target_audience',
        'keywords',
        'keywords_seo',
        'use_html',
        'style_and_tone',
        'limitations',
        'material',
        'warranty',
        'unique_features',
        'description',
        'generated_prompt',
        'result',
        'generated'
    ];

    protected $casts = [
        'unique_features' => 'array',
        'limitations' => 'array',
        'style_and_tone' => 'array',
        'keywords_seo' => 'array',
        'keywords' => 'array',
        'attributes' => 'array',
        'material' => 'array',
    ];

    public function tokenUsages(){
        return $this->hasMany(TokenUsage::class);
    }
}
