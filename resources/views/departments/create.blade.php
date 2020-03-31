@extends('layouts.dashboard.index')

@section('title', '| Criar Departamento')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Criar Departamento</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <create-update-department-component />
            </div>
        </div>
    </div>
</div>
@endsection
