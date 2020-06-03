<?php

use Illuminate\Database\Seeder;
use App\Models\Contact;
use Illuminate\Support\Carbon;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::insert([
            [
                'u_id'          => 1,
                'tel_number'    => '380960878728',
                'last_name'     => "Last",
                'first_name'    => "First",
                'middle_name'   => "Mid",
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
