@extends('layouts.dashboard.index')

@section('title', '| Criar Usuário')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Criar Usuário</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <create-update-users-component
                    :user="{{ $user }}"
                    url="/users/{{ $user->id }}"
                    http_verb="put"
                    message="Usuario atualizado com sucesso!"
                />
            </div>
        </div>
    </div>
</div>
@endsection
