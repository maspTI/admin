@extends('layouts.dashboard.index')

@section('title', '| Departamentos')

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Departamentos</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <index-departments-component />
            </div>
        </div>
    </div>
</div>
@endsection
