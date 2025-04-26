document.addEventListener("DOMContentLoaded", function () {
    const incomeCard = document.querySelector(".black-card");
    const expensesCard = document.querySelector(".green-card");
    const incomeTable = document.querySelector(".income-table");
    const expensesTable = document.querySelector(".expenses-table");

    expensesCard.addEventListener("click", function () {
        incomeTable.style.display = "none";
        expensesTable.style.display = "block";
    })

    incomeCard.addEventListener("click", function () {
        incomeTable.style.display = "block";
        expensesTable.style.display = "none";
    })

    animateIncome();
    animateExpenses();
});

function animateIncome() {
    const el = document.getElementById("total-income");
    const target = parseInt(el.getAttribute("data-value"));
    let count = 0;
    const duration = 2000;
    const steps = 100;
    const increment = target / steps;

    const counter = setInterval(() => {
        count += increment;
        if (count >= target) {
            count = target;
            clearInterval(counter);
        }
        el.textContent = "Rs. " + Math.floor(count).toLocaleString();
    }, duration / steps);
}

function animateExpenses() {
    const ell = document.getElementById("total-expenses");
    const target = parseInt(ell.getAttribute("data-value"));
    console.log("Expenses target value:", target);

    let count = 0;
    const duration = 2000;
    const steps = 100;
    const increment = target / steps;

    const counter2 = setInterval(() => {
        count += increment;
        if (count >= target) {
            count = target;
            clearInterval(counter2);
        }
        ell.textContent = "Rs. " + Math.floor(count).toLocaleString();
    }, duration / steps);
}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('simpleDownloadBtn').addEventListener('click', function () {
        generateSimplePDF();
    });

    function generateSimplePDF() {
        try {
            // Get table data
            const table = document.querySelector('#orderReport table');
            const headerCells = table.querySelectorAll('thead th');
            const rows = table.querySelectorAll('tbody tr');

            // Extract header texts
            const headers = [];
            headerCells.forEach(cell => {
                headers.push(cell.textContent.trim());
            });

            // Extract row data
            const data = [];
            rows.forEach(row => {
                const rowData = [];
                row.querySelectorAll('td').forEach(cell => {
                    rowData.push(cell.textContent.trim());
                });
                data.push(rowData);
            });

            // Create PDF
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Add title
            doc.setFontSize(18);
            doc.text('Income Report', 105, 15, { align: 'center' });

            // Add date
            doc.setFontSize(12);
            doc.text('Generated on: ' + new Date().toLocaleString(), 105, 25, { align: 'center' });

            // Add summary
            doc.setFontSize(14);
            doc.text('Income Summary', 14, 35);

            doc.setFontSize(12);
            doc.text('Total Income: ' + document.getElementById('total-income').textContent, 14, 45);
            doc.text('Total Expenses: ' + document.getElementById('total-expenses').textContent, 14, 55);

            // Add table
            doc.autoTable({
                head: [headers],
                body: data,
                startY: 65,
                theme: 'grid',
                headStyles: { fillColor: [80, 80, 80] },
                styles: { overflow: 'linebreak' },
                columnStyles: {
                    0: { cellWidth: 30 },
                    1: { cellWidth: 30 },
                    2: { cellWidth: 70 },
                    3: { cellWidth: 'auto' }
                }
            });

            // Add footer
            const pageCount = doc.internal.pages.length;
            for (let i = 1; i <= pageCount; i++) {
                doc.setPage(i);
                doc.setFontSize(10);
                doc.text('Page ' + i + ' of ' + pageCount, 105, 290, { align: 'center' });
                doc.text('ReMed Pharmacy Management System', 105, 285, { align: 'center' });
            }

            // Save the PDF
            doc.save('simple_income_report.pdf');

        } catch (error) {
            console.error('Error generating simple PDF:', error);
            alert('Failed to generate PDF: ' + error.message);
        }
    }
});
