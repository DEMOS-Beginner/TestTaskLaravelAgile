<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestRequest extends Model
{
	use softDeletes;
    protected $fillable = [
    	'user_id', 'subject', 'text', 'created_at', 'status', 'filename'
    ];
}
