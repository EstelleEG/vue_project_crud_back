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

    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingleBook();

    if($item->name !== null){
        // create array
        $emp_arr = array(
            "id" => $item->id,
            "name" => $item->name,
            "author" =>$item->author,
            "collection" =>$item->collection,
            "ISBN" => $item->ISBN,
            "dimensions" => $item->dimensions,
            "designation" => $item->designation,
            "created" => $item->created,
            "modified" => $item->modified,
            "imageURL" => $item->imageURL
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Employee not found.");
    }
?>