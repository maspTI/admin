@extends('layouts.dashboard.index')

@section('title', '| Usuários')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Usuários</h4>
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
