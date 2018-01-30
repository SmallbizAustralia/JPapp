<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Progress
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property int $week
 * @property string $photo
 */
class Progress extends Model
{
    use SoftDeletes;

    protected $fillable = ['week', 'photo'];

    /**
     * Scope a query to only include progress from given week.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $week
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfWeek($query, $week)
    {
        return $query->where('week', $week);
    }
}
