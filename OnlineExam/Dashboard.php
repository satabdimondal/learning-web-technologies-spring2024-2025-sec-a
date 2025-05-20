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
    <title>Teacher Dashboard</title>
    <style>
    .btn {
      padding: 8px 15px;
      margin: 5px 0;
      font-size: 16px;
      cursor: pointer;
    }
    #heatmap-container table {
      border-collapse: collapse;
      margin: 20px auto;
    }
    #heatmap-container th,
    #heatmap-container td {
      border: 1px solid #ddd;
      width: 40px;
      height: 40px;
      text-align: center;
      padding: 5px;
      user-select: none;
    }
    #heatmap-container th {
      font-weight: normal;
      font-size: 13px;
    }
    #heatmap-container td.wrong {
      background-color: black;
    }
    #heatmap-container td.right {
      background-color: gray;
    }
    #heatmap-legend {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
      user-select: none;
    }
    #heatmap-legend span {
      display: inline-block;
      width: 20px;
      height: 20px;
      margin: 0 8px;
      vertical-align: middle;
    }
    #heatmap-legend .wrong {
      background-color: black;
    }
    #heatmap-legend .right {
      background-color: gray;
    }
  </style>
    
</head>
<body>

    <!-- First screen -->
  <div id="dashboard">
    <h1>Teacher Dashboard</h1>
    <div id="button-container"></div>
    <button id="back-to-common" class="btn" onclick="window.location.href='CommonDash.php'">Back</button>

  </div>

  <!-- Second screen -->
  <div id="class-overview" style="display: none;">
    <h2>Real-time test progress monitoring</h2>
    <p>1. A — 80%</p>
    <p>2. B — 20%</p>
    <p>3. C — 5%</p>
    <p>4. D — 90%</p>
    <p>5. E — 80%</p>
    <button id="back-from-class" class="btn">Back</button>
  </div>


  <!-- 3rd screen-->
  <div id="intervention-alerts" style="display: none;">
    <h3>Red flags for struggling students</h3>
    <p>1. A — <span>health</span> <input type="checkbox"></p>
    <p>2. D — <span>financial</span> <input type="checkbox"></p>
    <p>3. C — <span>lazy</span> <input type="checkbox"></p>
    <button id="back-from-intervention" class="btn">Back</button>
  </div>

  <!-- 4th screen-->
    <div id="heat-maps" style="display:none;">
    <h4>Question-level difficulty analysis</h4>
    <div id="heatmap-container"></div>
    <button id="back-from-heatmaps" class="btn">Back</button>
  </div>

    <script src="Dashboard.js"></script>
    

    
</body>
</html>

