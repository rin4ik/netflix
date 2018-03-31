<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;

class VideoUploadController extends Controller
{
    public function index()
    {
        $this->authorize('update', auth()->user());
        return view('video.upload');
    }

    public function store(StoreVideoRequest $request)
    {
        $uid = uniqid(true);
        $user = request()->user();
        $video = $user->videos()->create([
                'uid' => $uid,
                'url' => $request->url,
                'title' => $request->title,
                'description' => $request->description,
                'visibility' => $request->visibility,
                ]);
        return response()->json(null, 200);
    }
}
