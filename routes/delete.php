<?php 
include_once './classes/Customer.php';
include_once './classes/UsageData.php';

//VALIDATION:
if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'ID is required']);
    exit;
}


// --- CUSTOMER TABLE ---
if (isset($_GET['customers'])) {
    $result = Customer::delete($_GET['id']);

    if ($result) {
        http_response_code(204); // No Content
        exit; // No response body per API spec
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Customer not found']);
    }

    
// --- USAGE TABLE ---
} elseif (isset($_GET['usage'])) {
    $result = UsageData::delete($_GET['id']);

    if ($result) {
        http_response_code(204); // No Content
        exit; // No response body per API spec
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Usage data not found']);
    }


// --- INVALID ---
} else {
    http_response_code(404); //not found
    echo json_encode(["error" => "Invalid DELETE endpoint, please check your URL"]);
}


?>