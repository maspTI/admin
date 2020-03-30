@extends('layouts.auth')

@section('title', ' | Departamento')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4>{{ __('Escolha seu Departamento') }}</h4>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <update-users-department-component :auth_user="{{ auth()->user() }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
