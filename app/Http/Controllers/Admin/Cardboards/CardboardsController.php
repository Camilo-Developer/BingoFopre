<?php

namespace App\Http\Controllers\Admin\Cardboards;

use App\Http\Controllers\Admin\Salesforce\SalesforceController;
use App\Http\Controllers\Controller;
use App\Models\State\State;
use Illuminate\Http\Request;

use App\Models\Cardboard\Cardboard;
use App\Models\CartonGroup\CartonGroup;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\Facades\Image;
use ZipArchive;
use App\Models\User;
use Spatie\Permission\Models\Role;

class CardboardsController extends Controller
{
    public function createForm(Request $request)
    {
        $search = $request->input('search');
        $cardboards = Cardboard::query()
            ->where('name', 'LIKE', "%$search%")
            ->orderBy('id', 'desc')
            ->paginate(10);
        $states = State::all();
        $carton_groups = CartonGroup::all();
        return view('admin.cartones.create',compact(
            'cardboards',
            'search',
            'states',
            'carton_groups',
        ));
    }
    public function create(Request $request)
    {
        $startNumber = strval($request->input('start_number'));
        $endNumber = strval($request->input('end_number'));
        $groupSize = $request->input('group_size');
        $price = $request->input('price');
        $group = null;
        $groupCount = 0;
        for ($i = $startNumber; $i <= $endNumber; $i++) {
            if ($groupCount % $groupSize === 0) {
                $group = CartonGroup::create(['user_id' => null]);
            }
            $formattedName = str_pad($i, strlen($endNumber), '0', STR_PAD_LEFT);
            $cardboard = Cardboard::create([
                'name' => $formattedName,
                'price' => $price,
                'state_id' => 3,
                'group_id' => $group ? $group->id : null,
            ]);
            $groupCount++;
            $cardboard->group_id = $group ? $group->id : null;
            $cardboard->save();
        }
        return redirect()->route('admin.cartones.createForm')->with('success', 'Cartones y grupos creados exitosamente.');
    }

    public function addToCart($name) {
        if (Auth::check()) {
            $carton = Cardboard::where('name', $name)->first();
            if (!$carton) {
                return redirect()->route('dashboard')->with('delete', 'El cartón no fue encontrado.');
            }
            if ($carton->state_id == 3) {
                $user = Auth::user();
                $grupoIdsDelUsuario = $user->cartongroup->pluck('id')->toArray();
                if (in_array($carton->group_id, $grupoIdsDelUsuario)) {
                    $cart = session()->get('cart');
                    $cart[$carton->id] = [
                        'name' => $carton->name,
                        'quantity' => 1,
                        'price' => $carton->price,
                        'state_id' => $carton->state_id,
                        'user_id' => $carton->user_id,
                        'document_number' => $carton->document_number,
                    ];
                    session()->put('cart', $cart);
                    return redirect()->route('dashboard')->with('success', 'Se añadió al carrito con éxito.');
                } else {
                    return redirect()->route('dashboard')->with('delete', 'No tienes permiso para agregar este cartón al carrito.');
                }
            } else {
                return redirect()->route('dashboard')->with('delete', 'Este cartón no puede ser agregado al carrito porque su estado no es 3.');
            }
        } else {
            return redirect()->route('login')->with('delete', 'Debes iniciar sesión para agregar cartones al carrito.');
        }
    }

    public function showCart(Request $request)
    {
        $salesforceController = new SalesforceController();
        $data = $salesforceController->index($document_number = $request->input('document_number'));

        $userData = json_decode($data->getContent());
        $cart = Session::get('cart', []);
        return view('user.cart.index', compact('cart','userData'));
    }
    public function finishPurchase(Request $request)
    {
        $cart = Session::get('cart', []);
        $cartonData = $request->input('cartons');
        $documentoComprador = $request->input('document_number');

        $Categoria_Principal__c = $request->input('Categoria_Principal__c');
        $Categoria__c = $request->input('Categoria__c');
        $Categoria_Administrativo__c = $request->input('Categoria_Administrativo__c');
        $FirstName = $request->input('FirstName');
        $LastName = $request->input('LastName');
        $Email = $request->input('Email');
        $generoEmail__c = $request->input('generoEmail__c');
        $Tipo_identificaci_n__c = $request->input('Tipo_identificaci_n__c');
        $Tel_fono_celular_1__c = $request->input('Tel_fono_celular_1__c');

        // Buscar al usuario por número de documento
        $user = User::where('email', $Email)->first();

        if (!$user) {
            // Si el usuario no existe, créalo
            $user = new User();
            $user->name = $FirstName;
            $user->lastname = $LastName;
            $user->document_number = $documentoComprador;
            $user->email = $Email;
            $user->password = bcrypt($documentoComprador);
            $user->external_auth = 'Salesforce';
            $user->state_id = 1;
            $userSaved = $user->save();

            if ($userSaved) {
                // Asigna el rol si el usuario se ha guardado correctamente
                $user->assignRole('Estudiante');
            }
        } else {
            // Si el usuario existe, actualiza los campos necesarios
            $user->name = $FirstName;
            $user->lastname = $LastName;
            $user->document_number = $documentoComprador;
            $user->email = $Email;
            $user->password = bcrypt($documentoComprador);
            if (empty($user->external_auth)) {
                $user->external_auth = 'Salesforce';
            }
            $user->state_id = 1;
            $user->save();

        }

        foreach ($cart as $cartonId => $carton) {
            $cartonDB = Cardboard::find($cartonId);
            if ($cartonDB) {
                $cartonDB->state_id = $cartonData[$cartonId]['state_id'];
                $cartonDB->document_number = $documentoComprador;
                $cartonDB->Categoria_Principal__c = $Categoria_Principal__c;
                $cartonDB->Categoria__c = $Categoria__c;
                $cartonDB->Categoria_Administrativo__c = $Categoria_Administrativo__c;
                $cartonDB->FirstName = $FirstName;
                $cartonDB->LastName = $LastName;
                $cartonDB->Email = $Email;
                $cartonDB->generoEmail__c = $generoEmail__c;
                $cartonDB->Tipo_identificaci_n__c = $Tipo_identificaci_n__c;
                $cartonDB->Tel_fono_celular_1__c = $Tel_fono_celular_1__c;
                $cartonDB->save();
            }
        }
        Session::forget('cart');
        return redirect()->route('user.cart.index')->with('success', 'Compra finalizada con éxito.');
    }

    public function removeFromCart($cartonId)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$cartonId])) {
            unset($cart[$cartonId]);
            Session::put('cart', $cart);
            return redirect()->route('user.cart.index')->with('success', 'Cartón eliminado del carrito con éxito.');
        }
        return redirect()->route('user.cart.index')->with('error', 'El cartón no se encontró en el carrito.');
    }

    public function edit(Cardboard $cardboard)
    {
        $states = State::all();
        return view('admin.cartones.create', compact('cardboard','states'));
    }

    public function update(Request $request, Cardboard $cardboard)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'document_number' => 'nullable',
            'state_id' => 'required',
            'group_id' => 'required',
        ]);
        $data = $request->all();
        $cardboard->update($data);
        return redirect()->route('admin.cartones.create')->with('edit', 'El Cartón se ha editado correctamente.');
    }

    public function generadormasivoQR(Request $request)
    {
        set_time_limit(0);
        // Validar los datos del formulario
        $request->validate([
            'inicio' => 'required|numeric',
            'final' => 'required|numeric',
        ]);

        $inicio = $request->input('inicio');
        $final = $request->input('final');
        $baseUrl = 'https://bingofopre.uniandes.edu.co/admin/add-to-cart/';

        // Ruta de la carpeta temporal
        $tempFolder = public_path('temp_qr');

        // Verificar si la carpeta ya existe
        if (!File::exists($tempFolder)) {
            // Si no existe, crear la carpeta
            File::makeDirectory($tempFolder, 0755, true);
        }

        // Generar los códigos QR en formato PNG y guardarlos en la carpeta temporal
        for ($i = $inicio; $i <= $final; $i++) {
            $pngFileName = '000' . str_pad($i, strlen($final), '0', STR_PAD_LEFT) . '.png';
            $gifFileName = '000' . str_pad($i, strlen($final), '0', STR_PAD_LEFT) . '.gif';

            QrCode::format('png')
                ->size(200) // Tamaño del código QR
                ->generate($baseUrl . str_pad($i, strlen($final), '0', STR_PAD_LEFT), public_path('temp_qr/' . $pngFileName));

            // Convertir el código QR de PNG a GIF
            $image = Image::make(public_path('temp_qr/' . $pngFileName));
            $image->save(public_path('temp_qr/' . $gifFileName), 100);
        }

        // Comprimir la carpeta temporal en un archivo ZIP
        $zipFileName = 'qrcodes.zip';
        $zipPath = public_path($zipFileName);
        $zip = new ZipArchive;

        if ($zip->open($zipPath, ZipArchive::CREATE) === true) {
            // Agregar solo archivos GIF al ZIP
            foreach (range($inicio, $final) as $i) {
                $gifFileName = '000' . str_pad($i, strlen($final), '0', STR_PAD_LEFT) . '.gif';
                $zip->addFile(public_path('temp_qr/' . $gifFileName), $gifFileName);
            }

            $zip->close();
        }

        // Eliminar la carpeta temporal y su contenido
        File::deleteDirectory($tempFolder);

        // Descargar el archivo ZIP con los códigos QR
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }


}
