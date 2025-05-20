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
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Online Exam System - Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      background: #f5f5f5;
      text-align: center;
    }
    h1 {
      margin-bottom: 20px;
    }
    .dashboard {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 15px;
      max-width: 800px;
      margin: 0 auto 30px;
    }
    
    .dashboard button {
      flex: 1 1 180px;
      min-width: 140px;
      padding: 15px 10px;
      background: white;
      border-radius: 6px;
      border: 1px solid #0288d1;
      color: #0288d1;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.2s, color 0.2s;
      user-select: none;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .dashboard button:hover {
      background: #0288d1;
      color: white;
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    
    .container {
      max-width: 800px;
      margin: 0 auto;
      text-align: center;
      margin-bottom: 30px;
    }

    .container button {
      padding: 12px 30px;
      background: hsl(217, 77%, 55%);  
      border: none;
      border-radius: 5px;
      color: white;
      font-size: 18px;
      cursor: pointer;
      transition: background 0.3s ease;
      user-select: none;
    }
    
  </style>
</head>
<body>

  <h1>Welcome to Online Exam System</h1>
  <h1>Dashboard</h1>

  <div class="dashboard">
    <button onclick="window.location.href='Dashboard.php'">Teacher Dashboard</button>
    <button onclick="window.location.href='Analytics.php'">Student Analytics</button>
    <button onclick="window.location.href='Randomization.php'">Question Randomization</button>
    <button onclick="window.location.href='BulkImport.php'">Bulk Import</button>
    <button onclick="window.location.href='Certificate.php'">Certificate Generation</button>
    <button onclick="window.location.href='Role.php'">Role-Based Access</button>
    <button onclick="window.location.href='Notification.php'">Notifications</button>
    <button onclick="window.location.href='SearchFilter.php'">Search & Filter</button>
  </div>

  <div class="container">
    <button onclick="window.location.href='UserAuth.php'">Back</button>
  </div>

</body>
</html>


