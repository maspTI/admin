@extends('layouts.dashboard.index')

@section('title', '| Usuarios')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Usuarios</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <index-users-component />
            </div>
        </div>
    </div>
</div>
@endsection
