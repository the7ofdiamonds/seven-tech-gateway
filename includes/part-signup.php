<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // User information
    $username = sanitize_user($_POST['username']);
    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];

    // Create the user
    $user_id = wp_create_user($username, $password, $email);

    // Check if user creation was successful
    if (!is_wp_error($user_id)) {
        // User registration successful
        echo 'User registered successfully with ID: ' . $user_id;
    } else {
        // User registration failed
        echo 'User registration failed: ' . $user_id->get_error_message();
    }
}
?>

<main class="login" id="thfw"></main>