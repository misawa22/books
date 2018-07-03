<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/classes/book.php');

$books = new books();


if(!empty($_POST["fxn"]))
{

        $fx = $_POST["fxn"];
        $response = array();
        switch($fx)
        {
            case 'getBookTable':
                $response = $books->displayBooksTable($_POST["data"]);
                break;
            case 'addBook':
                $response = $books->addBooks($_POST["data"]);
                break;
            default:
                break;
        }

        echo json_encode($response);

}