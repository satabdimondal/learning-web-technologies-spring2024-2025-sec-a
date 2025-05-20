<?php
session_start();
 // php session
if (!isset($_SESSION['user'])) {
    header("Location: UserAuth.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Search & Filter - Online Exam System</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 30px;
      background-color: #f4f6f9;
      position: relative;
      min-height: 100vh;
      box-sizing: border-box;
    }

    h1 {
      text-align: center;
      color: #1877f2;
      margin-bottom: 20px;
    }

    .search-filter-container {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      justify-content: center;
      margin-bottom: 20px;
    }

    input[type="text"], select {
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      width: 250px;
    }

    .results {
      max-width: 600px;
      margin: auto;
      background: white;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .item {
      padding: 10px;
      border-bottom: 1px solid #eee;
    }

    .item:last-child {
      border-bottom: none;
    }

    .hidden {
      display: none;
    }

    /* Back button styling */
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
      z-index: 1000;
    }

    #back-to-common:hover {
      background-color: #145db2;
    }
  </style>
</head>
<body>

  <h1>Search & Filter</h1>

  <!-- Search and Filter Panel -->
  <div class="search-filter-container">
    <input type="text" id="searchInput" placeholder="Search exams or topics" onkeyup="filterResults()">
    <select id="categoryFilter" onchange="filterResults()">
      <option value="All">All Subjects</option>
      <option value="Math">Math</option>
      <option value="English">English</option>
      <option value="Science">Science</option>
    </select>
  </div>

  <!-- Result List -->
  <div class="results" id="resultList">
    <div class="item" data-title="Algebra Basics" data-category="Math">Algebra Basics</div>
    <div class="item" data-title="English Grammar" data-category="English">English Grammar</div>
    <div class="item" data-title="Photosynthesis" data-category="Science"> Photosynthesis</div>
    <div class="item" data-title="Geometry Practice" data-category="Math"> Geometry Practice</div>
    <div class="item" data-title="Essay Writing" data-category="English"> Essay Writing</div>
    <div class="item" data-title="Physics Motion" data-category="Science"> Physics: Motion</div>
  </div>

  <button id="back-to-common" class="btn" onclick="window.location.href='CommonDash.php'">Back</button>

  <script>
    function filterResults() {
      const search = document.getElementById('searchInput').value.toLowerCase();
      const category = document.getElementById('categoryFilter').value;
      const items = document.querySelectorAll('.item');

      items.forEach(item => {
        const title = item.getAttribute('data-title').toLowerCase();
        const itemCategory = item.getAttribute('data-category');

        const matchSearch = title.includes(search);
        const matchCategory = (category === "All" || itemCategory === category);

        item.classList.toggle('hidden', !(matchSearch && matchCategory));
      });
    }
  </script>

</body>
</html>
