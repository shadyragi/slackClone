@extends("layouts.app")

@section('content')
	<div class="container" style="margin-left: 300px;">
	@if(count($channels) > 0)
		<div class="panel panel-default" style="width: 70%;">
		<ul style="list-style-type: none;">
			<div class="panel-heading">
				<h2>Channels</h2>
			</div>
			<hr>
			@foreach($channels as $channel)
					<div class="panel-body">	
						<li>
							<a href="{{$channel->path()}}"><h3 style="display: inline;">{{$channel->name}}</h3></a>
							<h4 style="display: inline;"><span style="color: grey;"> - {{$channel->created_at->diffForHumans()}}</span></h4>
							@if(Auth()->check())

							@if(!$channel->isSubscribed())
							<form method="POST", action="/subscribe/{{$channel->id}}">
								{{csrf_field()}}
							<input type="submit" name="submit" value="Subscribe" class="btn btn-primary" style="float: right;">
							</form>
							@else 

							<form method="POST", action="/unsubscribe/{{$channel->id}}">

								{{csrf_field()}}

								{{method_field("DELETE")}}

							<input type="submit" name="submit" value="unSubscribe" class="btn btn-default" style="float: right;">
							</form>
							@endif

							@can("delete-channel", $channel)
								<form method="POST" action="/channel/{{$channel->id}}">
										{{csrf_field()}}
										{{method_field("DELETE")}}
										<input type="submit" name="submit" value="Delete" class="btn btn-danger" style="float: right;">>
								</form>
							@endcan

							@endif
							<p style="">{{$channel->subscriptions_count}} {{str_plural('subscription', $channel->subscriptions_count)}}</p>
							 
						</li>
					</div>
			@endforeach
		</ul>
		</div>
	@else
		<h2>No Channels Found</h2>
	@endif
	</div>

@endsection