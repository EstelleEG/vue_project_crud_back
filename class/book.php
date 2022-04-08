<?php

class Book
{
    // Connection
    private $conn;

    // Table
    private $db_table = "book_travel";

    // Columns
    public $id;
    public $name;
    public $author;
    public $collection;
    public $ISBN;
    public $dimensions;
    public $designation;
    public $created;
    public $modified;

    // Db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // GET ALL
    public function getBooks()
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createBook()
    {
        $sqlQuery = "INSERT INTO
                        " . $this->db_table . "
                    SET
                        name = :name, 
                        author = :author,
                        collection = :collection, 
                        ISBN = :ISBN,
                        dimensions = :dimensions,
                        designation = :designation,
                        created = :created,
                        modified = :modified";


        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->collection = htmlspecialchars(strip_tags($this->collection));
        $this->ISBN = htmlspecialchars(strip_tags($this->ISBN));
        $this->dimensions = htmlspecialchars(strip_tags($this->dimensions));
        $this->designation = htmlspecialchars(strip_tags($this->designation));
        $this->created = htmlspecialchars(strip_tags($this->created));
        $this->modified = htmlspecialchars(strip_tags($this->modified));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":collection", $this->collection);
        $stmt->bindParam(":ISBN", $this->ISBN);
        $stmt->bindParam(":dimensions", $this->dimensions);
        $stmt->bindParam(":designation", $this->designation);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":modified", $this->modified);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // GET
    public function getSingleBook()
    {
        $sqlQuery = "SELECT
                        id, 
                        name, 
                        author, 
                        collection, 
                        ISBN, 
                        dimensions,
                        designation,
                        created, 
                        modified
                      FROM
                        " . $this->db_table . "
                    WHERE 
                       id = ?
                    LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $dataRow['name'];
        $this->author = $dataRow['author'];
        $this->collection = $dataRow['collection'];
        $this->ISBN = $dataRow['ISBN'];
        $this->dimensions = $dataRow['dimensions'];
        $this->designation = $dataRow['designation'];
        $this->created = $dataRow['created'];
        $this->modified = $dataRow['modified'];
    }

    // UPDATE
    public function updateBook(): bool
    {
        $sqlQuery = "UPDATE
                        " . $this->db_table . "
                    SET
                        name = :name, 
                        author = :author,
                        collection = :collection, 
                        ISBN = :ISBN,
                        dimensions = :dimensions,
                        designation = :designation,
                        modified = :modified
                    WHERE 
                        id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->collection = htmlspecialchars(strip_tags($this->collection));
        $this->ISBN = htmlspecialchars(strip_tags($this->ISBN));
        $this->dimensions = htmlspecialchars(strip_tags($this->dimensions));
        $this->designation = htmlspecialchars(strip_tags($this->designation));
        $this->modified = htmlspecialchars(strip_tags($this->modified));
        $this->id=htmlspecialchars(strip_tags($this->id));


        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":collection", $this->collection);
        $stmt->bindParam(":ISBN", $this->ISBN);
        $stmt->bindParam(":dimensions", $this->dimensions);
        $stmt->bindParam(":designation", $this->designation);
        $stmt->bindParam(":modified", $this->modified);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // DELETE
    function deleteBook()
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

}

?>

