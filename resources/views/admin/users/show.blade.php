@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('User Information ') }} 
                    <a class="float-right btn btn-primary" href="{{ route('users.index') }}" title="Go back"> <i class="fas fa-backward "></i></a></div>
                
                

                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name :') }} <b>{{ $user->name }}</b></label>      
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address :') }} <b>{{ $user->email }}</b></label>
                        </div>


                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role :') }} <b>{{ $user->role }}</b></label>   
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
