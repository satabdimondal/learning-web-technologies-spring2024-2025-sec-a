window.onload = function() {
  const screen1 = document.getElementById('screen1');
  const screen2 = document.getElementById('screen2');
  const skillMatrixScreen = document.getElementById('skillMatrixScreen');
  const algebraScreen = document.getElementById('algebraScreen');
  const geometryScreen = document.getElementById('geometryScreen');
  const trigonometryScreen = document.getElementById('trigonometryScreen');
  const weenessReportScreen = document.getElementById('weenessReportScreen');

  const studentForm = document.getElementById('studentForm');
  const errorDiv = document.getElementById('errorMsg');
  const studentIdInput = document.getElementById('studentId');

  // Submit student ID
  studentForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const input = studentIdInput.value.trim();
    if (input === '') {
      errorDiv.textContent = 'Please enter the student ID.';
    } else {
      errorDiv.textContent = '';
      screen1.style.display = 'none';
      screen2.style.display = 'block';
    }
  });

  // Back button on screen2 returns to screen1
  document.getElementById('backBtn').addEventListener('click', function() {
    studentIdInput.value = '';
    errorDiv.textContent = '';
    screen2.style.display = 'none';
    screen1.style.display = 'block';
  });

  // Skill Matrix button shows skill matrix screen
  document.getElementById('skillMatrixBtn').addEventListener('click', function() {
    screen2.style.display = 'none';
    skillMatrixScreen.style.display = 'block';
  });

  // Weeness Report button shows the weeness report screen
  document.getElementById('weenessReportBtn').addEventListener('click', function() {
    screen2.style.display = 'none';
    weenessReportScreen.style.display = 'block';
  });

  // Back button on skill matrix screen returns to screen2
  document.getElementById('backFromSkillMatrixBtn').addEventListener('click', function() {
    skillMatrixScreen.style.display = 'none';
    screen2.style.display = 'block';
  });

  // Topic buttons inside skill matrix table
  document.querySelectorAll('.topic-btn').forEach(button => {
    button.addEventListener('click', () => {
      const topic = button.textContent.trim().toLowerCase();

      // Hide skill matrix screen
      skillMatrixScreen.style.display = 'none';

      // Show the corresponding topic screen
      if (topic === 'algebra') {
        algebraScreen.style.display = 'block';
      } else if (topic === 'geometry') {
        geometryScreen.style.display = 'block';
      } else if (topic === 'trigonometry') {
        trigonometryScreen.style.display = 'block';
      }
    });
  });

  // Back buttons on topic screens return to skill matrix screen
  document.querySelectorAll('.backFromTopicBtn').forEach(button => {
    button.addEventListener('click', () => {
      // Hide all topic screens
      algebraScreen.style.display = 'none';
      geometryScreen.style.display = 'none';
      trigonometryScreen.style.display = 'none';

      // Show skill matrix screen
      skillMatrixScreen.style.display = 'block';
    });
  });

  // Back button on Weeness Report returns to screen2
  document.getElementById('weenessBackBtn').addEventListener('click', function() {
    weenessReportScreen.style.display = 'none';
    screen2.style.display = 'block';
  });
};

