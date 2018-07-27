@extends('layouts.app')

@section('content')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new Task</div>

                <div class="card-body">
                    <form method="POST" action="/task/{{$task->id}}/edit">
                        @csrf

                        <div class="form-group row">
                            <label for="task" class="col-md-4 col-form-label text-md-right">{{ __('Task') }}</label>

                            <div class="col-md-6">
                                <input id="task" type="text" value="{{$task->task}}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="text" type="description" name="description" >
                                    {{$task->description}}
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="due" class="col-md-4 col-form-label text-md-right">{{ __('Due date') }}</label>

                            <div class="col-md-6">
                                <input id="due" type="date" onfocus="today()" name="due" value="{{ $task->due }}" required>
                            </div>
                        </div>    

                        <!-- <div class="form-group row">
                            <label for="label" class="col-md-4 col-form-label text-md-right">{{ __('Labels') }}</label>

                            <div class="col-md-6">
                               
                                <select name="label" multiple>
                                    @foreach ($labels as $label)
                                        <option value="{{$label->id}}" >{{$label->label}}</option>
                                    @endforeach
                                    <hr>
                                </select>
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label for="priority" class="col-md-4 col-form-label text-md-right">{{ __('Priority') }}</label>

                            <div class="col-md-6">
                
                                <select name="priority" >
                                    <option value="0" {{ $task->priority == 0 ? 'selected' : '' }}>Normal</option>
                                    <option value="1"{{ $task->priority == 1 ? 'selected' : '' }}>Urgent</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                
                                <select name="status">
                                    <option value="0" {{ $task->priority == 0 ? 'selected' : '' }} >Not completed</option>
                                    <option value="1" {{ $task->priority == 1 ? 'selected' : '' }}>completed</option>
                                   
                                </select>
                            </div>
                        </div>           

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
@endsection
