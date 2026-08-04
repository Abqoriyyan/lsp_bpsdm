<?php
// 1. Load bagian Head dan CSS
$this->load->view('template/header');

// 2. Load navigasi samping (Sidebar)
$this->load->view('template/sidebar');

// 3. Load navigasi atas (Topbar)
$this->load->view('template/topbar');

// 4. Tempat untuk merender konten utama (Dashboard / Form Pelaporan dsb)
echo $contents;

// 5. Load Footer dan file-file JavaScript
$this->load->view('template/footer');