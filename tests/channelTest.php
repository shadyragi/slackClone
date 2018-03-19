<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

use App\Channel;

class channelTest extends TestCase
{
	
    /**
     * A basic test example.
     *
     * @return void
     */
   	use DatabaseTransactions;

    public function test_user_can_create_channel() {
    	
    	$user = factory("App\User")->create();

    	$this->actingAs($user);


    	$user->channels()->create(["name" => "test"]);

    	$this->assertEquals(1, $user->channels()->count());

    }

    public function test_user_can_subscribe_to_channel() {

    	$user = factory("App\User")->create();

    	$channel = factory("App\User")->create();

    	$user->subscribe($channel->id);

    	$this->assertEquals(1, $user->subscriptions()->count());
    }
}
