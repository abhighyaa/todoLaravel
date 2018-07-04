@extends('layouts.app')

@section('content')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tasks</div>

                <div class="card-body">
                  
                       <div class="task">
                            <h3><b>Task Name : {{$task->task}}</b></h3><hr>
                            Task description : {{$task->description}}
                            <br>
                            Task Duedate : {{$task->due}}
                            <br>
                            Task Label : {{$task->label}}
                            <br>
                            Task priority : {{$priority}}
                            <br><br>
                            <form method="GET" action="/task/{{$task->id}}/edit">
                                @csrf
                                <div class="form-group row mb-0">
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Edit') }}
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="/home">{{ __('See all') }}</a>
                                    </div>
                                </div>
                            </form>
                        
                                   
                        </div>
                   
                </div>
            </div>
        </div>
    
@endsection
