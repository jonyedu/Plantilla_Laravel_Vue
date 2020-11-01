@extends('layouts.app')
@section('contenido')
    <app :user="{{ json_encode(Auth::user()) }}"></app>
@endsection
