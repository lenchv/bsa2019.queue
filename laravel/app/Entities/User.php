<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticableContract;
use Illuminate\Auth\Authenticatable;

class User extends Model implements AuthenticableContract
{
    use Notifiable, Authenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function getKeyName()
    {
        return 'id';
    }
}
