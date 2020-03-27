<?php

namespace Wallet\Services;

use App\User;
use Wallet\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Wallet\Models\WalletTransaction;
use Wallet\ValueObjects\Transaction;
use Illuminate\Database\Eloquent\Collection;
use Wallet\Services\Contract\WalletServiceInterface;
use Wallet\Exceptions\WithdrawAmountGreaterThenBalance;
use Wallet\Services\Contract\WalletTransactionServiceInterface;

class WalletService implements WalletServiceInterface
{
    protected $walletModel;

    protected $currencyService;

    protected $walletTransactionService;

    public function __construct(
        Wallet $wallet,
        WalletTransactionServiceInterface $walletTransactionService
    )
    {
        $this->walletModel = $wallet;
        $this->walletTransactionService = $walletTransactionService;
    }

    public function transaction(Transaction $transaction)
    {
        $isDebit = $transaction->getType() == WalletTransaction::TYPE_DEBIT;

        try {
            DB::beginTransaction();
            /**
             * @var Wallet $wallet
             */
            $wallet = $this->walletModel::query()->find($transaction->getWalletId());

            if ($isDebit) {
                if ($transaction->getAmountInWalletCurrency() > $wallet->balance) {
                    throw new WithdrawAmountGreaterThenBalance;
                }
                $transaction->setAmountInWalletCurrency($transaction->getAmountInWalletCurrency() * -1);
            }

            $this->walletTransactionService->create([
                'wallet_id' => $transaction->getWalletId(),
                'currency_id' => $transaction->getCurrencyId(),
                'amount' => $transaction->getAmount(),
                'type' => $transaction->getType(),
                'transaction_date' => $transaction->getTransactionDate()
            ]);

            $wallet->balance = $wallet->balance + $transaction->getAmountInWalletCurrency();
            $wallet->save();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function create(\Wallet\ValueObjects\Wallet $wallet): int
    {
        try {
            DB::beginTransaction();
            User::identifier($wallet->getUserId())->update(['has_wallet' => true]);
            $wallet = $this->walletModel::query()->create([
                'user_id' => $wallet->getUserId(),
                'currency_id' => $wallet->getCurrencyId(),
                'balance' => 0.0,
                'type' => $wallet->getType(),
                'name' => $wallet->getName(),
            ]);
            DB::commit();
            return $wallet->id;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getWallet(int $walletId): ?Wallet
    {
        return $this->walletModel
            ->identifier($walletId)
            ->first()
        ;
    }

    public function getUserWallets(int $userId): Collection
    {
        return $this->walletModel
            ->ownedBy($userId)
            ->with(['currency'])
            ->withCount(['transactions'])
            ->get()
        ;
    }

    public function getUserBalance(int $userId): float
    {
        return $this->walletModel->sumBalance();
    }
}
