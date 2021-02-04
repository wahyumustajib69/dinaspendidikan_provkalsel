<?php
session_start();

//if(!isset($_SESSION['username'])){
  //header("location:login");
//}
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header(){
    // Logo
    $this->Image('asset/img/kalsel.png',10,8,17);
    // Arial bold 12
    $this->SetFont('Times','B',14);
    // Geser Ke Kanan 30mm
    $this->Cell(20);
    // Judul
    $this->Cell(290,5,'PEMERINTAH PROVINSI KALIMANTAN SELATAN',0,1,'C');
    $this->Cell(110);
    $this->SetFont('Times','B',12);
    $this->Cell(110,5,'DINAS PENDIDIKAN DAN KEBUDAYAAN',0,1,'C');
    $this->Cell(110);
    $this->Cell(110,5,'Komplek Perkantoran Provinsi Kalimantan Selatan',0,1,'C');
    $this->Cell(110);
    $this->SetFont('Times','',11);
    $this->Cell(110,5,'Jalan Dharma Praja II No.1 Trikora Banjarbaru,  Website : disdik.kalselprov.go.id',0,1,'C');
    // Garis Bawah Double
    $this->SetLineWidth(1);
    $this->Line(10,31,348,31);
    $this->SetLineWidth(0);
    $this->Line(10,32,348,32);
    // Line break 5mm
    $this->Ln(6);
}


// Page footer
function Footer(){
    // Posisi 15 cm dari bawah
    $this->SetY(-55);
    $this->SetFont('Times','B',10);
    $this->Cell(570,5,'Kepala Dinas Pendidikan dan Kebudayaan',0,1,'C');
    $this->Cell(550,5,'Provinsi Kalimantan Selatan,',0,1,'C');
    $this->Ln(20);
    require "koneksi.php";
    $sql = mysqli_query($konek,"SELECT*FROM pimpinan AS a JOIN pangkat AS b ON a.png=b.id_pnkt");
    foreach($sql as $pm);
    $this->Cell(570,5,$pm['nma'],0,1,'C');
    $this->Cell(543,5,$pm['nm_pnkt'],0,1,'C');
    $this->Cell(548,5,'NIP '.$pm['ni'],0,1,'C');
  
    $this->SetY(-10);
    // Arial italic 8
    $this->SetFont('Arial','',8);
    

    // Page number
    $this->Cell(0,10,'Halaman '.$this->PageNo().' / {nb}',0,0,'R');
}
}
function tgl_indo($tanggal){
  $bulan = array(
    1 => 'Januari',
          'Februari',
          'Maret',
          'April',
          'Mei',
          'Juni',
          'Juli',
          'Aguustus',
          'September',
          'Oktober',
          'November',
          'Desember'
    );
  $pecah = explode('-', $tanggal);
  return $pecah[2].' '.$bulan[(int)$pecah[1]].' '.$pecah[0];
}
//Membuat file PDF
$pdf = new PDF('L','mm','Legal');

//Alias total halaman dengan default {nb} (berhubungan dengan PageNo())
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

//Mencetak kalimat dengan perulangan
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Times','BU',14);
$pdf->Cell(330,6,'REKAPITULASI DATA PEGAWAI',0,1,'C',1);
$pdf->Ln(3);
$pdf->SetFont('Times','B',10);
$pdf->Cell(6,6,'NO',1,0,'C',0);
$pdf->Cell(36,6,'NIP',1,0,'C',0);
$pdf->Cell(45,6,'NAMA PEGAWAI',1,0,'C',0);
$pdf->Cell(55,6,'JABATAN',1,0,'C',0);
$pdf->Cell(45,6,'PANGKAT/GOL.',1,0,'C',0);
$pdf->Cell(40,6,'TANGGAL DIANGKAT',1,0,'C',0);
$pdf->Cell(55,6,'TTL',1,0,'C',0);
$pdf->Cell(30,6,'PENDIDIKAN',1,0,'C',0);
$pdf->Cell(27,6,'TELEPON',1,1,'C',0);

$pdf->SetFont('Times','',10);
 
include 'koneksi.php';
if($_GET['filter']=='ALL'){
  $data = mysqli_query($konek,"SELECT*FROM pegawai AS a JOIN pangkat AS b ON a.pangkat=b.id_pnkt ORDER BY a.nip");
}else{
  $ft = $_GET['filter'];
  $data = mysqli_query($konek,"SELECT*FROM pegawai AS a JOIN pangkat AS b ON a.pangkat=b.id_pnkt WHERE pangkat='$ft' ORDER BY a.nip");
}

$no =1;
while($hasil=mysqli_fetch_array($data)){
  $pdf->SetFont('Times','',9);

  $cellWidth=55; //lebar sel
  $cellHeight=6; //tinggi sel satu baris normal
  


  $Width=55; //lebar sel
  $Height=6; //tinggi sel satu baris normal
  
  //JABATAN
  if($pdf->GetStringWidth($hasil['jbtn']) < $Width){
    $line=1;
  }else{
    $textLength=strlen($hasil['jbtn']);  
    $errMargin=5;  
    $startChar=0;  
    $maxChar=0;  
    $textArray=array(); 
    $tmpString="";
    
    while($startChar < $textLength){ 
      while( 
      $pdf->GetStringWidth( $tmpString ) < ($Width-$errMargin) &&
      ($startChar+$maxChar) < $textLength ) {
        $maxChar++;
        $tmpString=substr($hasil['jbtn'],$startChar,$maxChar);
      }

      $startChar=$startChar+$maxChar;
      array_push($textArray,$tmpString);
      $maxChar=0;
      $tmpString=''; 
    }
    $line=count($textArray);
  }



  
  //tulis selnya
  $pdf->SetFont('Times','',10);
  $pdf->Cell(6,($line * $cellHeight),$no++,1,0,'C',true);
  $pdf->Cell(36,($line * $cellHeight),$hasil['nip'],1,0,'C',0);
  $pdf->Cell(45,($line * $cellHeight),$hasil['nama'],1,0,'L',0);
    //memanfaatkan MultiCell sebagai ganti Cell
  $Posx=$pdf->GetX();
  $Posy=$pdf->GetY();
  $pdf->MultiCell($Width,$Height,$hasil['jbtn'],1,'L');
  //kembalikan posisi untuk sel berikutnya di samping MultiCell 
  $pdf->SetXY($Posx + $Width , $Posy);

  $pdf->Cell(45,($line * $cellHeight),$hasil['nm_pnkt'].' ('.$hasil['ket'].')',1,0,'L',0);
  $pdf->Cell(40,($line * $cellHeight),tgl_indo($hasil['tgl_diangkat']),1,0,'C',0);
  $pdf->Cell(55,($line * $cellHeight),$hasil['tmp_lahir'].', '.tgl_indo($hasil['tgl_lahir']),1,0,'L',0);
  $pdf->Cell(30,($line * $cellHeight),$hasil['pend'],1,0,'C',0);
  $pdf->Cell(27,($line * $cellHeight),$hasil['hp'],1,1,'L',0);
  //$pdf->Cell(29,($line * $cellHeight),$hasil['sn_router'],1,1,'L',0); //sesuaikan ketinggian dengan jumlah garis
}

//Menutup dokumen dan dikirim ke browser
$pdf->Output();
?>