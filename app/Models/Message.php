<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Message extends Model
{
    protected $fillable = ['user_id', 'test_request_id', 'text', 'created_at'];

    /**
    * Автор сообщения
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo;
    */
    public function user() {
    	return $this->belongsTo(User::class);
    }
}
