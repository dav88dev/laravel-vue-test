<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Team::class, 5)->create()->each(function ($u) {
            $u->players()->saveMany(factory(App\Player::class, 15)->make());
        });
    }
}
