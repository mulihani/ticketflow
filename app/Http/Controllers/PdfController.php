<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    //
    public function generatePdf( $view = '')
    {
        $mpdf = new \Mpdf\Mpdf();

        // Render the view as HTML
        if ($view != '') {
            $html = view('reports.'.$view.'-report')->render();
        } else {
            $html = view('reports.categories-report')->render();
        }
        
        // Write HTML to the mPDF object
        $mpdf->WriteHTML($html);

        // Output the PDF 'I' for inline, 'D' for download
        return $mpdf->Output($view.'.pdf', 'D');
    }
}
