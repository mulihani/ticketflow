<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

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


    function generateUserTicketPdf($view = '', Ticket $record ) {

        $mpdf = new \Mpdf\Mpdf();

        if ($view != '' && $record != '') {
            $html = view('reports.'.$view.'-report', ['record' => $record])->render();
        
            // Write HTML to the mPDF object
            $mpdf->WriteHTML($html);

            // Output the PDF 'I' for inline, 'D' for download
            return $mpdf->Output($view.'.pdf', 'D');
        
        } else {
            abort(404, 'Record not found');
        }

    }
}