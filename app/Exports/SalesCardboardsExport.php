<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Cardboard\Cardboard;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

use Carbon\Carbon;

class SalesCardboardsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $sales;

    public function __construct($sales)
    {
        $this->sales = $sales;
    }

    public function collection()
    {
        return $this->sales;
    }

    public function headings(): array
    {
        return [
            'Nombre Cartón',
            'Precio Cartón',
            'Documento del Comprador',
            'Categoria Principal del Comprador',
            'Categoria C del Comprador',
            'Categoria Administrativa del Comprador',
            'Nombre del Comprador',
            'Apellido del Comprador',
            'Correo Electronico del Comprador',
            'Genero del Comprador',
            'Tipo de Identificacion del Comprador',
            'Telefono Celular del Comprador',
            'Fecha Venta',
            'Modo de Venta',
            'Estado del Cartón',
            'Grupo del Cartón',
            'Correo Usuario Vendedor del Cartón',
        ];
    }

    public function map($sale): array
    {
        return [
            $sale->name,
            $sale->price,
            $sale->document_number ?? 'N/A',
            $sale->Categoria_Principal__c ?? 'N/A',
            $sale->Categoria__c ?? 'N/A',
            $sale->Categoria_Administrativo__c ?? 'N/A',
            $sale->FirstName ?? 'N/A',
            $sale->LastName ?? 'N/A',
            $sale->Email ?? 'N/A',
            $sale->generoEmail__c ?? 'N/A',
            $sale->Tipo_identificaci_n__c ?? 'N/A',
            $sale->Tel_fono_celular_1__c ?? 'N/A',
            $this->formatSoldDate($sale->sold_date) ?? 'N/A',
            $sale->mode_sale ?? 'N/A',
            $sale->state->name,
            $sale->group_id,
            $sale->user->email ?? 'N/A',
        ];
    }

    protected function formatSoldDate($sold_date)
    {
        if ($sold_date) {
            if (is_string($sold_date)) {
                $sold_date = Carbon::parse($sold_date);
            }

            return $sold_date->format('Y-m-d');
        }
        return 'N/A';
    }
}
