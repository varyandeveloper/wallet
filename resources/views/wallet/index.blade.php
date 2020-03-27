@extends('layouts.app')

@section('content')
    <wallets v-bind:wallets="{{$wallets}}"></wallets>
@endsection
