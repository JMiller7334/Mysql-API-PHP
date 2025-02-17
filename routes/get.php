<?php
include_once './classes/Customer.php';
include_once './classes/UsageData.php';

// --- CUSTOMER TABLE ---
if (isset($_GET['customers'])) {
    if (isset($_GET['id'])) {
        $customer = Customer::getById($_GET['id']);

        if ($customer) {
            http_response_code(200);
            echo json_encode($customer);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Customer not found']);
        }
    } else {
        $customers = Customer::getAll();
        http_response_code(200);
        echo json_encode($customers);
    }


// --- USAGE TABLE ---
} elseif (isset($_GET['usage'])) {
    if (isset($_GET['customerId'])) {
        $usageData = UsageData::getByCustomerId($_GET['customerId']);

        if (!empty($usageData)) {
            http_response_code(200);
            echo json_encode($usageData);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'No usage data found for the provided customer ID']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'customerId is required']);
    }


// --- INVALID ---
} else {
    http_response_code(404); //not found
    echo json_encode(["error" => "Invalid GET endpoint, please check your URL"]);
}

?>