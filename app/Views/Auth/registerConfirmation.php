<?php if (session()->getFlashdata('success_message')) : ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success_message') ?>
    </div>
<?php elseif (session()->getFlashdata('error_message')) : ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error_message') ?>
    </div>
<?php endif; ?>
