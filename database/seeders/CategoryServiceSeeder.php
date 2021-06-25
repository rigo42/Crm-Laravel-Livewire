<?php

namespace Database\Seeders;

use App\Models\CategoryService;
use Illuminate\Database\Seeder;

class CategoryServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Marketing digital
        CategoryService::create([
            'name' => 'Gestión de redes sociales',
        ]);
        CategoryService::create([
            'name' => 'Campañas digitales',
        ]);
        CategoryService::create([
            'name' => 'Estrategia de contenidos',
        ]);
        CategoryService::create([
            'name' => 'Re-marketing',
        ]);
        CategoryService::create([
            'name' => 'Mailing',
        ]);

        //Desarrollo web
        CategoryService::create([
            'name' => 'One pages',
        ]);
        CategoryService::create([
            'name' => 'Páginas web',
        ]);
        CategoryService::create([
            'name' => 'Aplicaciónes web',
        ]);
        CategoryService::create([
            'name' => 'Tienda en linea',
        ]);
        CategoryService::create([
            'name' => 'Campañas y anuncios en Google Ads',
        ]);
        CategoryService::create([
            'name' => 'Optimizaciones y actualizaciones',
        ]);
        CategoryService::create([
            'name' => 'Software especializado',
        ]);

        //Diseño gráfico
        CategoryService::create([
            'name' => 'Identidad corporativa',
        ]);
        CategoryService::create([
            'name' => 'Naming y Slogan',
        ]);
        CategoryService::create([
            'name' => 'Logotipos y otros símbolos',
        ]);
        CategoryService::create([
            'name' => 'Manuales de identidad',
        ]);
        CategoryService::create([
            'name' => 'Registro de marca',
        ]);
        CategoryService::create([
            'name' => 'Brochure: Tarjetas de presentación impresas y digitales, Hojas membretadas, Trípticos, catálogos, Fyers etc.',
        ]);
        CategoryService::create([
            'name' => 'Material pop y promocionales',
        ]);
        CategoryService::create([
            'name' => 'Sesión fotográfica profesional',
        ]);
    }
}
