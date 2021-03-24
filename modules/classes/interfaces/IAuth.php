<?php

interface AuthInterface
{
    /**
	 * Registration user
	 * @param void
	 * @return registration.php if method GET and void if POST
	 */

    public function registration();

    /**
	 * Log in user
	 * @param void
	 * @return login.php if method GET and void if POST
	 */

    public function login();
}