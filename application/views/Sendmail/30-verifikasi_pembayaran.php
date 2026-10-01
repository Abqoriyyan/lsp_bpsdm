<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Perjanjian Sertifikasi</title>
</head>

<body
    style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
        style="background-color: #f1f5f9; padding: 40px 10px;">
        <tr>
            <td align="center">
                <!-- Main Container Card -->
                <table role="presentation" width="100%"
                    style="max-width: 600px; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); border: 1px solid #e2e8f0;"
                    cellspacing="0" cellpadding="0" border="0">

                    <!-- Header -->
                    <tr>
                        <td style="background-color: #1e293b; padding: 32px 24px; text-align: center;">
                            <?php if (!empty(base_url('assets/lsp/logo-lsp.png'))): ?>
                                <img src="<?= base_url('assets/lsp/logo-lsp.png') ?>" alt="Logo LSP"
                                    style="max-height: 50px; width: auto; margin-bottom: 12px; display: inline-block;">
                            <?php endif; ?>
                            <h1
                                style="color: #ffffff; font-size: 20px; font-weight: 700; margin: 0; letter-spacing: 0.5px;">
                                PROSES SELANJUTNYA</h1>
                            <p style="color: #94a3b8; font-size: 13px; margin: 6px 0 0 0;">Surat Perjanjian Sertifikasi
                                dan Konfirmasi Bebas Biaya
                            </p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 32px 28px;">
                            <p style="color: #334155; font-size: 15px; margin: 0 0 16px 0;">Kepada Yth.</p>
                            <h2 style="color: #0f172a; font-size: 18px; font-weight: 700; margin: 0 0 16px 0;">
                                <?= !empty($nama) ? $nama : 'Bapak/Ibu Pemohon'; ?>
                            </h2>

                            <p style="color: #475569; font-size: 14px; line-height: 1.6; margin: 0 0 20px 0;">
                                Terima kasih atas kepercayaan Anda melakukan permohonan Sertifikasi Kompetensi Kerja
                                Konstruksi (SKK Konstruksi) di <strong>LSP
                                    <?= isset($get_data_lsp->username) ? $get_data_lsp->username : ''; ?></strong>.
                            </p>

                            <p style="color: #475569; font-size: 14px; line-height: 1.6; margin: 0 0 20px 0;">
                                Permohonan Anda telah memasuki tahap berikutnya, yaitu <strong>Surat Perjanjian
                                    Sertifikasi dan Konfirmasi Bebas Biaya</strong>.
                            </p>

                            <!-- Detail Permohonan Box -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                                style="background-color: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 24px;">
                                <tr>
                                    <td style="padding: 16px 20px;">
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0"
                                            border="0" style="font-size: 14px;">
                                            <tr>
                                                <td width="35%"
                                                    style="padding: 6px 0; color: #64748b; font-weight: 500;">ID Izin
                                                    Permohonan</td>
                                                <td width="5%" style="padding: 6px 0; color: #64748b;">:</td>
                                                <td width="60%"
                                                    style="padding: 6px 0; color: #0f172a; font-weight: 700;">
                                                    <?= $id_izin; ?>
                                                </td>
                                            </tr>
                                            <?php if (!empty($jabker) && $jabker != '-'): ?>
                                                <tr>
                                                    <td style="padding: 6px 0; color: #64748b; font-weight: 500;">Jabatan
                                                        Kerja</td>
                                                    <td style="padding: 6px 0; color: #64748b;">:</td>
                                                    <td style="padding: 6px 0; color: #0f172a; font-weight: 600;">
                                                        <?= $jabker; ?>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <p style="color: #475569; font-size: 14px; line-height: 1.6; margin: 0 0 24px 0;">
                                Template surat perjanjian sertifikasi serta halaman konfirmasi bebas biaya
                                sertifikasi dapat diakses melalui tombol di bawah ini:
                            </p>

                            <!-- Call to Action Button -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                                style="margin-bottom: 28px;">
                                <tr>
                                    <td align="center">
                                        <a href="<?= base_url('pembayaran/checkout/') . base64_encode($id_izin); ?>"
                                            target="_blank"
                                            style="background-color: #2563eb; color: #ffffff; text-decoration: none; padding: 14px 28px; border-radius: 6px; font-weight: 600; font-size: 14px; display: inline-block; box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);">
                                            Lanjutkan &rarr;
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="color: #64748b; font-size: 13px; line-height: 1.5; margin: 0;">
                                Jika Anda mengalami kendala atau membutuhkan bantuan lebih lanjut, silakan hubungi tim
                                layanan pengguna kami.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="background-color: #f8fafc; padding: 20px 24px; text-align: center; border-top: 1px solid #e2e8f0;">
                            <p style="color: #94a3b8; font-size: 12px; margin: 0;">
                                &copy; <?= date('Y'); ?> LSP
                                <?= isset($get_data_lsp->username) ? $get_data_lsp->username : ''; ?>. All rights
                                reserved.<br>
                                Email ini dikirim secara otomatis oleh sistem, mohon tidak membalas email ini secara
                                langsung.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>