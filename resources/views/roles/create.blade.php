@extends('layouts.dashboard.index')

@section('title', '| Criar Funcao')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Criar Funcao</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <create-update-role-component
                    url="/roles"
                    http_verb="post"
                    message="Funcao criado com sucesso!"
                />
            </div>
        </div>
    </div>
</div>
@endsection
