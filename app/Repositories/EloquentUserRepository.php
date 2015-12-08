<?php

namespace AC\Repositories;

use Illuminate\Contracts\Auth\Guard;

class EloquentUserRepository
{
    /**
     * @var Guard
     */
    private $auth;

    /**
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Get current user id if logged in or else get the ip.
     *
     * return string
     */
    public function getCurrentUserID()
    {
        $whitelist = ['127.0.0.1', '::1',];
        $user = $this->auth->user();
        $userID = '';
        if ($user) {
            $userID = $user->id;
        } elseif (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            $userID = $_SERVER['REMOTE_ADDR'];
        }

        return $userID;
    }
}
