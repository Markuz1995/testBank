<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends authenticatable
{
    use HasFactory;

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
