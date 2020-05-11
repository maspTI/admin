<?php

use Carbon\Carbon;
use App\Department;
use App\Subdepartment;
use Illuminate\Database\Seeder;

class SubdepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subdepartment::insert([

            [
                'department_id' => Department::where('name', 'financeiro')->first()->id,
                'name' => strtolower('Compras'),
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'department_id' => Department::where('name', 'financeiro')->first()->id,
                'name' => strtolower('Contabilidade'),
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'department_id' => Department::where('name', 'operações')->first()->id,
                'name' => strtolower('Eventos'),
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'department_id' => Department::where('name', 'operações')->first()->id,
                'name' => strtolower('Bilheteria'),
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'department_id' => Department::where('name', 'operações')->first()->id,
                'name' => strtolower('Recepção'),
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'department_id' => Department::where('name', 'operações')->first()->id,
                'name' => strtolower('Segurança'),
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'department_id' => Department::where('name', 'facilities e tecnologia da informação')->first()->id,
                'name' => strtolower('tecnologia'),
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'department_id' => Department::where('name', 'facilities e tecnologia da informação')->first()->id,
                'name' => strtolower('manutenção'),
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'department_id' => Department::where('name', 'facilities e tecnologia da informação')->first()->id,
                'name' => strtolower('conservação e limpeza'),
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'department_id' => Department::where('name', 'diretoria')->first()->id,
                'name' => strtolower('diretoria artística'),
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'department_id' => Department::where('name', 'diretoria')->first()->id,
                'name' => strtolower('diretoria opeações e finanças'),
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

        ]);
    }
}
