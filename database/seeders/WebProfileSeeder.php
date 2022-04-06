<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WebProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newProfile = new \App\Models\WebProfile;
        $newProfile->link_wa = '6281225121659';
        $newProfile->alamat = 'Jl Kh Agus Salim , Bondowoso';
        $newProfile->no_hp = '081225121659';
        $newProfile->ig = 'aria_desta';
        $newProfile->save();
    }
}
