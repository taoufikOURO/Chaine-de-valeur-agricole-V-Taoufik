<?php

namespace App\Static;

use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Notifications\Notification;

class StaticFunction
{
    /**
     * Downloads file with given data
     */
    public static function stream(string $viewName, array $data, string $fileName)
    {

        $pdf = Pdf::loadView($viewName, $data);

        return response()->streamDownload(function () use ($pdf) {

            echo $pdf->stream();

   
        }, $fileName.'.pdf');

    }
}
