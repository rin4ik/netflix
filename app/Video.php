<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uid',
        'url',
        'title',
        'description',
        'visibility',
        ];

    public function getRouteKeyName()
    {
        return 'uid';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function isPrivate()
    {
        return $this->visibility === 'private';
    }

    public function ownedByUser(User $user)
    {
        return $this->user->id === $user->id;
    }

    public function canBeAccessed($user = null)
    {
        if (!$user && $this->isPrivate()) {
            return false;
        }
        if ($user && $this->isPrivate() && ($user->id !== $this->user->id)) {
            return false;
        }
        return true;
    }

    public function getStreamUrl()
    {
        return $this->url;
    }

    public function getThumbnail()
    {
        $url = $this->url;
        $urls = explode('=', $url);

        $thumb1 = 'http://img.youtube.com/vi/' . $urls[1] . '/0.jpg';

        return $thumb1;
    }

    public function viewCount()
    {
        return $this->views->count();
    }
}
