<?php echo $this->extend('templates/main'); ?>
<?php echo $this->section('content'); ?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Welcome Message -->
            <div class="col-12 mb-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="text-white mb-1">Selamat Datang,
                                    <?php echo session()->get('nama') ?>! 👋
                                </h4>
                                <p class="mb-0">CMS | DP3AP2KB</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php echo $this->endSection(); ?>