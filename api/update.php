<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/book.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Book($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->id = $data->id;

    // book values
    $item->name = $data->name;
    $item->author = $data->author;
    $item->collection = $data->collection;
    $item->ISBN = $data->ISBN;
    $item->dimensions = $data->dimensions;
    $item->designation = $data->designation;
    $item->modified = date('Y-m-d H:i:s');
    $item->imageURL = $data->imageURL;

    if($item->updateBook()){
        echo json_encode("Book data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>