<?php

use App\Menu;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::insert([
            [
                'name' => strtolower('admin masp'),
                'url' => 'http://admin.masp.net.br',
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'name' => strtolower('chamados'),
                'url' => 'http://chamados.masp.net.br',
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

            [
                'name' => strtolower('recepção'),
                'url' => 'http://recepcao.masp.net.br',
                'status' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

        ]);
    }
}
