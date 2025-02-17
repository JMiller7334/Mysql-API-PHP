<?php 
include_once './classes/Customer.php';
include_once './classes/UsageData.php';


//VALIDATION CHECKS:
if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'ID is required']);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if ($data === null) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON data']);
    exit;
}

// --- CUSTOMER TABLE ---
if (isset($_GET['customers'])) {
    $updatedCustomer = Customer::update($_GET['id'], $data);

    if ($updatedCustomer) {
        http_response_code(200);
        echo json_encode($updatedCustomer); // Return updated object
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Customer not found']);
    }


// --- USAGE TABLE ---
} elseif (isset($_GET['usage'])) {
    $updatedUsage = UsageData::update($_GET['id'], $data);

    if ($updatedUsage) {
        http_response_code(200);
        echo json_encode($updatedUsage);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Usage data not found']);
    }

    
// --- INVALID ---
} else {
    http_response_code(404); //not found
    echo json_encode(["error" => "Invalid PUT endpoint, please check your URL"]);
}

?>