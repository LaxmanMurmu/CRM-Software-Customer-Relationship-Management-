<?php
include "model.php";
$obj = new Query();

if (isset($_GET['type']) && $_GET['type'] === 'insert') {
    $name = mysqli_real_escape_string($obj->connect(), $_POST['name']);
    $email = mysqli_real_escape_string($obj->connect(), $_POST['email']);
    // $logo = mysqli_real_escape_string($obj->connect(), $_POST['logo']);
    $website = mysqli_real_escape_string($obj->connect(), $_POST['website']);

    $img_loc = $_FILES['logo']['tmp_name'];
    $img_name = $_FILES['logo']['name'];
    $img_des = "uploaded_Images/".$img_name;
    move_uploaded_file($img_loc, 'uploaded_Images/' .$img_name);


    $data = array(
        'name' => $name,
        'email' => $email,
        'logo' => $img_des,
        'website' => $website
    );
    $obj->insertData('company', $data);
}

// Calling getData() to fetch data
$result = $obj->getData('company', '*', '', 'id', 'DESC');

// Convert the result to JSON format
$jsonData = json_encode($result);

// Send the JSON response
header('Content-Type: application/json');
echo $jsonData;





// ================================UPDATE QUERY EXECTING=============================
// Update Query Execution
// Update Query Execution
if (isset($_GET['type']) && $_GET['type'] === 'update') {
    $ID = $obj->get_safe_str($_POST['id']);
    $name = $obj->get_safe_str($_POST['name']);
    $email = $obj->get_safe_str($_POST['email']);
    $website = $obj->get_safe_str($_POST['website']);

    $img_loc = $_FILES['logo']['tmp_name'];
    $img_name = $_FILES['logo']['name'];
    $img_des = "uploaded_Images/" . $img_name;
    move_uploaded_file($img_loc, 'uploaded_Images/' . $img_name);
    
    $condition_arr = array('id' => $ID);
    $update_arr = array('name' => $name, 'email' => $email, 'logo' => $img_des, 'website' => $website);
    $obj->updateData('company', $update_arr, $condition_arr);
}


// ================================UPDATE QUERY EXECTING=============================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_GET['type']) && $_GET['type'] === 'delete') {
    $ID = $obj->get_safe_str($_POST['id']);
    $condition_arr = array('id' => $ID);
    $obj->deleteData('company', $condition_arr);
}


?>
