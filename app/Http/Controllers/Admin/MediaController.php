<?php

namespace App\Http\Controllers\Admin;

use App\Models\Content;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $files = Media::all();
        return view('admin.media.index', compact('files'));
    }

    public function store(Request $request)
    {
        if ($request->file('media')->isValid()) {
            $path = $request->file('media')->store('media');
            Media::create([
                'type' => $request->file('media')->getClientMimeType(),
                'name' => $request->file('media')->getClientOriginalName(),
                'description' => $request->input('description'),
                'source' => Storage::url($path),
            ]);
            return redirect()->route('admin.media')->with('media-uploaded', true);
        }
        return redirect()->route('admin.media');
    }
}
