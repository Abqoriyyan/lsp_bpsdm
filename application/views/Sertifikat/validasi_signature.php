<style>
    body{
        background-color:#f5f5f5;
        font-family : Arial, Helvetica, sans-serif;
    }
</style>
<div style="text-align:center;">
    <img src="<?php echo base_url('assets/lsp/logo-lsp.png');?>" style="width:120px; height:120px;"/>
    <h3 style="text-align:center; color:#111;">Lembaga Sertifikasi Profesi <?=$data_lsp->username;?></h3>
    <h2 style="text-align:center; color:#111;">Data Validasi Signature SKK-K</h2>
               <hr/>
</h2>
</div>
<div style="margin-left:15%;">
    <table border="0" style="font-size:18px; ">
        <tr>
            <td width="200px;">Nama Pemohon</td>
            <td> : </td>
            <td><?= $get_data_pencatatan->nama;?></td>
        </tr>
        <tr>
            <td width="200px;">Jabatan Kerja</td>
            <td> : </td>
            <td><?= $get_data_pencatatan->jabatan_kerja;?></td>
        </tr>
        <tr>
            <td width="200px;">Nama Ketua Pelaksana</td>
            <td> : </td>
            <td><?= $get_data_pencatatan->ketua_pelaksana;?></td>
        </tr>
        <tr>
            <td width="200px;">Tanggal & Waktu Pengesahan Sertifikat</td>
            <td> : </td>
            <td><?= $get_data_pencatatan->log;?></td>
        </tr>
    </table>
</div>

