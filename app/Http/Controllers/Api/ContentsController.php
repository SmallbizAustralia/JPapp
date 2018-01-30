<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Transformers\ContentTransformer;
use App\Http\Resources\Content as ContentResource;
use App\Models\Content;

class ContentsController extends ApiController
{
    const TYPE = 'contents';

    public function weeklyOverview($week)
    {
        $content = Content::published()->weeklyOverview()->ofWeek($week)->first();
        return new ContentResource($content ?: new Content);
    }

    public function weeklyTrainingSplit($week)
    {
        $content = Content::published()->weeklyTrainingSplit()->ofWeek($week)->first();
        return new ContentResource($content ?: new Content);
    }

    public function weeklyWorkouts($week, $day)
    {
        $content = Content::published()->weeklyWorkout()->ofWeek($week)->ofDay($day)->first();
        return new ContentResource($content ?: new Content);
    }

    public function weeklyRecipes($week)
    {
        $content = Content::published()->weeklyRecipe()->ofWeek($week)->get();
        return ContentResource::collection($content ?: new Content);
    }

    public function weeklyMealPlan($week)
    {
        $content = Content::published()->weeklyMealPlan()->ofWeek($week)->get();
        return ContentResource::collection($content ?: new Content);
    }

    public function education($type)
    {
        $type = 'education-' . $type;
        $content = Content::published()->education()->whereType($type)->get();
        return ContentResource::collection($content ?: new Content);
    }

    public function exerciseDemos()
    {
        $content = Content::published()->exerciseDemo()->get();
        return ContentResource::collection($content ?: new Content);
    }

    public function elite()
    {
        $content = Content::published()->becomingElite()->get();
        return ContentResource::collection($content ?: new Content);
    }
}
