<?php

$app=App::get_instance();
$gagnant=$app->get_table('gagnant')->get_coords_gagnant($_GET['gagnant']);


function get_qrcode($gagnant ,$id_gagnant){
    require '../app/table/librairie/phpqrcode/qrlib.php';
    $nom='../app/views/compte/image/qrcode/'.$id_gagnant.'.png';
    QRcode::png($gagnant , $nom);

}
$qrcode=get_qrcode($gagnant, $_GET['gagnant']);

//____________________________________________________________
require '../app/table/librairie/fpdf183/fpdf.php';
$gagnant_info=$app->get_table('gagnant')->get_info_gagnant($_GET['gagnant']);
$user=$app->get_table('user')->get_user($gagnant_info->id_user);
$image=$app->get_table('image')->get_user_image($user->id_user);
class PDF extends FPDF{
	
	function Header(){
		
 		global $user;
        global $image;
		$this->SetDrawColor(255,255,255);
		$this->setFillColor(50,50,50);
		$this->setleftmargin(2);
		$this->setrightmargin(2);
		$this->setX(2);
		$this->SetFont('Arial','I',19);
		$this->settextcolor(0,0,0);
		$this->SetDrawColor(0,0,0);
		$this->Cell(200,12,ucwords($user->nom_user).'   '.ucwords($user->prenom_user),1,1,"C");
		$this->ln(2);
		$this->setleftmargin(1);
		$this->Image($image->path_image.$image->nom_image,1,15,40, 40);
    $this->Image('../app/views/compte/image/qrcode/'.$_GET['gagnant'].'.png',1,70,30, 30);

	}
	function footer(){
		$this->setY(-10);
		$this->SetFont('Arial','',12);
		$this->settextcolor(251,13,19);
		$this->cell(0,10,'page'.$this->pageNo().'/{nb}',0,0,'C');
	}
}
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->setmargins(2,2,2);
$pdf->addpage();
$pdf->setleftmargin(1);
$pdf->ln(40);
$pdf->Cell(200,12,'ce fichier est tres interessant : le qrcode est lid unique de produit',1,1,"C");
$pdf->SetFont('Arial','',18);
$pdf->output('I','cer.pdf');
/*
require '../app/table/librairie/tcpdf_min/tcpdf.php';
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 12);  
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= '  
      <h3 align="center">Export HTML Table data to PDF using TCPDF in PHP</h3><br /><br />  
      <table border="1" cellspacing="0" cellpadding="5">  
           <tr>  
                <th width="5%">ID</th>  
                <th width="30%">Name</th>  
                <th width="10%">Gender</th>  
                <th width="45%">Designation</th>  
                <th width="10%">Age</th>  
           </tr>  
      ';  
      //$content .= fetch_data();  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('sample.pdf', 'I');  
     */ 
?>