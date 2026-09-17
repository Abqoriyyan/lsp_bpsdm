<style>
    .bg-modern-sidebar {
        background-color: #2c395c !important;
        background-image: none !important;
        font-family: 'Nunito', sans-serif;
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.05);

        position: sticky;
        top: 0;
        height: 100vh;
        overflow-y: auto;
        overflow-x: hidden;
        z-index: 1000;
        width: 250px !important;
        transition: width 0.3s ease;
        box-sizing: border-box;
    }

    .bg-modern-sidebar * {
        box-sizing: border-box;
    }

    .bg-modern-sidebar::-webkit-scrollbar {
        width: 4px;
    }

    .bg-modern-sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 10px;
    }

    .bg-modern-sidebar .sidebar-brand {
        padding: 1.25rem 1rem;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .bg-modern-sidebar .nav-item {
        width: 100%;
    }

    .bg-modern-sidebar .nav-item .nav-link {
        color: rgba(255, 255, 255, 0.7);
        padding: 10px 12px;
        margin: 3px 10px;
        border-radius: 8px;
        transition: background-color 0.2s ease, color 0.2s ease;
        display: flex;
        align-items: center;
        width: calc(100% - 20px);
    }

    .bg-modern-sidebar .nav-item .nav-link i {
        color: rgba(255, 255, 255, 0.5);
        font-size: 1.05rem;
        width: 24px;
        min-width: 24px;
        flex-shrink: 0;
        text-align: center;
        transition: color 0.2s ease;
    }

    .bg-modern-sidebar .nav-item .nav-link span {
        font-weight: 600;
        font-size: 0.85rem;
        letter-spacing: 0.2px;
        margin-left: 10px;
        flex: 1;
        min-width: 0;
        white-space: normal;
        word-break: break-word;
        overflow-wrap: break-word;
        line-height: 1.3;
    }

    .bg-modern-sidebar .nav-item .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.08);
        color: #ffffff;
    }

    .bg-modern-sidebar .nav-item .nav-link:hover i {
        color: #EAB360;
    }

    .bg-modern-sidebar .nav-item.active .nav-link {
        background-color: #374774;
        color: #EAB360;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        font-weight: 700;
    }

    .bg-modern-sidebar .nav-item.active .nav-link i {
        color: #EAB360;
    }

    .bg-modern-sidebar .collapse-inner {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin: 4px 10px 10px 10px;
        padding: 0.5rem 0;
    }

    .bg-modern-sidebar .collapse-inner .collapse-header {
        font-size: 0.7rem;
        font-weight: 800;
        color: #b7b9cc;
        text-transform: uppercase;
        padding: 0.5rem 1rem;
        margin: 0;
    }

    .bg-modern-sidebar .collapse-inner .collapse-item {
        border-radius: 6px;
        transition: background-color 0.2s ease, color 0.2s ease;
        font-size: 0.82rem;
        padding: 8px 12px;
        margin: 2px 6px;
        white-space: normal;
        word-break: break-word;
        overflow-wrap: break-word;
        display: block;
        color: #3a3b45;
    }

    .bg-modern-sidebar .collapse-inner .collapse-item:hover {
        background-color: #f1f3f9;
        color: #2c395c;
        font-weight: 700;
        text-decoration: none;
    }

    .bg-modern-sidebar.toggled {
        width: 6.5rem !important;
        overflow: visible !important;
    }

    .bg-modern-sidebar.toggled .nav-item .nav-link span,
    .bg-modern-sidebar.toggled .sidebar-brand-text,
    .bg-modern-sidebar.toggled .nav-item .nav-link::after {
        display: none !important;
    }

    .bg-modern-sidebar.toggled .nav-item .nav-link {
        width: calc(100% - 16px);
        margin: 4px 8px;
        padding: 10px 0;
        justify-content: center;
    }

    .bg-modern-sidebar.toggled .nav-item .nav-link i {
        margin: 0;
        width: auto;
        min-width: 0;
        font-size: 1.15rem;
    }

    .bg-modern-sidebar.toggled .nav-item {
        position: relative;
    }

    .bg-modern-sidebar.toggled .nav-item .collapse {
        position: absolute;
        left: calc(6.5rem + 5px);
        top: 0;
        z-index: 1050;
        width: 13rem;
    }

    .bg-modern-sidebar.toggled .nav-item .collapse .collapse-inner {
        margin: 0;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        border: 1px solid #e3e6f0;
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
                    <a class="collapse-item" href="<?= base_url('Admin/list_penunjukan_komite'); ?>">Penunjukan Komite</a>
                    <a class="collapse-item" href="<?= base_url('admin/list_selesai_penetapan'); ?>">Selesai Penetapan</a>
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