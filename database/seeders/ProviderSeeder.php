<?php

namespace Database\Seeders;

use App\Models\Provider;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provider::create([
            'name' => 'Facebook',
            'description' => 'Anuncios de facebook Ads',
        ]);
        Provider::create([
            'name' => 'Google',
            'description' => 'Anuncios de google Ads',
        ]);
        Provider::create([
            'name' => 'Hostgator',
            'description' => 'Proveedor de hosting y dominio',
        ]);
        Provider::create([
            'name' => 'Hostinger',
            'description' => 'Proveedor de hosting y dominio',
        ]);
        
    }
}
