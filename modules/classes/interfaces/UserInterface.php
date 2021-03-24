<?php

interface UserInterface
{
    /**
	 * Registration user
	 * @param void
	 * @return registration.php if method GET and void if POST
	 */

    public function registration();

    public function login();
}