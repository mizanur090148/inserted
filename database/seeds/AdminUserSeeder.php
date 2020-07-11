<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [ 
            [ 
                'name' => 'Mr user',
                'email' => 'user@inserted.com',
                'is_admin' => 0,
                'password' => bcrypt(123456),
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today()
            ], 
            [ 
                'name' => 'Mr admin',               
                'email' => 'admin@inserted.com',
                'is_admin' => 1,
                'password' => bcrypt(123456),             
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today()
            ]
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::table('users')->insert($users);

        $this->command->info('Successfully run admin user seeder');
    }
}
