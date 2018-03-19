<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Channel;

use Auth;

class channelController extends Controller
{
    //

    public function __construct() {

    	$this->middleware("auth", ["only" => ["create", "store"]]);
    }

    public function index() {

    	$channels = Channel::all();

    	return view("channels.index", ["channels" => $channels]);
    }

    public function create() {

    	return view("channel.create");
    }

    public function store(Request $request) {

    	
    	if (Auth::check()) {

    		$name = $request->channelName;

            $type = $request->type;

    		$channel = Auth::user()->channels()->create(["name" => $name, "type" => $type]);

    		$channel->subscribe();
    	}

    	return back();
    }

    public function show(Channel $channel) {

    	if(isset($channel))
    	{
    		if($channel->isSubscribed() AND Auth::check()) {

    			return view("channel.show", ['channel' => $channel]);
    		}
    	}
    }

    public function destroy(Channel $channel) {

    	if (isset($channel)) {

    		if($this->authorize("delete-channel", $channel)) {

    			$channel->delete();
    		}

    	}
    	return back();

    }

    public function search(Request $request) {

    	$search = $request->query()["search"];

    	$channels = Channel::where("name", "like", '%'.$search.'%')->withCount("subscriptions")->get();

    	return view("channel.index", ["channels" => $channels]);


    }


}
