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
  <meta charset="UTF-8" />
  <title>Notifications - Online Exam System</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
      background-color: #f4f6f9;
      position: relative;
      min-height: 100vh;
    }

    /* Page headline */
    h1 {
      color: #1877f2;
      text-align: center;
      margin-bottom: 20px;
    }

    /* Header with bell icon */
    .header {
      display: flex;
      justify-content: flex-end;
      align-items: center;
    }

    .bell {
      position: relative;
      font-size: 24px;
      cursor: pointer;
      padding: 10px;
    }

    .count {
      position: absolute;
      top: 5px;
      right: 5px;
      background: red;
      color: white;
      font-size: 12px;
      padding: 2px 6px;
      border-radius: 50%;
    }

    /* Notification panel */
    .notification-panel {
      display: none;
      position: absolute;
      right: 20px;
      width: 280px;
      background: white;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 10px;
      z-index: 100;
    }

    .notification {
      padding: 8px;
      border-bottom: 1px solid #eee;
    }

    .notification:last-child {
      border-bottom: none;
    }

    .settings {
      margin-top: 20px;
    }

    .toggle {
      display: flex;
      justify-content: space-between;
      margin: 5px 0;
    }

    input[type="checkbox"] {
      transform: scale(1.2);
    }

    h4 {
      margin: 10px 0 5px;
      color: #1877f2;
    }

    /* Back button styles */
    #back-to-common {
      position: fixed;
      bottom: 20px;
      left: 20px;
      background-color: #1877f2;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
      box-shadow: 0 3px 6px rgba(24, 119, 242, 0.5);
      transition: background-color 0.3s ease;
      user-select: none;
      z-index: 101;
    }
    #back-to-common:hover {
      background-color: #145db2;
      
      
      
      
    }
  </style>
</head>
<body>

  <!-- Page Headline -->
  <h1>Notifications</h1>

  <!-- Header area -->
  <div class="header">
    <div class="bell" onclick="togglePanel()">
      Notification
      <span class="count" id="unreadCount">3</span>
    </div>
  </div>

  <!-- Notification Panel -->
  <div class="notification-panel" id="notificationPanel">
    <h4>Notifications</h4>
    <div class="notification"> Exam results published!</div>
    <div class="notification"> New exam assigned.</div>
    <div class="notification"> Exam scheduled for tomorrow.</div>

    <!-- Settings -->
    <div class="settings">
      <h4>Notification Settings</h4>
      <div class="toggle">
        <label>Email Alerts</label>
        <input type="checkbox" checked>
      </div>
      <div class="toggle">
        <label>Push Notifications</label>
        <input type="checkbox">
      </div>
    </div>
  </div>

  <button id="back-to-common" onclick="window.location.href='CommonDash.php'">Back</button>

  <!-- JavaScript -->
  <script>
    const panel = document.getElementById("notificationPanel");
    const count = document.getElementById("unreadCount");

    // Toggle visibility of notification panel
    function togglePanel() {
      panel.style.display = panel.style.display === "block" ? "none" : "block";
      count.style.display = "none"; // Hide count when viewed
    }

    // Optional: Click outside to close panel
    window.addEventListener("click", function(e) {
      if (!e.target.closest(".bell") && !e.target.closest(".notification-panel")) {
        panel.style.display = "none";
      }
    });
  </script>

</body>
</html>
