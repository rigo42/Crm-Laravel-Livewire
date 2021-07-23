<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'usuarios']);
        Permission::create(['name' => 'cuentas']);
        Permission::create(['name' => 'servicios']);
        Permission::create(['name' => 'prospectos']);
        Permission::create(['name' => 'clientes']);
        Permission::create(['name' => 'facturas']);
        Permission::create(['name' => 'pagos']);
        Permission::create(['name' => 'gastos']);
        Permission::create(['name' => 'reportes']);
        Permission::create(['name' => 'calendario']);

        //news 20/mayo/2021
        Permission::create(['name' => 'ajustes']);
        Permission::create(['name' => 'cotizaciones']);

        //News 12/07/2021
        Permission::create(['name' => 'proyectos']);
        Permission::create(['name' => 'proveedores']);
        Permission::create(['name' => 'tipo de servicio']);

        //News 19/07/2021
        Permission::create(['name' => 'google analytics']);
        Permission::create(['name' => 'log']);
    }
}
