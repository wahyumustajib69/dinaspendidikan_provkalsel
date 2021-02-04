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
    $this->SetY(-85);
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
$sql = mysqli_query($konek,"SELECT*FROM promosi AS a JOIN pegawai AS b ON a.nip=b.nip JOIN pangkat AS c ON a.id_pkb=c.id_pnkt WHERE id_pro='$no'");
$no =1;
while($row = mysqli_fetch_array($sql)){
$pdf->SetFont('Times','BU',14);
$pdf->Cell(202,5,'DAFTAR USUL MUTASI PROMOSI',0,1,'C',0);

//=========================================
$pdf->Ln(5);

$pdf->SetFont('Times','U',11);
$pdf->Cell(46,5,'1. Tempat Pekerjaan:',0,1,'L',0);

$pdf->SetFont('Times','',11);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(55,5,'1.1. Kantor',0,0,'L',0);
$pdf->Cell(10,5,':',0,0,'C',0);
$pdf->Cell(25,5,$row['unit_kerja'],0,1,'L',0);

$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(55,5,'1.2. Direktorat',0,0,'L',0);
$pdf->Cell(10,5,':',0,0,'C',0);
$pdf->Cell(25,5,'--',0,1,'L',0);

$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(55,5,'1.3. Biro/Bagian',0,0,'L',0);
$pdf->Cell(10,5,':',0,0,'C',0);
$pdf->Cell(25,5,$row['tmp_kerja'],0,1,'L',0);

//===========================================
$pdf->Ln(5);
$pdf->SetFont('Times','U',11);
$pdf->Cell(46,5,'2. Nama dan Usia :',0,1,'L',0);

$pdf->SetFont('Times','',11);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(55,5,'2.1. Nama',0,0,'L',0);
$pdf->Cell(10,5,':',0,0,'C',0);
$pdf->Cell(25,5,$row['nama'],0,1,'L',0);

$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(55,5,'2.2. Rek. TUK / NIP',0,0,'L',0);
$pdf->Cell(10,5,':',0,0,'C',0);
$pdf->Cell(25,5,$row['nip'],0,1,'L',0);

$tg = new DateTime($row['tgl_lahir']);
$tl = new DateTime();
$usia = $tl->diff($tg);

$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(55,5,'2.3. Tanggal Lahir / Usia',0,0,'L',0);
$pdf->Cell(10,5,':',0,0,'C',0);
$pdf->Cell(25,5,tgl_indo($row['tgl_lahir']).' / '.$usia->y.' Tahun '.$usia->m.' Bulan '.$usia->d.' Hari',0,1,'L',0);
//============================================

$pdf->Ln(5);

$pdf->SetFont('Times','U',11);
$pdf->Cell(46,5,'3. Pangkat:',0,1,'L',0);

$pdf->SetFont('Times','',11);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(55,5,'3.1. Pangkat Lama',0,0,'L',0);
$pdf->Cell(10,5,':',0,0,'C',0);
$ip = $row['pnkt_lama'];
$sq = mysqli_query($konek,"SELECT*FROM pangkat WHERE id_pnkt='$ip'");
foreach($sq as $pn){
$pdf->Cell(25,5,$pn['nm_pnkt'].' (Gol. '.$pn['ket'].' ) / '.tgl_indo($row['tgl_diangkat']),0,1,'L',0);

$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(55,5,'3.2. Pangkat yang diusulkan',0,0,'L',0);
$pdf->Cell(10,5,':',0,0,'C',0);
$pdf->Cell(25,5,$row['pnkt_baru'].' (Gol. '.$row['gol_baru'].') / '.tgl_indo($row['tgl_mulai']),0,1,'L',0);

//============================================
$pdf->Ln(5);
$pdf->SetFont('Times','U',11);
$pdf->Cell(46,5,'4. URAIAN TENTANG TUGAS PEKERJAAN / JABATAN',0,1,'L',0);

$pdf->SetFont('Times','',11);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(55,5,'4.1. Tugas pekerjaan dalam',0,0,'L',0);
$pdf->Cell(10,5,':',0,0,'C',0);
$pdf->Cell(25,5,$row['jbtn'],0,1,'L',0);

$pdf->Cell(10,5,'',0,0,'C',0);
$pdf->Cell(48,5,'pangkat lama',0,0,'L',0);
$pdf->Cell(10,5,':',0,0,'C',0);
$pdf->Cell(25,5,$pn['nm_pnkt'].' (Gol. '.$pn['ket'].')',0,1,'L',0);
$pdf->Ln(5);

$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(55,5,'4.2. Tugas Pekerjaan dalam',0,0,'L',0);
$pdf->Cell(10,5,':',0,0,'C',0);
$pdf->Cell(25,5,$row['jbtn_baru'],0,1,'L',0);
$pdf->Cell(10,5,'',0,0,'C',0);
$pdf->Cell(48,5,'pangkat baru',0,0,'L',0);
$pdf->Cell(10,5,':',0,0,'C',0);
$pdf->Cell(25,5,$row['pnkt_baru'].' (Gol. '.$row['gol_baru'].')',0,1,'L',0);
}
$pdf->Ln(5);
$pdf->Cell(10,5,'4.3.',0,0,'R',0);
$xPos=$pdf->GetX();
$yPos=$pdf->GetY();
$pdf->MultiCell(50,5,'Dalam menjalankan pekerjaan dalam jabatan baru, pegawai Ybs. bertanggung jawab kepada',0,'L');
$pdf->SetXY($xPos + 50 , $yPos);
$pdf->Cell(7,5,':',0,0,'C',0);
$pdf->Cell(25,5,' '.$row['atasan'],0,1,'L',0);

$pdf->Ln(20);
$pdf->Cell(10,5,'4.4.',0,0,'R',0);
$xPos=$pdf->GetX();
$yPos=$pdf->GetY();
$pdf->MultiCell(50,5,'Dalam menjalankan pekerjaan dalam jabatan baru, pegawai Ybs. memimpin langsung pegawai sebanyak',0,'L');
$pdf->SetXY($xPos + 50 , $yPos);
$pdf->Cell(7,5,':',0,0,'C',0);
$pdf->Cell(25,5,' '.'--',0,1,'L',0);

$pdf->Ln(20);
$pdf->SetFont('Times','U',11);
$pdf->Cell(46,5,'5. LOWONGAN',0,1,'L',0);

$pdf->SetFont('Times','',11);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(55,5,'5.1. Golongan yang akan diisi',0,0,'L',0);
$pdf->Cell(10,5,':',0,0,'C',0);
$pdf->Cell(25,5,$row['gol_baru'],0,1,'L',0);

$pdf->Cell(10,5,'',0,0,'C',0);
$pdf->Cell(48,5,'dan diatasinya',0,0,'L',0);
$pdf->Cell(10,5,'',0,0,'C',0);
$pdf->Cell(25,5,'',0,1,'L',0);


$pdf->Ln(5);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(55,5,'5.2. Uraian tentang alasan-alasan',0,0,'L',0);
$pdf->Cell(10,5,':',0,0,'C',0);
$pdf->Cell(25,5,'Kenaikan Pangkat Pengabdian ke '.$row['pnkt_baru'].',',0,1,'L',0);

$pdf->Cell(10,5,'',0,0,'C',0);
$pdf->Cell(48,5,'untuk mutasi promosi',0,0,'L',0);
$pdf->Cell(10,5,'',0,0,'C',0);
$pdf->Cell(25,5,'(Gol. '.$row['gol_baru'].') TMT '.tgl_indo($row['tgl_mulai']),0,1,'L',0);

$pdf->Ln(10);
$pdf->Cell(10,5,'6. ',0,0,'R',0);
$xPos=$pdf->GetX();
$yPos=$pdf->GetY();
$pdf->MultiCell(50,5,'Keterangan-keterangan lain (tentang pendidikan yang bersangkutan dsb)',0,'L');
$pdf->SetXY($xPos + 50 , $yPos);
$pdf->Cell(7,5,':',0,0,'C',0);
$pdf->Cell(25,5,' '.$row['pend'],0,1,'L',0);
}

//Menutup dokumen dan dikirim ke browser
$pdf->Output();
?>
