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
  <title>Simple Role-Based Access</title>
  <style>
    body {
      font-family: Verdana, sans-serif;
      max-width: 400px;
      margin: 40px auto;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background: #f9f9f9;
    }
    h2 {
      margin-top: 30px;
      border-bottom: 1px solid #ccc;
      padding-bottom: 5px;
    }
    label {
      display: block;
      margin-top: 15px;
      margin-bottom: 5px;
      font-weight: bold;
    }
    select, button {
      width: 100%;
      padding: 8px;
      border-radius: 4px;
      border: 1px solid #aaa;
      box-sizing: border-box;
      font-size: 16px;
    }
    button {
      margin-top: 20px;
      background: #007bff;
      color: white;
      border: none;
      cursor: pointer;
    }
    button:hover {
      background: #0056b3;
    }
    ul {
      list-style: none;
      padding-left: 0;
      margin-top: 20px;
    }
    ul li {
      background: white;
      margin-bottom: 8px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-weight: 600;
    }
    #adminPanel {
      display: none;
    }
  </style>
</head>
<body>

  <h1>Role-Based Access Demo</h1>

  <label for="currentUser">Select Current User (Login):</label>
  <select id="currentUser"></select>

  <h2>Navigation Menu</h2>
  <ul id="navMenu"></ul>

  <div id="adminPanel">
    <h2>Admin: Assign Roles</h2>
    <label for="userToAssign">Select User:</label>
    <select id="userToAssign"></select>

    <label for="roleToAssign">Select Role:</label>
    <select id="roleToAssign">
      <option value="Admin">Admin</option>
      <option value="Editor">Editor</option>
      <option value="User">User</option>
    </select>

    <button id="assignRoleBtn">Assign Role</button>

    <h3>Users & Roles</h3>
    <ul id="userList"></ul>
  </div>

  <button id="back-to-common" class="btn" onclick="window.location.href='CommonDash.php'">Back</button>

  <script src="Role.js"></script>
</body>
</html>
