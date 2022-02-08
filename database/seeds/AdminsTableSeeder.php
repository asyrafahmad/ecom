<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();

        $adminRecords = [
            [
                'id' =>1,
                'name'=>'admin',
                'type'=>'admin',
                'mobile'=>'0123456691',
                'email'=>'admin@gmail.com',
                'password'=>'$2y$10$jmIzpijRnZv/oAwss5mrc.d9KLQBllXGmwrL8XdzBXaP/W.WOIO4.',
                'image'=>'',
                'status'=>1
            ],
            [
                'id' =>2,
                'name'=>'author',
                'type'=>'author',
                'mobile'=>'0123456692',
                'email'=>'author@gmail.com',
                'password'=>'$2y$10$jmIzpijRnZv/oAwss5mrc.d9KLQBllXGmwrL8XdzBXaP/W.WOIO4.',
                'image'=>'',
                'status'=>1
            ],
            [
                'id' =>3,
                'name'=>'user',
                'type'=>'user',
                'mobile'=>'0123456693',
                'email'=>'user@gmail.com',
                'password'=>'$2y$10$jmIzpijRnZv/oAwss5mrc.d9KLQBllXGmwrL8XdzBXaP/W.WOIO4.',
                'image'=>'',
                'status'=>1
            ],
        ];

        DB::table('admins')->insert($adminRecords);

        // foreach ($adminRecords as $key => $record){
        //     Admin::create($record);
        // }
    }
}
