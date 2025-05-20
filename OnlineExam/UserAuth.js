// Show Signup form and hide others
function showSignup() {
  document.getElementById("loginForm").style.display = "none";
  document.getElementById("signupForm").style.display = "block";
  document.getElementById("forgotForm").style.display = "none";
}

// Show Login form and hide others
function showLogin() {
  document.getElementById("loginForm").style.display = "block";
  document.getElementById("signupForm").style.display = "none";
  document.getElementById("forgotForm").style.display = "none";
}

// Show Forgot Password form
function showForgot() {
  document.getElementById("loginForm").style.display = "none";
  document.getElementById("signupForm").style.display = "none";
  document.getElementById("forgotForm").style.display = "block";
}

// JS validation for Login form before submit
document.querySelector('#loginForm form').addEventListener('submit', function(e) {
  const email = this.email.value.trim();
  const pass = this.password.value.trim();
  const errorElem = this.querySelector('.error');
  errorElem.textContent = '';

  if (!email || !pass) {
    errorElem.textContent = 'Please fill all fields.';
    e.preventDefault();
    return;
  }
  if (!validateEmail(email)) {
    errorElem.textContent = 'Invalid email format.';
    e.preventDefault();
    return;
  }
});

// JS validation for Signup form before submit
document.querySelector('#signupForm form').addEventListener('submit', function(e) {
  const name = this.name.value.trim();
  const email = this.email.value.trim();
  const pass = this.password.value;
  const errorElem = this.querySelector('.error');
  errorElem.textContent = '';

  if (!name || !email || !pass) {
    errorElem.textContent = 'All fields are required.';
    e.preventDefault();
    return;
  }
  if (!validateEmail(email)) {
    errorElem.textContent = 'Invalid email format.';
    e.preventDefault();
    return;
  }
  if (pass.length < 6) {
    errorElem.textContent = 'Password must be at least 6 characters.';
    e.preventDefault();
    return;
  }
});

// JS validation for Reset Password form before submit
document.querySelector('#forgotForm form').addEventListener('submit', function(e) {
  const email = this.email.value.trim();
  const errorElem = this.querySelector('.error');
  errorElem.textContent = '';

  if (!email) {
    errorElem.textContent = 'Email is required.';
    e.preventDefault();
    return;
  }
  if (!validateEmail(email)) {
    errorElem.textContent = 'Invalid email format.';
    e.preventDefault();
    return;
  }
});


function validateEmail(email) {
  
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email.toLowerCase());
}
