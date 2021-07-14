<?php

namespace Database\Seeders;

use App\Models\ServiceType;
use Illuminate\Database\Seeder;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Marketing digital
        ServiceType::create([
            'name' => 'Gestión de redes sociales',
        ]);
        ServiceType::create([
            'name' => 'Campañas digitales',
        ]);
        ServiceType::create([
            'name' => 'Estrategia de contenidos',
        ]);
        ServiceType::create([
            'name' => 'Re-marketing',
        ]);
        ServiceType::create([
            'name' => 'Mailing',
        ]);

        //Desarrollo web
        ServiceType::create([
            'name' => 'One pages',
        ]);
        ServiceType::create([
            'name' => 'Páginas web',
        ]);
        ServiceType::create([
            'name' => 'Aplicaciónes web',
        ]);
        ServiceType::create([
            'name' => 'Tienda en linea',
        ]);
        ServiceType::create([
            'name' => 'Campañas y anuncios en Google Ads',
        ]);
        ServiceType::create([
            'name' => 'Optimizaciones y actualizaciones',
        ]);
        ServiceType::create([
            'name' => 'Software especializado',
        ]);

        //Diseño gráfico
        ServiceType::create([
            'name' => 'Identidad corporativa',
        ]);
        ServiceType::create([
            'name' => 'Naming y Slogan',
        ]);
        ServiceType::create([
            'name' => 'Logotipos y otros símbolos',
        ]);
        ServiceType::create([
            'name' => 'Manuales de identidad',
        ]);
        ServiceType::create([
            'name' => 'Registro de marca',
        ]);
        ServiceType::create([
            'name' => 'Brochure: Tarjetas de presentación impresas y digitales, Hojas membretadas, Trípticos, catálogos, Fyers etc.',
        ]);
        ServiceType::create([
            'name' => 'Material pop y promocionales',
        ]);
        ServiceType::create([
            'name' => 'Sesión fotográfica profesional',
        ]);
    }
}
