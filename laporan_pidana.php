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
    1 => 'JANUARI',
          'FEBRUARI',
          'MARET',
          'APRIL',
          'MEI',
          'JUNI',
          'JULI',
          'AGUSTUS',
          'SEPTEMBER',
          'OKTOBER',
          'NOVEMBER',
          'DESEMBER'
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
$pdf->Cell(330,6,'REKAPITULASI SURAT PERNYATAAN PIDANA',0,1,'C',1);
$pdf->Ln(3);

$pdf->SetFont('Times','B',10);
$pdf->Cell(6,6,'NO',1,0,'C',0);
$pdf->Cell(45,6,'NOMOR SURAT',1,0,'C',0);
$pdf->Cell(33,6,'TANGGAL',1,0,'C',0);
$pdf->Cell(37,6,'NIP KEPALA DINAS',1,0,'C',0);
$pdf->Cell(63,6,'NAMA KEPALA DINAS',1,0,'C',0);
$pdf->Cell(37,6,'NIP PEGAWAI',1,0,'C',0);
$pdf->Cell(60,6,'NAMA PEGAWAI',1,0,'C',0);
$pdf->Cell(60,6,'ALAMAT PEGAWAI',1,1,'C',0);

$pdf->SetFont('Times','',10);


 
include 'koneksi.php';
if($_GET['filter']=='ALL'){
  $data = mysqli_query($konek,"SELECT*FROM pidana AS a JOIN pegawai AS b ON a.nip=b.nip JOIN pangkat AS c ON b.pangkat=c.id_pnkt ORDER BY no DESC");
}else{
  $tg = explode('-', $_GET['filter']);
  $th = $tg[0];
  $bl = $tg[1];
  $data = mysqli_query($konek,"SELECT*FROM pidana AS a JOIN pegawai AS b ON a.nip=b.nip JOIN pangkat AS c ON b.pangkat=c.id_pnkt WHERE month(tanggal)='$bl' AND year(tanggal)='$th' ORDER BY no DESC");
}

$no =1;
while($hasil=mysqli_fetch_array($data)){
  $pdf->SetFont('Arial','',9);

  $cellWidth=60; //lebar sel
  $cellHeight=6; //tinggi sel satu baris normal
  
  //periksa apakah teksnya melibihi kolom?
  if($pdf->GetStringWidth($hasil['alamat']) < $cellWidth){
    //jika tidak, maka tidak melakukan apa-apa
    $line=1;
  }else{
    //jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
    //dengan memisahkan teks agar sesuai dengan lebar sel
    //lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel
    
    $textLength=strlen($hasil['alamat']);  //total panjang teks
    $errMargin=5;   //margin kesalahan lebar sel, untuk jaga-jaga
    $startChar=0;   //posisi awal karakter untuk setiap baris
    $maxChar=0;     //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
    $textArray=array(); //untuk menampung data untuk setiap baris
    $tmpString="";    //untuk menampung teks untuk setiap baris (sementara)
    
    while($startChar < $textLength){ //perulangan sampai akhir teks
      //perulangan sampai karakter maksimum tercapai
      while( 
      $pdf->GetStringWidth( $tmpString ) < ($cellWidth-$errMargin) &&
      ($startChar+$maxChar) < $textLength ) {
        $maxChar++;
        $tmpString=substr($hasil['alamat'],$startChar,$maxChar);
      }
      //pindahkan ke baris berikutnya
      $startChar=$startChar+$maxChar;
      //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
      array_push($textArray,$tmpString);
      //reset variabel penampung
      $maxChar=0;
      $tmpString='';
      
    }
    //dapatkan jumlah baris
    $line=count($textArray);
  }
  
  //tulis selnya
  $pdf->SetFont('Times','',10);
  $pdf->Cell(6,($line * $cellHeight),$no++,1,0,'C',true);
  $pdf->Cell(45,($line * $cellHeight),'882/'.$hasil['no'],1,0,'C',0);
  $pdf->Cell(33,($line * $cellHeight),tgl_indo($hasil['tanggal']),1,0,'L',0);
  $pdf->Cell(37,($line * $cellHeight),$hasil['nip_kadin'],1,0,'L',0);
  $pdf->Cell(63,($line * $cellHeight),$hasil['kadin'],1,0,'L',0);
  $pdf->Cell(37,($line * $cellHeight),$hasil['nip'],1,0,'C',0);
  $pdf->Cell(60,($line * $cellHeight),$hasil['nama'],1,0,'L',0);
  //memanfaatkan MultiCell sebagai ganti Cell
  //atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
  //ingat posisi x dan y sebelum menulis MultiCell
  $xPos=$pdf->GetX();
  $yPos=$pdf->GetY();

  $pdf->MultiCell($cellWidth,$cellHeight,$hasil['alamat'],1);
  
  //kembalikan posisi untuk sel berikutnya di samping MultiCell 
    //dan offset x dengan lebar MultiCell
  //$pdf->SetXY($xPos + $cellWidth , $yPos);
  
  
  
  //$pdf->Cell(29,($line * $cellHeight),$hasil['no_toko'],1,1,'R',0);
  //$pdf->Cell(29,($line * $cellHeight),$hasil['sn_router'],1,1,'L',0); //sesuaikan ketinggian dengan jumlah garis
}

//Menutup dokumen dan dikirim ke browser
$pdf->Output();
?>
