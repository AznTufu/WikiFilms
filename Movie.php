<?php

class Movie{

    public string $id;

    public function __construct(

        public int $movie_id,
        public int $album_id
    )
    {
    }

    public function verify(): bool
    {
        $isValid = true;

        if ($this->movie_id == Null || $this->album_id == Null ) {
            $isValid = false;
        }

        return $isValid;
    }

}