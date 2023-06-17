<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TokenUsage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_description',
        'prompt_tokens',
        'completion_tokens',
        'total_tokens',
        'estimated_cost',
        'response',
    ];

    public function productDescriptions(){
        return $this->belongsTo(ProductDescription::class);
    }

    public static function getTotalEstimatedCost()
    {
        return self::sum('estimated_cost');
    }
}
