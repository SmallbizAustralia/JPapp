<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Progress as ProgressResource;
use Illuminate\Http\Request;

class ProgressesController extends ApiController
{
    const TYPE = 'progress';

    public function index(Request $request)
    {
        $user = $request->user();
        return ProgressResource::collection($user->progresses()->get());
    }

    public function uploadPhoto(Request $request, $week)
    {
        \Log::info($request->all());
        $user = $request->user();
        $progress = $user->progresses()->ofWeek($week)->first();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos');
            $progress->update(['photo' => $path]);
        }

        return new ProgressResource($progress);
    }
}
