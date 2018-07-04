@extends('layouts.app')

@section('content')

        <div class="col-md-8" >
            <div class="card">
                <div class="card-header">Trashed Tasks</div>

                <div class="card-body">
                    Tasks will be deleted from here automatically within a week.
                    <br><br><hr><br>
                    @if (count($tasks)>0)
                        @foreach ($tasks as $task)
                            <div class="task">
                                <div class="row ml-2">
                                        <!-- <a href="/task/{{$task->id}}" id="title"><h3>
                                        <b>{{$task->task}}</b></h3></a> -->
                                        <h3 style="color:blue"><b>{{$task->task}}</b></h3>
                                        <div class="onhover ml-auto">
                                        
                                            <a href="/restore/{{$task->id}}" class="restore"><img src="{{url('images/restore.png')}}" width="30" height="30"></a>
                                            <a href="#" class="deletecompletely"><img src={{url('images/delete.png')}} alt="" width="20" height="20"></a>
                                            <div hidden>{{$task->id}}</div>
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
                        Empty Bin
                    @endif

                    <br><br><br>
                    
                        <a href="/home">{{ __('Go to home page') }}</a>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
