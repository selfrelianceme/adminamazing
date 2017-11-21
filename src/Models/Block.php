<?php

namespace Selfreliance\adminamazing\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
	public $timestamps = false;

    protected $fillable = [
    	'view', 'posX', 'posY', 'sort', 'width', 'height'
    ];
}