<?php
session_start();

// Check if user is logged in (for example, after login set $_SESSION['user'])
// Uncomment below if you want to protect this page
 if (!isset($_SESSION['user'])) {
     header("Location: UserAuth.php");
     exit;
 }

// Handle "reset" to clear studentId and go back to input screen
if (isset($_GET['reset']) && $_GET['reset'] == '1') {
    unset($_SESSION['studentId']);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$error = '';
$studentId = $_SESSION['studentId'] ?? '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputId = trim($_POST['studentId'] ?? '');

    if ($inputId === '') {
        $error = 'Please enter the student ID.';
    } elseif (!ctype_alnum($inputId)) {
        $error = 'Student ID must be alphanumeric only.';
    } else {
        // Valid student ID - store in session
        $_SESSION['studentId'] = $inputId;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Show input screen only if no valid studentId in session
$showInputScreen = empty($studentId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Student Analytics</title>
<style>
  /* Your existing CSS from above */
  body {
    font-family: Arial, sans-serif;
    text-align: center;
    padding: 80px 20px;
  }
  h1,h2 {
    font-size: 48px;
    margin-bottom: 60px;
  }
  label {
    font-size: 22px;
    margin-right: 10px;
  }
  input[type="text"] {
    width: 350px;
    height: 50px;
    font-size: 20px;
    border-radius: 30px;
    border: 1px solid #ccc;
    padding: 0 20px;
    outline: none;
  }
  input[type="text"]:focus {
    border-color: #4CAF50;
  }
  button {
    margin-left: 20px;
    font-size: 20px;
    padding: 12px 30px;
    border: none;
    border-radius: 25px;
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
  }
  button:hover {
    background-color: #45a049;
  }
  .error {
    color: red;
    font-size: 18px;
    margin-top: 15px;
  }
  .topic-btn {
    background: none;
    border: none;
    color: blue;
    text-decoration: underline;
    font-size: 22px;
    cursor: pointer;
    padding: 0;
    font-family: inherit;
  }
  .topic-btn:hover {
    color: darkblue;
  }
  #screen1, #screen2, #skillMatrixScreen, #algebraScreen, #geometryScreen, #trigonometryScreen {
    display: none;
  }
</style>
</head>
<body>

<!-- Screen 1: Student ID Input -->
<div id="screen1" style="display: <?= $showInputScreen ? 'block' : 'none' ?>">
  <form id="studentForm" method="POST" action="">
    <h1>Student Analytics</h1>
    <label for="studentId">Student ID :</label>
    <input type="text" id="studentId" name="studentId" placeholder="Enter student ID" value="<?= htmlspecialchars($_POST['studentId'] ?? '') ?>" />
    <br><br>
    <button type="submit">Done</button>
    <div id="errorMsg" class="error"><?= htmlspecialchars($error) ?></div>
    <button type="button" onclick="window.location.href='CommonDash.php'" style="margin-left:15px;">Back</button>
  </form>
</div>

<!-- Screen 2 -->
<div id="screen2" style="display: <?= $showInputScreen ? 'none' : 'block' ?>">
  <h1>Identify Learning Gaps</h1>
  <p><strong>Student ID: <?= htmlspecialchars($studentId) ?></strong></p>
  <button id="skillMatrixBtn">Skill Matrix</button>
  <button id="weenessReportBtn">Weeness Report</button>
  <br><br>
  <button id="backBtn" class="btn" onclick="window.location.href='?reset=1'">Back</button>
</div>

<!-- The rest of your screens below ... -->
<div id="skillMatrixScreen">
  <!-- Your Skill Matrix content -->
  <h1>Skill Matrix</h1>
  <table>
    <thead>
      <tr>
        <th>Topic</th><th>Mastery</th><th>Status</th><th>Attempts</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><button class="topic-btn">Algebra</button></td>
        <td>30%</td>
        <td>Weak</td>
        <td>3</td>
      </tr>
      <tr>
        <td><button class="topic-btn">Geometry</button></td>
        <td>75%</td>
        <td>Medium</td>
        <td>2</td>
      </tr>
      <tr>
        <td><button class="topic-btn">Trigonometry</button></td>
        <td>90%</td>
        <td>Strong</td>
        <td>5</td>
      </tr>
    </tbody>
  </table>
  <button id="backFromSkillMatrixBtn">Back</button>
</div>

<!-- Topic screens here as before -->
<div id="algebraScreen" style="display:none; padding: 40px; text-align:center;">
  <h1>Track progress over time: Algebra</h1>
  <p>Details and content about Algebra go here.</p>
  <button class="backFromTopicBtn">Back</button>
</div>

<div id="geometryScreen" style="display:none; padding: 40px; text-align:center;">
  <h1>Track progress over time: Geometry</h1>
  <p>Details and content about Geometry go here.</p>
  <button class="backFromTopicBtn">Back</button>
</div>

<div id="trigonometryScreen" style="display:none; padding: 40px; text-align:center;">
  <h1>Track progress over time: Trigonometry</h1>
  <p>Details and content about Trigonometry go here.</p>
  <button class="backFromTopicBtn">Back</button>
</div>

<!-- Weeness Report Screen -->
<div id="weenessReportScreen" style="display:none; padding: 40px; text-align:center;">
  <h1>Weeness Report</h1>
  <p>Details and content about Weeness Report go here.</p>
  <button id="weenessBackBtn">Back</button>
</div>

<script src="Analytics.js"></script>

</body>
</html>
