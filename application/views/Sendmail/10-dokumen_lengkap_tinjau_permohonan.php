<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Sertifikasi - Dokumen Lengkap</title>
</head>

<body
    style="margin: 0; padding: 0; background-color: #f4f6f9; font-family: 'Segoe UI', Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased;">

    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f4f6f9; padding: 20px 0;">
        <tr>
            <td align="center">

                <!-- Main Container -->
                <table border="0" cellpadding="0" cellspacing="0" width="100%"
                    style="max-width: 600px; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                    <tr>
                        <td align="center" style="background-color: #059669; padding: 25px 20px; color: #ffffff;">
                            <?php if (!empty($get_data_lsp->logo)): ?>
                                <img src="<?= base_url('assets/lsp/' . $get_data_lsp->logo); ?>" alt="Logo LSP"
                                    style="max-height: 50px; margin-bottom: 10px; display: block;">
                            <?php else: ?>
                                <img src="<?= base_url('assets/lsp/logo-lsp.png'); ?>" alt="Logo LSP"
                                    style="max-height: 50px; margin-bottom: 10px; display: block;">
                            <?php endif; ?>
                            <h2
                                style="margin: 0; font-size: 20px; font-weight: 600; color: #ffffff; letter-spacing: 0.5px;">
                                Permohonan Dinyatakan Lengkap</h2>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 30px 25px; color: #333333; font-size: 14px; line-height: 1.6;">

                            <p style="margin-top: 0;">Kepada Yth.<br><strong>Bapak/Ibu
                                    <?= isset($nama) ? $nama : ''; ?></strong>,</p>

                            <p>Terima kasih atas kepercayaan Anda dalam mengajukan Permohonan Sertifikasi Kompetensi
                                Kerja (SKK) di <strong>LSP
                                    <?= isset($get_data_lsp->nama_lsp) ? $get_data_lsp->nama_lsp : $get_data_lsp->username; ?></strong>.
                            </p>

                            <p>Tahap Verifikasi dan Validasi dokumen untuk permohonan Anda telah selesai dilaksanakan
                                dengan hasil <strong>LENGKAP & MEMENUHI SYARAT</strong>:</p>

                            <!-- Detail Permohonan Card -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; margin: 20px 0; padding: 15px;">
                                <tr>
                                    <td width="35%" style="padding: 6px 0; color: #64748b; font-weight: 500;">ID Izin
                                        Permohonan</td>
                                    <td width="5%" style="padding: 6px 0; color: #64748b;">:</td>
                                    <td width="60%" style="padding: 6px 0; color: #0f172a; font-weight: 600;">
                                        <?= $id_izin; ?>
                                    </td>
                                </tr>
                                <?php if (!empty($jabker)): ?>
                                    <tr>
                                        <td style="padding: 6px 0; color: #64748b; font-weight: 500;">Jabatan Kerja</td>
                                        <td style="padding: 6px 0; color: #64748b;">:</td>
                                        <td style="padding: 6px 0; color: #0f172a; font-weight: 600;"><?= $jabker; ?></td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <td style="padding: 6px 0; color: #64748b; font-weight: 500;">Status Verifikasi</td>
                                    <td style="padding: 6px 0; color: #64748b;">:</td>
                                    <td style="padding: 6px 0; color: #059669; font-weight: 700;">LENGKAP (Memenuhi
                                        Syarat)</td>
                                </tr>
                            </table>

                            <!-- Langkah Selanjutnya Box -->
                            <div
                                style="background-color: #ecfdf5; border-left: 4px solid #10b981; padding: 18px; border-radius: 6px; margin-bottom: 25px;">
                                <strong
                                    style="color: #047857; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 6px;">
                                    📌 Langkah Selanjutnya (Pra-Asesmen):
                                </strong>
                                <p style="margin: 0; color: #064e3b; font-size: 13px; line-height: 1.5;">
                                    Pastikan Anda telah melengkapi formulir permohonan SKK yaitu Form
                                    <strong>APL-01</strong> dan <strong>APL-02</strong> secara lengkap di
                                    aplikasi LSP sebelum melanjutkan ke proses <strong>Kirim Pra-Asesmen</strong>.
                                </p>
                            </div>

                            <!-- CTA Button -->
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 30px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="<?= isset($url) ? $url : base_url(); ?>" target="_blank"
                                            style="background-color: #2563eb; color: #ffffff; text-decoration: none; padding: 12px 30px; border-radius: 6px; font-weight: 600; font-size: 15px; display: inline-block; box-shadow: 0 2px 4px rgba(37, 99, 235, 0.3);">
                                            LOGIN
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin-bottom: 0;">Terima kasih atas kerja sama Anda.</p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center"
                            style="background-color: #f8fafc; padding: 20px; border-top: 1px solid #e2e8f0; color: #94a3b8; font-size: 12px;">
                            <p style="margin: 0 0 5px 0;"><strong>LSP
                                    <?= isset($get_data_lsp->nama_lsp) ? $get_data_lsp->nama_lsp : $get_data_lsp->username; ?></strong>
                            </p>
                            <p style="margin: 0;">Email ini dikirimkan secara otomatis oleh sistem. Mohon tidak membalas
                                email ini.</p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>