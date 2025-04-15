const display = document.getElementById("display");
const buttonContainer = document.getElementById("buttons");

const buttons = [
  '7', '8', '9', '/',
  '4', '5', '6', '*',
  '1', '2', '3', '-',
  '0', '.', '%', '+',
  'C', '='
];


function addToDisplay(value) {
  if (value === 'C') {
    display.value = '';
  } else if (value === '=') {
    try {
      display.value = eval(display.value);
    } catch {
      display.value = 'Error';
    }
  } else {
    display.value += value;
  }
}


buttons.forEach(function(btnValue) {
  const button = document.createElement("button");
  button.textContent = btnValue;
  button.className = "btn";
  button.addEventListener("click", function() {
    addToDisplay(btnValue);
  });
  buttonContainer.appendChild(button);
  if (['/', '*', '-', '+', '=', '%'].includes(btnValue)) {
    buttonContainer.appendChild(document.createElement("br"));
  }
});
