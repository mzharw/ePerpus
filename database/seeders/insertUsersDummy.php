<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use  Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class insertUsersDummy extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'=>1,
            'username'=>'zhar',
            'password'=>Hash::make('qwe123')
        ]);
    }
}
