const ctxBar = document.getElementById('myBarChart').getContext('2d');
const myBarChart = new Chart(ctxBar, {
    type: 'line',
    data: {
        labels: income.labels, // X-axis labels
        datasets: [{
            label: 'Over the counter',
            data: income.data, // Y-axis values
            backgroundColor: 'rgb(0, 80, 67);',
            borderColor: 'rgb(0, 80, 67)',
            borderWidth: 1,
            fill: false,
            tension: 0.3,
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
        labels: ['In Stock', 'Low Stock', 'Out of Stock'],
        datasets: [{
            label: 'Inventory Distribution',
            data: stockLevel,
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

// const ctx = document.getElementById('myPatientChart').getContext('2d');
//     const myChart = new Chart(ctx, {
//       type: 'line', // Use 'line' for curved charts
//       data: {
//         labels: patientVisit.labels, // X-axis labels
//         datasets: [{
//           label: 'Sales',
//           data: patientVisit.data, // Data points
//           backgroundColor: 'rgba(108, 160, 220, 0.7)', // Area fill color
//           borderColor: 'rgba(108, 160, 220, 0.9)', // Line color
//           borderWidth: 2, // Line width
//           tension: 0.4, // Adds curve to the line
//           fill: true // Enables area coloring
//         }]
//       },
//       options: {
//         responsive: true,
//         scales: {
//           x: { // X-axis customization
//             beginAtZero: true
//           },
//           y: { // Y-axis customization
//             beginAtZero: true
//           }
//         }
//       }
//     });
  

    //new part from here

    // Revenue Trend - Line Chart
// const ctxLine = document.getElementById('myLineChart').getContext('2d');
// const myLineChart = new Chart(ctxLine, {
//   type: 'line',
//   data: {
//     labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
//     datasets: [{
//       label: 'Revenue',
//       data: [50000, 70000, 65000, 80000],
//       backgroundColor: 'rgba(3, 39, 93, 0.2)',
//       borderColor: 'rgb(3, 39, 93)',
//       borderWidth: 2,
//       tension: 0.4,
//       fill: true
//     }]
//   },
//   options: {
//     responsive: true,
//     scales: {
//       x: {
//         beginAtZero: true
//       },
//       y: {
//         beginAtZero: true
//       }
//     }
//   }
// });

// Sales by Category - Doughnut Chart
// const ctxDoughnut = document.getElementById('myDoughnutChart').getContext('2d');

// const myDoughnutChart = new Chart(ctxDoughnut, {
//   type: 'doughnut',
//   data: {
//     labels: ['Painkillers', 'Antibiotics', 'Vitamins', 'Others'],
//     datasets: [{
//       label: 'Sales by Category',
//       data: [35, 25, 20, 20],
//       backgroundColor: [rgba(3, 39, 93,0.3), rgba(32, 39, 93, 0.2), rgba(3, 93, 93, 0.2), rgba(3, 39, 93, 0.2)],
//       borderColor: '#f0f0f0', // subtle inner glow-like separation
//       borderWidth: 2,
//       hoverOffset: 10
//     }]
//   },
//   options: {
//     responsive: true,
//     cutout: '60%',
//     plugins: {
//       legend: {
//         position: 'bottom',
//         labels: {
//           color: '#333',
//           font: {
//             size: 12,
//             weight: 'bold'
//           }
//         }
//       }
//     }
//   }
// });
