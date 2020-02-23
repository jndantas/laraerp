<?php

use App\Models\AuthorizationCertificate;
use Illuminate\Database\Seeder;

class AuthorizationCertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(AuthorizationCertificate::class, 100)->create();
    }
}
