document.addEventListener("DOMContentLoaded", function() {
    // Data for charts
    const income = {
        labels: ['January', 'February', 'March', 'April'],
        data: [4000, 5000, 4500, 6000]
    };
    
    const stockLevel = [30, 50, 20]; // Stock Levels: In Stock, Low Stock, Out of Stock
    const patientVisit = {
        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
        data: [200, 250, 300, 280]
    };

    // Bar Chart - Over the Counter Sales
    const ctxBar = document.getElementById('myBarChart').getContext('2d');
    const myBarChart = new Chart(ctxBar, {
        type: 'line',
        data: {
            labels: income.labels,
            datasets: [{
                label: 'Over the counter',
                data: income.data,
                backgroundColor: 'rgb(0, 80, 67)',
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

    // Pie Chart - Inventory Distribution
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
        },
    });

    // Line Chart - Patient Visit Trends
    const ctxPatient = document.getElementById('myPatientChart').getContext('2d');
    const myPatientChart = new Chart(ctxPatient, {
        type: 'line',
        data: {
            labels: patientVisit.labels,
            datasets: [{
                label: 'Patient Visits',
                data: patientVisit.data,
                backgroundColor: 'rgba(108, 160, 220, 0.7)',
                borderColor: 'rgba(108, 160, 220, 0.9)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: { beginAtZero: true },
                y: { beginAtZero: true }
            }
        }
    });

    // Line Chart - Revenue Trend
    const ctxLine = document.getElementById('myLineChart').getContext('2d');
    const myLineChart = new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [{
                label: 'Revenue',
                data: [50000, 70000, 65000, 80000],
                backgroundColor: 'rgba(3, 39, 93, 0.2)',
                borderColor: 'rgb(3, 39, 93)',
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: { beginAtZero: true },
                y: { beginAtZero: true }
            }
        }
    });

    // Doughnut Chart - Sales by Category
    const ctxDoughnut = document.getElementById('myDoughnutChart').getContext('2d');
    const myDoughnutChart = new Chart(ctxDoughnut, {
        type: 'doughnut',
        data: {
            labels: ['Painkillers', 'Antibiotics', 'Vitamins', 'Others'],
            datasets: [{
                label: 'Sales by Category',
                data: [35, 25, 20, 20],
                backgroundColor: [
                    'rgba(3, 39, 83, 0.2)',
                    'rgba(32, 39, 93, 0.2)',
                    'rgba(3, 93, 93, 0.2)',
                    'rgba(3, 39, 93, 0.2)'
                ],
                borderColor: '#f0f0f0',
                borderWidth: 2,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            cutout: '60%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#333',
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                }
            }
        }
    });
});
