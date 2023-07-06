<?php if (isset($_SESSION['error_message'])) : ?>
    <div class="alert alert-danger m-2" role="alert">
        <?= $_SESSION['error_message']; ?>
        <?php unset($_SESSION['error_message']); ?>
    </div>
<?php endif; ?>