<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model{

	protected $table = 'backend_article';

	protected $fillable = [
        'title','abstract','banner','author','content'
    ];

}