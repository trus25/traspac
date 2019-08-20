<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
// create new PDF document
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator($name);
$pdf->SetAuthor($name);
$pdf->SetTitle($name);
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Detail Pengajuan',' ', array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = <<<EOD
<table style="width:100%">
  <tr>
    <th>
    <b>Informasi Pegawai</b><br>
    </th>
  </tr>
  <tr>
    <td>
        Nama : $pengaju->p_nama
        <br>
    </td>
  </tr>
  <tr>
    <td>
        NIP : $pengaju->p_id
        <br>
    </td>
  </tr>
  <tr>
    <td>
        Jabatan : $pengaju->r_nama
        <br>
    </td>
  </tr>
  <tr>
    <td>
        Golongan : $pengaju->g_tingkat
        <br>
    </td>
  </tr>
  <tr>
    <td>
        Unit Kerja : $pengaju->p_unitkerja
        <br>
    </td>
  </tr>
  <tr>
    <td>
        Alamat dan Nomor Telpon: $cuti->c_kontak<br>  yang dapat dihubungi
        <br>
    </td>
  </tr>
</table>
<table style="width:100%">
  <tr>
    <th>
    <b>Detaill Pengajuan Cuti</b><br>
    </th>
  </tr>
  <tr>
    <td>
        Jenis Cuti : $cuti->c_jenis
        <br>
    </td>
  </tr>
  <tr>
    <td>
        Tanggal Cuti : $cuti->c_dari s.d $cuti->c_sampai
        <br>
    </td>
  </tr>
  <tr>
    <td>
        Lama Cuti : $cuti->c_lama
        <br>
    </td>
  </tr>
  <tr>
    <td>
        Tempat Cuti : $cuti->c_tempat
        <br>
    </td>
  </tr>
  <tr>
    <td>
        Keperluan : $cuti->c_keperluan
        <br>
    </td>
  </tr>
  <tr>
    <td>
        Alamat dan Nomor Telpon: $cuti->c_kontak<br>  yang dapat dihubungi 
    </td>
  </tr>
</table>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+