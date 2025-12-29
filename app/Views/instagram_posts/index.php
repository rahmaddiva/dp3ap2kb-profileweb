<?php $this->extend('templates/main'); ?>
<?php $this->section('content'); ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0"><?= $title ?></h3>
        <!-- modal tambah pegawai -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPostinganModal">
            <i class="bx bx-plus me-1"></i> Tambah Postingan
        </button>
    </div>
    <div class="modal fade" id="tambahPostinganModal" tabindex="-1" aria-labelledby="tambahPostinganModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPostinganModalLabel">Tambah Postingan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo base_url('kelola-instagram/store'); ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body pb-0">
                        <di class="mb-3">
                            <label for="post_url" class="form-label">URL Postingan</label>
                            <input type="text" class="form-control" id="post_url" name="post_url" required>
                        </di>

                        <div class="modal-footer pt-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <h5 class="card-header">Data Postingan</h5>
        <div class=" card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="" class="table table-striped datatables-basic" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>URL Postingan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($posts as $p): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo esc($p['post_url']); ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Aksi postingan">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editPostinganModal<?php echo $p['id']; ?>" title="Edit"
                                                aria-label="Edit">
                                                <i class="bx bx-edit"></i>
                                            </button>
                                            <?php if (isset($p['is_active']) && $p['is_active']): ?>
                                                <a href="<?php echo base_url('kelola-instagram/deactivate/' . $p['id']); ?>"
                                                    class="btn btn-success" title="Nonaktifkan" aria-label="Nonaktifkan"
                                                    onclick="return confirm('Nonaktifkan postingan ini?');">
                                                    <i class="bx bx-toggle-left"></i>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo base_url('kelola-instagram/activate/' . $p['id']); ?>"
                                                    class="btn btn-secondary" title="Aktifkan" aria-label="Aktifkan"
                                                    onclick="return confirm('Aktifkan postingan ini?');">
                                                    <i class="bx bx-toggle-right"></i>
                                                </a>
                                            <?php endif; ?>
                                            <a href="<?php echo base_url('kelola-instagram/delete/' . $p['id']); ?>"
                                                class="btn btn-danger" title="Hapus" aria-label="Hapus"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?');">
                                                <i class="bx bx-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>

    </div>
</div>
<!-- modals edit postingan -->
<?php foreach ($posts as $p): ?>
    <div class="modal fade" id="editPostinganModal<?php echo $p['id']; ?>" tabindex="-1"
        aria-labelledby="editPostinganModalLabel<?php echo $p['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPostinganModalLabel<?php echo $p['id']; ?>">Edit Postingan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo base_url('kelola-instagram/update/' . $p['id']); ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body pb-0">
                        <div class="mb-3">
                            <label for="post_url<?php echo $p['id']; ?>" class="form-label">URL Postingan</label>
                            <input type="text" class="form-control" id="post_url<?php echo $p['id']; ?>" name="post_url"
                                value="<?php echo esc($p['post_url']); ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer pt-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php echo view('templates/partials') ?>
<?php $this->endSection(); ?>