<?php

class Book
{
    private $title;
    private $author;
    private $EAN;
    private $edition;
    private $publication;
    private $user;

    public function __construct(string $title, string $author, int $EAN, int $edition, string $publication, string $user)
    {
        $this->title = $title;
        $this->author = $author;
        $this->EAN = $EAN;
        $this->edition = $edition;
        $this->publication = $publication;
        $this->user = $user;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getEAN()
    {
        return $this->EAN;
    }

    public function getEdition()
    {
        return $this->edition;
    }

    public function getPublication()
    {
        return $this->publication;
    }

    public function getUser()
    {
        return $this->user;
    }
}