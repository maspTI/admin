@extends('layouts.dashboard.index')

@section('title', '| Editar Departamento')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Editar Departamento</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <create-update-subdepartment-component
                    :departments="{{ $departments }}"
                    :subdepartment="{{ $subdepartment }}"
                    url="/subdepartments/{{ $subdepartment->id }}"
                    http_verb="put"
                    message="Subdepartamento atualizado com sucesso"
                ></create-update-subdepartment-component>
            </div>
        </div>
    </div>
</div>
@endsection
