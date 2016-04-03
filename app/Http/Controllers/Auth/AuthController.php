<?php

namespace AC\Http\Controllers\Auth;

use AC\Http\Controllers\Controller;
use AC\Models\Meta;
use AC\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $username = 'username';

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    protected $redirectPath = '/dashboard';

    /**
     * @var Meta
     */
    private $meta;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Meta $meta)
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'getLogout']);
        $this->meta = $meta;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        $this->data['meta'] = $this->meta->whereRoute('/')->orderBy('route')
            ->firstOrFail(['title', 'keywords', 'description']);
        return view('app.auth.register', $this->data);
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        $this->data['meta'] = $this->meta->whereRoute('/')->orderBy('route')
            ->firstOrFail(['title', 'keywords', 'description']);
        return view('app.auth.login', $this->data);
    }
}
