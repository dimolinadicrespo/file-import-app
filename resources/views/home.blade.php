@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}


                    <!-- Regular -->
                        <i class="far fa-user"></i>

                        <!-- Solid -->
                        <i class="fas fa-user"></i>

                        <!-- Brand -->
                        <i class="fab fa-dev"></i>

                        <i class="far fa-file"></i>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
