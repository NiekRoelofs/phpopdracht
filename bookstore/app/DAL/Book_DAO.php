<?php
require_once "IBase_DAO.php";
class Book_DAO implements IBase_DAO
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAll()
    {
        $books = [];
        //use inner join to get username who added the book
        $this->db->query("SELECT title, author, EAN, edition, publication, username FROM books JOIN users ON books.user_id = users.id");
        $result = $this->db->resultSet();

        foreach ($result as $book) {
            $b = new Book($book->title, $book->author, $book->EAN, $book->edition, $book->publication, $book->username);
            array_push($books, $b);
        }

        return $books;
    }

    public function getById(int $id)
    {
        $book = null;
        $this->db->query("SELECT * FROM books WHERE id = :id");
        $this->db->bind(":id", $id);
        $book = $this->db->single();
        $b = new Book($book->title, $book->author, $book->EAN, $book->edition, $book->publication);

        return $b;
    }

    public function create($data)
    {
        $this->db->query("INSERT INTO books (title, author, EAN, edition, publication, user_id)
                                VALUES (:title, :author, :EAN, :edition, :publication, :user_id);");
        $this->db->bind(":title", $data["title"]);
        $this->db->bind(":author", $data["author"]);
        $this->db->bind(":EAN", $data["EAN"]);
        $this->db->bind(":edition", $data["edition"]);
        $this->db->bind(":publication", $data["publication"]);
        $this->db->bind(":user_id", $data["user"]);
        $this->db->execute();
    }

    public function delete($ean)
    {
        $this->db->query("DELETE FROM books WHERE ean = :ean");
        $this->db->bind(":ean", $ean);
        $this->db->execute();
    }
}