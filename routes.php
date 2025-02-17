<?php
// Include necessary files
include_once './classes/Customer.php';
include_once './classes/UsageData.php';

header('Content-Type: application/json'); // Ensure response is JSON

// -- ROUTE FOR GET --
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include_once './routes/get.php';

// -- ROUTE FOR POST --
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once './routes/post.php';

// -- ROUTE FOR PUT --
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    include_once './routes/put.php';

// -- ROUTE FOR DELETE --
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    include_once './routes/delete.php';

// -- NO END POINT --
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method not allowed or unknown']);
}
?>