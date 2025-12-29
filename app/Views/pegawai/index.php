<?php $this->extend('templates/main'); ?>
<?php $this->section('content'); ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Kelola Pegawai</h3>
        <!-- modal tambah pegawai -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPegawaiModal">
            <i class="bx bx-plus me-1"></i> Tambah Pegawai
        </button>
    </div>
    <!-- modal -->
    <?php $options = [
        'Kepala Dinas',
        'Sekretaris',
        'Sub Bagian Perencanaan dan Keuangan',
        'Sub Bagian Umum dan Kepegawaian',
        'Kepala Bidang Keluarga Berencana dan Keluarga Sejahtera',
        'Kepala Bidang Pengendalian Penduduk Data dan Informasi',
        'Kepala Bidang Pemberdayaan Perempuan dan Perlindungan Anak',
        'Kepala UPTD PPA',
        'Jabatan Fungsional Lainnya',
        'Pegawai Outsorcing'
    ]; ?>
    <div class="modal fade" id="tambahPegawaiModal" tabindex="-1" aria-labelledby="tambahPegawaiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPegawaiModalLabel">Tambah Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo base_url('kelola-pegawai/store'); ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body pb-0">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" required>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <select name="jabatan" id="jabatan" class="form-control" required>
                                <?php $oldJ = old('jabatan');
                                foreach ($options as $opt): ?>
                                    <option value="<?= esc($opt) ?>" <?= $oldJ === $opt ? 'selected' : '' ?>><?= esc($opt) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Foto Pegawai</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <small class="form-text text-muted">Foto pegawai (opsional).</small>

                        </div>
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
        <h5 class="card-header">Data Pegawai</h5>
        <div class=" card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="" class="table table-striped datatables-basic" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($pegawai as $p): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo esc($p['nama']); ?></td>
                                    <td><?php echo esc($p['nip']); ?></td>
                                    <td><?php echo esc($p['jabatan']); ?></td>
                                    <td>
                                        <!-- modal edit -->
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editPegawaiModal<?php echo $p['id_pegawai']; ?>">
                                            Edit</button>
                                        <a href="<?php echo base_url('pegawai/delete/' . $p['id_pegawai']); ?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pegawai ini?');">
                                            Hapus</a>
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
<!-- modals edit pegawai -->
<?php foreach ($pegawai as $p): ?>
    <div class="modal fade" id="editPegawaiModal<?php echo $p['id_pegawai']; ?>" tabindex="-1"
        aria-labelledby="editPegawaiModalLabel<?php echo $p['id_pegawai']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPegawaiModalLabel<?php echo $p['id_pegawai']; ?>">Edit Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo base_url('kelola-pegawai/update/' . $p['id_pegawai']); ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body pb-0">
                        <div class="mb-3">
                            <label for="nama<?php echo $p['id_pegawai']; ?>" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama<?php echo $p['id_pegawai']; ?>" name="nama"
                                value="<?php echo esc($p['nama']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nip<?php echo $p['id_pegawai']; ?>" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip<?php echo $p['id_pegawai']; ?>" name="nip"
                                value="<?php echo esc($p['nip']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan<?php echo $p['id_pegawai']; ?>" class="form-label">Jabatan</label>
                            <select class="form-control" id="jabatan<?php echo $p['id_pegawai']; ?>" name="jabatan"
                                required>
                                <?php foreach ($options as $opt): ?>
                                    <option value="<?= esc($opt) ?>" <?= $p['jabatan'] === $opt ? 'selected' : '' ?>>
                                        <?= esc($opt) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image<?php echo $p['id_pegawai']; ?>" class="form-label">Foto Pegawai</label>
                            <input type="file" class="form-control" id="image<?php echo $p['id_pegawai']; ?>" name="image"
                                accept="image/*">
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
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