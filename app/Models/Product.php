<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property int $click_funnels_product_id
 * @property string $name
 * @property float $amount
 * @property array $raw_data
 * @property \Carbon\Carbon $ends_at
 */
class Product extends Model
{
    use SoftDeletes;

    protected $casts = [
        'raw_data' => 'array',
    ];

    protected $dates = [
        'ends_at',
    ];

    protected $fillable = [
        'user_id',
        'click_funnels_product_id',
        'name',
        'amount',
        'raw_data',
        'ends_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include Lifetime product.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLifetime($query)
    {
        return $query->where('click_funnels_product_id', env('CF_LIFETIME_SUB_PRODUCT_ID'));
    }

    /**
     * Scope a query to only include the e-book.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEbook($query)
    {
        return $query->where('click_funnels_product_id', env('CF_EBOOK_PRODUCT_ID'));
    }

    public function isEbook()
    {
        return $this->click_funnels_product_id == env('CF_EBOOK_PRODUCT_ID');
    }
}
