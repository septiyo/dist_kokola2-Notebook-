<?php
error_reporting (0);
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');

// create new PDF document
 include "koneksi.php";
 
 $nopol=$_GET[NOPOL];
 $id = $_GET[ID];
 $rid = $_GET[RID];
 ////////////////////////////////////////////////////update time to 24 hours
 $sql_rhs="select jam_masuk,jam_keluar from tb_secure where rid_secure='$rid'";
 $sql_rhs=mysql_query($sql_rhs);
 $hasil_rhs=mysql_fetch_assoc($sql_rhs);
 $time_msk  = date("H:i", strtotime($hasil_rhs[jam_masuk]));
 if(($hasil_rhs[jam_keluar]!="")&&($hasil_rhs[jam_keluar]!='-')){
 $time_klr  = date("H:i", strtotime($hasil_rhs[jam_keluar]));
 }else{$time_klr="";}
 $sql_upd_rhs="UPDATE tb_secure SET jam_masuk='$time_msk', jam_keluar='$time_klr' where rid_secure='$rid'";
 $sql_query_rhs=mysql_query($sql_upd_rhs);
 ///////////////////////////////////////////////////
 
 
   $sql  = "SELECT * FROM tb_secure where rid_secure = '$rid'";
   $sql2 = "SELECT * FROM tb_gudangkemas where rid_secure = '$rid'";
   
   
   
   $sqlnopol = "SELECT UCASE(nopol) as nopol FROM tb_secure where rid_secure = '$rid'";

   $hasil = mysql_query($sql);
   $hasil2 = mysql_query($sql2);
   //$hasil3 = mysql_query($sql3);
   $hasilnopol = mysql_query($sqlnopol);
   
   $data  = mysql_fetch_array($hasil);
   $data2 = mysql_fetch_array($hasil2);
   //$data3 = mysql_fetch_array($hasil3);
   //$datanopol = mysql_fetch_array($hasilnopol);
   
   /////surat jalan
   
   $luk = '<img src="';
   $suk = ''.$data2[surat_jalan].'';
   $kuk = '">'; 
   if (empty ($data2[surat_jalan])){
	   $suratan_takdir = "Gambar masih kosong";
	   }
   
   else {
   $suratan_takdir = $luk.$suk.$kuk;
  
   }
   
   $luk2 = '<img src="';
   $suk2 = ''.$data2[direktori_file].'';
   $kuk2 = '">'; 
   if (empty ($data2[direktori_file])){
	   $direktori = "Gambar masih kosong";
	   }
   
   else {
   $direktori = $luk2.$suk2.$kuk2;
  
   }
   
   $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
   
   // set font
   $pdf->SetFont('helvetica', '', 9);
   
   // add a page
  // $pdf->AddPage();
   
   
// landscape
   $pdf->addPage();

//'.$data[no_suratfull].'
  
   
   $html .= '
<table border="0.5" cellspacing="0" cellpadding="4">
    <tr><td colspan="10" align="center"><h2>CHECKLIST INSPEKSI HARIAN KENDARAAN PEMASOK / PENGIRIMAN</h2></td></tr>
	<tr><td align="center" colspan="10"><i>DICEKLIST OLEH SECURITY "'.$data[username].'"</i> </td></tr>
	<tr>
	  <td width="200">No.Surat</td> 
	  <td colspan="2" width="200">MGFI/FR/GDG/13; Rev 00</td>
	  <td width="120" rowspan="4"><img src="'.$data[direktori].'"></td>
	</tr>
    <tr>
        <td width="200">Tanggal</td>
        <td colspan="2">'.$data2[tgl_kirim].'</td>
   </tr>
	<tr>
        <td width="200">Nomor Kendaraan</td>
        <td colspan="2">'.$data[nopol].'</td>
	</tr>
    <tr>
        <td width="200">Nama Suplier/Expedisi</td>
        <td colspan="2">'.$data[namasupexp].'</td>
    </tr>
	<tr>
        <td width="200">Barang Yang Dikirim</td>
        <td colspan="2">'.$data[bkirim].'</td>
    </tr>
	<tr>
        <td width="200">Kota Tujuan</td>
        <td colspan="2">'.$data[kota_tujuan].'</td>
    </tr>
	<tr>
        <td width="200">Jam Masuk</td>
        <td colspan="2">'.$data[jam_masuk].'</td>
    </tr>
	<tr>
        <td width="200">Jam Keluar</td>
        <td colspan="2">'.$data[jam_keluar].'</td>
    </tr>
	<tr>
        <td width="200">Nama Pengemudi</td>
        <td colspan="2">'.$data[nama_sopir].'</td>
    </tr>
	<tr>
        <td width="200">Jenis Kendaraan</td>
        <td colspan="2">'.$data[jenis_kendaraan].'</td>
    </tr>
	<tr>
        <td width="200">Surat Jalan</td>
        <td colspan="2">'.$data[surat_jalan].'</td>
    </tr>
    <tr>
        <td width="200">Buku KIR / STNK</td>
        <td colspan="2">'.$data[STNK].'</td>
    </tr>
	<tr>
		<td width="200" >Keterangan Buku KIR/STNK</td>
		<td colspan="2">'.$data[stnk_ket].'</td>
	</tr>
    <tr>
        <td width="200">SIM</td>
        <td colspan="2">'.$data[SIM].'</td>
    </tr>
	<tr>
		 <td width="200" >Keterangan SIM</td>
		 <td colspan="2">'.$data[sim_ket].'</td>
	</tr>
	<tr>
        <td width="200">Lampu Rem</td>
        <td colspan="2">'.$data[lrem].'</td>
    </tr>
	<tr>
        <td width="200">Lampu Sign</td>
        <td colspan="2">'.$data[lsign].'</td>
    </tr>
	<tr>
        <td width="200">Kaca Spion</td>
        <td colspan="2">'.$data[spion].'</td>
    </tr>
	<tr>
        <td width="200">Sabuk Pengaman</td>
        <td colspan="2">'.$data[sabuk].'</td>
    </tr>
	</table>';
	
	$html .='
	
	<table border="0.5" cellspacing="0" cellpadding="4">
	<tr><td align="center" colspan="9"><i>DICEKLIST OLEH GUDANG KEMAS "'.$data2[username].'"</i> </td></tr>
	<tr>
        <td width="200">Kebersihan Kendaraan</td>
        <td width="200">'.$data2[kebersihan].'</td>
		<td width="125" rowspan="4">'.$direktori.'</td>
    </tr>
	<tr>
        <td width="200">Terpal Penutup Atas</td>
        <td width="200">'.$data2[terpal].'</td>
    </tr>
    <tr>
        <td width="200">Alas Lantai Kendaraan</td>
        <td width="200">'.$data2[alas].'</td>
    </tr>
	<tr>
        <td width="200">Tali Pengikat</td>
        <td width="200">'.$data2[tali].'</td>
    </tr>
	<tr>
        <td width="200">Ada Bau Menyengat</td>
        <td width="200">'.$data2[bau].'</td>
    </tr>
	<tr>
        <td width="200">Keterangan Bau</td>
        <td width="200">'.$data3[ket_bau].'</td>
    </tr>
	<tr>
        <td width="200">Koreksi Bau</td>
        <td width="200">'.$data2[koreksi_bau].'</td>
    </tr>
	<tr>
        <td width="200">Bekerat / Penyok</td>
        <td width="200">'.$data2[penyok].'</td>
    </tr>
	<tr>
        <td width="200">Posisi Penyok</td>
        <td width="200">'.$data2[posisi_penyok].'</td> 
    </tr>
	<tr>
        <td width="200">Koreksi Penyok</td>
        <td width="200">'.$data2[koreksi_penyok].'</td>
    </tr>
	
	<tr>
        <td width="200">Basah/Lembab/Berminyak</td>
        <td width="200">'.$data2[basah].'</td>
    </tr>
	<tr>
        <td width="200">Kunci Segel/Seal</td>
        <td width="200">'.$data2[kunci].'</td>
    </tr>
	<tr>
        <td width="200">Koreksi Kunci Segel/Seal</td>
        <td width="200">'.$data2[koreksi_seal].'</td>
    </tr>
	<tr>
        <td width="200">Ada Kontaminasi Pest</td>
        <td width="200">'.$data2[konta_pest].'</td>
    </tr>
	<tr>
        <td width="200">Kesesuaian Suhu</td>
        <td width="200">'.$data2[suhu].'</td>
    </tr>
	<tr>
        <td width="200">Kontaminasi Bahan Lain</td>
        <td width="200">'.$data2[konbahanlain].'</td>
    </tr>
	</table>
	<br>
	<table border="0.5" cellspacing="0" cellpadding="4">
	<tr>
	<td align="center" width="538"><b>FOTO SURAT JALAN</b></td>
	</tr>
	<tr>
		<td width="538" >'.$suratan_takdir.' </td>
		
    </tr>
	</table>
	
	';
	
	
	
   $pdf->writeHTML($html, true, false, true, false, '');
    
 

 
   
   
   $pdf->Output('Ceklist Inspeksi harian', 'I');
 
?>