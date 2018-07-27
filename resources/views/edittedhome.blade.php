@extends('layouts.app')

@section('content')

        <div class="col-md-8" >
            <div class="card">
                <div class="card-header">Tasks</div>

                <div class="card-body">
                    @if (count($tasks)>0)
                        @foreach ($tasks as $task)
                            <div class="task display">
                            <div hidden>{{$task->id}}</div>
                                <div class="row ml-2">
                                        <a href="/task/{{$task->id}}" id="title"><h3>
                                        <b>{{$task->task}}</b></h3></a>
                                        <div class="check strike ml-auto">
                                            @if($task->pin==1)
                                                <a href="/pin/{{$task->id}}"><img src="{{url('images/pinned.png')}}" alt="" width="40" height="40" class="mr-4"></a>
                                            @endif
                                            @if($task->status==1)
                                                <a href="/status/{{$task->id}}" ><img class="undo" src="/images/finallydone.png" alt="" width="30" height="30" class="mr-4"></a>  
                                                <div hidden>{{$task->id}}</div>
                                            @endif
                                        </div>
                                        <div class="onhover strike ml-auto">
                                            @if($task->pin!=1)
                                                <!-- <a href="/pin/{{$task->id}}"><img src="{{url('images/pinned.png')}}" alt="" width="40" height="40"></a>
                                            @else -->
                                                <a href="/pin/{{$task->id}}"><img src="{{url('images/pin1.png')}}" alt="" width="30" height="30"></a>
                                            @endif
                                            @if($task->status==1)
                                                <a href="/status/{{$task->id}}" ><img  class="undo" src="/images/finallydone.png" alt="undo" width="30" height="30"></a>  
                                            @else 
                                                <a href="/status/{{$task->id}}" ><img class="do" src="/images/done.png" alt="do" width="30" height="30"></a>  
                                            @endif
                                                <div hidden>{{$task->id}}</div>
                                                @if($task->archived==0)
                                                <a href="/archive/{{$task->id}}" class="archive"><img src="{{url('images/archive.png')}}" width="30" height="30"></a>
                                                @else
                                                    <a href="/unarchive/{{$task->id}}" class="unarchive"><img src="{{url('images/unarchive.png')}}" width="30" height="30"></a>
                                                @endif  
                                            <div hidden>{{$task->id}}</div>  

                                                <a href="#" class="deletetask"><img src={{url('images/delete.png')}} alt="" width="20" height="20"></a>
                                                <div hidden>{{$task->id}}</div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row ml-2">
                                        {{$task->description}}
                                    </div>
                                        <br>
                                        <!-- <div class="ml-2" style="display:inline-block">
                                            @if ($task->label != null)
                                            <div class="labelshow ml-2" style="display:inline-block">
                                                <span>{{$task->label}} &nbsp;&nbsp;&nbsp;</span>
                                                <span class="close">&times;</span>
                                                <div hidden>{{$task->id}}</div>
                                            </div>
                                            @endif
                                        </div> -->

                                        @foreach ($task->labels as $label)
                                        <div class="ml-1" style="display:inline-block">
                                            @if ($label != null)
                                            <div class="labelshow ml-2" style="display:inline-block">
                                                <span>{{$label->label}} &nbsp;</span>
                                                <span class="close">&times;</span>
                                                <div hidden>{{$task->id}}</div>
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                        <div class="ml-3" style="display:inline-block" >
                                            @if (count($labels)!=count($task->labels))
                                                <button type="button" class="addlabel"><img src="{{url('/images/image1.png')}}" alt="" width="20" height="20"> Add Label</button>
                                            @endif
                                            <div class="toadd">
                                                @foreach ($labels as $label)
                                                        @php $found=0 @endphp
                                                        @if(!empty($task->labels))
                                                            @foreach($task->labels as $thislabel)                                                         
                                                                @if ($thislabel->label == $label->label)
                                                                    @php $found = 1 @endphp
                                                                    @break
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                        @if ($found==0)
                                                        &nbsp;<input type="checkbox" value="{{$label->id}}" class="toaddcheck">{{$label->label}}&nbsp;
                                                        <div hidden>{{$task->id}}</div>
                                               
                                                        @endif

                                                    @endforeach
                                               
                                            </div>
                                            
                                        </div>
                                        
                                        <br><hr><br>
                            </div><div hidden>{{$task->id}}</div>   
                        @endforeach
                    @else
                        No tasks
                        <a href="/task/create">Add some here..</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
