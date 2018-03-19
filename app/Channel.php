<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Builder;

use Auth;

class Channel extends Model
{
    //
    protected $fillable = ["name", "type"];

    protected static function boot() {

    	parent::boot();

       

    	static::deleting(function($channel) {

    		$channel->subscriptions()->delete();

            $channel->posts->each(function($post) {

                $post->delete();

            });

    	});
    }

    public function subscriptions() {

    	return $this->hasMany("App\subscription");
    }

    public function isSubscribed() {
    	
    	if($this->subscriptions()->where("user_id", Auth::user()->id)->first()) {
    		
    		return true;
    	}

    	return false;

    }

    public function path() {
    	
    	return "/channel/" . $this->id;
    }

    public function subscribe() {

        $this->subscriptions()->create(["user_id" => Auth::id()]);
    }

    public function unSubscribe() {

    	$this->subscriptions()->where("user_id", Auth::id())->delete();
    }

    public function posts() {

    	return $this->hasMany("App\Post", "channel_id", "id");
    }


}
