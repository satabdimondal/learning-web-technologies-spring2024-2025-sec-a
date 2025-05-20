//Put the button
const container = document.getElementById("button-container");

//create button-1
const btn1 = document.createElement("button");
btn1.textContent = "Class Overview";
btn1.className = "btn";
btn1.onclick = function() {
  // Hide dashboard, show class overview
  document.getElementById("dashboard").style.display = "none";
  document.getElementById("class-overview").style.display = "block";
  
};
//container.appendChild(btn1);

container.appendChild(btn1);

container.appendChild(document.createElement("br"));
container.appendChild(document.createElement("br"));

//Create button-2
const btn2 = document.createElement("button");
btn2.textContent = "Intervention Alerts";
btn2.className = "btn";
btn2.onclick = function() {
  document.getElementById("dashboard").style.display = "none";
  document.getElementById("intervention-alerts").style.display = "block";
};



container.appendChild(btn2);
container.appendChild(document.createElement("br"));
container.appendChild(document.createElement("br"));

// Create button-3
const btn3 = document.createElement("button");
btn3.textContent = "Heat Maps";
btn3.className = "btn";
btn3.onclick = function() {
  document.getElementById("dashboard").style.display = "none";
  document.getElementById("heat-maps").style.display = "block";
  renderHeatMap();
  
};





container.appendChild(btn3);

window.onload = function() {
  
  // Back from Class Overview screen
  document.getElementById("back-from-class").onclick = function() {
    document.getElementById("class-overview").style.display = "none";
    document.getElementById("dashboard").style.display = "block";
  };

  // Back from Intervention Alerts screen
  document.getElementById("back-from-intervention").onclick = function() {
    document.getElementById("intervention-alerts").style.display = "none";
    document.getElementById("dashboard").style.display = "block";
  };

  // Back from Heat Maps screen
  document.getElementById("back-from-heatmaps").onclick = function() {
    document.getElementById("heat-maps").style.display = "none";
    document.getElementById("dashboard").style.display = "block";
  };
};


// Heatmap data: 0 = wrong (black), 1 = right (gray)
const heatmapData = [
  [0, 1, 1, 0, 1], // A
  [0, 0, 1, 1, 1], // B
  [0, 1, 1, 1, 1], // C
  [0, 0, 1, 1, 1], // D
  [0, 0, 1, 1, 1], // E
];
const students = ['A', 'B', 'C', 'D', 'E'];

function renderHeatMap() {
  const container = document.getElementById("heatmap-container");

  // Clear previous content
  while (container.firstChild) container.removeChild(container.firstChild);

  const table = document.createElement("table");
  table.className = "heatmap-table";

  // Header row
  const headerRow = document.createElement("tr");
  headerRow.appendChild(document.createElement("th")); // empty corner

  heatmapData[0].forEach((_, i) => {
    const th = document.createElement("th");
    th.textContent = `Question no. ${i + 1}`;
    headerRow.appendChild(th);
  });
  table.appendChild(headerRow);

  // Data rows
  heatmapData.forEach((rowData, i) => {
    const row = document.createElement("tr");

    const th = document.createElement("th");
    th.textContent = `${i + 1}. ${students[i]}`;
    row.appendChild(th);

    rowData.forEach(value => {
      const td = document.createElement("td");
      td.className = value === 0 ? "wrong" : "right";
      row.appendChild(td);
    });

    table.appendChild(row);
  });

  container.appendChild(table);

  // Legend
  const legend = document.createElement("div");
  legend.id = "heatmap-legend";

  const wrongBox = document.createElement("span");
  wrongBox.className = "wrong";
  legend.appendChild(wrongBox);

  legend.appendChild(document.createTextNode(" Wrong  "));

  const rightBox = document.createElement("span");
  rightBox.className = "right";
  legend.appendChild(rightBox);

  legend.appendChild(document.createTextNode(" Right"));

  container.appendChild(legend);

  

  

}



