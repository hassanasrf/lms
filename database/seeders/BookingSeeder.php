<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = [
            [
                'company_id' => 1,
                'customer_id' => 1,
                'service_type' => '1',
                'shipment_type' => 'By Sea',
                'number_of_containers' => 2,
                'bulk_details' => null,
                'other_details' => null,
                'loading_point' => 'Karachi Port',
                'commodity_id' => 1,
                'destination_country_id' => 2,
                'licence_name' => 'Licence 001',
                'mailing_details' => 'Address, Email, Contact',
                'shipping_line_id' => 3,
                'vessel_name_voy' => 'Vessel XYZ',
                'eta' => now()->addDays(10),
                'sgs_required' => true,
                'fumigation_required' => true,
                'fumigation_certificate_required' => false,
                'document_type' => 'CNF',
                'loading_person' => 'John Doe',
                'loading_person_cell' => '123456789',
            ]
        ];

        foreach ($bookings as $booking) {
            Booking::create($booking);
        }
    }
}
