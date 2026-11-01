<?php
$errors = [];
$storage_mode = 'csv'; // Options: 'csv' or 'json'

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Sanitize & Validate Inputs
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $mobile = trim($_POST['mobile'] ?? ''); 
    $pincode = trim($_POST['pincode'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $gender = trim($_POST['gender'] ?? '');

    if (empty($name)) {
        $errors[] = "Name is required.";
    } else {
        $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address format.";
    }

    if (empty($message)) {
        $errors[] = "Message is required.";
    } else {
        $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    }

    if(empty($mobile)){
        $errors[] = "Mobile is required.";
    } elseif  (!preg_match('/^\d{10}$/', $mobile)) {
        $errors[] = "Invalid mobile number format.";
    } else {
        $mobile = htmlspecialchars($mobile, ENT_QUOTES, 'UTF-8');
    }

    if(empty($pincode)){
        $errors[] = "Pincode is required.";
    } elseif(!preg_match('/^\d{6}$/', $pincode)) {
        $errors[] = "Invalid pincode format.";}
        
     else {
        $pincode = htmlspecialchars($pincode, ENT_QUOTES, 'UTF-8');
    }

    if(empty($address)){
        $error[]= "address is required.";
    }else {
        $address = htmlspecialchars($address, ENT_QUOTES, 'UTF-8');
    }

    if(empty($gender)){
        $error[]= "gender is required.";
    }else {
        $gender = htmlspecialchars($gender, ENT_QUOTES, 'UTF-8');
    }
    


    // 2. Save Data if Validation Passes
    if (empty($errors)) {
        $entry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'name'      => $name,
            'email'     => $email,
            'message'   => $message,
            'mobile'    => $mobile,
            'pincode'   => $pincode,
            'address'   => $address,
            'gender'    => $gender
        ];

        if ($storage_mode === 'csv') {
            saveToCSV('data.csv', $entry);
        } else {
            saveToJSON('data.json', $entry);
        }

        echo "Form submitted successfully!";
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}

// Function to append data to CSV
function saveToCSV($filename, $data) {
    $file_exists = file_exists($filename);
    $handle = fopen($filename, 'a');

    // Automatically add header row if creating a new CSV file
    if (!$file_exists) {
        fputcsv($handle, array_keys($data));
    }

    fputcsv($handle, $data);
    fclose($handle);
}

// Function to append data to JSON
function saveToJSON($filename, $data) {
    $existing = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];
    if (!is_array($existing)) {
        $existing = [];
    }

    $existing[] = $data;
    file_put_contents($filename, json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
?>