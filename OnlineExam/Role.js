const users = [
  { id: 1, name: "Alice", role: "Admin" },
  { id: 2, name: "Bob", role: "Editor" },
  { id: 3, name: "Charlie", role: "User" },
];

const navItems = [
  { name: "Dashboard", roles: ["Admin", "Editor", "User"] },
  { name: "Manage Users", roles: ["Admin"] },
  { name: "Edit Content", roles: ["Admin", "Editor"] },
  { name: "View Reports", roles: ["Admin", "Editor", "User"] },
  { name: "Settings", roles: ["Admin"] },
];

const currentUserSelect = document.getElementById("currentUser");
const navMenu = document.getElementById("navMenu");
const adminPanel = document.getElementById("adminPanel");
const userToAssign = document.getElementById("userToAssign");
const roleToAssign = document.getElementById("roleToAssign");
const assignRoleBtn = document.getElementById("assignRoleBtn");
const userList = document.getElementById("userList");

function fillUserSelects() {
  currentUserSelect.innerHTML = "";
  userToAssign.innerHTML = "";
  users.forEach(user => {
    const option1 = document.createElement("option");
    option1.value = user.id;
    option1.textContent = `${user.name} (${user.role})`;
    currentUserSelect.appendChild(option1);

    const option2 = document.createElement("option");
    option2.value = user.id;
    option2.textContent = `${user.name} (${user.role})`;
    userToAssign.appendChild(option2);
  });
}

function renderNavMenu(user) {
  navMenu.innerHTML = "";
  navItems.forEach(item => {
    if (item.roles.includes(user.role)) {
      const li = document.createElement("li");
      li.textContent = item.name;
      navMenu.appendChild(li);
    }
  });
}

function renderUserList() {
  userList.innerHTML = "";
  users.forEach(user => {
    const li = document.createElement("li");
    li.textContent = `${user.name}: ${user.role}`;
    userList.appendChild(li);
  });
}

function checkAdminPanel(user) {
  if (user.role === "Admin") {
    adminPanel.style.display = "block";
  } else {
    adminPanel.style.display = "none";
  }
}

currentUserSelect.addEventListener("change", () => {
  const user = users.find(u => u.id === parseInt(currentUserSelect.value));
  renderNavMenu(user);
  checkAdminPanel(user);
});

assignRoleBtn.addEventListener("click", () => {
  const userId = parseInt(userToAssign.value);
  const role = roleToAssign.value;
  const user = users.find(u => u.id === userId);
  if (user) {
    user.role = role;
    alert(`${user.name} role changed to ${role}`);
    fillUserSelects();
    renderUserList();
    // Update nav if currently logged in user role changed
    if (userId === parseInt(currentUserSelect.value)) {
      renderNavMenu(user);
      checkAdminPanel(user);
    }
  }
});

// Initialize
fillUserSelects();
renderUserList();
currentUserSelect.value = users[0].id;
renderNavMenu(users[0]);
checkAdminPanel(users[0]);
