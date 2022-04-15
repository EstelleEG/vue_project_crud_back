<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/book.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Book($db);

    $stmt = $items->getBooks();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $bookArray = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "name" => $name,
                "author" => $author,
                "collection" => $collection,
                "ISBN" => $ISBN,
                "dimensions" => $dimensions,
                "designation" => $designation,
                "created" => $created,
                "modified" => $modified, 
                "imageURL" => $imageURL
            );

            array_push($bookArray, $e);
        }
        echo json_encode($bookArray);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>