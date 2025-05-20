const csvTemplate = `Question,Option A,Option B,Option C,Option D,Answer
What is 2+2?,3,4,5,6,B
Which is a fruit?,Carrot,Apple,Potato,Onion,B
`;

// Elements
const downloadBtn = document.getElementById('download-template');
const fileInput = document.getElementById('csv-file');
const previewContainer = document.getElementById('preview-container');
const importBtn = document.getElementById('import-btn');

let parsedQuestions = [];

// Download CSV Template
downloadBtn.addEventListener('click', () => {
  const blob = new Blob([csvTemplate], { type: 'text/csv' });
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = 'questions_template.csv';
  a.click();
  URL.revokeObjectURL(url);
});

// Parse CSV to array of objects (simple parser, assumes no commas in values)
function parseCSV(text) {
  const lines = text.trim().split('\n');
  if (lines.length < 2) return [];
  const headers = lines[0].split(',');
  const data = lines.slice(1).map(line => {
    const values = line.split(',');
    const obj = {};
    headers.forEach((h, i) => obj[h.trim()] = values[i]?.trim() || '');
    return obj;
  });
  return data;
}

// Validate question row: all fields filled, answer matches one option (A-D)
function validateQuestion(q) {
  if (!q['Question'] || !q['Option A'] || !q['Option B'] || !q['Option C'] || !q['Option D'] || !q['Answer']) {
    return false;
  }
  if (!['A','B','C','D'].includes(q['Answer'].toUpperCase())) {
    return false;
  }
  return true;
}

// Render preview table with error highlighting
function renderPreview(questions) {
  if (questions.length === 0) {
    previewContainer.innerHTML = '<p>No questions to preview.</p>';
    importBtn.disabled = true;
    return;
  }
  
  let html = '<table><thead><tr><th>#</th><th>Question</th><th>Option A</th><th>Option B</th><th>Option C</th><th>Option D</th><th>Answer</th></tr></thead><tbody>';
  
  let hasError = false;
  questions.forEach((q, i) => {
    const isValid = validateQuestion(q);
    if (!isValid) hasError = true;
    html += `<tr class="${isValid ? '' : 'error'}">
      <td>${i + 1}</td>
      <td>${q['Question']}</td>
      <td>${q['Option A']}</td>
      <td>${q['Option B']}</td>
      <td>${q['Option C']}</td>
      <td>${q['Option D']}</td>
      <td>${q['Answer']}</td>
    </tr>`;
  });
  
  html += '</tbody></table>';
  previewContainer.innerHTML = html;
  importBtn.disabled = hasError;
}

// Handle file upload and preview
fileInput.addEventListener('change', e => {
  const file = e.target.files[0];
  if (!file) return;
  
  const reader = new FileReader();
  reader.onload = e => {
    const text = e.target.result;
    parsedQuestions = parseCSV(text);
    renderPreview(parsedQuestions);
  };
  reader.readAsText(file);
});

// Import button action (here just alert)
importBtn.addEventListener('click', () => {
  alert(`Successfully imported ${parsedQuestions.length} questions!`);
  // Reset
  fileInput.value = '';
  previewContainer.innerHTML = '';
  importBtn.disabled = true;
  parsedQuestions = [];
});
