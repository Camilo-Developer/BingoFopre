<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\Facades\Image;
use ZipArchive;

class GenerateQRCodes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $inicio;
    protected $final;

    /**
     * Create a new job instance.
     */
    public function __construct($inicio, $final)
    {
        $this->inicio = $inicio;
        $this->final = $final;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Generar los códigos QR en formato PNG y guardarlos en la carpeta temporal
        for ($i = $this->inicio; $i <= $this->final; $i++) {
            $pngFileName = '000' . str_pad($i, strlen($this->final), '0', STR_PAD_LEFT) . '.png';
            $gifFileName = '000' . str_pad($i, strlen($this->final), '0', STR_PAD_LEFT) . '.gif';

            QrCode::format('png')
                ->size(200) // Tamaño del código QR
                ->generate($baseUrl . str_pad($i, strlen($this->final), '0', STR_PAD_LEFT), public_path('temp_qr/' . $pngFileName));

            // Convertir el código QR de PNG a GIF
            $image = Image::make(public_path('temp_qr/' . $pngFileName));
            $image->save(public_path('temp_qr/' . $gifFileName), 100);
        }
    }
}
