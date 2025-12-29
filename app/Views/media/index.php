<?php $this->extend('templates/main'); ?>
<?php $this->section('content'); ?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Kelola Media</h3>
        <a href="/kelola-media/create" class="btn btn-success">Tambah Media</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-media" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#table-media').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '/kelola-media',
                        language: {
                            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/id.json'
                        }
                    });
                });
            </script>

        </div>
    </div>

</div>
<?php echo view('templates/partials') ?>
<?php $this->endSection(); ?>