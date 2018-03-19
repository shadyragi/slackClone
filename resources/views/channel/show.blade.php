@extends("layouts.app")

@section("content")
	
		<div class="container" style= " margin-left: 250px; overflow: scroll; width: 80%;  height: 600px;">
				@if($channel->posts->count() > 0)
				@foreach($channel->posts as $post)

				<div class="row" style="padding-top: 50px; padding-left: 10px;">

						<img style="float: left; width: 60px; height: 60px;" src="http://placehold.it/100/100">

						<div style="margin-left: 70px;">

						<h4 style="display: inline;">{{$post->user->name}}</h4>

						<span style="color: grey;"> - {{$post->created_at->diffForHumans()}}</span>
						@can("delete-post", $post)
						<form method="POST" action="/post/{{$post->id}}">
							{{method_field("DELETE")}}
							{{csrf_field()}}
							<button  style=" display: inline; float: right;" class="btn btn-danger">Delete</button>
						</form>
						@endcan
						<p>{{$post->content}}</p>

						@if($post->hasAttachment()) 

							@if($post->attachments->type == "image")

							<img style="width: 300px; height: 300px;" src="/{{$post->attachments->path}}">
							
							@else
							
							<div class="container">
									<strong>{{$post->attachments->title}}</strong>
									
									<a href="/{{$post->attachments->path}}" style="margin-left: 5px;" class="btn btn-primary"> Download</a>
							</div>
							@endif
						@endif
						</div>

				</div>
				@endforeach
				@else
				<h3>No Posts In Channel</h3>
				@endif

				
				</div>
	

		<form method="POST" action="/post/{{$channel->id}}" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="form-group" style="margin-left: 250px; width: 80%;">
				
					<div class="form-group"><input type="file" name="attachment"></div>
			<input style="font-family: bold; font-size: larger;" placeholder="Type Your Message" type="text" name="content" class="form-control">
			
			<input type="submit" name="submit" style="visibility: hidden;">>
			</div>
		</form>

@endsection