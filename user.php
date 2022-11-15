<?php

class User{

    public string $id;

    public function __construct(

        public string $email,
        public string $password,
        public string $password2,
        public string $firstName,
        public string $lastName,
        public string $username

    )
    {
    }

    public function verify(): bool
    {
        $isValid = true;

        if ($this->email === '' || $this->firstName === '' || $this->lastName === '' || $this->username === '') {
        $isValid = false;
    }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $isValid = false;
        }

        if ($this->password === '' || $this->password === '' || $this->password != $this->password2) {
            $isValid = false;
        }

        return $isValid;
    }

}