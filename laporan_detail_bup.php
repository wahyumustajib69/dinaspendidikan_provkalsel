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
    $this->Line(10,31,198,31);
    $this->SetLineWidth(0);
    $this->Line(10,32,198,32);
    // Line break 5mm
    $this->Ln(6);
}

// Page footer
function Footer()
{
    // Posisi 15 cm dari bawah
    $this->SetY(-95);
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
$pdf = new PDF('P','mm','A4');
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
$sql = mysqli_query($konek,"SELECT*FROM pmpp AS a JOIN pegawai AS b ON a.nip=b.nip JOIN pangkat AS c ON b.pangkat=c.id_pnkt WHERE no_surat='$no'");
$no =1;
while($row = mysqli_fetch_array($sql)){

$pdf->SetFont('Times','',11);
$pdf->Cell(26,5,'Nomor',0,0,'L',0);
$pdf->Cell(3,5,':',0,0,'C',0);
$pdf->Cell(55,5,'882/'.$row['no_surat'],0,0,'L',0);
$pdf->Cell(40,5,'',0,0,'C',0);
$pdf->Cell(25,5,'Banjarbaru,',0,0,'L',0);
$pdf->Cell(1,5,'',0,0,'C',0);
$pdf->Cell(38,5,tgl_indo($row['tgl_surat']),0,1,'L',0);

$pdf->Cell(26,5,'Lampiran',0,0,'L',0);
$pdf->Cell(3,5,':',0,0,'C',0);
$pdf->Cell(55,5,'2 (dua) berkas',0,1,'L',0);

$pdf->Cell(26,5,'Hal',0,0,'L',0);
$pdf->Cell(3,5,':',0,0,'C',0);
$pdf->Cell(60,5,'Permohonan MPP dan usul pensiun',0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'C',0);
$pdf->Cell(25,5,'Kepada Yth.',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(38,5,'',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,'Karena Mencapai Batas Usia Pensiun',0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'C',0);
$pdf->Cell(25,5,'Gubernur Kalimantan Selatan',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(38,5,'',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,'atas nama Sdr. '.$row['nama'],0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'C',0);
$pdf->Cell(25,5,'u.p. Kepala Badan Kepegawaian Daerah',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(38,5,'',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,'NIP. '.$row['nip'],0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'C',0);
$pdf->Cell(25,5,'Provinsi Kalimantan Selatan',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(38,5,'',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,'',0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'C',0);
$pdf->Cell(25,5,'di Banjarbaru',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(38,5,'',0,1,'L',0);

$pdf->Ln(5);
$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'C',0);
$pdf->Cell(60,5,'Bersama ini kami sampaikan Permohonan Masa Persiapan Pensiun dan',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,'Berhenti Dengan Hormat Sebagai Pegawai Negeri Sipil Atas Permintaan Sendiri',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,'dengan mendapat Hak Pensiun atas nama Saudara :',0,1,'L',0);

$pdf->Ln(5);
$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(45,5,'Nama',0,0,'L',0);
$pdf->Cell(5,5,':',0,0,'L',0);
$pdf->Cell(60,5,$row['nama'],0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(45,5,'NIP',0,0,'L',0);
$pdf->Cell(5,5,':',0,0,'L',0);
$pdf->Cell(60,5,$row['nip'],0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(45,5,'Tempat/Tanggal Lahir',0,0,'L',0);
$pdf->Cell(5,5,':',0,0,'L',0);
$pdf->Cell(60,5,$row['tmp_lahir'].', '.tgl_indo($row['tgl_lahir']),0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(45,5,'Pangkat/Golongan Ruang',0,0,'L',0);
$pdf->Cell(5,5,':',0,0,'L',0);
$pdf->Cell(60,5,$row['nm_pnkt'].' (Gol. '.$row['ket'].')',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(45,5,'Jabatan',0,0,'L',0);
$pdf->Cell(5,5,':',0,0,'L',0);
$pdf->Cell(60,5,$row['jbtn'],0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(45,5,'Unit Kerja',0,0,'L',0);
$pdf->Cell(5,5,':',0,0,'L',0);
$pdf->Cell(60,5,$row['unit_kerja'],0,1,'L',0);


//MENAMPILKAN ALAMAT SEKARANG
$cellWidth=110; 
$cellHeight=5; 
  
  if($pdf->GetStringWidth($row['alamat']) < $cellWidth){
    $line=1;
  }else{
    $textLength=strlen($row['alamat']);  //total panjang teks
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
        $tmpString=substr($row['alamat'],$startChar,$maxChar);
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

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(45,5,'Alamat Sekarang',0,0,'L',0);
$pdf->Cell(5,5,':',0,0,'L',0);
$xPos=$pdf->GetX();
$yPos=$pdf->GetY();
$pdf->MultiCell($cellWidth,$cellHeight,$row['alamat'],0);
  //kembalikan posisi untuk sel berikutnya di samping MultiCell 
//$pdf->SetXY($xPos + $cellWidth , $yPos);
$pdf->Ln(3);

//MENAMPILKAN ALAMAT SETELAH PENSIUN
$Width=110; //lebar sel
$Height=5; //tinggi sel satu baris normal
  
  if($pdf->GetStringWidth($row['alm_pensiun']) < $Width){
    $line=1;
  }else{
    
    $Length=strlen($row['alm_pensiun']);  //total panjang teks
    $Margin=5;   //margin kesalahan lebar sel, untuk jaga-jaga
    $Char=0;   //posisi awal karakter untuk setiap baris
    $max=0;     //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
    $text=array(); //untuk menampung data untuk setiap baris
    $String="";    //untuk menampung teks untuk setiap baris (sementara)
    
    while($Char < $Length){ //perulangan sampai akhir teks
      //perulangan sampai karakter maksimum tercapai
      while( 
      $pdf->GetStringWidth( $String ) < ($Width-$Margin) &&
      ($Char+$max) < $Length ) {
        $max++;
        $String=substr($row['alm_pensiun'],$Char,$max);
      }
      //pindahkan ke baris berikutnya
      $Char=$Char+$max;
      //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
      array_push($text,$String);
      //reset variabel penampung
      $max=0;
      $String='';
      
    }
    //dapatkan jumlah baris
    $line=count($text);
  }

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(45,5,'Alamat Setelah Pensiun',0,0,'L',0);
$pdf->Cell(5,5,':',0,0,'L',0);
$xPos=$pdf->GetX();
$yPos=$pdf->GetY();
$pdf->MultiCell($cellWidth,$cellHeight,$row['alm_pensiun'],0);
  
  //kembalikan posisi untuk sel berikutnya di samping MultiCell 
  //$pdf->SetXY($xPos + $cellWidth , $yPos);

$pdf->Ln(5);
$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'C',0);
$pdf->Cell(60,5,'Pada prinsipnya kami dapat menyetujui usul permohonan Masa Persiapan Pensiun',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);

$tg = new DateTime($row['tgl_diangkat']);
$tp = date('Y-m-d', strtotime('-1 year', strtotime($row['tgl_diangkat'])));
$hp = new DateTime($tp);
$td = new DateTime();
$ms = $td->diff($tg);
$mp = $td->diff($hp);

$pdf->Cell(60,5,'(MPP) yang bersangkutan mulai tanggal '.tgl_indo($row['tgl_pensiun']).' dengan masa kerja ' .$ms->y.' Tahun '.$ms->m.' Bulan',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$tl = strtotime($row['tgl_lahir']);
$dt = date('Y-m-d', strtotime('+60 year', $tl));
$pdf->Cell(60,5,'dan usul pensiun karena telah mencapai Batas Usia Pensiun 60 tahun pada akhir '.tgl_indo($dt),0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,'dengan masa kerja '.$mp->y.' Tahun '.$mp->m.' Bulan.',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'C',0);
$pdf->Cell(60,5,'Sebagai bahan pertimbangan dan penyelesaian Saudara selanjutnya, terlampir',0,1,'L',0);

$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,'bahan kelengkapan pensiun bagi yang bersangkutan.',0,1,'L',0);

$pdf->Ln(4);
$pdf->Cell(26,5,'',0,0,'L',0);
$pdf->Cell(20,5,'',0,0,'C',0);
$pdf->Cell(60,5,'Demikian disampaikan, atas perhatian dan kerja samanya diucapkan terima kasih.',0,1,'L',0);

$pdf->SetFont('Times','',9);
$pdf->SetY(-48);
$pdf->Cell(20,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,'Tembusan :',0,1,'L',0);

$pdf->Cell(20,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,'1. Kepala '.$row['tmp_kerja'],0,1,'L',0);

$pdf->Cell(20,5,'',0,0,'L',0);
$pdf->Cell(3,5,'',0,0,'C',0);
$pdf->Cell(60,5,'2. Sdr. '.$row['nama'],0,1,'L',0);

$pdf->Cell(20,5,'',0,0,'L',0);
$pdf->Cell(6,5,'',0,0,'C',0);
$xPos=$pdf->GetX();
$yPos=$pdf->GetY();
$pdf->MultiCell($cellWidth,$cellHeight,$row['alamat'],0);
}

//Menutup dokumen dan dikirim ke browser
$pdf->Output();
?>
