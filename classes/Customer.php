<?php
/**DOCUMENTATION:
 * This class holds all functionality for running querys to customer table.
 */

include_once '../connect/db.php';

class Customer 
{

    // -- GET ALL FUNCTION
    public static function getAll(): array {
        global $pdo;

        //query:
        $stmt = $pdo->prepare("SELECT * FROM customers");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // -- GET BY ID FUNCTION
    public static function getById($id): ?array 
    {
        global $pdo;

        //query:
        $stmt = $pdo->prepare("SELECT * FROM customers WHERE id = :id");

        //binding:
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    //-- POST FUNCTION --
    public static function create($data): bool 
    {
        global $pdo;

        //query:
        $stmt = $pdo->prepare("INSERT INTO 
            customers (name, address, phone, email, customer_type) 
            VALUES (:name, :address, :phone, :email, :customer_type)");

        //binding:
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':address', $data['address']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':customer_type', $data['customer_type']);
        return $stmt->execute();
    }


    //-- PUT FUNCTION --
    public static function update($id, $data): bool 
    {
        global $pdo;

        //query:
        $stmt = $pdo->prepare("UPDATE customers SET 
            name = :name, 
            address = :address,
            phone = :phone,
            email = :email,
            customer_type = :customer_type WHERE id = :id");

        //binding:
        $stmt->bindParam(':id', $id);

        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':address', $data['address']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':customer_type', $data['customer_type']);
        $stmt->execute();

        //case: rows updated - success
        if ($stmt->rowCount() > 0) {
            return true;
        
        //case: no rows updated - no match or changes
        } else {
            return false;
        }
    }


    public static function delete($id): bool 
    {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM customers WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        //case: rows deleted
        if ($stmt->rowCount() > 0) {
            return true;

        //case: no rows deleted
        } else {
            return false;
        }
    }

}
?>
