<?php

class Books extends Controller
{
    private $bookService;

    public function __construct()
    {
        $this->bookService = $this->service("Book_Service");
    }

    public function index()
    {
        $books = $this->bookService->getAllBooks();

        $data = [
            "books" => $books,
        ];

        $this->view("books/index", $data);
    }

    public function addbook()
    {
        $data = [
            "titleError" => "",
            "authorError" => "",
            "EANError" => "",
            "editionError" => "",
            "publicationError" => ""
        ];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "title" => trim($_POST["title"]),
                "author" => trim($_POST["author"]),
                "EAN" => trim($_POST["EAN"]),
                "edition" => trim($_POST["edition"]),
                "publication" => trim($_POST["publication"]),
                "user" => "",
                "titleError" => "",
                "authorError" => "",
                "EANError" => "",
                "editionError" => "",
                "publicationError" => ""
            ];

            $charValidation = "/^[a-zA-Z0-9]*$/";
            $numberValidation = "/^[0-9]*$/";
            //check if all input fields are correct
            if(empty($data["title"])) {
                $data["titleError"] = "Please enter a title.";
            } elseif (!preg_match($charValidation, $data["title"])) {
                $data["titleError"] = "Title can only contain letters and numbers.";
            }

            if(empty($data["author"])) {
                $data["authorError"] = "Please enter an author.";
            } elseif (!preg_match($charValidation, $data["author"])) {
                $data["authorError"] = "Author can only contain letters and numbers.";
            }

            if(empty($data["EAN"])) {
                $data["EANError"] = "Please enter a EAN.";
            } elseif (!preg_match($numberValidation, $data["EAN"])) {
                $data["EANError"] = "EAN can only contain numbers.";
            }

            if(empty($data["edition"])) {
                $data["editionError"] = "Please enter a edition.";
            } elseif (!preg_match($numberValidation, $data["edition"])) {
                $data["editionError"] = "Edition can only contain numbers.";
            }

            if(empty($data["publication"])) {
                $data["publicationError"] = "Please enter a publication.";
            } elseif (!preg_match($charValidation, $data["publication"])) {
                $data["publicationError"] = "Publication can only contain letters and numbers.";
            }


            if(empty($data["titleError"]) && empty($data["authorError"]) && empty($data["EANError"]) &&
                empty($data["editionError"]) && empty($data["publicationError"])){
                $data["user"] = $_SESSION["user_id"];
                $this->bookService->createBook($data);
                header("location: " . URLROOT . "/books/index");
            } else {
                $this->view("books/addbook", $data);
            }
        }
        $this->view("books/addbook", $data);
    }

    public function deletebook(){
        $data = [
            "invalidEANError" => ""
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $bookEAN = trim($_POST["bookEAN"]);
            $numberValidation = "/^[0-9]*$/";

            if(!empty($bookEAN) && preg_match($numberValidation, $bookEAN)) { //check if empty and if only numbers are used
                $this->bookService->deleteBook($bookEAN);
            }

            $bookEAN = $_POST["bookEAN"];

            $this->index();

        }
        $this->index();
    }

    public function error()
    {
        $this->view("error");
    }
}
