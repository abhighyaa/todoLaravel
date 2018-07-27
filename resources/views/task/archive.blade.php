@extends('layouts.app')

@section('content')

        <div class="col-md-8" >
            <div class="card">
                <div class="card-header">Archived Tasks</div>

                <div class="card-body">
                    @if (count($tasks)>0)
                        @foreach ($tasks as $task)
                            <div class="task display">
                                <div hidden>{{$task->id}}</div>
                                <div class="row ml-2">
                                        <a href="/task/{{$task->id}}" id="title"><h3>
                                        <b>{{$task->task}}</b></h3></a>
                                        <div class="check ml-auto">
                                            @if($task->pin==1)
                                                <a href="/pin/{{$task->id}}"><img src="{{url('images/pinned.png')}}" alt="" width="40" height="40" class="mr-4"></a>
                                            @endif
                                            @if($task->status==1)
                                                <a href="/status/{{$task->id}}"><img src="{{url('images/finallydone.png')}}" alt="" width="30" height="30" class="mr-4"></a>  
                                            @endif
                                        </div>
                                        <div class="onhover ml-auto">
                                            @if($task->pin==1)
                                                <a href="/pin/{{$task->id}}"><img src="{{url('images/pinned.png')}}" alt="" width="40" height="40"></a>
                                            @else
                                                <a href="/pin/{{$task->id}}"><img src="{{url('images/pin1.png')}}" alt="" width="30" height="30"></a>
                                            @endif
                                            @if($task->status==1)
                                                <a href="/status/{{$task->id}}" class="undo"><img src="{{url('images/finallydone.png')}}" alt="undo" width="30" height="30"></a>  
                                            @else 
                                                <a href="/status/{{$task->id}}" class="do"><img src="{{url('images/done.png')}}" alt="do" width="30" height="30"></a>  
                                            @endif
                                                <a href="/unarchive/{{$task->id}}" class="archive"><img src="{{url('images/unarchive.png')}}" width="30" height="30"></a>
                                                <a href="#" class="deletetask"><img src={{url('images/delete.png')}} alt="" width="20" height="20"></a><div hidden>{{$task->id}}</div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row ml-2">
                                        {{$task->description}}
                                    </div>
                                        <br><br><br><hr><br>
                            </div>   
                        @endforeach
                    @else
                        No archived Tasks
                    @endif

                    <br>
                    
                        <a href="/home">{{ __('Go to home page') }}</a>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
