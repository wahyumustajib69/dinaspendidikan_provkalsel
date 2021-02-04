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
    1 => 'Jan',
          'Feb',
          'Mar',
          'Apr',
          'Mei',
          'Jun',
          'Jul',
          'Agu',
          'Sep',
          'Okt',
          'Nov',
          'Des'
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
$pdf->Cell(330,6,'REKAPITULASI PROMOSI PEGAWAI',0,1,'C',1);
$pdf->Ln(3);
$pdf->SetFont('Times','B',10);
$pdf->Cell(6,6,'NO',1,0,'C',0);
$pdf->Cell(36,6,'NIP',1,0,'C',0);
$pdf->Cell(45,6,'NAMA PEGAWAI',1,0,'C',0);
$pdf->Cell(55,6,'JABATAN BARU',1,0,'C',0);
$pdf->Cell(45,6,'PANGKAT/GOL. BARU',1,0,'C',0);
$pdf->Cell(55,6,'TEMPAT KERJA BARU',1,0,'C',0);
$pdf->Cell(45,6,'TTL',1,0,'C',0);
$pdf->Cell(26,6,'PENDIDIKAN',1,0,'C',0);
$pdf->Cell(27,6,'TELEPON',1,1,'C',0);

$pdf->SetFont('Times','',10);
 
include 'koneksi.php';
$data = mysqli_query($konek,"SELECT*FROM promosi AS a JOIN pegawai AS b ON a.nip=b.nip JOIN pangkat AS c ON b.pangkat=c.id_pnkt WHERE a.tmp_baru=a.tmp_lama ORDER BY a.nip");
$no =1;
while($hasil=mysqli_fetch_array($data)){
  $pdf->SetFont('Times','',9);

  $cellWidth=55; //lebar sel
  $cellHeight=6; //tinggi sel satu baris normal
  
  //TEMPAT KERJA
  if($pdf->GetStringWidth($hasil['tmp_baru']) < $cellWidth){
    $line=1;
  }else{
    $textLength=strlen($hasil['tmp_baru']);  
    $errMargin=5;  
    $startChar=0;  
    $maxChar=0;  
    $textArray=array(); 
    $tmpString="";
    
    while($startChar < $textLength){ 
      while( 
      $pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
      ($startChar+$maxChar) < $textLength ) {
        $maxChar++;
        $tmpString=substr($hasil['tmp_baru'],$startChar,$maxChar);
      }

      $startChar=$startChar+$maxChar;
      array_push($textArray,$tmpString);
      $maxChar=0;
      $tmpString=''; 
    }
    $line=count($textArray);
  }


  $Width=55; //lebar sel
  $Height=6; //tinggi sel satu baris normal
  
  //JABATAN
  if($pdf->GetStringWidth($hasil['jbtn_baru']) < $Width){
    $line=1;
  }else{
    $text=strlen($hasil['jbtn_baru']);  
    $margin=5;  
    $start=0;  
    $max=0;  
    $Array=array(); 
    $string="";
    
    while($start < $text){ 
      while( 
      $pdf->GetStringWidth( $string ) < ($Width-$margin) &&
      ($start+$max) < $text ) {
        $max++;
        $string=substr($hasil['jbtn_baru'],$start,$max);
      }

      $start=$start+$max;
      array_push($Array,$string);
      $max=0;
      $string=''; 
    }
    $line=count($Array);
  }



  
  //tulis selnya
  $pdf->SetFont('Times','',10);
  $pdf->Cell(6,($line * $cellHeight),$no++,1,0,'C',true);
  $pdf->Cell(36,($line * $cellHeight),$hasil['nip'],1,0,'C',0);
  $pdf->Cell(45,($line * $cellHeight),$hasil['nama'],1,0,'L',0);
    //memanfaatkan MultiCell sebagai ganti Cell
  $Posx=$pdf->GetX();
  $Posy=$pdf->GetY();
  $pdf->MultiCell($Width,$Height,$hasil['jbtn_baru'],1);
  //kembalikan posisi untuk sel berikutnya di samping MultiCell 
  $pdf->SetXY($Posx + $Width , $Posy);

  $pdf->Cell(45,($line * $cellHeight),$hasil['nm_pnkt'].'/ '.$hasil['ket'],1,0,'L',0);

  //memanfaatkan MultiCell sebagai ganti Cell
  $xPos=$pdf->GetX();
  $yPos=$pdf->GetY();
  $pdf->MultiCell($cellWidth,$cellHeight,$hasil['tmp_baru'],1);
  //kembalikan posisi untuk sel berikutnya di samping MultiCell 
  $pdf->SetXY($xPos + $cellWidth , $yPos);
  
  $pdf->Cell(45,($line * $cellHeight),$hasil['tmp_lahir'].', '.tgl_indo($hasil['tgl_lahir']),1,0,'L',0);
  $pdf->Cell(26,($line * $cellHeight),$hasil['pend'],1,0,'C',0);
  $pdf->Cell(27,($line * $cellHeight),$hasil['hp'],1,1,'C',0);
  //$pdf->Cell(29,($line * $cellHeight),$hasil['sn_router'],1,1,'L',0); //sesuaikan ketinggian dengan jumlah garis
}

//Menutup dokumen dan dikirim ke browser
$pdf->Output();
?>