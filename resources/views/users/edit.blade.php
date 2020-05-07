@extends('layouts.dashboard.index')

@section('title', '| Editar Usuário')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Editar Usuário {{ $user->name }}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <create-update-users-component
                    :user="{{ $user }}"
                    :departments="{{ $departments }}"
                    :subdepartments_db="{{ $subdepartments }}"
                    :roles="{{ $roles }}"
                    url="/users/{{ $user->id }}"
                    http_verb="put"
                    message="Usuario atualizado com sucesso!"
                />
            </div>
        </div>
    </div>
</div>
@endsection
