<?php $this->extend('templates/main'); ?>
<?php $this->section('content'); ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Kelola User</h3>
        <a href="/kelola-users/create" class="btn btn-success">Tambah User</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-users" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $index => $user): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= esc($user['nama']) ?></td>
                                <td><?= esc($user['username']) ?></td>
                                <td><?= esc($user['role']) ?></td>
                                <td>
                                    <a href="/kelola-users/<?= $user['id_users'] ?>/edit"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <a href="/kelola-users/<?= $user['id_users'] ?>" class="btn btn-info btn-sm">View</a>
                                    <form action="/kelola-users/<?= $user['id_users'] ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?php echo view('templates/partials') ?>
<?php $this->endSection(); ?>