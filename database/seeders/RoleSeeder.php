<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrador = Role::create(['name' => 'Administrador']);
        $cobranza = Role::create(['name' => 'Cobranza']);
        $gerenteDeVentas = Role::create(['name' => 'Gerente de ventas']);
        $relacionesPublicas = Role::create(['name' => 'Relaciones publicas']);

        $permissions = Permission::all();
        foreach($permissions as $permission){
            $administrador->givePermissionTo($permission->name);
        }

        $cobranza->givePermissionTo(['pagos', 'gastos', 'facturas']);
        $gerenteDeVentas->givePermissionTo(['usuarios', 'pagos', 'gastos', 'facturas', 'reportes']);
        $relacionesPublicas->givePermissionTo(['servicios', 'proyectos', 'clientes', 'prospectos', 'calendario', 'cotizaciones']);

    }
}
