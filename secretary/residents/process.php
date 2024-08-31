<?php
include('config.php');

// Get form data
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$extension_name = $_POST['extension_name'];
$birthday = $_POST['birthday'];
$age = $_POST['age'];
$marital_status = $_POST['marital_status'];
$partner_name = $_POST['partner_name'] ?? null;
$children_count = $_POST['children_count'] ?? null;
$purok = $_POST['purok'];
$source_of_income = $_POST['source_of_income'];
$company_name = $_POST['company_name'] ?? null;
$government_work = $_POST['government_work'] ?? null;
$vehicle_type = $_POST['vehicle_type'] ?? null;
$business_type = $_POST['business_type'] ?? null;
$house_ownership = $_POST['house_ownership'];
$light_source = $_POST['light_source'];
$water_source = $_POST['water_source'];
$pets = $_POST['pets'];
$beneficiaries = $_POST['beneficiaries'];

// Insert query
$sql = "INSERT INTO residents (last_name, first_name, middle_name, extension_name, birthday, age, marital_status, partner_name, children_count, purok, source_of_income, company_name, government_work, vehicle_type, business_type, house_ownership, light_source, water_source, pets, beneficiaries)
        VALUES ('$last_name', '$first_name', '$middle_name', '$extension_name', '$birthday', '$age', '$marital_status', '$partner_name', '$children_count', '$purok', '$source_of_income', '$company_name', '$government_work', '$vehicle_type', '$business_type', '$house_ownership', '$light_source', '$water_source', '$pets', '$beneficiaries')";

if ($mysqli->query($sql) === TRUE) {
    // Redirect to the residents list page after success
    header('Location: index.php');
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

$mysqli->close();
?>
