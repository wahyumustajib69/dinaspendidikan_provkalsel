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
    $this->Line(10,31,211,31);
    $this->SetLineWidth(0);
    $this->Line(10,32,211,32);
    // Line break 5mm
    $this->Ln(6);
}

// Page footer
function Footer()
{
    // Posisi 15 cm dari bawah
    $this->SetY(-185);
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
$sql = mysqli_query($konek,"SELECT*FROM pen_dj AS a JOIN pegawai AS b ON a.nip=b.nip JOIN pangkat AS c ON b.pangkat=c.id_pnkt WHERE nosurat='$no'");
$no =1;
while($row = mysqli_fetch_array($sql)){

$pdf->SetFont('Times','',11);
$pdf->Cell(26,5,'Nomor',0,0,'L',0);
$pdf->Cell(3,5,':',0,0,'C',0);
$pdf->Cell(55,5,'882/'.$row['nosurat'],0,0,'L',0);
$pdf->Cell(40,5,'',0,0,'C',0);
$pdf->Cell(25,5,'Banjarbaru,',0,0,'L',0);
$pdf->Cell(1,5,'',0,0,'C',0);
$pdf->Cell(38,5,tgl_indo($row['tgl_surat']),0,1,'L',0);

$pdf->Cell(26,5,'Lampiran',0,0,'L',0);
$pdf->Cell(3,5,':',0,0,'C',0);
$pdf->Cell(55,5,'2 (dua) berkas',0,1,'L',0);

$pdf->Cell(26,5,'Hal',0,0,'L',0);
$pdf->Cell(3,5,':',0,0,'C',0);
$pdf->Cell(60,5,'Usul Kenaikan Pangkat Pengabdian',0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'C',0);
$pdf->Cell(25,5,'Kepada Yth.',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(38,5,'',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,'dan Pensiun '.$row['stts'].' PNS yang meninggal',0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'C',0);
$pdf->Cell(25,5,'Gubernur Kalimantan Selatan',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(38,5,'',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,'dunia a.n. '.$row['nm_pmh'],0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'C',0);
$pdf->Cell(25,5,'u.p. Kepala Badan Kepegawaian Daerah',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(38,5,'',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,$row['hub'].' Almarhum',0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'C',0);
$pdf->Cell(25,5,'Provinsi Kalimantan Selatan',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(38,5,'',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,$row['nama'],0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'C',0);
$pdf->Cell(25,5,'di Banjarbaru',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(38,5,'',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,'NIP. '.$row['nip'],0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'C',0);
$pdf->Cell(25,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(38,5,'',0,1,'L',0);

$pdf->Ln(5);
$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'C',0);
$pdf->Cell(60,5,'Bersama ini kami sampaikan dengan hormat berkas usul permohonan untuk',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,'mendapatkan hak pensiun '.strtolower($row['stts']).' dan kenaikan pangkat pengabdian dari almarhum',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,'Pegawai Negeri Sipil tersebut di bawah ini :',0,1,'L',0);

$pdf->Ln(5);
$pdf->SetFont('Times','B',10);
$pdf->Cell(6,5,'No',1,0,'L',0);
$pdf->Cell(35,5,'Nama Pemohon',1,0,'C',0);
$pdf->Cell(50,5,'Nama Almarhum',1,0,'C',0);
$pdf->Cell(50,5,'Jabatan Terakhir',1,0,'C',0);
$pdf->Cell(32,5,'Meninggal Tanggal',1,0,'C',0);
$pdf->Cell(28,5,'Keterangan',1,1,'C',0);

$pdf->SetFont('Times','',10);

$pdf->Cell(6,25,'1',1,0,'L',0);

$xPos=$pdf->GetX();
$yPos=$pdf->GetY();
$pdf->MultiCell(35,5,$row['nm_pmh']."\n".$row['tlh'].','."\n".tgl_indo($row['ttl'])."\n".' '."\n",0,'L');
$pdf->SetXY($xPos + 35 , $yPos);

$xPos=$pdf->GetX();
$yPos=$pdf->GetY();
$pdf->MultiCell(50,5,$row['nama']."\n".$row['nip']."\n".$row['nm_pnkt']."\n".'(Golongan. '.$row['ket'].')'."\n".' ',1,'L');
$pdf->SetXY($xPos + 50 , $yPos);

$pdf->SetFont('Times','',9);
$xPos=$pdf->GetX();
$yPos=$pdf->GetY();
$pdf->MultiCell(50,5,$row['jbtn']."\n".'pada '.$row['tmp_kerja'],0,'L');
$pdf->SetLineWidth(0);
$pdf->Line(196,131,12,131);
$pdf->SetXY($xPos + 50 , $yPos);

$pdf->SetFont('Times','',10);
$xPos=$pdf->GetX();
$yPos=$pdf->GetY();
$pdf->MultiCell(32,25,tgl_indo($row['tgl_wft']),1,'C');
$pdf->SetXY($xPos + 32 , $yPos);

$xPos=$pdf->GetX();
$yPos=$pdf->GetY();
$pdf->MultiCell(28,5,'Diusulkan kenaikan pangkat pengabdian dari Gol. ('.$row['ket'].') ke ('.$row['gol_usul'].')',1,'L');
$pdf->SetXY($xPos + 28 , $yPos);

$pdf->Ln(30);
$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'C',0);
$pdf->Cell(60,5,'Demikian kami sampaikan untuk mendapat penyelesaian selanjutnya, atas perhatian',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,'dan kerja sama yang baik, kami sampaikan terima kasih.',0,1,'L',0);

$pdf->Ln(4);

$pdf->SetFont('Times','',9);
$pdf->SetY(-48);
$pdf->Cell(20,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,'Tembusan :',0,1,'L',0);

$pdf->Cell(20,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,$row['nm_pmh'].' '.$row['stts'].' almarhum '.$row['nama'],0,1,'L',0);

$pdf->Cell(20,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$xPos=$pdf->GetX();
$yPos=$pdf->GetY();
$pdf->MultiCell(100,5,$row['alamat'],0,'L');
//$pdf->SetXY($xPos + 32 , $yPos);

}

//Menutup dokumen dan dikirim ke browser
$pdf->Output();
?>
