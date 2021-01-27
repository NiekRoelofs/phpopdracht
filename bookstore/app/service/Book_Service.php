<?php

class Book_Service
{
    private $book_dao;

    public function __construct()
    {
        $this->book_dao = new Book_DAO();
    }

    public function getAllBooks()
    {
        return $this->book_dao->getAll();
    }

    public function getBookById(int $id)
    {
        return $this->book_dao->getById($id);
    }

    public function createBook($book)
    {
        $this->book_dao->create($book);
    }

    public function deleteBook($EAN)
    {
        $this->book_dao->delete($EAN);
    }
}