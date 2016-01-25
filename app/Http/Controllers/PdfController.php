<?php

namespace Sibas\Http\Controllers;

use Illuminate\Support\Facades\App;
use Sibas\Http\Requests;
use Sibas\Http\Controllers\Controller;

class PdfController extends Controller
{
    /**
     * Show the form for creating a new resource PDF.
     *
     * @param string $view
     * @param string $title
     * @return \Illuminate\Http\Response
     */
    public function create($view, $title)
    {
        $pdf = \PDF::loadHTML($view);

        return $pdf->setPaper('Letter')->stream($title);
    }

}
