<?php
session_start();

// Check login session - protect this page
if (!isset($_SESSION['user'])) {
    header("Location: UserAuth.php");
    exit;
}

// Initialize variables and error message
$recipient = '';
$examName = '';
$score = '';
$error = '';
$showCertificate = false;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipient = trim($_POST['recipient'] ?? '');
    $examName = trim($_POST['examName'] ?? '');
    $score = $_POST['score'] ?? '';

    // Server-side validation
    if ($recipient === '' || $examName === '' || $score === '') {
        $error = "Please fill in all fields with valid data.";
    } elseif (!is_numeric($score) || $score < 0 || $score > 100) {
        $error = "Score must be a number between 0 and 100.";
    } elseif ((int)$score < 50) {
        $error = "Candidate did not pass. No certificate generated.";
    } else {
        $showCertificate = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Certificate Generator</title>
  <style>
    body { font-family: Arial, sans-serif; max-width: 500px; margin: 20px auto; }
    label, input, button { display: block; width: 100%; margin: 10px 0; }
    #certificate { 
      margin-top: 30px; 
      border: 2px solid #444; 
      padding: 20px; 
      text-align: center; 
      display: <?= $showCertificate ? 'block' : 'none' ?>;
    }
    .error-message {
      color: red;
      font-weight: bold;
      margin-top: 10px;
    }
  </style>
</head>
<body>

<h2>Certificate Generator</h2>

<form method="POST" action="">
  <label>Recipient Name:</label>
  <input type="text" name="recipient" placeholder="Enter recipient name" value="<?= htmlspecialchars($recipient) ?>" />

  <label>Exam Name:</label>
  <input type="text" name="examName" placeholder="Enter exam name" value="<?= htmlspecialchars($examName) ?>" />

  <label>Candidate Score:</label>
  <input type="number" name="score" placeholder="Enter score (0-100)" min="0" max="100" value="<?= htmlspecialchars($score) ?>" />

  <button type="submit">Generate Certificate</button>

  <?php if ($error !== ''): ?>
    <div class="error-message"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
</form>

<div id="certificate">
  <h2>Certificate of Completion</h2>
  <p>This certifies that</p>
  <h3><?= htmlspecialchars($recipient) ?></h3>
  <p>has passed the exam</p>
  <h3><?= htmlspecialchars($examName) ?></h3><br>
</div>

<button id="back-to-common" onclick="window.location.href='CommonDash.php'">Back</button>

<script src="Certificate.js"></script>

</body>
</html>



