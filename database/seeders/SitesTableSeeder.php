<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Site;

class SitesTableSeeder extends Seeder
{
    public function run()
    {
        Site::create([
            'sitelocation' => 'Downtown',
            'contactorname' => 'John Contractor',
            'area' => '500 sq ft',
            'sitestartingdate' => now(),
            'siteendingdate' => null,
            'siteprice' => null,
        ]);

        Site::create([
            'sitelocation' => 'Uptown',
            'contactorname' => 'Jane Contractor',
            'area' => '1000 sq ft',
            'sitestartingdate' => now()->subMonth(),
            'siteendingdate' => now(),
            'siteprice' => 00,
        ]);
    }
}