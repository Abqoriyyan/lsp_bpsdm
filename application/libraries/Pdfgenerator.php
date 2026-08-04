
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('DOMPDF_ENABLE_AUTOLOAD', TRUE);
// require_once("./vendor/dompdf/dompdf/dompdf_config.inc.php");

class Pdfgenerator {
  public function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
  {
    $dompdf = new Dompdf\Dompdf();
    $dompdf->load_html($html);
    $dompdf->set_paper($paper, $orientation);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf", array("Attachment" => 0));
    } else {
        return $dompdf->output();
    }
  }

  public function generate_tofile($html, $filename='', $paper = 'A4', $orientation = "portrait")
  {
    $dompdf = new Dompdf\Dompdf();
    $dompdf->load_html($html);
    $dompdf->setPaper($paper, $orientation);
    $dompdf->render();
    $output = $dompdf->output();
    file_put_contents('./uploads/'.$filename, $output);
  }

}
