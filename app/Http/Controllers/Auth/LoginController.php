<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    protected const VALID_AUTH_DRIVERS = ['google', 'facebook'];

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param string $driver
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws AuthenticationException
     */
    public function redirectToProvider(string $driver)
    {
        $this->validateProvider($driver);
        return Socialite::driver($driver)->redirect();
    }

    /**
     * @param string $driver
     * @throws AuthenticationException
     */
    public function handleProviderCallback(string $driver)
    {
        $this->validateProvider($driver);
        $user = Socialite::driver($driver)->user();

        //TODO social login provider based coding
    }

    /**
     * @param string $provider
     * @throws AuthenticationException
     */
    protected function validateProvider(string $provider)
    {
        if (!in_array($provider , self::VALID_AUTH_DRIVERS)) {
            throw new AuthenticationException('Invalid Auth Provider: ' . $provider);
        }
    }
}
