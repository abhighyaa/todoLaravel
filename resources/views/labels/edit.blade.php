@extends('layouts.app')

@section('content')

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Labels') }}</div>

                <div class="card-body">
                    <form method="POST" action="/label/edit">
                        @csrf

                        <div class="form-group row justify-content-center">

                            <div class="col-md-6">
                                <a href="/task/create"><img src={{url("images/images.png")}} width="20" height="20"></a> &nbsp;&nbsp;&nbsp;&nbsp;
                                Add a new label<br><br> 
                            </div>
                
                        </div>

                        <hr>

                        @foreach ($labels as $label)
                            <div class="form-group row justify-content-center">
                                <div class="col-md-6">
                                <a href="#" class="delete"><img src={{url('images/delete.png')}} alt="" width="20" height="20"></a>
                                &nbsp;&nbsp;&nbsp;
                                <div class="del"> {{$label->label}}</div>
                                &nbsp;&nbsp;&nbsp;
                                <a href="#" class="editlab"><img src={{url('images/edit.png')}} alt="" width="20" height="20"></a>
                                <br><br>
                                </div>
                            </div> 

                        @endforeach
                        
                            

                        <hr>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Done') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
@endsection
