<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Seed realistic, fictional inventory records for local demonstrations.
     */
    public function run(): void
    {
        $this->call(SupplierSeeder::class);

        $categories = [
            'bikes' => Category::firstOrCreate(
                ['slug' => 'bikes'],
                ['name' => 'Bikes', 'description' => 'Complete bicycles for road, trail, and city riding.'],
            ),
            'parts' => Category::firstOrCreate(
                ['slug' => 'parts'],
                ['name' => 'Parts', 'description' => 'Replacement and upgrade components for bicycles.'],
            ),
            'accessories' => Category::firstOrCreate(
                ['slug' => 'accessories'],
                ['name' => 'Accessories', 'description' => 'Rider safety and everyday cycling accessories.'],
            ),
        ];

        $suppliers = [
            'northstar' => Supplier::where('email', 'orders@northstar-cycle.example')->firstOrFail(),
            'fast-lane' => Supplier::where('email', 'sales@fastlane-components.example')->firstOrFail(),
            'trailhead' => Supplier::where('email', 'wholesale@trailhead-gear.example')->firstOrFail(),
        ];

        $products = [
            [
                'category' => 'bikes',
                'supplier' => 'northstar',
                'name' => '29-inch Trail Hardtail',
                'sku' => 'DEMO-BIKE-TRAIL29',
                'description' => 'Aluminum hardtail with 29-inch wheels and hydraulic disc brakes.',
                'price' => 32999.00,
                'cost' => 23000.00,
                'stock_quantity' => 8,
            ],
            [
                'category' => 'bikes',
                'supplier' => 'fast-lane',
                'name' => '700c Aluminum Road Bike',
                'sku' => 'DEMO-BIKE-ROAD700',
                'description' => 'Lightweight aluminum road bike with a dependable 2x drivetrain.',
                'price' => 54999.00,
                'cost' => 39000.00,
                'stock_quantity' => 5,
            ],
            [
                'category' => 'bikes',
                'supplier' => 'northstar',
                'name' => '700c Gravel Bike',
                'sku' => 'DEMO-BIKE-GRAVEL700',
                'description' => 'Versatile gravel bike with disc brakes and wide-tire clearance.',
                'price' => 46999.00,
                'cost' => 33000.00,
                'stock_quantity' => 7,
            ],
            [
                'category' => 'bikes',
                'supplier' => 'northstar',
                'name' => '24-inch Youth Mountain Bike',
                'sku' => 'DEMO-BIKE-024',
                'description' => 'Youth-size mountain bike with a lightweight frame and front suspension.',
                'price' => 18999.00,
                'cost' => 12800.00,
                'stock_quantity' => 6,
            ],
            [
                'category' => 'parts',
                'supplier' => 'fast-lane',
                'name' => '12-speed Bicycle Chain',
                'sku' => 'DEMO-PART-CHAIN12',
                'description' => 'Replacement 12-speed chain for compatible mountain and road drivetrains.',
                'price' => 1699.00,
                'cost' => 1050.00,
                'stock_quantity' => 22,
            ],
            [
                'category' => 'parts',
                'supplier' => 'fast-lane',
                'name' => '160mm Disc Brake Rotor',
                'sku' => 'DEMO-PART-ROTOR160',
                'description' => 'Stainless-steel 160mm rotor for compatible disc brake systems.',
                'price' => 1299.00,
                'cost' => 780.00,
                'stock_quantity' => 16,
            ],
            [
                'category' => 'parts',
                'supplier' => 'northstar',
                'name' => '29 x 2.25-inch Trail Tire',
                'sku' => 'DEMO-PART-TIRE29225',
                'description' => 'All-round trail tire with a puncture-resistant casing.',
                'price' => 2299.00,
                'cost' => 1420.00,
                'stock_quantity' => 12,
            ],
            [
                'category' => 'accessories',
                'supplier' => 'trailhead',
                'name' => 'Adjustable Road Helmet',
                'sku' => 'DEMO-ACC-HELMET01',
                'description' => 'Ventilated cycling helmet with an adjustable retention system.',
                'price' => 3599.00,
                'cost' => 2180.00,
                'stock_quantity' => 14,
            ],
            [
                'category' => 'accessories',
                'supplier' => 'trailhead',
                'name' => 'Hardened Steel U-Lock',
                'sku' => 'DEMO-ACC-LOCK01',
                'description' => 'Compact hardened-steel lock supplied with a frame-mounting bracket.',
                'price' => 1899.00,
                'cost' => 1120.00,
                'stock_quantity' => 9,
            ],
            [
                'category' => 'accessories',
                'supplier' => 'trailhead',
                'name' => 'USB Rechargeable Front Light',
                'sku' => 'DEMO-ACC-LIGHT01',
                'description' => 'Rechargeable handlebar light with multiple brightness settings.',
                'price' => 1199.00,
                'cost' => 690.00,
                'stock_quantity' => 18,
            ],
        ];

        foreach ($products as $product) {
            $category = $categories[$product['category']];
            $supplier = $suppliers[$product['supplier']];
            unset($product['category'], $product['supplier']);

            Product::updateOrCreate(
                ['sku' => $product['sku']],
                [
                    ...$product,
                    'category_id' => $category->id,
                    'supplier_id' => $supplier->id,
                ],
            );
        }

        $activities = [
            [
                'action' => 'Stock Added',
                'description' => 'Eight units of the 29-inch Trail Hardtail were added to demo inventory.',
                'icon' => 'plus',
                'color' => 'blue',
            ],
            [
                'action' => 'Shipment Received',
                'description' => 'A sample shipment of bicycle parts was received from a demo supplier.',
                'icon' => 'box',
                'color' => 'orange',
            ],
            [
                'action' => 'Order Processed',
                'description' => 'A sample bicycle order was processed for dashboard demonstrations.',
                'icon' => 'check',
                'color' => 'indigo',
            ],
        ];

        foreach ($activities as $activity) {
            ActivityLog::firstOrCreate(
                ['description' => $activity['description']],
                $activity,
            );
        }
    }
}
