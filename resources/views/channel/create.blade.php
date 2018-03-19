@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create New Channel</div>

                <div class="panel-body">
                	<form method="POST" action="/channel">
                			{{csrf_field()}}
              				<div class="form-group">
              						<label>Name: </label>
              						<input type="text" name="channelName" class="form-control">
                          <label>Type: </label>
                          <select name="type" class="form-control">
                            <option value="public">Public</option>
                            <option value="private">Private</option>
                          </select>
              						<input type="submit" name="submit" class="btn btn-primary">
              				</div>
                	</form>>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection