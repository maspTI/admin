@extends('layouts.dashboard.index')

@section('title', '| Criar Subdepartamento')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Criar Subdepartamento</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <create-update-subdepartment-component
                    url="/subdepartments"
                    http_verb="post"
                    :departments="{{ $departments }}"
                    message="Subdepartmento criado com sucesso!"
                ></create-update-subdepartment-component>
            </div>
        </div>
    </div>
</div>
@endsection
