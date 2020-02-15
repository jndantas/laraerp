<?php

use App\Models\Enterprise;
use Illuminate\Database\Seeder;

class EnterpriseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Enterprise::class, 10)->create();
    }
}
