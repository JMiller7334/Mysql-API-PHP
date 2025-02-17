<?php
/** DOCUMENTATION
 * static class that handles all functionality for CRUD operations to the database.
 */
include_once './connect/db.php';

class UsageData {

    // -- GET BY ID --
    public static function getByCustomerId(int $customerId): array 
    {
        global $pdo;

        //query:
        $stmt = $pdo->prepare("SELECT * FROM usage_data WHERE customer_id = :customerId");

        //binding:
        $stmt->bindParam(':customerId', $customerId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // -- POST --
    public static function create(array $data): bool 
    {
        global $pdo;

        //query:
        $stmt = $pdo->prepare("INSERT INTO usage_data 
            (customerId, usage_month, customer_usage) 
            VALUES (:customerId, :usage_month, :customer_usage)");

        //binding:
        $stmt->bindParam(':customerId', $data['customerId']);
        $stmt->bindParam(':usage_month', $data['usage_month']);
        $stmt->bindParam(':customer_usage', $data['customer_usage']);

        return $stmt->execute();
    }


    // -- PUT --
    public static function update(int $id, array $data): bool 
    {
        global $pdo;

        //query: - tell the database what to do
        $stmt = $pdo->prepare("UPDATE usage_data SET 
            customerId = :customerId, 
            usage_month = :usage_month,
            customer_usage = :customer_usage
            WHERE id = :id");

        //binding:
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':customerId', $data['customerId']);
        $stmt->bindParam(':usage_month', $data['usage_month']);
        $stmt->bindParam(':customer_usage', $data['customer_usage']);
        $stmt->execute();

        //case: rows were affected
        if ($stmt->rowCount() > 0) {
            return true;

        //case: no rows were affected
        } else {
            return false; //return result indicates to main app if operation was successful
        }
    }

    // -- DELETE --
    public static function delete(int $id): bool 
    {
        global $pdo;

        //query:
        $stmt = $pdo->prepare("DELETE FROM usage_data WHERE id = :id");

        //binding:
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>
