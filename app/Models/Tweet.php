<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tweet extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
    ];

    /**
     * Get the user associated with the twwet.
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function retweet()
    {
        return $this->belongsTo(Tweet::class, 'retweets', 'uuid');
    }

    public function comment()
    {
        return $this->hasOne(Tweet::class, 'uuid', 'comments');
    }

    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'tweet_uuid', 'uuid');
    }

    public function AnalyticsBy(User $user)
    {
        return $this->Analytics->contains('user_id', $user->id);
    }

    public function Analytics()
    {
        return $this->hasMany(Analytic::class, 'tweet_uuid', 'uuid');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'tweet_uuid', 'uuid');
    }
}
