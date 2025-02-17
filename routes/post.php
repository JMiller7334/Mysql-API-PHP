<?php 
include_once './classes/Customer.php';
include_once './classes/UsageData.php';


$data = json_decode(file_get_contents("php://input"), true);

if ($data === null) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON data']);
    exit;
}


//--- CUSTOMERS TABLE ---
if (isset($_GET['customers'])) {
    $customer = Customer::create($data);

    if ($customer) {
        http_response_code(201);
        echo json_encode($customer); //return created object instead of success message
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Server error']);
    }


//--- USAGE TABLE ---
} elseif (isset($_GET['usage'])) {
    $usageData = UsageData::create($data);

    if ($usageData) {
        http_response_code(201);
        echo json_encode($usageData);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Server error']);
    }


// --- INVALID ---
} else {
    http_response_code(404); //not found
    echo json_encode(["error" => "Invalid GET endpoint, please check your URL"]);
}

?>