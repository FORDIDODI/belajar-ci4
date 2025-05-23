<?= $this->extend('layouts/admin_layout'); ?>

<?= $this->section('content'); ?>
<?php
$uri = service('uri');
$totalSegments = $uri->getTotalSegments(); ?>
<div class="card">
    <div class="card-header bg-white">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <?php for ($i = 1; $i <= $totalSegments; $i++): ?>
                    <?php
                    $segment = $uri->getSegment($i);
                    $link = base_url(implode('/', array_slice($uri->getSegments(), 0, $i)));
                    $isLast = $i == $totalSegments;
                    ?>
                    <li class="breadcrumb-item <?= $isLast ? 'active' : '' ?>" <?= $isLast ? 'aria-current="page"' : '' ?>>
                        <?php if (!$isLast): ?>
                            <a class="text-decoration-none" href="<?= $link ?>"><?= ucfirst($segment) ?></a>
                        <?php else: ?>
                            <?= ucfirst($segment) ?>
                        <?php endif; ?>
                    </li>
                <?php endfor; ?>
            </ol>
        </nav>
    </div>

    <div class="card-body">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-3">
            <h5 class="card-title m-0">Daftar Berita</h5>
            <a href="<?= base_url('admin/berita/tambah'); ?>" class="btn btn-primary text-white rounded-pill px-3">
                Tambah Berita <i class="bi bi-plus-lg"></i>
            </a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div id="successAlert" class="alert alert-success fade show" role="alert">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table align-middle" id="tabel-berita">
                <thead class="table-light">
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">BERITA</th>
                        <th scope="col">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php foreach ($list_berita as $berita): ?>
                        <tr>
                            <th scope="row"><?= $nomor++; ?></th>
                            <td>
                                <div class="d-flex flex-column flex-sm-row gap-3 align-items-start align-items-sm-center">
                                    <img src="<?= $berita->gambar_id ? base_url('assets/img/upload/' . $berita->nama_file_gambar) : base_url('assets/img/upload/default.jpg'); ?>"
                                        alt="<?= $berita->slug; ?>"
                                        class="img-fluid object-fit-cover rounded"
                                        style="width: 100px; height: 70px;">

                                    <div>
                                        <span class="fw-semibold text-truncate judul-berita" title="<?= esc($berita->judul); ?>">
                                            <?= esc($berita->judul); ?>
                                        </span>
                                        <br>
                                        <small class="text-muted">
                                            <?php
                                            $createdAt = new DateTime($berita->created_at);
                                            $updatedAt = new DateTime($berita->updated_at);
                                            $now = new DateTime();

                                            $intervalCreated = $createdAt->diff($now);
                                            $intervalUpdated = $updatedAt->diff($now);

                                            $createdText = ($intervalCreated->y * 12 + $intervalCreated->m) . ' bulan ' . $intervalCreated->d . ' hari';
                                            $updatedText = ($intervalUpdated->y * 12 + $intervalUpdated->m) . ' bulan ' . $intervalUpdated->d . ' hari';
                                            ?>
                                            Dibuat: <?= trim($createdText) ?> yang lalu <br>
                                            Diubah: <?= trim($updatedText) ?> yang lalu
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <a class="btn btn-sm btn-primary text-white" title="Lihat berita" href="<?= base_url('berita/' . $berita->slug); ?>">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a class="btn btn-sm btn-info text-white" title="Edit berita">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" title="Hapus berita" type="submit">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>