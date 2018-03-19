<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    //
    protected $fillable = ["title", "type", "path"];


    public function isImage() {

    	if($this->type == "image") {
    		return true;
    	}
    	return false;
    }
}
