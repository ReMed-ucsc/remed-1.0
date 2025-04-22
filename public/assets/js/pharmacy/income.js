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
