<?php

namespace App\Http\Controllers\Admin\Salesforce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class SalesforceController extends Controller
{
    public function index($id)
    {
        $accessToken = $this->getAccessToken();

        if (!$accessToken) {
            return response('No se pudo obtener un token de acceso válido', 401);
        }

        $contact = $this->gatData($accessToken, $id);

        //dd($contact);
        return response()->json($contact);
    }

    protected function getAccessToken()
    {
        $client = new Client();

        $url = 'https://login.salesforce.com/services/oauth2/token';

        try {
            $response = $client->post($url, [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => env('SALESFORCE_CLIENT_ID'),
                    'client_secret' => env('SALESFORCE_CLIENT_SECRET'),
                    'username' => env('SALESFORCE_USERNAME'),
                    'password' => env('SALESFORCE_PASSWORD') . env('SALESFORCE_SECURITY_TOKEN')
                ]
            ]);

            return json_decode($response->getBody())->access_token;
        } catch (ClientException $e) {
            // Maneja errores de solicitud aquí si es necesario
            return null;
        }

    }

    protected function gatData($accessToken, $id)
    {
        $client = new Client();

        $url = "https://vde.my.salesforce.com/services/data/v58.0/query?q=SELECT+Categoria_Principal__c,Categoria__c,Categoria_Administrativo__c,FirstName,LastName,Email,generoEmail__c,Tipo_identificaci_n__c,N_mero_de_Identificaci_n__c,Tel_fono_celular_1__c+FROM+Contact+WHERE+N_mero_de_Identificaci_n__c='$id' OR Email='$id'";

        try {
            $contactsResponse = $client->get($url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);

            $contactsData = json_decode($contactsResponse->getBody());

            // Verifica si "records" es un array y si tiene al menos un elemento
            if (is_array($contactsData->records) && count($contactsData->records) > 0) {
                // Accede al primer elemento (índice 0) y obtén el valor de "Categoria_Administrativo__c"
                $categoriaAdministrativo = $contactsData->records[0];

                // Retorna el valor de "Categoria_Administrativo__c"
                return $categoriaAdministrativo;
            } else {
                // Maneja el caso en que no haya registros o la estructura sea diferente a la esperada
                return null; // O puedes retornar un valor predeterminado según tu lógica
            }


        } catch (ClientException $e) {
            // Maneja errores de solicitud aquí si es necesario
        }

        return null;
    }
}
