@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome back {{auth()->user()->name}}

                    <div class="row mt-4">
                        <div class="col-12">Your Balance {{$userBalance}} {{$systemCurrency->code}}</div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <a href="{{route('wallet.index')}}" class="btn btn-primary">
                                Wallets
                                <span class="badge badge-light">{{$walletsCount}}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
