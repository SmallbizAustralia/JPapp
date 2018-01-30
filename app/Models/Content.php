<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Content
 * @package App\Models
 *
 * @property int $id
 * @property string $type `overview` | `workout` | `training_split` | `recipe` | `meal_plan` | 
 *                        `education-nutrition` | `education-training` | `education-workout` |
 *                        `exercise-demo` | `becoming-elite`
 * @property int $week
 * @property int $day
 * @property string $title
 * @property string $content
 * @property string $source Path or URL of remote content like video links
 * @property string $source_type `video` | `image`
 * @property string $preview Path or URL of page/video preview.
 * @property boolean $published
 */
class Content extends Model
{
    use SoftDeletes;

    protected $casts = [
        'published' => 'boolean',
    ];

    protected $fillable = ['type', 'week', 'day', 'title', 'content', 'source', 'source_type', 'preview', 'published'];

    /**
     * Scope a query to only include content from given week.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $week
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfWeek($query, $week)
    {
        return $query->where('week', $week);
    }

    /**
     * Scope a query to only include content from given day.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $day
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfDay($query, $day)
    {
        return $query->where('day', $day);
    }

    /**
     * Scope a query to only include weekly overviews.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWeeklyOverview($query)
    {
        return $query->whereType('overview');
    }

    /**
     * Scope a query to only include weekly training splits.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWeeklyTrainingSplit($query)
    {
        return $query->whereType('training_split');
    }

    /**
     * Scope a query to only include weekly workouts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWeeklyWorkout($query)
    {
        return $query->whereType('workout');
    }

    /**
     * Scope a query to only include weekly recipes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWeeklyRecipe($query)
    {
        return $query->whereType('recipe');
    }

    /**
     * Scope a query to only include weekly meal plans.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWeeklyMealPlan($query)
    {
        return $query->whereType('meal_plan');
    }

    /**
     * Scope a query to only include published contents.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->wherePublished(1);
    }

    /**
     * Scope a query to only include education content.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
     public function scopeEducation($query)
     {
         return $query->whereIn('type', ['education-nutrition', 'education-training', 'education-workout']);
     }

    /**
     * Scope a query to only include exercise demo content.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExerciseDemo($query)
    {
        return $query->whereType('exercise-demo');
    }

    /**
     * Scope a query to only include becoming elite content.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBecomingElite($query)
    {
        return $query->whereType('becoming-elite');
    }
}
