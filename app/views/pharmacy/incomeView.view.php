<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReMed Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/navbar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/table.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/incomeView.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/component/sidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/income.js"> </script>
</head>

<body data-user-id="<?php echo $_SESSION['user_id'] ?? ''; ?>">

    <header>
        <?php
        include BASE_PATH . '/app/views/inc/pharmacy/regNavbar.php';
        ?>
    </header>

    <?php include BASE_PATH . '/app/views/inc/pharmacy/sidebar.php' ?>

    <div class="fullpage">
        <div class="main-content">
            <h2>Income</h2>
            <div class="structure">
                <div class="search-bar">
                    <form method="GET">
                        <div class="search-bar-styles">
                            <label for="month">Month:</label>
                            <select name="month" id="month" class="select">
                                <?php for ($m = 1; $m <= 12; $m++): ?>
                                    <option value="<?= $m ?>" <?= $m == $month ? 'selected' : '' ?>>
                                        <?= date('F', mktime(0, 0, 0, $m, 1)) ?>
                                    </option>
                                <?php endfor ?>
                            </select>

                            <label for="year">Year:</label>
                            <select name="year" id="year" class="select">
                                <?php
                                $currentYear = date('Y');
                                for ($y = $currentYear - 5; $y <= $currentYear; $y++): ?>
                                    <option value="<?= $y ?>" <?= $y == $year ? 'selected' : '' ?>>
                                        <?= $y ?>
                                    </option>
                                <?php endfor ?>
                            </select>

                            <button type="submit" class="select">Filter</button>
                        </div>
                    </form>
                </div>
                <div class="top">
                    <div class=" cards">
                        <div class="card black-card">
                            <div><img src="<?= ROOT ?>/assets/images/revenue.jpg" class="card-icon"></div>
                            <div>
                                <h4>This month income</h4>
                            </div>
                            <div class="data">
                                <h2>
                                    <p id="total-income" data-value="<?= $totalIncome ?>">
                                        Rs. 0
                                    </p>
                                </h2>
                            </div>
                            <a href="<?= ROOT ?>/income"></a>
                        </div>
                        <div class="card green-card">
                            <img src="<?= ROOT ?>/assets/images/inventory.jpg" class="card-icon">
                            <h4>This month expenses</h4>
                            <div class="data">
                                <h2>
                                    <p id="total-expenses" data-value="<?= $totalExpenses ?>">
                                        Rs. 0
                                    </p>
                                </h2>
                            </div>
                            <a href="<?= ROOT ?>/income"></a>
                        </div>
                    </div>
                </div>

                <div class="middle">
                    <button id="simpleDownloadBtn"><i class="ph-bold ph-download-simple" style="font-size: 20px;"></i>Download PDF</button>

                    <section class="table-management income-table" id="orderReport">
                        <h3>Income</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 20%;">Order ID</th>
                                    <th style="width: 20%;">Patient ID</th>
                                    <th style="width: 40%;">Date</th>
                                    <th style="width: 20%">Total Bill</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($orders)): ?>
                                    <?php foreach ($orders as $order): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($order->orderId) ?></td>
                                            <td><?= htmlspecialchars($order->patientId) ?></td>
                                            <td><?= htmlspecialchars($order->date) ?></td>
                                            <td><?= htmlspecialchars($order->totalBill) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4">
                                            <h2>No data to show</h2>
                                        </td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </section>
                    <section class="table-management expenses-table" style="display: none;">
                        <h3>Expenses</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 20%;">Stock ID</th>
                                    <th style="width: 20%">Inventory ID</th>
                                    <th style="width: 30%;">Stock Quantity</th>
                                    <th style="width: 30%;">Purchase Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($expenses)): ?>
                                    <?php foreach ($expenses as $expense): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($expense->stockId) ?></td>
                                            <td><?= htmlspecialchars($expense->InventoryId) ?></td>
                                            <td><?= htmlspecialchars($expense->stockQuantity) ?></td>
                                            <td><?= htmlspecialchars($expense->purchaseCost) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <td colspan="4">
                                        <h4>No data to show</h4>
                                    </td>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script>
        function generateTwoPagePDF() {
            try {
                // First, check if we can access the income table
                const incomeTableSection = document.querySelector('#orderReport .income-table') || document.querySelector('#orderReport');

                if (!incomeTableSection) {
                    throw new Error("Income table section not found. Please check the HTML structure.");
                }

                const incomeTable = incomeTableSection.querySelector('table');

                if (!incomeTable) {
                    throw new Error("Income table not found within the section. Please check the HTML structure.");
                }

                // Get income table data
                const incomeHeaderCells = incomeTable.querySelectorAll('thead th');
                const incomeRows = incomeTable.querySelectorAll('tbody tr');

                // Extract income header texts
                const incomeHeaders = [];
                incomeHeaderCells.forEach(cell => {
                    incomeHeaders.push(cell.textContent.trim());
                });

                // Extract income row data
                const incomeData = [];
                incomeRows.forEach(row => {
                    const rowData = [];
                    row.querySelectorAll('td').forEach(cell => {
                        rowData.push(cell.textContent.trim());
                    });
                    incomeData.push(rowData);
                });

                // Now look for the expenses table - with error handling
                let expensesTable = null;
                let expensesHeaders = [];
                let expensesData = [];

                // Try multiple possible selectors for expenses table
                const expensesTableSection = document.querySelector('.expenses-table') ||
                    document.querySelector('#expensesReport') ||
                    document.querySelector('section.expenses-table');

                if (expensesTableSection) {
                    expensesTable = expensesTableSection.querySelector('table');

                    if (expensesTable) {
                        // Extract expenses header texts
                        const expensesHeaderCells = expensesTable.querySelectorAll('thead th');
                        expensesHeaderCells.forEach(cell => {
                            expensesHeaders.push(cell.textContent.trim());
                        });

                        // Extract expenses row data
                        const expensesRows = expensesTable.querySelectorAll('tbody tr');
                        expensesRows.forEach(row => {
                            const rowData = [];
                            row.querySelectorAll('td').forEach(cell => {
                                rowData.push(cell.textContent.trim());
                            });
                            expensesData.push(rowData);
                        });
                    } else {
                        console.warn("Expenses table not found within the expenses section");
                    }
                } else {
                    console.warn("Expenses table section not found in document");
                }

                // Create PDF
                const {
                    jsPDF
                } = window.jspdf;
                const doc = new jsPDF();

                // Get month and year for header
                const month = document.getElementById('month')?.options[document.getElementById('month')?.selectedIndex]?.text || '';
                const year = document.getElementById('year')?.value || '';

                // ===== PAGE 1: INCOME =====

                // Add title with pharmacy name
                doc.setFontSize(22);
                doc.setTextColor(44, 62, 80);
                doc.text('ReMed Pharmacy', 105, 15, {
                    align: 'center'
                });

                // Add subtitle
                doc.setFontSize(18);
                doc.setTextColor(52, 73, 94);
                doc.text(`Income Report - ${month} ${year}`, 105, 25, {
                    align: 'center'
                });

                // Add date
                doc.setFontSize(11);
                doc.setTextColor(100, 100, 100);
                doc.text('Generated on: ' + new Date().toLocaleString(), 105, 32, {
                    align: 'center'
                });

                //summary boxes
                // Income card
                doc.setFillColor(52, 152, 219);
                doc.rect(14, 40, 85, 35, 'F');
                doc.setTextColor(255, 255, 255);
                doc.setFontSize(14);
                doc.text('This month income', 56, 50, {
                    align: 'center'
                });
                doc.setFontSize(16);

                // Income amout
                const totalIncomeElement = document.getElementById('total-income');
                const totalIncomeText = totalIncomeElement ? totalIncomeElement.textContent : "Rs. 0";
                doc.text(totalIncomeText, 56, 65, {
                    align: 'center'
                });

                // Expenses card
                doc.setFillColor(46, 204, 113);
                doc.rect(110, 40, 85, 35, 'F');
                doc.setTextColor(255, 255, 255);
                doc.setFontSize(14);
                doc.text('This month expenses', 152, 50, {
                    align: 'center'
                });
                doc.setFontSize(16);

                // Safely get expenses amount
                const totalExpensesElement = document.getElementById('total-expenses');
                const totalExpensesText = totalExpensesElement ? totalExpensesElement.textContent : "Rs. 0";
                doc.text(totalExpensesText, 152, 65, {
                    align: 'center'
                });

                // Add page 1 heading
                doc.setFontSize(16);
                doc.setTextColor(44, 62, 80);
                doc.text('Income Details', 105, 85, {
                    align: 'center'
                });

                // Add income table
                doc.autoTable({
                    head: [incomeHeaders],
                    body: incomeData,
                    startY: 95,
                    theme: 'grid',
                    headStyles: {
                        fillColor: [52, 73, 94],
                        textColor: [255, 255, 255],
                        fontStyle: 'bold',
                        halign: 'left',
                        fontSize: 12
                    },
                    bodyStyles: {
                        textColor: [44, 62, 80],
                        fontSize: 11
                    },
                    alternateRowStyles: {
                        fillColor: [240, 240, 240]
                    },
                    styles: {
                        overflow: 'linebreak',
                        cellPadding: 6
                    },
                    columnStyles: {
                        0: {
                            cellWidth: 30
                        },
                        1: {
                            cellWidth: 30
                        },
                        2: {
                            cellWidth: 70
                        },
                        3: {
                            cellWidth: 'auto',
                            halign: 'right'
                        }
                    }
                });

                // Set total pages based on whether we have expenses data
                const totalPages = expensesData.length > 0 ? 2 : 1;

                // Add footer to page 1
                doc.setFontSize(10);
                doc.setTextColor(100, 100, 100);
                doc.text(`Page 1 of ${totalPages}`, 105, 290, {
                    align: 'center'
                });
                doc.text('ReMed Pharmacy Management System', 105, 285, {
                    align: 'center'
                });

                // ===== PAGE 2: EXPENSES (only if we have data) =====
                if (expensesData.length > 0) {
                    // Add new page
                    doc.addPage();

                    // Add title with pharmacy name on page 2
                    doc.setFontSize(22);
                    doc.setTextColor(44, 62, 80);
                    doc.text('ReMed Pharmacy', 105, 15, {
                        align: 'center'
                    });

                    // Add subtitle
                    doc.setFontSize(18);
                    doc.setTextColor(52, 73, 94);
                    doc.text(`Expenses Report - ${month} ${year}`, 105, 25, {
                        align: 'center'
                    });

                    // Add date
                    doc.setFontSize(11);
                    doc.setTextColor(100, 100, 100);
                    doc.text('Generated on: ' + new Date().toLocaleString(), 105, 32, {
                        align: 'center'
                    });

                    // Add page 2 heading
                    doc.setFontSize(16);
                    doc.setTextColor(44, 62, 80);
                    doc.text('Expenses Details', 105, 45, {
                        align: 'center'
                    });

                    // Add expenses table
                    doc.autoTable({
                        head: [expensesHeaders],
                        body: expensesData,
                        startY: 55,
                        theme: 'grid',
                        headStyles: {
                            fillColor: [52, 73, 94],
                            textColor: [255, 255, 255],
                            fontStyle: 'bold',
                            halign: 'left',
                            fontSize: 12
                        },
                        bodyStyles: {
                            textColor: [44, 62, 80],
                            fontSize: 11
                        },
                        alternateRowStyles: {
                            fillColor: [240, 240, 240]
                        },
                        styles: {
                            overflow: 'linebreak',
                            cellPadding: 6
                        },
                        columnStyles: {
                            0: {
                                cellWidth: 35
                            },
                            1: {
                                cellWidth: 35
                            },
                            2: {
                                cellWidth: 35
                            },
                            3: {
                                cellWidth: 'auto',
                                halign: 'right'
                            }
                        }
                    });

                    // Add footer to page 2
                    doc.setFontSize(10);
                    doc.setTextColor(100, 100, 100);
                    doc.text('Page 2 of 2', 105, 290, {
                        align: 'center'
                    });
                    doc.text('ReMed Pharmacy Management System', 105, 285, {
                        align: 'center'
                    });
                }

                // Save the PDF with month/year in filename
                doc.save(`Income_Expenses_Report_${month}_${year}.pdf`);

            } catch (error) {
                console.error('Error generating PDF:', error);
                alert('Failed to generate PDF: ' + error.message);
            }
        }

        //download button
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('simpleDownloadBtn').addEventListener('click', function() {
                generateTwoPagePDF();
            });
        });
    </script>
</body>