<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\User;

class Message extends Model
{
    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
