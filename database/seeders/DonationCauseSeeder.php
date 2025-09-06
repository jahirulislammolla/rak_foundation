<?php
use Illuminate\Database\Seeder;
use App\Models\DonationCause;

class DonationCauseSeeder extends Seeder {
    public function run(): void {
        foreach ([
            'Zakat','Education Support','Medical Fund','Orphan Care','General Donation'
        ] as $i => $name) {
            DonationCause::firstOrCreate(['name'=>$name], ['priority'=>$i+1, 'is_active'=>true]);
        }
    }
}