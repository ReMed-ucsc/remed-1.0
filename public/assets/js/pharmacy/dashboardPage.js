const ctxBar = document.getElementById('myBarChart').getContext('2d');
const myBarChart = new Chart(ctxBar, {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'], // X-axis labels
        datasets: [{
            label: 'Over the counter',
            data: [20000, 30000, 25000, 40000, 60000, 50000], // Y-axis values
            backgroundColor: 'rgb(0, 80, 67);',
            borderColor: 'rgb(0, 80, 67);',
            borderWidth: 1
        },
        {
            label: 'Prescription drugs',
            data: [15000, 25000, 20000, 30000, 50000, 40000],
            backgroundColor: 'rgb(3, 39, 93)',
            borderColor: 'rgb(3, 39, 93)',
            borderWidth: 1
        },
        {
            label: 'Supplements',
            data: [10000, 20000, 15000, 25000, 40000, 30000],
            backgroundColor: 'rgb(183, 28, 28)',
            borderColor: 'rgb(183, 28, 28)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});

const ctxPie = document.getElementById('myPieChart').getContext('2d');
const myPieChart = new Chart(ctxPie, {
    type: 'pie',
    data: {
        labels: ['Over the counter', 'Prescription drugs', 'Supplements'],
        datasets: [{
            label: 'Inventory Distribution',
            data: [70, 20, 10],
            backgroundColor: [
                'rgb(0, 80, 67)',
                'rgb(3, 39, 93)',
                'rgb(183, 28, 28)'
            ],
            borderColor: [
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        // maintainAspectRatio: false,
    },
});


function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('open');  // Toggle the 'open' class to show or hide sidebar
}

const ctx = document.getElementById('myPatientChart').getContext('2d');
    const myChart = new Chart(ctx, {
      type: 'line', // Use 'line' for curved charts
      data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'], // X-axis labels
        datasets: [{
          label: 'Sales',
          data: [30, 50, 40, 60, 70, 90], // Data points
          backgroundColor: 'rgba(108, 160, 220, 0.7)', // Area fill color
          borderColor: 'rgba(108, 160, 220, 0.9)', // Line color
          borderWidth: 2, // Line width
          tension: 0.4, // Adds curve to the line
          fill: true // Enables area coloring
        }]
      },
      options: {
        responsive: true,
        scales: {
          x: { // X-axis customization
            beginAtZero: true
          },
          y: { // Y-axis customization
            beginAtZero: true
          }
        }
      }
    });
  
