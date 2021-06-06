<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rigoberto = User::create([
            'id' => 3,
            'name' => 'Rigoberto',
            'email' => 'rigoberto@brandbean.mx',
            'position' => 'Programador',
            'email_verified_at' => NULL,
            'password' => '$2y$10$0pjbhgRmKknJF3/G0xMa5eIyaiUbcCnnFDCv/ncqzx4qEaSVmUeGO',
            'remember_token' => 'JtlrsaY77QUrkXefm2KhB6DRkQVx1JbBSy5ZpHwFYhcAZmul6ouWuYAS8pAR',
            'created_at' => '2021-05-24 21:43:00',
            'updated_at' => NULL,
        ]);

        $oscar = User::create([
            'id' => 4,
            'name' => 'Oscar',
            'email' => 'oscar@brandbean.mx',
            'position' => 'Relaciones publicas',
            'email_verified_at' => NULL,
            'password' => '$2y$10$uOKbJkD9aHYv2uOOan.UyOaZmihakZxChXU1IO1pXyUtg2sN68qpa',
            'remember_token' => NULL,
            'created_at' => '2021-03-02 04:43:43',
            'updated_at' => NULL,
        ]);

        $andrea = User::create([
            'id' => 6,
            'name' => 'Andrea Gomez Hurtado',
            'email' => 'andrea@brandbean.mx',
            'position' => 'Ejecutiva de Relaciones Públicas',
            'email_verified_at' => NULL,
            'password' => '$2y$10$06stZmku4OVtixNHLzJCyuBuXth0xQ09v/BMmJ828IV7/t4DZje3m',
            'remember_token' => NULL,
            'created_at' => '2021-03-18 05:25:21',
            'updated_at' => NULL,
        ]);

        $brenda = User::create([
            'id' => 7,
            'name' => 'Brenda Calzada',
            'email' => 'brenda@brandbean.mx',
            'position' => 'Directora general',
            'email_verified_at' => NULL,
            'password' => '$2y$10$G5P4WApmW4j8N/FhiT2SLO2BTivhhruhqaevnSHQz5ZmyfjU.H/yC',
            'remember_token' => 'bQxwng7XxwyG6NPCkbZgRYu5uQG7QhtnININCwcqGLLrRj44RaOMFrPT9FTd',
            'created_at' => '2021-05-19 23:46:53',
            'updated_at' => NULL,
        ]);

        $brendaAdmin = User::create([
            'id' => 8,
            'name' => 'Brenda Calzada Admin',
            'email' => 'brendacalzadamkt@gmail.com',
            'position' => 'Gerente general',
            'email_verified_at' => NULL,
            'password' => '$2y$10$cFjVG7AYysYkxzo/lTdkPeUmp2WdCSvC7zOsHBQnBnvYXGHWl4qL6',
            'remember_token' => NULL,
            'created_at' => '2021-05-25 01:48:28',
            'updated_at' => NULL,
        ]);

        $alex = User::create([
            'id' => 9,
            'name' => 'Javier Alejandro Colunga Ramírez ',
            'email' => 'alex@brandbean.mx',
            'position' => 'Director de marketing ',
            'email_verified_at' => NULL,
            'password' => '$2y$10$unLcpAMs.MOOVdsN5jSR3OFY27JkMn7fhL3qGaqyhno.GYzuQElz.',
            'remember_token' => NULL,
            'created_at' => '2021-05-25 19:16:09',
            'updated_at' => NULL,
        ]);

        $yessi = User::create([
            'id' => 10,
            'name' => 'Yessenia',
            'email' => 'yessi@brandbean.mx',
            'position' => 'Administración de cobranza',
            'email_verified_at' => NULL,
            'password' => '$2y$10$Kl5yk069vnv8aR0Q0esTa.T6SjDi0aXEsz.KF8fz.hEtrRiqYC732',
            'remember_token' => 'b2mGTEp5V2MLg3bZvcoBFXbA0SR10FASAPN9FmKHgMXQH1z2KtyFzcbjyFGu',
            'created_at' => '2021-05-25 19:23:21',
            'updated_at' => NULL,
        ]);

        $rigoberto->assignRole('Administrador');
        $oscar->assignRole('Relaciones publicas');
        $andrea->assignRole('Relaciones publicas');
        $brenda->assignRole('Gerente de ventas');
        $brendaAdmin->assignRole('Administrador');
        $alex->assignRole('Relaciones publicas');
        $yessi->assignRole('Cobranza');

    }
}
