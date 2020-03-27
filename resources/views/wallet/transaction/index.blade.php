@extends('layouts.app')

@section('content')
    <wallet-transactions v-bind:wallet="{{$wallet}}" v-bind:transactions="{{$transactions}}"></wallet-transactions>
@endsection
