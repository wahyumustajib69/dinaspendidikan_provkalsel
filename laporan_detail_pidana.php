<?php
//session_start();
//if(!isset($_SESSION['username'])){
  //header("location:login");
//}
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
     $this->Image('asset/img/kalsel.png',10,8,17);
    // Arial bold 12
    $this->SetFont('Times','B',14);
    // Geser Ke Kanan 30mm
    $this->Cell(30);
    // Judul
    $this->Cell(150,5,'PEMERINTAH PROVINSI KALIMANTAN SELATAN',0,1,'C');
    $this->Cell(70);
    $this->SetFont('Times','B',12);
    $this->Cell(70,5,'DINAS PENDIDIKAN DAN KEBUDAYAAN',0,1,'C');
    $this->Cell(70);
    $this->Cell(70,5,'Komplek Perkantoran Provinsi Kalimantan Selatan',0,1,'C');
    $this->Cell(70);
    $this->SetFont('Times','',11);
    $this->Cell(70,5,'Jalan Dharma Praja II No.1 Trikora Banjarbaru,  Website : disdik.kalselprov.go.id',0,1,'C');
    // Garis Bawah Double
    $this->SetLineWidth(1);
    $this->Line(10,31,208,31);
    $this->SetLineWidth(0);
    $this->Line(10,32,208,32);
    // Line break 5mm
    $this->Ln(6);
}

// Page footer
function Footer()
{
    // Posisi 15 cm dari bawah
    $this->SetY(-115);
    $this->SetFont('Times','B',10);
    $this->Cell(275,5,'Kepala Dinas Pendidikan dan Kebudayaan',0,1,'C');
    $this->Cell(255,5,'Provinsi Kalimantan Selatan,',0,1,'C');
    $this->Ln(20);
    require "koneksi.php";
    $sql = mysqli_query($konek,"SELECT*FROM pimpinan AS a JOIN pangkat AS b ON a.png=b.id_pnkt");
    foreach($sql as $pm);
    $this->Cell(275,5,$pm['nma'],0,1,'C');
    $this->Cell(248,5,$pm['nm_pnkt'],0,1,'C');
    $this->Cell(253,5,'NIP '.$pm['ni'],0,1,'C');
  
    $this->SetY(-10);
    // Arial italic 8
    $this->SetFont('Arial','',8);
    

    // Page number
    $this->Cell(0,10,'Halaman '.$this->PageNo().' / {nb}',0,0,'R');
}
}

//Membuat file PDF
$pdf = new PDF('P','mm','Legal');
function tgl_indo($tanggal){
    $bulan = array(
        1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
             );
    $pecah = explode('-', $tanggal);
    return $pecah[2].' '.$bulan[(int)$pecah[1]].' '.$pecah[0];
}

//Alias total halaman dengan default {nb} (berhubungan dengan PageNo())
$pdf->AliasNbPages();

$pdf->AddPage();
$pdf->SetFont('Times','',12);

//Mencetak kalimat dengan perulangan
$pdf->SetFillColor(24,224,23);
include 'koneksi.php';
$no = $_GET['ref'];
$sql = mysqli_query($konek,"SELECT*FROM pidana AS a JOIN pegawai AS b ON a.nip=b.nip JOIN pangkat AS c ON b.pangkat=c.id_pnkt WHERE no='$no'");
$no =1;
while($row = mysqli_fetch_array($sql)){

//===== SURAT KETERANGAN PIDANA =====
$pdf->SetFont('Times','B',14);
$pdf->Cell(202,5,'SURAT PERNYATAAN',0,1,'C',0);
$pdf->Ln(3);

$pdf->SetFont('Times','U',12);
$pdf->MultiCell(195,5,'TIDAK SEDANG MENJALANI PROSES PIDANA ATAU PERNAH DIPIDANA PENJARA BERDASARKAN PUTUSAN PENGADILAN YANG TELAH BERKEKUATAN HUKUM TETAP',0,'C');

//=========================================
$pdf->Ln(5);
$pdf->SetFont('Times','',11);
$pdf->Cell(202,5,'NOMOR: 800/'.$row['no'],0,1,'C',0);
$pdf->Ln(5);
$pdf->Cell(46,10,'Yang bertandatangan di bawah ini :',0,1,'L',0);

$pdf->Cell(10,10,'',0,0,'C',0);
$pdf->Cell(55,10,'Nama',0,0,'L',0);
$pdf->Cell(10,10,':',0,0,'C',0);
$pdf->Cell(25,10,$row['kadin'],0,1,'L',0);

$pdf->Cell(10,10,'',0,0,'C',0);
$pdf->Cell(55,10,'NIP',0,0,'L',0);
$pdf->Cell(10,10,':',0,0,'C',0);
$pdf->Cell(25,10,$row['nip_kadin'],0,1,'L',0);

$pdf->Cell(10,10,'',0,0,'C',0);
$pdf->Cell(55,10,'Pangkat/Golongan Ruang',0,0,'L',0);
$pdf->Cell(10,10,':',0,0,'C',0);
$pdf->Cell(25,10,$row['pnk_kdin'].' (Gol. '.$row['gol_kadin'].')',0,1,'L',0);

$pdf->Cell(10,10,'',0,0,'C',0);
$pdf->Cell(55,10,'Jabatan',0,0,'L',0);
$pdf->Cell(10,10,':',0,0,'C',0);
$pdf->Cell(25,10,$row['jbtn_kadin'],0,1,'L',0);

//===========================================

$pdf->Cell(46,10,'dengan ini menyatakan dengan sesungguhnya, bahwa Pegawai Negeri Sipil :',0,1,'L',0);

$pdf->Cell(10,10,'',0,0,'C',0);
$pdf->Cell(55,10,'Nama',0,0,'L',0);
$pdf->Cell(10,10,':',0,0,'C',0);
$pdf->Cell(25,10,$row['nama'],0,1,'L',0);

$pdf->Cell(10,10,'',0,0,'C',0);
$pdf->Cell(55,10,'NIP',0,0,'L',0);
$pdf->Cell(10,10,':',0,0,'C',0);
$pdf->Cell(25,10,$row['nip'],0,1,'L',0);

$pdf->Cell(10,10,'',0,0,'C',0);
$pdf->Cell(55,10,'Pangkat/Golongan Ruang',0,0,'L',0);
$pdf->Cell(10,10,':',0,0,'C',0);
$pdf->Cell(25,10,$row['nm_pnkt'].' (Gol. '.$row['ket'].')',0,1,'L',0);

$pdf->Cell(10,10,'',0,0,'C',0);
$pdf->Cell(55,10,'Jabatan',0,0,'L',0);
$pdf->Cell(10,10,':',0,0,'C',0);
$pdf->Cell(25,10,$row['jbtn'],0,1,'L',0);

$pdf->Cell(10,5,'',0,0,'C',0);
$pdf->Cell(55,5,'Instansi',0,0,'L',0);
$pdf->Cell(10,5,':',0,0,'C',0);
$pdf->Cell(25,5,$row['tmp_kerja'],0,1,'L',0);

$pdf->Cell(10,5,'',0,0,'C',0);
$pdf->Cell(55,5,'',0,0,'L',0);
$pdf->Cell(10,5,'',0,0,'C',0);
$pdf->Cell(25,5,$row['unit_kerja'],0,1,'L',0);
$pdf->Ln(5);

$pdf->MultiCell(200,5,'          '.'Tidak sedang menjalani proses pidana atau pernah dipidana penjara berdasarkan putusan pengadilan yang telah berkekuatan hukum tetap karena melakukan tindak pidana kejahatan jabatan atau tindak pidana kejahatan yang ada hubungannya dengan jabatan dan/atau pidana umum.',0,'L');
$pdf->Ln(5);
$pdf->MultiCell(200,5,'          '.'Demikian surat pernyataan ini saya buat dengan sesungguhnya dengan mengingat sunpah jabatan dan apabila di kemudian hari ternyata isi surat ini tidak benar yang mengakibatkan kerugian bagi negara maka saya bersedia menanggung kerugian negara sesuai dengan ketentuan peraturan perundang-undangan.',0,'L');

//===== SURAT KETERANGAN DISIPLIN =====
$pdf->Ln(245);
$pdf->SetFont('Times','B',12);
$pdf->Cell(202,5,'ANAK LAMPIRAN 1-P KEPALA BADAN KEPEGAWAIAN NEGARA',0,1,'C',0);

$pdf->Cell(121,5,'',0,0,'C',0);
$pdf->Cell(30,5,'NOMOR',0,0,'L',0);
$pdf->Cell(5,5,':',0,0,'C',0);
$pdf->Cell(45,5,'11 TAHUN 2001',0,1,'L',0);

$pdf->Cell(121,5,'',0,0,'C',0);
$pdf->Cell(30,5,'TANGGAL',0,0,'L',0);
$pdf->Cell(5,5,':',0,0,'C',0);
$pdf->Cell(45,5,'17 JANUARI 2001',0,1,'L',0);
$pdf->Ln(7);

$pdf->SetFont('Times','B',12);
$pdf->Cell(202,5,'SURAT PERNYATAAN',0,1,'C',0);

$pdf->SetFont('Times','U',12);
$pdf->MultiCell(195,5,'TIDAK PERNAH DIJATUHI HUKUMAN DISIPLIN TINGKAT SEDANG / BERAT',0,'C');

$pdf->SetFont('Times','',11);
$pdf->Cell(46,10,'Yang bertandatangan di bawah ini :',0,1,'L',0);

$pdf->Cell(10,10,'',0,0,'C',0);
$pdf->Cell(55,10,'Nama',0,0,'L',0);
$pdf->Cell(10,10,':',0,0,'C',0);
$pdf->Cell(25,10,$row['kadin'],0,1,'L',0);

$pdf->Cell(10,10,'',0,0,'C',0);
$pdf->Cell(55,10,'NIP',0,0,'L',0);
$pdf->Cell(10,10,':',0,0,'C',0);
$pdf->Cell(25,10,$row['nip_kadin'],0,1,'L',0);

$pdf->Cell(10,10,'',0,0,'C',0);
$pdf->Cell(55,10,'Pangkat/Golongan Ruang',0,0,'L',0);
$pdf->Cell(10,10,':',0,0,'C',0);
$pdf->Cell(25,10,$row['pnk_kdin'].' (Gol. '.$row['gol_kadin'].')',0,1,'L',0);

$pdf->Cell(10,10,'',0,0,'C',0);
$pdf->Cell(55,10,'Jabatan',0,0,'L',0);
$pdf->Cell(10,10,':',0,0,'C',0);
$pdf->Cell(25,10,$row['jbtn_kadin'],0,1,'L',0);

$pdf->Cell(46,10,'dengan ini menyatakan dengan sesungguhnya, bahwa Pegawai Negeri Sipil :',0,1,'L',0);

$pdf->Cell(10,10,'',0,0,'C',0);
$pdf->Cell(55,10,'Nama',0,0,'L',0);
$pdf->Cell(10,10,':',0,0,'C',0);
$pdf->Cell(25,10,$row['nama'],0,1,'L',0);

$pdf->Cell(10,10,'',0,0,'C',0);
$pdf->Cell(55,10,'NIP',0,0,'L',0);
$pdf->Cell(10,10,':',0,0,'C',0);
$pdf->Cell(25,10,$row['nip'],0,1,'L',0);

$pdf->Cell(10,10,'',0,0,'C',0);
$pdf->Cell(55,10,'Pangkat/Golongan Ruang',0,0,'L',0);
$pdf->Cell(10,10,':',0,0,'C',0);
$pdf->Cell(25,10,$row['nm_pnkt'].' (Gol. '.$row['ket'].')',0,1,'L',0);

$pdf->Cell(10,10,'',0,0,'C',0);
$pdf->Cell(55,10,'Jabatan',0,0,'L',0);
$pdf->Cell(10,10,':',0,0,'C',0);
$pdf->Cell(25,10,$row['jbtn'],0,1,'L',0);

$pdf->Cell(10,5,'',0,0,'C',0);
$pdf->Cell(55,5,'Instansi',0,0,'L',0);
$pdf->Cell(10,5,':',0,0,'C',0);
$pdf->Cell(25,5,$row['tmp_kerja'],0,1,'L',0);

$pdf->Cell(10,5,'',0,0,'C',0);
$pdf->Cell(55,5,'',0,0,'L',0);
$pdf->Cell(10,5,'',0,0,'C',0);
$pdf->Cell(25,5,$row['unit_kerja'],0,1,'L',0);
$pdf->Ln(5);

$pdf->MultiCell(200,5,'          '.'Dalam satu tahun terakhir tidak pernah dijatuhi hukuman disiplin tingkat Sedang/Berat.',0,'L');
$pdf->Ln(5);
$pdf->MultiCell(200,5,'          '.'Demikian surat pernyataan ini saya buat dengan sesungguhnya dengan mengingat sunpah jabatan dan apabila di kemudian hari ternyata isi surat ini tidak benar yang mengakibatkan kerugian bagi negara maka saya bersedia menanggung kerugian negara sesuai dengan ketentuan peraturan perundang-undangan.',0,'L');

}

//Menutup dokumen dan dikirim ke browser
$pdf->Output();
?>
