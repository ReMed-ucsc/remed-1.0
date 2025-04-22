<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ReMed Dashboard</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/incomeView.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/navbar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pharmacy/table.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/component/sidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= ROOT ?>/assets/js/pharmacy/income.js"> </script>
</head>

<body>

    <header>
        <?php
        include BASE_PATH . '/app/views/inc/pharmacy/regNavbar.php';
        ?>
    </header>

    <?php include BASE_PATH . '/app/views/inc/pharmacy/sidebar.php' ?>

    <div class="fullpage">
        <div class="main-content">
            <div class="structure">
                <div class="search-bar">
                    <form method="GET" style="margin: 20px 0;">
                        <div>
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
                        </div>
                        <button type="submit">Filter</button>
                    </form>
                </div>
                <div class="top">
                    <div class=" cards">
                        <div class="card black-card">
                            <img src="<?= ROOT ?>/assets/images/revenue.jpg" class="card-icon">
                            <h4>This month income</h4>
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
                    <section class="table-management income-table">
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
</body>