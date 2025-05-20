<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Authentication</title>
  <style>
    
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      flex-direction: column;
    }
    .auth-box {
      background-color: white;
      padding: 20px;
      width: 300px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    h1 { color: #1877f2; }
    h2 { text-align: center; }
    input[type="text"], input[type="password"], input[type="email"] {
      width: 100%;
      padding: 10px;
      margin: 6px 0;
    }
    button {
      background-color: #1877f2;
      color: white;
      padding: 10px;
      width: 100%;
      border: none;
      cursor: pointer;
      font-weight: bold;
    }
    button:hover {
      background-color: #155db2;
    }
    .switch {
      text-align: center;
      margin-top: 10px;
      color: #555;
      cursor: pointer;
    }
    .error {
      color: red;
      font-size: 0.9em;
      min-height: 18px;
    }
  </style>
</head>
<body>
 
  <h1>User Authentication</h1>
 
  <!-- Login form -->
  <div class="auth-box" id="loginForm">
    <h2>Login</h2>
    <form method="POST" action="">
      <input type="hidden" name="form_type" value="login" />
      <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars(old('login_email')) ?>" required>
      <input type="password" name="password" placeholder="Password" required>
      <p class="error"><?= error('login') ?></p>
      <button type="submit">Login</button>
    </form>
    <div class="switch" onclick="showSignup()">New user? Signup</div>
    <div class="switch" onclick="showForgot()">Forgot Password?</div>
  </div>
 
  <!-- Signup form -->
  <div class="auth-box" id="signupForm" style="display:none;">
    <h2>Signup</h2>
    <form method="POST" action="">
      <input type="hidden" name="form_type" value="signup" />
      <input type="text" name="name" placeholder="Full Name" value="<?= htmlspecialchars(old('signup_name')) ?>" required>
      <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars(old('signup_email')) ?>" required>
      <input type="password" name="password" placeholder="Password" required>
      <p class="error"><?= error('signup') ?></p>
      <button type="submit">Signup</button>
    </form>
    <div class="switch" onclick="showLogin()">Already have an account? Login</div>
  </div>
 
  <!-- Forgot password form -->
  <div class="auth-box" id="forgotForm" style="display:none;">
    <h2>Reset Password</h2>
    <form method="POST" action="">
      <input type="hidden" name="form_type" value="reset" />
      <input type="email" name="email" placeholder="Enter your email" value="<?= htmlspecialchars(old('reset_email')) ?>" required>
      <p class="error"><?= error('reset') ?></p>
      <button type="submit">Send Reset Link</button>
    </form>
    <div class="switch" onclick="showLogin()">Back to Login</div>
  </div>
 
  <script src="UserAuth.js"></script>
</body>
</html>
<?php
session_start();
 
// Initialize errors and old inputs arrays
if (!isset($_SESSION['errors'])) $_SESSION['errors'] = [];
if (!isset($_SESSION['old'])) $_SESSION['old'] = [];
 
// Process POST requests internally
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['errors'] = [];
    $_SESSION['old'] = [];
 
    $form_type = $_POST['form_type'] ?? '';
 
    if ($form_type === 'login') {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
 
        $_SESSION['old']['login_email'] = $email;
 
        if (!$email || !$password) {
            $_SESSION['errors']['login'] = "Please fill all fields.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors']['login'] = "Invalid email format.";
        } else {
            // fixed login check
            $fixed_email = "user@gmail.com";
            $fixed_password = "123";
            if ($email === $fixed_email && $password === $fixed_password) {
                $_SESSION['user'] = $email;
                header("Location: CommonDash.php");
                exit;
            } else {
                $_SESSION['errors']['login'] = "Email or password incorrect.";
            }
        }
    }
    elseif ($form_type === 'signup') {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
 
        $_SESSION['old']['signup_name'] = $name;
        $_SESSION['old']['signup_email'] = $email;
 
        if (!$name || !$email || !$password) {
            $_SESSION['errors']['signup'] = "All fields are required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors']['signup'] = "Invalid email format.";
        } elseif (strlen($password) < 6) {
            $_SESSION['errors']['signup'] = "Password must be at least 6 characters.";
        } else {
            $_SESSION['errors']['signup'] = "Signup successful! Please verify your email.";
            $_SESSION['old'] = [];
        }
    }
    elseif ($form_type === 'reset') {
        $email = trim($_POST['email'] ?? '');
        $_SESSION['old']['reset_email'] = $email;
 
        if (!$email) {
            $_SESSION['errors']['reset'] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors']['reset'] = "Invalid email format.";
        } else {
            $_SESSION['errors']['reset'] = "Reset link sent to your email.";
            $_SESSION['old'] = [];
        }
 
    }
 
    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
 

function old($key) {
    return $_SESSION['old'][$key] ?? '';
}
function error($form) {
    return $_SESSION['errors'][$form] ?? '';
}
 

?>
 