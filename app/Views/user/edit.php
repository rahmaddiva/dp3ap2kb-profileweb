<?php $this->extend('templates/main'); ?>
<?php $this->section('content'); ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Edit User</h3>
    </div>

    <?php $errors = session()->getFlashdata('errors') ?? (isset($errors) ? $errors : null); ?>
    <?php if ($errors): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $err): ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form action="<?= site_url('/kelola-users/update/' . $user['id_users']) ?>" method="post">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control"
                            value="<?= old('nama', $user['nama']) ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="<?= old('username', $user['username']) ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Isi bila ingin mengubah password">
                        <div class="form-text">Minimal 6 karakter. Kosongkan untuk mempertahankan password lama.</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="<?= old('email', $user['email']) ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-select">
                        <option value="Admin" <?= old('role', $user['role']) === 'Admin' ? 'selected' : '' ?>>Admin
                        </option>
                        <option value="User" <?= old('role', $user['role']) === 'User' ? 'selected' : '' ?>>User</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="<?= site_url('/kelola-users') ?>" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>