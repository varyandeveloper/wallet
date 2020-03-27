@extends('layouts.app')

@section('content')
    <wallet-form v-bind:types="{{json_encode($types)}}" v-bind:currencies="{{$currencies}}"></wallet-form>
@endsection
