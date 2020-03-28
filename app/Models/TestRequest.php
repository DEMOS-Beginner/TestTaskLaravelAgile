<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class TestRequest extends Model
{
	use softDeletes;
    protected $fillable = [
    	'user_id', 'subject', 'text', 'created_at', 'status', 'filename'
    ];


    /**
    * Автор заявки
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo;
    */
    public function user() {
    	return $this->belongsTo(User::class);
    }
}
