<?php

namespace App\Http\Controllers;

use Wallet\Models\Wallet;
use App\Http\Requests\WalletRequest;
use App\Services\Contract\WalletServiceInterface;
use Currency\Services\Contract\CurrencyServiceInterface;

class WalletController extends StateController
{
    protected const VIEW_PREFIX = 'wallet.';

    protected $currencyService;

    protected $walletService;

    public function __construct(
        CurrencyServiceInterface $currencyService,
        WalletServiceInterface $walletService
    )
    {
        parent::__construct();
        $this->currencyService = $currencyService;
        $this->walletService = $walletService;
    }

    public function index()
    {
        $wallets = $this->walletService->getUserWallets(auth()->id());
        return view(self::VIEW_PREFIX . __FUNCTION__, compact(
            'wallets'
        ));
    }

    public function create()
    {
        $types = $this->getTypes();
        $currencies = $this->currencyService->fetchAll();
        $currencies->prepend(['id' => 0, 'name' => '-- Select Currency --']);

        return view(self::VIEW_PREFIX . __FUNCTION__, compact(
            'types',
            'currencies'
        ));
    }

    public function store(WalletRequest $request)
    {
        $input = $request->all();
        $this->walletService->create($this->walletService->translateToWalletValueObject($input));
        return response()->json([
            'status' => 'success',
            'message' => 'Wallet Created'
        ], 201);
    }

    protected function getTypes(): array
    {
        return [
            [
                'value' => 0,
                'label' => '-- Select Type --',
            ],
            [
                'value' => Wallet::TYPE_CASH,
                'label' => 'Cash'
            ],
            [
                'value' => Wallet::TYPE_CREDIT_CARD,
                'label' => 'Credit Card'
            ]
        ];
    }
}
