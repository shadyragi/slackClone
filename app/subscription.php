<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subscription extends Model
{
    //

    protected $fillable = ["channel_id", "user_id"];

    public function channel() {

    	return $this->belongsTo("App\Channel");
    }
}
