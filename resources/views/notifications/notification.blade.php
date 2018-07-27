@extends('layouts.app')

@section('content')

        <div class="col-md-8" >
            <div class="card">
                <div class="card-header">Notifications</div>

                <div class="card-body notifications">
                   @if (count($notifications)>0 ) 
                        @foreach ($notifications as $notification)
                            <div class="notification">
                                    @include ('notifications.'.class_basename($notification->type))
                                    <br><hr><br>
                            </div>
                        @endforeach
                        <!-- <form method="POST" action="/notifications">
                            @csrf
                            <button type="submit">Mark as Read</button>
                        </form> -->
                    @else
                        No new notifications :D 
                    @endif

                    <a href="#Old" class="old">
                       <br><br> See older notifications <hr> <br>
                    </a>
                    <div id="old">
                        @if (count(Auth::user()->readNotifications)>0 ) 
                            @foreach (Auth::user()->readNotifications as $notification)
                                <div class="notification">
                                        @include ('notifications.'.class_basename($notification->type))
                                        <br><hr><br>
                                </div>
                            @endforeach
                            
                        @else
                            No notifications :D 
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
