</body>

<form method="GET" id="dateForm">
    <div class="search-bar-styles">
        <label for="date">Select Date:</label>
        <input type="date" name="date" id="date" class="select" value="<?= htmlspecialchars($date ?? date('Y-m-d')) ?>">
    </div>
</form>

<script>
    document.getElementById('date').addEventListener('change', function() {
        document.getElementById('dateForm').submit();
    });
</script>

</html>