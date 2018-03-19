<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ["user_id", "content"];

    protected $with = ["user"];


    protected static function boot() {
        parent::boot();

        static::deleting(function($post) {

            if($post->hasAttachment()) {
                
                $post->attachments()->delete();
            }

        });
    }

    public function user() {

	return $this->belongsTo("App\User");
    }

    public function attachments() {

    	return $this->hasOne("App\Attachment");
    }

    public function hasAttachment() {

    	$attachments = $this->attachments;

    	if(count($attachments) > 0) {
    		return true;
    	}

    	return false;

    }
}
