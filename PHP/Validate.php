<?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

     $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        echo "<p><a href='admin_reg.html'>Go back to form</a></p>";
    }
     else {
        echo "<h3>Registration Successful</h3>";
        echo "<p>Name: " . htmlspecialchars($name) . "</p>";
        echo "<p>Email: " . htmlspecialchars($email) . "</p>";
    }
}
 else {
    echo "<p>Invalid Request.</p>";
}
?>