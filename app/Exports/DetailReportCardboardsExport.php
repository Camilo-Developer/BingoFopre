<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class DetailReportCardboardsExport implements FromView
{
    protected $totalCartonesCreados;
    protected $totalCartonesVendidos;
    protected $totalCartonesObsequio;
    protected $montoCartonesCreados;
    protected $montoCartonesVendidos;
    protected $montoCartonesObsequio;
    protected $totalCartonesRestantes;
    protected $montoCartonesRestantes;

    public function __construct($totalCartonesCreados, $montoCartonesCreados, $totalCartonesVendidos, $montoCartonesVendidos, $totalCartonesObsequio,  $montoCartonesObsequio, $totalCartonesRestantes, $montoCartonesRestantes)
    {
        $this->totalCartonesCreados = $totalCartonesCreados;
        $this->montoCartonesCreados = $montoCartonesCreados;

        $this->totalCartonesVendidos = $totalCartonesVendidos;
        $this->montoCartonesVendidos = $montoCartonesVendidos;

        $this->totalCartonesObsequio = $totalCartonesObsequio;
        $this->montoCartonesObsequio = $montoCartonesObsequio;

        $this->totalCartonesRestantes = $totalCartonesRestantes;
        $this->montoCartonesRestantes = $montoCartonesRestantes;
    }

    public function view(): View
    {
        return view('admin.cartones.export.sales_detail_report_export', [
            'totalCartonesCreados' => $this->totalCartonesCreados,
            'montoCartonesCreados' => $this->montoCartonesCreados,

            'totalCartonesVendidos' => $this->totalCartonesVendidos,
            'montoCartonesVendidos' => $this->montoCartonesVendidos,

            'totalCartonesObsequio' => $this->totalCartonesObsequio,
            'montoCartonesObsequio' => $this->montoCartonesObsequio,

            'totalCartonesRestantes' => $this->totalCartonesRestantes,
            'montoCartonesRestantes' => $this->montoCartonesRestantes,
        ]);
    }
}
