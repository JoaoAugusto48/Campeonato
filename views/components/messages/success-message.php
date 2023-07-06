<?php if (isset($_SESSION['success_message'])) : ?>
    <div class="alert alert-success m-2" role="alert">
        <?= $_SESSION['success_message']; ?>
        <?php unset($_SESSION['success_message']); ?>
    </div>
<?php endif; ?>