<?php

namespace App\Auth;

interface AuthInterface
{
    public function attempt(string $login, string $password): bool;

}