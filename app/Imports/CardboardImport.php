<?php

namespace App\Imports;

use App\Models\Cardboard\Cardboard;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class CardboardImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        // Verificar si el campo "nombre carton" y "estado del carton" están presentes en la fila.
        if (isset($row['nombre_carton']) && isset($row['precio_carton']) && isset($row['estado_carton'])) {
            // Agrega registros de depuración para verificar el valor de $row['fecha_venta']
            $soldDate = $row['fecha_venta'] ?? null;
            if ($soldDate) {
                // Intenta convertir la fecha usando excelToDateTimeObject
                $soldDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($soldDate);
            }



            return new Cardboard([
                'name' => $row['nombre_carton'],
                'price' => $row['precio_carton'],
                'Tipo_identificaci_n__c' => $row['tipo_documento'] ?? null,
                'document_number' => $row['numero_documento'] ?? null,
                'Categoria_Principal__c' => $row['categoria_principal'] ?? null,
                'Categoria__c' => $row['categoria_c'] ?? null,
                'Categoria_Administrativo__c' => $row['categoria_administrativa'] ?? null,
                'FirstName' => $row['nombre_comprador'] ?? null,
                'LastName' => $row['apellido_Comprador'] ?? null,
                'Email' => $row['correo_comprador'] ?? null,
                'generoEmail__c' => $row['genero_comprador'] ?? null,
                'Tel_fono_celular_1__c' => $row['telefono_comprador'] ?? null,
                'sold_date' => $soldDate, // Utiliza la fecha convertida
                'mode_sale' => $row['modo_venta'] ?? null,
                'state_id' => $row['estado_carton'],
                'group_id' => null,
            ]);
        }
    }


}
