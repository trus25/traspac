<?php

// Include classes
include_once('./vendor/tinybutstrong/tinybutstrong/tbs_class.php'); // Load the TinyButStrong template engine
include_once('./vendor/tinybutstrong/opentbs/tbs_plugin_opentbs.php'); // Load the OpenTBS plugin

// prevent from a PHP configuration problem when using mktime() and date()
if (version_compare(PHP_VERSION,'5.1.0')>=0) {
    if (ini_get('date.timezone')=='') {
        date_default_timezone_set('UTC');
    }
}
global $yourname;
global $x_num;
global $x_pc;
global $x_bt;
global $x_dt;
global $x_picture;

function format_tanggal($tanggal){
  $bulan = array (1 =>   'Januari',
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
  $split = explode('-', $tanggal);
  return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
  }

// Initialize the TBS instance
$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin

// ------------------------------
// Prepare some data for the demo
// ------------------------------

// A recordset for merging tables
$data = array();
$i=1;
foreach ($cuti as $ct) {
    $status='';
    if($ct->c_status=='new'){
        $status = 'Usulan Baru';
    }else if($ct->c_status=='acc'){
        $status = 'Disetujui Atasan';
    }else if($ct->c_status=='rjct'){
        $status = 'Ditolak Atasan';
    }
    $data[] = array('no'=> $i, 'nama'=> $ct->p_nama, 'nip' => $ct->p_id, 'tgl'=> format_tanggal($ct->c_dari).' s.d. '.format_tanggal($ct->c_sampai), 'jenis'=>$ct->c_jenis, 'lama'=>$ct->c_lama , 'tempat'=>$ct->c_tempat, 'jenis'=>$ct->c_jenis, 'tanggal'=>format_tanggal($ct->c_tanggal), 'status'=> $status);
    $i=$i+1;
}
// -----------------
// Load the template
// -----------------

$template = './demo_ms_excel.xlsx';
$ext = '.xlsx';
$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).

// ----------------------
// Debug mode of the demo
// ----------------------
if (isset($_POST['debug']) && ($_POST['debug']=='current')) $TBS->Plugin(OPENTBS_DEBUG_XML_CURRENT, true); // Display the intented XML of the current sub-file, and exit.
if (isset($_POST['debug']) && ($_POST['debug']=='info'))    $TBS->Plugin(OPENTBS_DEBUG_INFO, true); // Display information about the document, and exit.
if (isset($_POST['debug']) && ($_POST['debug']=='show'))    $TBS->Plugin(OPENTBS_DEBUG_XML_SHOW); // Tells TBS to display information when the document is merged. No exit.

// --------------------------------------------
// Merging and other operations on the template
// --------------------------------------------

$TBS->PlugIn(OPENTBS_SELECT_SHEET, "Dynamic columns");

// Merge data in Sheet 2
$TBS->MergeBlock('b2', $data);

// -----------------
// Output the result
// -----------------

// Define the name of the output file
$save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
$output_file_name = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $template);
if ($save_as==='') {
    // Output the result as a downloadable file (only streaming, no data saved in the server)
    $TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields.
    // Be sure that no more output is done, otherwise the download file is corrupted with extra data.
    exit();
} else {
    // Output the result as a file on the server.
    $TBS->Show(OPENTBS_FILE, $output_file_name); // Also merges all [onshow] automatic fields.
    // The script can continue.
    exit("File [$output_file_name] has been created.");
}
