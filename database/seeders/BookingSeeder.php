<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('bookings')->insert([
            [
                'company_id' => 1,
                'customer_id' => 1,
                'shipment_type' => 'Bulk',
                'number_of_containers' => 1,
                'bulk_details' => 'Grains, Wheat',
                'other_details' => 'No additional details',
                'loading_point_id' => 1,
                'commodity_id' => 1,
                'destination_country_id' => 1,
                'licence_name' => 'ABC License',
                'mailing_details' => '123, Street Name, City, Country',
                'shipping_line_id' => 1,
                'vessel_id' => 1,
                'eta' => Carbon::parse('2024-05-01'),
                'sgs_required' => true,
                'fumigation_required' => false,
                'fumigation_certificate_required' => true,
                'document_type' => 'Bill of Lading',
                'loading_person' => 'John Doe',
                'loading_person_cell' => '+1234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
