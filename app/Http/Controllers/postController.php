<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Channel;

use App\Post;

use Auth;
class postController extends Controller
{
    //

	public function __construct() {
		$this->middleware("auth", ["only" => ["store"]]);
	}


    public function destroy(POST $post) {

        if(isset($post)) {
            if(Auth::user()->can("delete-post", $post)) {

             $post->delete();
         }
     }
        return back();
    }

    public function store(Request $request, Channel $channel) {

		$content = $request->content;

    		if(!isset($channel->posts)) {
    			$post = new Post;

    			$post->channel_id = $channel->id;

    			$post->user_id    = Auth::id();

    			$post->content    = $content;

    			$post->save();
    		}
    		else {
    			
    			$post = $channel->posts()->create(["user_id" => Auth::id(), "content" => $content]);

    			if($request->hasFile("attachment")) {

                    $attachment = $request->file("attachment");

    				if ($attachment->isValid()) {

    					
    				    
                        if($this->isImage($attachment->getClientOriginalName())) {

                            $path = $attachment->move("public/Attachments");

                            $type = "image";
                        }
                        else {

                            $attachTitle = $post->id . "-" . $attachment->getClientOriginalName();

                            $path = $attachment->move("public/Attachments", $attachTitle);

                            $type = "file";
                        }

    					$post->attachments()->create(["path" => $path, "title" => $attachment->getClientOriginalName(), "type" => $type]);

    					
    				}
    			}

    			
    		}

    		return back();

    }

    public function isImage($fileName) {

        $extension = substr($fileName, strrpos($fileName, "." ) + 1);
    
        $imageExtensions = ["jpg", "svg", "png", "gif", "bmp","jpeg"];

        if(in_array(strtolower($extension), $imageExtensions)) {
            return true;
        }

        return false;

    }


}
