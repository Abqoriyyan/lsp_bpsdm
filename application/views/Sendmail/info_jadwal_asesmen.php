<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Sertifikasi - Informasi Jadwal Asesmen</title>
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
                                JADWAL ASESMEN SERTIFIKASI</h1>
                            <p style="color: #94a3b8; font-size: 13px; margin: 6px 0 0 0;">Informasi Tempat & Waktu
                                Pelaksanaan Asesmen SKK</p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 32px 28px;">
                            <p style="color: #334155; font-size: 15px; margin: 0 0 16px 0;">Kepada Yth.</p>
                            <h2 style="color: #0f172a; font-size: 18px; font-weight: 700; margin: 0 0 16px 0;">
                                <?= !empty($get_data_personal_permohonan[0]['nama']) ? $get_data_personal_permohonan[0]['nama'] : 'Bapak/Ibu Pemohon'; ?>
                            </h2>

                            <p style="color: #475569; font-size: 14px; line-height: 1.6; margin: 0 0 20px 0;">
                                Pemberitahuan mengenai jadwal asesmen untuk Permohonan Sertifikasi Anda dengan
                                <strong>ID-Izin: <?= $id_izin; ?></strong>. Berikut adalah rincian pelaksanaan asesmen
                                yang wajib Anda perhatikan:
                            </p>

                            <!-- Detail Asesmen & TUK Box -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                                style="background-color: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 24px;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0"
                                            border="0" style="font-size: 14px; line-height: 1.5;">
                                            <tr>
                                                <td width="30%" valign="top"
                                                    style="padding: 6px 0; color: #64748b; font-weight: 500;">ID Izin
                                                </td>
                                                <td width="5%" valign="top" style="padding: 6px 0; color: #64748b;">:
                                                </td>
                                                <td width="65%" valign="top"
                                                    style="padding: 6px 0; color: #0f172a; font-weight: 700;">
                                                    <?= $id_izin; ?>
                                                </td>
                                            </tr>
                                            <?php if (!empty($jabker) && $jabker != '-'): ?>
                                                <tr>
                                                    <td valign="top"
                                                        style="padding: 6px 0; color: #64748b; font-weight: 500;">Jabatan
                                                        Kerja</td>
                                                    <td valign="top" style="padding: 6px 0; color: #64748b;">:</td>
                                                    <td valign="top"
                                                        style="padding: 6px 0; color: #0f172a; font-weight: 600;">
                                                        <?= $jabker; ?>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td valign="top"
                                                    style="padding: 6px 0; color: #64748b; font-weight: 500;">Nama TUK
                                                </td>
                                                <td valign="top" style="padding: 6px 0; color: #64748b;">:</td>
                                                <td valign="top"
                                                    style="padding: 6px 0; color: #0f172a; font-weight: 600;">
                                                    <?= isset($get_data_penunjukan_asesor->nama_tuk) ? $get_data_penunjukan_asesor->nama_tuk : '-'; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top"
                                                    style="padding: 6px 0; color: #64748b; font-weight: 500;">Alamat TUK
                                                </td>
                                                <td valign="top" style="padding: 6px 0; color: #64748b;">:</td>
                                                <td valign="top" style="padding: 6px 0; color: #334155;">
                                                    <?= isset($get_data_penunjukan_asesor->alamat) ? $get_data_penunjukan_asesor->alamat : '-'; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top"
                                                    style="padding: 6px 0; color: #64748b; font-weight: 500;">Jadwal
                                                    Pelaksanaan</td>
                                                <td valign="top" style="padding: 6px 0; color: #64748b;">:</td>
                                                <td valign="top"
                                                    style="padding: 6px 0; color: #2563eb; font-weight: 700;">
                                                    <?php
                                                    $tgl_mulai = isset($get_data_penunjukan_asesor->tanggal_mulai) ? $get_data_penunjukan_asesor->tanggal_mulai : '-';
                                                    $tgl_selesai = isset($get_data_penunjukan_asesor->tanggal_selesai) ? $get_data_penunjukan_asesor->tanggal_selesai : $tgl_mulai;
                                                    ?>
                                                    <?= ($tgl_mulai == $tgl_selesai) ? $tgl_mulai : $tgl_mulai . ' s/d ' . $tgl_selesai; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Important Note Box -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                                style="background-color: #eff6ff; border-left: 4px solid #2563eb; border-radius: 4px; margin-bottom: 24px;">
                                <tr>
                                    <td style="padding: 14px 16px;">
                                        <p style="color: #1e40af; font-size: 13px; line-height: 1.5; margin: 0;">
                                            <strong>Himbauan:</strong> Mohon hadir di Alamat TUK sesuai jadwal yang
                                            telah ditentukan serta membawa kelengkapan dokumen yang diperlukan.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <p style="color: #64748b; font-size: 13px; line-height: 1.5; margin: 0;">
                                Terima kasih atas perhatian dan kerja sama Anda.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="background-color: #f8fafc; padding: 20px 24px; text-align: center; border-top: 1px solid #e2e8f0;">
                            <p style="color: #94a3b8; font-size: 12px; margin: 0;">
                                &copy; <?= date('Y'); ?> LSP. All rights reserved.<br>
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