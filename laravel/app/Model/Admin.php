<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable{

	protected $table = 'backend_admin';

	protected $fillable = [
        'name','password'
    ];
    protected $hidden = [
        'password'
    ];
}