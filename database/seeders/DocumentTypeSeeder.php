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
        DocumentType::create(['code' => 'ROR', 'name' => 'Report of Rating', 'days_before_expire' => 1, 'price' => 60.00]);
        DocumentType::create(['code' => 'COR', 'name' => 'Certificate of Registration', 'days_before_expire' => 1, 'price' => 0]);
        DocumentType::create(['code' => 'TOR', 'name' => 'Transcript of Records', 'days_before_expire' => 10, 'price' => 230.00]);
        DocumentType::create(['code' => 'DIP', 'name' => 'Diploma', 'days_before_expire' => 10, 'price' => 280.00]);
        DocumentType::create(['code' => 'CAV', 'name' => 'Certification & Authentication & Verification', 'days_before_expire' => 10, 'price' => 60.00]);
        DocumentType::create(['code' => 'ComForm', 'name' => 'Completion Form', 'days_before_expire' => 10, 'price' => 60.00]);
        DocumentType::create(['code' => 'ShiftForm', 'name' => 'Shifting Form', 'days_before_expire' => 10, 'price' => 80.00]);
        DocumentType::create(['code' => 'CertFS', 'name' => 'Certification - FS Rating', 'days_before_expire' => 10, 'price' => 60.00]);
        DocumentType::create(['code' => 'CertGWA', 'name' => 'Certification - GWA', 'days_before_expire' => 10, 'price' => 60.00]);
        DocumentType::create(['code' => 'CertGM', 'name' => 'Certification - Good Moral', 'days_before_expire' => 10, 'price' => 60.00]);
        DocumentType::create(['code' => 'CertBS', 'name' => 'Certification - Bonafied Student', 'days_before_expire' => 10, 'price' => 60.00]);
        DocumentType::create(['code' => 'CertGrad', 'name' => 'Certification - Graduate', 'days_before_expire' => 10, 'price' => 60.00]);
        DocumentType::create(['code' => 'AthOTR', 'name' => 'Authentication - OTR', 'days_before_expire' => 10, 'price' => 30.00]);
        DocumentType::create(['code' => 'AthDip', 'name' => 'Authentication - Diploma', 'days_before_expire' => 10, 'price' => 30.00]);
        DocumentType::create(['code' => 'TCGrade', 'name' => 'Certified True Copy - Grade', 'days_before_expire' => 10, 'price' => 0]);
    }
}
