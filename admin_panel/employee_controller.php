<?php
include "model.php";
$obj = new Query();

if (isset($_GET['type']) && $_GET['type'] === 'insert') {
    $firstname = mysqli_real_escape_string($obj->connect(), $_POST['firstname']);
    $company_id = mysqli_real_escape_string($obj->connect(), $_POST['company_id']);
    $lastname = mysqli_real_escape_string($obj->connect(), $_POST['lastname']);
    $email = mysqli_real_escape_string($obj->connect(), $_POST['email']);
    $phone = mysqli_real_escape_string($obj->connect(), $_POST['phone']);

    // Fetch the company ID from the company table
    $companyResult = $obj->getData('company', 'id', '', 'id', 'DESC');
    if (!empty($companyResult)) {
        $companyId = $companyResult[0]['id'];
    } else {
        // Handle the case when there is no company ID available
        $companyId = null; // or any default value you want
    }

    $data = array(
        'firstname' => $firstname,
        'company_id' => $company_id, // Assign the company_id
        'lastname' => $lastname,
        'email' => $email,
        'phone' => $phone,
    );
    $obj->insertData('employee', $data);
}

// Calling getData() to fetch data
$result = $obj->getData('employee', '*', '', 'id', 'DESC');

// Convert the result to JSON format
$jsonData = json_encode($result);

// Send the JSON response
header('Content-Type: application/json');
echo $jsonData;





// ================================UPDATE QUERY EXECTING=============================
// Update Query Execution
if (isset($_GET['type']) && $_GET['type'] === 'update') {
    $ID = $obj->get_safe_str($_POST['id']);
    $firstname = $obj->get_safe_str($_POST['firstname']);
    $lastname = $obj->get_safe_str($_POST['lastname']);
    $email = $obj->get_safe_str($_POST['email']);
    $phone = $obj->get_safe_str($_POST['phone']);

    
    $condition_arr = array('id' => $ID);
    $update_arr = array('firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'phone' => $phone);
    $obj->updateData('employee', $update_arr, $condition_arr);
}


// ================================UPDATE QUERY EXECTING=============================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_GET['type']) && $_GET['type'] === 'delete') {
    $ID = $obj->get_safe_str($_POST['id']);
    $condition_arr = array('id' => $ID);
    $obj->deleteData('employee', $condition_arr);
}


?>
