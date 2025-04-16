@extends('errors.minimal')
@section('title', __('Database Connection Error'))
@section('code', '500')
@section('message', __('Database Connection Error Occurred please try again later'))
@section('image')
    <img src="{{ asset('images/database-connection.png') }}" alt="Database Error" width="400">
@endsection
