<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestRequest extends Model
{
    protected $fillable = [
    	'user_id', 'subject', 'text', 'created_at', 'status', 'filename'
    ];
}
