<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        //DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $password = Hash::make('1q2w3e');
        User::insert([
            [
                "type_account"  =>  "admin",
                "tel_number"    =>  "380960878727",
                "email"         =>  "admin@gmail.com",
                "password"      =>  $password,
                "first_name"    =>  "Jacov",
                "middle_name"   =>  "Sergeevich",
                "last_name"     =>  "Gluhota",
                "birth_date"    =>  "2017-06-15",
                "city"		    =>  "Hadich",
                "street"	    =>  "Gagarina",
                "house"		    =>  "84",
                "created_at"    =>  Carbon::now()->format('Y-m-d H:i:s'),
                "updated_at"    =>  Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
