<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocumentType::create(['code' => 'ROR', 'name' => 'Report of Rating', 'days_before_expire' => 1]);
        DocumentType::create(['code' => 'COR', 'name' => 'Certificate of Registration', 'days_before_expire' => 1]);
        DocumentType::create(['code' => 'COG', 'name' => 'Certificate of Grades', 'days_before_expire' => 10]);
        DocumentType::create(['code' => 'TOR', 'name' => 'Transcript of Records', 'days_before_expire' => 10]);
        DocumentType::create(['code' => 'CAV', 'name' => 'Certification & Authentication & Verification', 'days_before_expire' => 10]);
        DocumentType::create(['code' => 'ATL', 'name' => 'Authorization Letter', 'days_before_expire' => 10]);
        DocumentType::create(['code' => 'GWA', 'name' => 'General Weighted Average', 'days_before_expire' => 10]);
    }
}
