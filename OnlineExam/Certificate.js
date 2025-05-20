function generateCert() {
  const recipient = document.getElementById('recipient').value.trim();
  const examName = document.getElementById('examName').value.trim();
  const score = parseInt(document.getElementById('score').value, 10);
  const message = document.getElementById('message');
  const cert = document.getElementById('certificate');

  message.textContent = '';
  cert.style.display = 'none';

  if (!recipient || !examName || isNaN(score)) {
    message.textContent = 'Please fill in all fields with valid data.';
    return;
  }

  const passingScore = 50; // fixed passing threshold

  if (score < passingScore) {
    message.textContent = 'Candidate did not pass. No certificate generated.';
    return;
  }

  document.getElementById('certRecipient').textContent = recipient;
  document.getElementById('certExam').textContent = examName;

  cert.style.display = 'block';
}
