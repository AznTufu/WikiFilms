<?php

class Album{

    public string $id;

    public function __construct(

        public string $name,
        public string $description,
        public bool $private,
        public int $user_id

    )
    {
    }

    public function verify(): bool
    {
        $isValid = true;

        if ($this->name === '' || $this->private === '' || $this->user_id === '') {
            $isValid = false;
        }

        return $isValid;
    }

}