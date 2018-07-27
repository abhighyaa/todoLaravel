<!-- @extends('layouts.app') -->

@section('content')

        <div class="col-md-8" >
            <div class="card">
                <div class="card-header">Tasks</div>

                <div class="card-body">
                    @if (count($searchedTasks)>0)
                        @foreach ($searchedTasks as $searchedTask)
                            <div class="task display">
                                <a href="/task/{{$searchedTask->id}}"><h3><b>{{$searchedTask->task}}</b></h3></a><br>
                                {{$searchedTask->description}}
                                <br><br><br><hr><br>
                            </div> 
                         
                        @endforeach

                    @else
                        No tasks to display.    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
