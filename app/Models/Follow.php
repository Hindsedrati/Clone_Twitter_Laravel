<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = [
        'follower_user_id',
        'followed_user_id'
    ];

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_user_id');
    }

    public function followed()
    {
        return $this->belongsTo(User::class, 'followed_user_id');
    }

    public function follower_user()
    {
        return $this->hasOne(User::class, 'id', 'follower_user_id');
    }

    public function followed_user()
    {
        return $this->hasOne(User::class, 'id', 'followed_user_id');
    }
}
