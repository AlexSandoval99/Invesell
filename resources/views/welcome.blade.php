@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <p>Bienvenido al Sistema</p> @version('compact')
@stop
@section('footer')
   <div class="float-right d-none d-sm-block">
        <b>Version</b> @version('compact')       
    </div>
@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

@section('footer')
   <div class="float-right d-none d-sm-block">
        <b>Version</b> @version('compact')       
    </div>
@stop
