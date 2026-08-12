<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class StudentsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $sequence = [87, 88, 87, 88, 87, 88, 86, 271, 115, 272, 103, 339, 316, 372, 317];
        $currentCount = DB::table('students')->where('source', 'KPM')->count();

        foreach ($rows as $row) {
            // Check status (case-insensitive)
            $status = isset($row['status']) ? trim(strtoupper($row['status'])) : '';
            
            if ($status === 'BERMINAT') {
                $ic = $row['no_kp'] ?? null;
                
                // Skip if IC is missing
                if (!$ic) {
                    continue;
                }

                // Check for duplicates
                $exists = DB::table('students')->where('ic', $ic)->exists();
                
                if (!$exists) {
                    $userId = $sequence[$currentCount % 15]; // Cycle through the sequence array

                    DB::table('students')->insert([
                        'user_id' => $userId,
                        'name' => $row['nama'] ?? null,
                        'ic' => $ic,
                        'phone' => $row['no_telefon'] ?? null,
                        'email' => $row['email'] ?? null,
                        'referral_code' => $row['kod_rujukan'] ?? null,
                        'state_id' => 12,
                        'spm_year' => 2025,
                        'location_id' => 1,
                        'auto_assign' => 1,
                        'incentive' => 10,
                        'commission' => 0,
                        'remark' => 'N',
                        'source' => 'KPM',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                    
                    $currentCount++;
                }
            }
        }
    }
}
