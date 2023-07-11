<?php if (isset($_SESSION['error_message'])) : ?>
    <div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
        <?= $_SESSION['error_message']; ?>
        <?php unset($_SESSION['error_message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>