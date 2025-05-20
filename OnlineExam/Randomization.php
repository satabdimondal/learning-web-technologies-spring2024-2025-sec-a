<?php
session_start();
 
// Redirect to login if not authenticated
if (!isset($_SESSION['user'])) {
    header("Location: UserAuth.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Question Randomization</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      padding: 30px;
    }
    .container {
      margin: 20px;
    }
    .question-container {
      margin-bottom: 20px;
    }
    .btn {
      font-size: 18px;
      padding: 10px 20px;
      cursor: pointer;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
    }
    .btn:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>

  <h1>Question Randomization Settings</h1>

  <!-- Randomization Settings Screen -->
  <div class="container">
    <label for="shuffleQuestions">Shuffle Question Order:</label>
    <input type="checkbox" id="shuffleQuestions" checked><br><br>

    <label for="shuffleAnswers">Shuffle Answer Order:</label>
    <input type="checkbox" id="shuffleAnswers" checked><br><br>

    <button class="btn" onclick="generateTestVersion()">Generate Test Version</button>
    <button id="back-to-common" class="btn" onclick="window.location.href='CommonDash.php'">Back</button>
  </div>

  <!-- Version Preview Screen -->
  <div id="versionPreview" class="container" style="display:none;">
    <h2>Test Version Preview</h2>
    <div id="questionsList"></div>
    <button class="btn" onclick="goBack()">Back</button>
  </div>

  <script src="Randomization.js"></script>
</body>
</html>










