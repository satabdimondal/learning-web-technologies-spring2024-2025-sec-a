<?php
session_start();
 
// php track
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
  <title>Bulk Import Questions</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      max-width: 700px;
    }
    button {
      margin: 10px 0;
      padding: 10px 15px;
      font-size: 16px;
      cursor: pointer;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f4f4f4;
    }
    tr.error {
      background-color: #fdd;
    }
    tr.error td {
      color: #900;
      font-weight: bold;
    }
    #preview-container {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <h2>Bulk Import Questions</h2>
  
  <button id="download-template">Download CSV Template</button><br/>
  
  <input type="file" id="csv-file" accept=".csv" />
  
  <div id="preview-container"></div>
  
  <button id="import-btn" disabled>Import</button>

  <button id="back-to-common" class="btn" onclick="window.location.href='CommonDash.php'">Back</button>
  
  <script src="Bulk.js"></script>
</body>
</html>
