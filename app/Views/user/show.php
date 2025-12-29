<?php $this->extend('templates/main'); ?>
<?php $this->section('content'); ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Detail User</h3>
        <div>
            <a href="<?= site_url('/kelola-users/' . $user['id_users'] . '/edit') ?>"
                class="btn btn-primary me-2">Edit</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-sm-3 text-muted">Nama</div>
                <div class="col-sm-9"><?= esc($user['nama']) ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-3 text-muted">Username</div>
                <div class="col-sm-9"><?= esc($user['username']) ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-3 text-muted">Email</div>
                <div class="col-sm-9"><?= esc($user['email']) ?></div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-3 text-muted">Role</div>
                <div class="col-sm-9"><?= esc($user['role']) ?></div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>