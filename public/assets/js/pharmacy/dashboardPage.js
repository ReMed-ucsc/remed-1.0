document.addEventListener("DOMContentLoaded", function () {
  console.log("Stock Level Data:", stockLevel);
  console.log("Income Data:", income);
  console.log("Patient Visit Data:", patientVisit);

  // Only proceed if canvas elements exist
  if (!document.getElementById("myBarChart")) {
    console.error("Bar chart canvas missing");
    return;
  }

  // Revenue/Income Line Chart
  const ctxBar = document.getElementById("myBarChart").getContext("2d");
  const myBarChart = new Chart(ctxBar, {
    type: "line",
    data: {
      labels: income.labels || ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
      datasets: [
        {
          label: "Revenue",
          data: income.data || [0, 0, 0, 0, 0, 0],
          backgroundColor: "rgba(0, 80, 67, 0.2)",
          borderColor: "rgb(0, 80, 67)",
          borderWidth: 2,
          fill: true,
          tension: 0.3,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: "Revenue (Rs)",
          },
        },
        x: {
          beginAtZero: true,
          title: {
            display: true,
            text: `${income.labels[0]} - ${income.labels[6]} (days)`,
          },
        },
      },
      plugins: {
        tooltip: {
          callbacks: {
            label: function (context) {
              return `Rs. ${context.raw}`;
            },
          },
        },
      },
    },
  });

  // Inventory Pie Chart
  if (document.getElementById("myPieChart")) {
    const ctxPie = document.getElementById("myPieChart").getContext("2d");
    const myPieChart = new Chart(ctxPie, {
      type: "pie",
      data: {
        labels: ["In Stock", "Low Stock", "Out of Stock"],
        datasets: [
          {
            label: "Inventory Distribution",
            data: Array.isArray(stockLevel) ? stockLevel : [10, 5, 2], // Fallback data
            backgroundColor: [
              "rgb(0, 80, 67)", // Green for in stock
              "rgb(255, 159, 64)", // Orange for low stock
              "rgb(183, 28, 28)", // Red for out of stock
            ],
            borderColor: [
              "rgba(0, 80, 67, 0.8)",
              "rgba(255, 159, 64, 0.8)",
              "rgba(183, 28, 28, 0.8)",
            ],
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: "bottom",
          },
          tooltip: {
            callbacks: {
              label: function (context) {
                const label = context.label || "";
                const value = context.raw || 0;
                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                const percentage = Math.round((value / total) * 100);
                return `${label}: ${value} (${percentage}%)`;
              },
            },
          },
        },
      },
    });
  }

  // Patient Visit Chart
  if (document.getElementById("myPatientChart")) {
    const ctxPatient = document
      .getElementById("myPatientChart")
      .getContext("2d");
    const myPatientChart = new Chart(ctxPatient, {
      type: "bar",
      data: {
        labels: patientVisit.labels || ["Week 1", "Week 2", "Week 3", "Week 4"],
        datasets: [
          {
            label: "Patient Visits",
            data: patientVisit.data || [0, 0, 0, 0],
            backgroundColor: "rgba(108, 160, 220, 0.7)",
            borderColor: "rgba(108, 160, 220, 0.9)",
            borderWidth: 2,
            tension: 0.4,
            fill: true,
          },
        ],
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: "Number of Visits",
            },
          },
        },
      },
    });
  }

  // Sales by Category - Doughnut Chart
  if (document.getElementById("myDoughnutChart")) {
    const ctxDoughnut = document
      .getElementById("myDoughnutChart")
      .getContext("2d");
    const myDoughnutChart = new Chart(ctxDoughnut, {
      type: "doughnut",
      data: {
        labels: medicineCat.labels,
        datasets: [
          {
            label: "Sales by Category",
            data: medicineCat.data,
            backgroundColor: [
              "rgba(3, 39, 93, 0.8)",
              "rgba(75, 192, 192, 0.8)",
              "rgba(255, 205, 86, 0.8)",
              "rgba(201, 203, 207, 0.8)",
            ],
            borderColor: "#f0f0f0",
            borderWidth: 1,
            hoverOffset: 10,
          },
        ],
      },
      options: {
        responsive: true,
        cutout: "60%",
        plugins: {
          legend: {
            position: "bottom",
          },
        },
      },
    });
  }

  // Line Chart
  if (document.getElementById("myLineChart")) {
    const ctxLine = document.getElementById("myLineChart").getContext("2d");
    const myLineChart = new Chart(ctxLine, {
      type: "line",
      data: {
        labels: ["Week 1", "Week 2", "Week 3", "Week 4"],
        datasets: [
          {
            label: "Revenue Trend",
            data: [50000, 70000, 65000, 80000],
            backgroundColor: "rgba(3, 39, 93, 0.2)",
            borderColor: "rgb(3, 39, 93)",
            borderWidth: 2,
            tension: 0.4,
            fill: true,
          },
        ],
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
    });
  }
});

function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  sidebar.classList.toggle("open");
}
