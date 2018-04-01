<?php

namespace App\Http\Controllers;

use App\Video;

class VideoViewController extends Controller
{
    public function store(Video $video)
    {
        $video->views()->create([
            'user_id' => request()->user() ? request()->user()->id : null,
            'ip' => request()->ip()
        ]);
        return response()->json(null, 200);
    }
}
