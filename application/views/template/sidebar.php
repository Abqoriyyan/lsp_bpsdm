<style>
    /* Kustomisasi Sidebar Modern */
    .bg-modern-sidebar {
        background-color: #2c395c !important;
        /* Warna dasar Navy Blue gelap */
        background-image: none !important;
        font-family: 'Nunito', sans-serif;
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.05);
        /* Bayangan halus ke kanan */
    }

    .bg-modern-sidebar .sidebar-brand {
        padding: 1.5rem 1rem;
        margin-bottom: 10px;
    }

    /* Styling Teks dan Icon Menu */
    .bg-modern-sidebar .nav-item .nav-link {
        color: rgba(255, 255, 255, 0.7);
        padding: 12px 20px;
        margin: 4px 15px;
        border-radius: 10px;
        /* Sudut melengkung kekinian */
        transition: all 0.3s ease;
    }

    .bg-modern-sidebar .nav-item .nav-link i {
        color: rgba(255, 255, 255, 0.5);
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .bg-modern-sidebar .nav-item .nav-link span {
        font-weight: 600;
        font-size: 0.9rem;
        letter-spacing: 0.3px;
    }

    /* Hover Effect */
    .bg-modern-sidebar .nav-item .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.05);
        color: #ffffff;
        transform: translateX(3px);
        /* Animasi geser sedikit ke kanan */
    }

    .bg-modern-sidebar .nav-item .nav-link:hover i {
        color: #EAB360;
        /* Icon berubah warna emas saat di-hover */
    }

    .bg-modern-sidebar .nav-item.active .nav-link {
        background-color: #374774;
        color: #EAB360;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .bg-modern-sidebar .nav-item.active .nav-link i {
        color: #EAB360;
    }

    .bg-modern-sidebar .collapse-inner {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin: 0 15px;
    }

    .bg-modern-sidebar .collapse-inner .collapse-item {
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .bg-modern-sidebar .collapse-inner .collapse-item:hover {
        background-color: #f8f9fc;
        color: #374774;
        font-weight: 700;
        padding-left: 20px;
    }
</style>

<ul class="navbar-nav bg-modern-sidebar sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('assets/lsp/logo-lsp1.png') ?>"
                style="width:55px; height:auto; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));" alt="Logo LSP" />
        </div>
    </a>

    <hr class="sidebar-divider my-1 mb-1" style="border-top: 1px solid rgba(255,255,255,0.1);">

    <?php if ($this->ion_auth->login_admin()) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('admin'); ?>">
                <i class="fas fa-fw fa-bullseye"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pra" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-fw fa-book"></i>
                <span>Pra-Asesmen</span>
            </a>
            <div id="pra" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="py-2 collapse-inner">
                    <h6 class="collapse-header">Pra-Asesmen:</h6>
                    <a class="collapse-item" href="<?= base_url('Admin/list_pra_asesmen'); ?>">Absensi Pra Asesmen</a>
                    <a class="collapse-item" href="<?= base_url('Admin/list_verifikasi_tuk'); ?>">Verifikasi TUK</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sertifikasi" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-fw fa-book-open"></i>
                <span>Asesmen</span>
            </a>
            <div id="sertifikasi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="py-2 collapse-inner">
                    <h6 class="collapse-header">Sertifikasi:</h6>
                    <a class="collapse-item" href="<?= base_url('admin/list_permohonan'); ?>">List Permohonan</a>
                    <a class="collapse-item" href="<?= base_url('admin/list_tinjau_permohonan'); ?>">Tinjau Permohonan</a>
                    <a class="collapse-item" href="<?= base_url('admin/list_tagihan_pembayaran'); ?>">Pembayaran</a>
                    <a class="collapse-item" href="<?= base_url('admin/list_penunjukan_asesor'); ?>">Penunjukan Asesor</a>
                    <a class="collapse-item" href="<?= base_url('admin/list_asesmen'); ?>">Absensi Asesmen</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pasca" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-fw fa-clipboard-check"></i>
                <span>Pasca-Asesmen</span>
            </a>
            <div id="pasca" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="py-2 collapse-inner">
                    <h6 class="collapse-header">Pasca-Asesmen:</h6>
                    <a class="collapse-item" href="<?= base_url('Admin/list_komite_teknis'); ?>">Penunjukan Komite</a>
                    <a class="collapse-item" href="<?= base_url('admin/list_selesai_penetapan'); ?>">QC - Selesai
                        Penetapan</a>
                    <a class="collapse-item" href="<?= base_url('admin/terbit_sertifikat'); ?>">Sertifikat Terbit</a>
                    <a class="collapse-item" href="<?= base_url('Admin/list_pernyataan_asesi'); ?>">Surat Pemegang</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#master" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-fw fa-key"></i>
                <span>Master</span>
            </a>
            <div id="master" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="py-2 collapse-inner">
                    <h6 class="collapse-header">Master:</h6>
                    <a class="collapse-item" href="<?= base_url('admin/master_tuk'); ?>">TUK</a>
                    <a class="collapse-item" href="<?= base_url('admin/master_asesor'); ?>">Asesor</a>
                    <a class="collapse-item" href="<?= base_url('admin/jadwal_asesmen'); ?>">Jadwal Asesmen</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bantuan" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-fw fa-lightbulb"></i>
                <span>Bantuan</span>
            </a>
            <div id="bantuan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="py-2 collapse-inner">
                    <h6 class="collapse-header">Bantuan:</h6>
                    <a class="collapse-item" href="<?= base_url('admin/tolak_permohonan'); ?>">Tolak Permohonan</a>
                </div>
            </div>
        </li>
    <?php } ?>

    <?php if ($this->ion_auth->login_user()) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('User'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('User/permohonan_skk') ?>">
                <i class="fas fa-fw fa-table"></i>
                <span>Sertifikasi</span>
            </a>
        </li>
    <?php } ?>

    <?php if ($this->ion_auth->login_asesor()) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('Asesor'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('Asesor/list_tugas_asesmen') ?>">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Tugas Asesmen</span>
            </a>
        </li>
    <?php } ?>

    <?php if ($this->ion_auth->login_komite()) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('Komite'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('Komite/list_penetapan') ?>">
                <i class="fas fa-fw fa-clipboard-list"></i>
                <span>List Penetapan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('Komite/selesai_penetapan') ?>">
                <i class="fas fa-fw fa-check-circle"></i>
                <span>Selesai Penetapan</span>
            </a>
        </li>
    <?php } ?>

    <?php if ($this->ion_auth->login_tuk()) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('Tuk'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('Tuk/materi_uji_skema') ?>">
                <i class="fas fa-fw fa-folder-open"></i>
                <span>Materi Uji & Skema</span>
            </a>
        </li>
    <?php } ?>

    <hr class="sidebar-divider d-none d-md-block mt-3" style="border-top: 1px solid rgba(255,255,255,0.1);">

    <div class="text-center d-none d-md-inline mb-4">
        <button class="rounded-circle border-0" id="sidebarToggle"
            style="background-color: rgba(255,255,255,0.1);"></button>
    </div>

</ul>
<div id="content-wrapper" class="d-flex flex-column">

    <div id="content">