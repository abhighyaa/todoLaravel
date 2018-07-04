@extends('layouts.app')

@section('content')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new Task</div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="/{{Auth::user()->id}}/label/create">
                        @csrf

                        <div class="form-group row">
                            <label for="label" class="col-md-4 col-form-label text-md-right">{{ __('Label') }}</label>

                            <div class="col-md-6">
                                <input id="label" type="text"  name="label" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" name="image">
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
