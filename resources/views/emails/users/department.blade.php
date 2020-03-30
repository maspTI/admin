@component('mail::message')
<h4>Olá!</h4>

<p>O usuário {{ $user->name }} escolheu o departamento {{ $user->department->name }}.</p>

<p>Clique no link abaixo para validar a escolha e libierar o acesso deste usuário.</p>

@component('mail::button', ['url' => "/verify/{$user->id}/department"])
Validar Escolha
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
