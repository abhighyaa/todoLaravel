@extends('layouts.app')

@section('content')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new Task</div>

                <div class="card-body">
                    <form method="POST" action="/task/create">
                        @csrf

                        <div class="form-group row">
                            <label for="task" class="col-md-4 col-form-label text-md-right">{{ __('Task') }}</label>

                            <div class="col-md-6">
                                <input id="task" type="text" class="form-control{{ $errors->has('task') ? ' is-invalid' : '' }}" name="task" value="{{ old('task') }}" required autofocus>

                                @if ($errors->has('task'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('task') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="text" type="description" name="description" value="{{ old('description') }}">
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="due" class="col-md-4 col-form-label text-md-right">{{ __('Due date') }}</label>

                            <div class="col-md-6">
                                <input id="due" type="date" onfocus="today()" class="today form-control{{ $errors->has('due') ? ' is-invalid' : '' }}" name="due" value="{{ old('due') }}" required>

                                @if ($errors->has('due'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('due') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>    

                        <div class="form-group row">
                            <label for="label" class="col-md-4 col-form-label text-md-right">{{ __('Label') }}</label>

                            <div class="col-md-6">
                                <select id="label" type="text" class="form-control" name="label[]" multiple >
                                
                                    @foreach ($labels as $label)
                                        <option value="{{$label->id}}">{{$label->label}}</option>
                                    @endforeach
                                    <hr>
                                    
                                </select>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="priority" class="col-md-4 col-form-label text-md-right">{{ __('Priority') }}</label>

                            <div class="col-md-6">
                                
                                <select name="priority">
                                    <option value="0" >Normal</option>
                                    <option value="1">Urgent</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                
                                <select name="status">
                                    <option value="0">Not completed</option>
                                    <option value="1">completed</option>
                                </select>
                            </div>
                        </div>           

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
@endsection
