<?php

use Illuminate\Database\Seeder;
use Encore\Admin\Auth\Database\Menu;

class AdminMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Menu::insert([

            [
                'parent_id' => 0,
                'order'     => 0,
                'title'     => 'Companies',
                'icon'      => 'fa-building',
                'uri'       => '/companies',
            ],
            [
                'parent_id' => 0,
                'order'     => 0,
                'title'     => 'Employees',
                'icon'      => 'fa-meh-o',
                'uri'       => '/employees',
            ],

        ]);
    }
}
