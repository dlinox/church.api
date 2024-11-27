<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InitSeeder extends Seeder
{

    protected $permission = [
        'dashboard.Dashboard' => [
            'dashboard.report1' => 'Reporte1',
        ],
        'positions.cargos' => [
            'positions.index' => 'Ver cargos',
            'positions.create' => 'Crear cargos',
            'positions.edit' => 'Editar cargos',
            'positions.delete' => 'Eliminar cargos',
        ],
        'offices.oficinas' => [
            'offices.index' => 'Ver oficinas',
            'offices.create' => 'Crear oficinas',
            'offices.edit' => 'Editar oficinas',
            'offices.delete' => 'Eliminar oficinas',
        ],
        'workers.trabajadores' => [
            'workers.index' => 'Ver trabajadores',
            'workers.create' => 'Crear trabajadores',
            'workers.edit' => 'Editar trabajadores',
            'workers.delete' => 'Eliminar trabajadores',
        ],
        'users.usuarios' => [
            'users.index' => 'Ver usuarios',
            'users.create' => 'Crear usuarios',
            'users.edit' => 'Editar usuarios',
            'users.delete' => 'Eliminar usuarios',
            'users.assign-permissions' => 'Asignar permisos',
        ],
    ];


    protected $postions = [
        ['name' => 'Desarrollador', 'description' => 'Desarrollador de software', 'status' => 1],
        ['name' => 'Padre', 'description' => 'Padre de familia', 'status' => 1],
        ['name' => 'Parroco', 'description' => 'Parroco de la iglesia', 'status' => 1],
    ];

    protected $offices = [
        ['name' => 'Sede Arequipa', 'description' => 'Sede Arequipa', 'status' => 1],
    ];

    protected $workers = [
        [
            'document_type' => 'DNI',
            'document_number' => '71822317',
            'name' => 'Lino',
            'paternal_last_name' => 'Puma',
            // 'maternal_last_name' => 'Ticona',
            'birth_date' => '1994-09-23',
            'gender' => 'M',
            'phone_number' => '951208106',
            'email' => 'dpumaticona@gmail.com',
            'position_id' => 1,
            'office_id' => 1,
            'status' => 1,
        ],
    ];

    protected $user = [
        'full_name' => 'Lino Puma',
        'email' => 'lnx.dvlpr@gmail.com',
        'password' => 'linox123',
        'worker_id' => 1,
        'status' => 1,
    ];

    public function run(): void
    {

        $rolesuper = \Spatie\Permission\Models\Role::create(
            [
                'name' => 'superadmin',
                'guard_name' => 'web',
                'is_super' => true,
                'redirect_route' => '/a'
            ],

        );

        $roleUser = \Spatie\Permission\Models\Role::create(
            [
                'name' => 'user',
                'guard_name' => 'web',
                'is_super' => false,
                'redirect_route' => '/a'
            ],
        );

        foreach ($this->postions as $position) {
            \App\Models\Position::create($position);
        }

        foreach ($this->offices as $office) {
            \App\Models\Office::create($office);
        }

        foreach ($this->workers as $worker) {
            \App\Models\Worker::create($worker);
        }

        $user =    \App\Models\User::create($this->user);


        foreach ($this->permission as $key => $value) {
            $permission = \Spatie\Permission\Models\Permission::create(
                [
                    'name' => explode('.', $key)[0],
                    'guard_name' => 'web',
                    'description' => strtoupper(explode('.', $key)[1]),
                ]
            );

            foreach ($value as $key2 => $value2) {
                \Spatie\Permission\Models\Permission::create(
                    [
                        'name' => $key2,
                        'guard_name' => 'web',
                        'description' => $value2,
                        'parent_id' => $permission->id,
                    ]
                );
            }
        }

        $permissions = \Spatie\Permission\Models\Permission::all();
        $user->givePermissionTo($permissions);

        $user->assignRole($rolesuper);
    }
}
