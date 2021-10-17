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
        DocumentType::create(['code' => 'ROR', 'name' => 'Report of Rating']);
        DocumentType::create(['code' => 'COR', 'name' => 'Certificate of Registration']);
        DocumentType::create(['code' => 'COG', 'name' => 'Certificate of Grades']);
        DocumentType::create(['code' => 'TOR', 'name' => 'Transcript of Records']);
        DocumentType::create(['code' => 'CAV', 'name' => 'Certification & Authentication & Verification']);
        DocumentType::create(['code' => 'ATL', 'name' => 'Authorization Letter']);
        DocumentType::create(['code' => 'GWA', 'name' => 'General Weighted Average']);
    }
}
