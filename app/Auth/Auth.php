<?php

namespace App\Auth;

use App\Database\DatabaseInterface;

class Auth implements AuthInterface
{
    public function __construct(
        private DatabaseInterface $db
    )
    {

    }

    public function attempt(string $login, string $password): bool
    {
        $user = $this->db->first('users',[
            'login' => $login
        ]);
        if (!$user)
        {
            return false;
        }
        if (! password_verify($password, $user['password'])) {
            return false;
        }
        return true;
    }
}