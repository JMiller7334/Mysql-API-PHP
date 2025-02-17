<?php
include_once './classes/Customer.php';
include_once './classes/UsageData.php';

header('Content-Type: application/json'); // Ensure response is JSON

// -- ROUTE FOR GET --
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

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
    }
}

// -- ROUTE FOR POST --
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if ($data === null) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid JSON data']);
        exit;
    }

    if (isset($_GET['customers'])) {
        $customer = Customer::create($data);

        if ($customer) {
            http_response_code(201);
            echo json_encode($customer); // Return created object instead of success message
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Server error']);
        }

    } elseif (isset($_GET['usage'])) {
        $usageData = UsageData::create($data);

        if ($usageData) {
            http_response_code(201);
            echo json_encode($usageData);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Server error']);
        }
    }
}

// -- ROUTE FOR PUT --
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
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

    if (isset($_GET['customers'])) {
        $updatedCustomer = Customer::update($_GET['id'], $data);

        if ($updatedCustomer) {
            http_response_code(200);
            echo json_encode($updatedCustomer); // Return updated object
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Customer not found']);
        }

    } elseif (isset($_GET['usage'])) {
        $updatedUsage = UsageData::update($_GET['id'], $data);

        if ($updatedUsage) {
            http_response_code(200);
            echo json_encode($updatedUsage);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Usage data not found']);
        }
    }
}

// -- ROUTE FOR DELETE --
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (!isset($_GET['id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'ID is required']);
        exit;
    }

    if (isset($_GET['customers'])) {
        $result = Customer::delete($_GET['id']);

        if ($result) {
            http_response_code(204); // No Content
            exit; // No response body per API spec
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Customer not found']);
        }

    } elseif (isset($_GET['usage'])) {
        $result = UsageData::delete($_GET['id']);

        if ($result) {
            http_response_code(204); // No Content
            exit;
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Usage data not found']);
        }
    }
}
?>
