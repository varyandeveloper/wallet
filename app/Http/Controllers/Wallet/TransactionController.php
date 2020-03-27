<?php

namespace App\Http\Controllers\Wallet;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Wallet\Models\WalletTransaction;
use App\Http\Requests\TransactionRequest;
use App\Http\Controllers\StateController;
use Wallet\Exceptions\WalletExceptionInterface;
use App\Services\Contract\WalletServiceInterface;
use Currency\Services\Contract\CurrencyServiceInterface;
use Wallet\Services\Contract\WalletTransactionServiceInterface;

class TransactionController extends StateController
{
    protected const VIEW_PREFIX = 'wallet.transaction.';

    protected $walletService;

    protected $currencyService;

    protected $walletTransactionService;

    public function __construct(
        WalletServiceInterface $walletService,
        CurrencyServiceInterface $currencyService,
        WalletTransactionServiceInterface $walletTransactionService
    )
    {
        parent::__construct();
        $this->walletService = $walletService;
        $this->currencyService = $currencyService;
        $this->walletTransactionService = $walletTransactionService;
    }

    public function index(int $walletId)
    {
        $wallet = $this->walletService->getWallet($walletId);

        if (!Gate::allows('wallet-owner', $wallet)) {
            return $this->buildForbiddenResponse();
        }

        $transactions = $this->walletTransactionService->getWalletTransactions($walletId);
        return view(self::VIEW_PREFIX . __FUNCTION__, compact(
            'transactions',
            'wallet'
        ));
    }

    public function create(int $walletId)
    {
        $wallet = $this->walletService->getWallet($walletId);

        if (!Gate::allows('wallet-owner', $wallet)) {
            return $this->buildForbiddenResponse();
        }

        $currencies = $this->currencyService->fetchAll();
        $types = $this->getTypes();
        $currencies->prepend(['id' => 0, 'name' => '-- Select Currency --']);
        return view(self::VIEW_PREFIX . __FUNCTION__, compact(
            'currencies',
            'wallet',
            'types'
        ));
    }

    public function store(int $walletId, TransactionRequest $request)
    {
        $code = Response::HTTP_INTERNAL_SERVER_ERROR;
        $response = ['status' => 'error'];
        $wallet = $this->walletService->getWallet($walletId);

        if (!Gate::allows('wallet-owner', $wallet)) {
            return $this->buildForbiddenResponse();
        }

        try {
            $transactionValueObject = $this->walletService->translateToTransactionValueObject($request->merge(['wallet_id' => $walletId])->all());
            $this->walletService->transaction($transactionValueObject);
            $code = Response::HTTP_OK;
            $response = ['status' => 'success', 'message' => 'Transaction registered successfully.'];
        } catch (WalletExceptionInterface $e) {
            $code = Response::HTTP_BAD_REQUEST;
            $response['message'] = $e->getMessage();
        } catch (\Throwable $e) {
            $response['message'] = 'Server Side Error.';
        }

        return response()->json($response, $code);
    }

    protected function getTypes(): array
    {
        return [
            [
                'value' => 0,
                'label' => '-- Select Type --',
            ],
            [
                'value' => WalletTransaction::TYPE_CREDIT,
                'label' => 'Credit'
            ],
            [
                'value' => WalletTransaction::TYPE_DEBIT,
                'label' => 'Debit'
            ]
        ];
    }
}
