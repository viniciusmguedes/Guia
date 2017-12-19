<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'email'=>'vi.niguedes12345@gmail.com',
            'password' => app('hash')->make('1234567')
        ]);
    }
}
