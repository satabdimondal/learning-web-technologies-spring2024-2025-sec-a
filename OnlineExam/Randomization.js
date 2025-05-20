// Sample question set
const questions = [
  {
    question: "What is 2 + 2?",
    answers: ["3", "4", "5", "6"]
  },
  {
    question: "What is the capital of France?",
    answers: ["Berlin", "Paris", "Madrid", "Rome"]
  },
  {
    question: "What is 5 x 3?",
    answers: ["15", "10", "20", "25"]
  },
  {
    question: "Who wrote 'Hamlet'?",
    answers: ["Shakespeare", "Dickens", "Austen", "Hemingway"]
  }
];

// Shuffle function
function shuffleArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]]; // Swap elements
  }
}

// Function to generate test version
function generateTestVersion() {
  const shuffleQuestions = document.getElementById('shuffleQuestions').checked;
  const shuffleAnswers = document.getElementById('shuffleAnswers').checked;

  // Create a deep copy of the questions to avoid mutation
  const testVersion = JSON.parse(JSON.stringify(questions));

  // Shuffle questions if checkbox is checked
  if (shuffleQuestions) {
    shuffleArray(testVersion);
  }

  // Shuffle answers if checkbox is checked
  testVersion.forEach(question => {
    if (shuffleAnswers) {
      shuffleArray(question.answers);
    }
  });

  // Show version preview
  const questionsList = document.getElementById('questionsList');
  questionsList.innerHTML = ''; // Clear any previous preview
  testVersion.forEach((question, index) => {
    const questionElement = document.createElement('div');
    questionElement.classList.add('question-container');
    questionElement.innerHTML = `
      <p><strong>${index + 1}. ${question.question}</strong></p>
      <ul>
        ${question.answers.map(answer => `<li>${answer}</li>`).join('')}
      </ul>
    `;
    questionsList.appendChild(questionElement);
  });

  // Hide settings screen and show version preview
  document.querySelector('.container').style.display = 'none';
  document.getElementById('versionPreview').style.display = 'block';
}

// Go back to settings screen
function goBack() {
  document.querySelector('.container').style.display = 'block';
  document.getElementById('versionPreview').style.display = 'none';
}


