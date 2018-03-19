<!DOCTYPE html>
<html lang="en">

<head>


    <title>Simple Sidebar - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <!--<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="/css/simple-sidebar.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper" class="toggled">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Start Bootstrap
                    </a>
                </li>
                <li>
                    <a href="/channels">All channels</a>
                </li>
                <li>
                    <a href="/createChannel">Create Channel</a>
                </li>

                <li>
                    <form method="GET", action="/channels/search">
                        {{csrf_field()}}
                    <input placeholder="search for Channel" type="text" name="search" class="form-control">
                        <input style="visibility: hidden;" type="submit" name="submit">
                     </form>
                </li>
                <li>
                    <h3>My Channels</h3>

                    @if(Auth::check()) 
                        @foreach(Auth::user()->channels()->withoutGlobalScopes()->get() as $channel)
                        <li><a href="{{$channel->path()}}">{{$channel->name}}</a></li>
                        @endforeach
                    
                </li>
                <li>
                    <h3>Subscribed Channels</h3>

                     @foreach(Auth::user()->subscriptions()->with("channel")->withoutGlobalScopes()->get() as $subscription)
                        <li><a href="{{$subscription->channel->path()}}">{{$subscription->channel->name}}</a></li>
                    @endforeach
                    @endif
                </li>

                   
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        
        <!-- /#page-content-wrapper -->

    </div>

    @yield('content')
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->


</body>

</html>
