<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function weekly($type)
    {
        $contents = [];
        $title = '';
        switch ($type) {
            case 'overview':
                $contents = Content::weeklyOverview()->get();
                $title = 'Weekly Overview';
                break;
            case 'workout':
                $contents = Content::weeklyWorkout()->get();
                $title = 'Weekly Workouts';
                break;
            case 'training-split':
            case 'training_split':
                $contents = Content::weeklyTrainingSplit()->get();
                $title = 'Weekly Training Splits';
                break;
        }
        return view('admin.dashboard.weekly', compact('contents', 'title'));
    }

    public function weeklyEdit(Request $request, $id)
    {
        $content = Content::find($id);
        if ($content->type === 'meal_plan') {
            $redirect = route('admin.dash.mealPlan');
        } elseif ($content->type === 'recipe') {
            $redirect = route('admin.dash.recipes');
        } else {
            $redirect = route('admin.dash.weekly', ['type' => $content->type]);
        }

        if ($request->isMethod('post')) {
            // checkbox (published) if not ticked wont send any value, thus wont override existing value.
            $content->update(array_merge(['published' => 0], $request->all()));
            return redirect($redirect)->with('changes-saved', true);
        }

        return view('admin.dashboard.weekly-edit', compact('content', 'redirect'));
    }

    public function weeklyMealPlan()
    {
        $contents = Content::weeklyMealPlan()->get();
        return view('admin.dashboard.weekly-meal-plan', compact('contents'));
    }

    public function weeklyRecipes()
    {
        $contents = Content::weeklyRecipe()->get();
        return view('admin.dashboard.weekly-recipes', compact('contents'));
    }

    public function pageEdit(Request $request, $id)
    {
        $content = Content::find($id);
        switch ($content->type) {
            case 'education-nutrition':
            case 'education-training':
            case 'education-workout':
                $redirect = route('admin.dash.education');
                break;
            case 'exercise-demo':
                $redirect = route('admin.dash.exerciseDemo');
                break;
            case 'becoming-elite':
                $redirect = route('admin.dash.becomingElite');
                break;
        }

        if ($request->isMethod('post')) {
            // checkbox (published) if not ticked wont send any value, thus wont override existing value.
            $content->update(array_merge(['published' => 0], $request->all()));
            return redirect($redirect)->with('changes-saved', true);
        }

        return view('admin.dashboard.page-edit', compact('content', 'redirect'));
    }

    public function pageAdd(Request $request, $type)
    {
        $content = new Content();
        switch ($type) {
            case 'education':
                $redirect = route('admin.dash.education');
                break;
            case 'exercise-demo':
                $redirect = route('admin.dash.exerciseDemo');
                break;
            case 'becoming-elite':
                $redirect = route('admin.dash.becomingElite');
                break;
        }

        if ($request->isMethod('post')) {
            // checkbox (published) if not ticked wont send any value, thus wont override existing value.
            $content->create(array_merge(['published' => 0, 'type' => $type], $request->all()));
            return redirect($redirect)->with('changes-saved', true);
        }

        return view('admin.dashboard.page-add', compact('content', 'redirect', 'type'));
    }

    public function education()
    {
        $contents = Content::education()->get();
        return view('admin.dashboard.education', compact('contents'));
    }

    public function exerciseDemo()
    {
        $contents = Content::exerciseDemo()->get();
        return view('admin.dashboard.exercise-demo', compact('contents'));
    }

    public function becomingElite()
    {
        $contents = Content::becomingElite()->get();
        return view('admin.dashboard.becoming-elite', compact('contents'));
    }
}
