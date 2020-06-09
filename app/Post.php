<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;

class Post extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }
}
