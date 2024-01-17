<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Admin extends User
{
    use HasFactory;

    protected $fillable = [
        'admin_number',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function username()
    {
        return 'admin_number';
    }
}
