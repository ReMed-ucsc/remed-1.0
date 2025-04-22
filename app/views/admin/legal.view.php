<?php require_once BASE_PATH.'/app/views/inc/header.view.php'; ?>
<?php require_once BASE_PATH.'/app/views/inc/navBar.view.php'; ?>

<h2 class="page-title">Legal & Compliance</h2>

<div class="details-container">
    <form action="<?= ROOT ?>/admin/legal/legalEdit" method="POST">
        <div class="Form">
            <label for="privacy_policy">Privacy Policy</label>
            <textarea class="legal" id="privacy_policy" name="privacy_policy" rows="20" required><?= htmlspecialchars($data['privacy']) ?></textarea>
        </div>

        <div class="Form">
            <label for="terms_conditions">Terms and Conditions</label>
            <textarea class="legal" id="terms_conditions" name="terms_conditions" rows="20" required><?= htmlspecialchars($data['terms']) ?></textarea>
        </div>

        <div>
            <button class="btn-green" type="submit">Save changes</button>
        </div>
    </form>
</div>

<?php require_once BASE_PATH.'/app/views/inc/footer.view.php'; ?>
