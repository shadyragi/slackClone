<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Channel;

use Auth;
class subscriptionsController extends Controller
{
    //
    public function store(Channel $channel) {

    	if (isset($channel)) {

    		$channel->subscriptions()->create(['user_id' => Auth::user()->id]);
    	}

    	return back();
    }

    public function destroy(Channel $channel) {	
    

    	if (isset($channel)) {

    		$channel->subscriptions()->where("user_id", Auth::user()->id)->delete();
    	}
    	return back();
    }
    
}
