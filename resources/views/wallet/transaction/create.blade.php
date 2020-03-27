@extends('layouts.app')

@section('content')
    <wallet-transaction-form
        v-bind:currencies="{{$currencies}}"
        v-bind:wallet="{{$wallet}}"
        v-bind:types="{{json_encode($types)}}"
    ></wallet-transaction-form>
@endsection
