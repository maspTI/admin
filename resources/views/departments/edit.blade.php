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
                <create-update-department-component
                    :department="{{ $department }}"
                    url="/departments/{{ $department->id }}"
                    http_verb="put"
                    message="Departamento atualizado com sucesso"
                />
            </div>
        </div>
    </div>
</div>
@endsection
