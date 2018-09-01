<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sign extends Model{

	protected $table = 'backend_signs';

	protected $fillable = [
        'name','rsa_private_key','rsa_public_key','hash_key'
    ];

}