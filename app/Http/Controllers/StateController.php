<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Currency\Services\Contract\CurrencyServiceInterface;

abstract class StateController extends Controller
{
    protected $systemCurrency;

    public function __construct()
    {
        $this->systemCurrency = cache()->remember('systemCurrency', 600, function () {
            return $this->getCurrencyService()->getDefaultCurrency();
        });
        view()->share(['systemCurrency' => $this->systemCurrency]);
    }

    protected function buildForbiddenResponse()
    {
        if (!request()->ajax()) {
            abort(403);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Your are not allowed to do this action'
        ], Response::HTTP_FORBIDDEN);
    }

    protected function getCurrencyService(): CurrencyServiceInterface
    {
        return app(CurrencyServiceInterface::class);
    }
}
