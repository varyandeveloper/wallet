<?php

namespace App\Http\Controllers;

use Wallet\Services\Contract\WalletServiceInterface;

class HomeController extends StateController
{
    protected $walletService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(WalletServiceInterface $walletService)
    {
        parent::__construct();
        $this->middleware('auth');
        $this->walletService = $walletService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $walletsCount = auth()->user()->wallets()->count();
        $userBalance = $this->walletService->getUserBalance(auth()->id());

        return view('home', compact(
            'walletsCount',
            'userBalance'
        ));
    }
}
