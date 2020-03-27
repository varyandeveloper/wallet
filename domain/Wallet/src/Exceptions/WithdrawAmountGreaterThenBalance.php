<?php

namespace Wallet\Exceptions;

class WithdrawAmountGreaterThenBalance extends \Exception implements WalletExceptionInterface
{
    protected $message = 'Withdraw balance is greater then wallet balance';
}
