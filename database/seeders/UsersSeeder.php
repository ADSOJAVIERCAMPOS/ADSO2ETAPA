<?php 

namespace Database\Seeders; 

use Illuminate\Database\Seeder;
use App\Models\Peoples;
use App\Models\Users;
use App\Models\Roles;
use App\Models\Users_role;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Crear una persona y usuario para el rol 'APRENDIZ'
        $aprendizPerson = Peoples::create([
            'name' => 'Ana Maria',
            'last_name' => 'Gomez',
            'email' => 'anamaria@example.com',
            'phone' => '3051234567',
            'document_number' => '33445566',
            'permission' => '',
            'date_birth' => '2000-05-12',
            'address' => 'Avenida principal',
            'country_id' => 1,
            'document_type_id' => 1,
            'course_id' => 1,
        ]);

        $aprendizUser = Users::create([
            'password' => '33445566a',
            'state_user' => 'active',
            'person_id' => $aprendizPerson->id_person,
        ]);

        $aprendizRole = Roles::where('name_rol', 'APRENDIZ')->first();
        if ($aprendizRole) {
            Users_role::create([
                'id_user' => $aprendizUser->id_user,
                'id_rol' => $aprendizRole->id_rol,
            ]);
        }

        // Crear una persona y usuario para el rol 'INSTRUCTOR'
        $instructorPerson = Peoples::create([
            'name' => 'Luis Eduardo',
            'last_name' => 'Martinez',
            'email' => 'luiseduardo@example.com',
            'phone' => '3109876543',
            'document_number' => '22334455',
            'permission' => '',
            'date_birth' => '1985-11-22',
            'address' => 'Calle secundaria',
            'country_id' => 1,
            'document_type_id' => 1,
            'course_id' => 1,
        ]);

        $instructorUser = Users::create([
            'password' => '22334455l',
            'state_user' => 'active',
            'person_id' => $instructorPerson->id_person,
        ]);

        $instructorRole = Roles::where('name_rol', 'INSTRUCTOR')->first();
        if ($instructorRole) {
            Users_role::create([
                'id_user' => $instructorUser->id_user,
                'id_rol' => $instructorRole->id_rol,
            ]);
        }

        // Crear una persona y usuario para el rol 'COORDINADOR'
        $coordinadorPerson = Peoples::create([
            'name' => 'Jorge Luis',
            'last_name' => 'Ramirez',
            'email' => 'jorgeramirez@example.com',
            'phone' => '3001122334',
            'document_number' => '66778899',
            'permission' => '',
            'date_birth' => '1980-07-30',
            'address' => 'Avenida central',
            'country_id' => 1,
            'document_type_id' => 1,
            'course_id' => 1,
        ]);

        $coordinadorUser = Users::create([
            'password' => '66778899j',
            'state_user' => 'active',
            'person_id' => $coordinadorPerson->id_person,
        ]);

        $coordinadorRole = Roles::where('name_rol', 'COORDINADOR')->first();
        if ($coordinadorRole) {
            Users_role::create([
                'id_user' => $coordinadorUser->id_user,
                'id_rol' => $coordinadorRole->id_rol,
            ]);
        }

        // Crear una persona y usuario para el rol 'ADMIN'
        $adminPerson = Peoples::create([
            'name' => 'Carlos Andres',
            'last_name' => 'Gonzalez',
            'email' => 'carlosgonzalez@example.com',
            'phone' => '3152233445',
            'document_number' => '99887766',
            'permission' => '',
            'date_birth' => '1975-02-19',
            'address' => 'Calle 123',
            'country_id' => 1,
            'document_type_id' => 1,
            'course_id' => 1,
        ]);

        $adminUser = Users::create([
            'password' => '99887766c',
            'state_user' => 'active',
            'person_id' => $adminPerson->id_person,
        ]);

        $adminRole = Roles::where('name_rol', 'ADMIN')->first();
        if ($adminRole) {
            Users_role::create([
                'id_user' => $adminUser->id_user,
                'id_rol' => $adminRole->id_rol,
            ]);
        }

        // Crear una persona y usuario para el rol 'SUPER_ADMIN'
        $superAdminPerson = Peoples::create([
            
            'name' => 'Diego Alejandro',
            'last_name' => 'Boada',
            'email' => 'diegoboada1@gmail.com',
            'phone' => '3023363603',
            'document_number' => '88247917',
            'permission' => '',
            'date_birth' => '1981-01-29',
            'address' => 'Calle falsa',
            'country_id' => 1,
            'document_type_id' => 1,
            'course_id' => 1,
        ]);

        $superAdminUser = Users::create([
            'password' => '88247917i',
            'state_user' => 'active',
            'person_id' => $superAdminPerson->id_person,
        ]);

        $superAdminRole = Roles::where('name_rol', 'SUPER_ADMIN')->first();
        if ($superAdminRole) {
            Users_role::create([
                'id_user' => $superAdminUser->id_user,
                'id_rol' => $superAdminRole->id_rol,
            ]);
        }
    }
}
