<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    /**
     * Get the user associated with the twwet.
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
