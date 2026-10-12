<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'Northstar Cycle Supply (Demo)',
                'contact_name' => 'Demo supplier contact',
                'email' => 'orders@northstar-cycle.example',
                'phone' => null,
                'address' => 'Demonstration data only',
            ],
            [
                'name' => 'Fast Lane Components (Demo)',
                'contact_name' => 'Demo supplier contact',
                'email' => 'sales@fastlane-components.example',
                'phone' => null,
                'address' => 'Demonstration data only',
            ],
            [
                'name' => 'Trailhead Rider Gear (Demo)',
                'contact_name' => 'Demo supplier contact',
                'email' => 'wholesale@trailhead-gear.example',
                'phone' => null,
                'address' => 'Demonstration data only',
            ],
        ];

        foreach ($suppliers as $data) {
            Supplier::updateOrCreate(['email' => $data['email']], $data);
        }
    }
}
