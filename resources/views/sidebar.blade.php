@extends('layouts.layout')

@section('title')
    Sidebar
@stop

@section('sidebar')
    This is sidebar of {{ $name }}
@stop

@section('content')
    @component('components.alert', ['foo' => 'bar'])
        @slot('title')
            <strong>Some thing wrong</strong>
        @endslot
        You are not allowed to do that
    @endcomponent
@stop

@for ($i = 0; $i < 10; $i++)
    <div>The current value is {{ $i }}</div>
@endfor

<form action="" method="post">
    @csrf
    @method('PUT')
    <input type="text">
    <input type="password" name="" id="">
</form>