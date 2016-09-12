<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class my_pdf_lib {
	public function my_pdf_lib() {
		require_once ('pdfcrowd.php');
	}

	public function export() {
		try {
			// create an API client instance
			$client = new Pdfcrowd("ahmsayat", "24dd3aa778167081ba01e2e95d069fdd");

			// convert a web page and store the generated PDF into a $pdf variable
			$pdf = $client -> convertURI('http://www.google.com/');

			// set HTTP response headers
			header("Content-Type: application/pdf");
			header("Cache-Control: max-age=0");
			header("Accept-Ranges: none");
			header("Content-Disposition: attachment; filename=\"google_com.pdf\"");

			// send the generated PDF
			echo $pdf;
		} catch(PdfcrowdException $why) {
			echo "Pdfcrowd Error: " . $why;
		}
	}
	
	public function export_url($url) {
		try {
			// create an API client instance
			$client = new Pdfcrowd("ahmsayat", "24dd3aa778167081ba01e2e95d069fdd");

			// convert a web page and store the generated PDF into a $pdf variable
			$pdf = $client -> convertURI($url);

			// set HTTP response headers
			header("Content-Type: application/pdf");
			header("Cache-Control: max-age=0");
			header("Accept-Ranges: none");
			header("Content-Disposition: attachment; filename=\"google_com.pdf\"");

			// send the generated PDF
			echo $pdf;
		} catch(PdfcrowdException $why) {
			echo "Pdfcrowd Error: " . $why;
		}
	}
	
	public function export_html($html = "<head></head><body>My HTML Layout</body>", $id) 
	{
		try {
			// create an API client instance
			$client = new Pdfcrowd("ahmsayat", "24dd3aa778167081ba01e2e95d069fdd");

			// convert a web page and store the generated PDF into a $pdf variable
			$pdf = $client->convertHtml($html);
			
			// set HTTP response headers
			header("Content-Type: application/pdf");
			header("Cache-Control: max-age=0");
			header("Accept-Ranges: none");
			header("Content-Disposition: attachment; filename=\"Public_News_Publishing_System_" . $id . ".pdf\"");

			// send the generated PDF
			echo $pdf;
		} catch(PdfcrowdException $why) {
			echo "Pdfcrowd Error: " . $why;
		}
	}
	
	public function save() 
	{
		try {
			// create an API client instance
			$client = new Pdfcrowd("ahmsayat", "24dd3aa778167081ba01e2e95d069fdd");

			$out_file = fopen("document.pdf", "wb");
    		$client->convertHtml("<head></head><body>My HTML Layout</body>", $out_file);
    		fclose($out_file);
	
			// set HTTP response headers
			header("Content-Type: application/pdf");
			header("Cache-Control: max-age=0");
			header("Accept-Ranges: none");
			header("Content-Disposition: attachment; filename=\"google_com.pdf\"");

		} catch(PdfcrowdException $why) {
			echo "Pdfcrowd Error: " . $why;
		}
	}

}
