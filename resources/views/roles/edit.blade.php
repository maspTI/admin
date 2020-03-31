@extends('layouts.dashboard.index')

@section('title', '| Editar Funcao')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Editar Funcao</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <create-update-role-component
                    :role="{{ $role }}"
                    url="/roles/{{ $role->id }}"
                    http_verb="put"
                    message="Funcao atualizada com sucesso!"
                />
            </div>
        </div>
    </div>
</div>
@endsection
