<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model{

	protected $table = 'backend_invite_code';

	protected $fillable = [
        'host','code'
    ];

}