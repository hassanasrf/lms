<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use Carbon\Carbon;

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
                'booking_type' => 'Import',
                'shipment_type' => 'Containerized',
                'number_of_containers' => 3,
                'bulk_details' => 'Electronics',
                'other_details' => 'Sensitive cargo, requires handling',
                'loading_point_id' => 1,
                'commodity_id' => 1,
                'destination_country_id' => 1,
                'licence_name' => 'Import Licence A123',
                'mailing_details' => 'Customer Email: customer@example.com',
                'shipping_line_id' => 1,
                'voyage_id' => 1,
                'fumigation_required' => true,
                'fumigation_certificate_required' => true,
                'document_type' => 'Bill of Lading',
                'loading_person' => 'John Doe',
                'loading_person_cell' => '9876543210',
            ],
            [
                'company_id' => 1,
                'customer_id' => 1,
                'booking_type' => 'Export',
                'shipment_type' => 'Bulk',
                'number_of_containers' => 5,
                'bulk_details' => 'Food Products',
                'other_details' => 'Requires temperature control',
                'loading_point_id' => 1,
                'commodity_id' => 1,
                'destination_country_id' => 1,
                'licence_name' => 'Export Licence B456',
                'mailing_details' => 'Customer Email: customer2@example.com',
                'shipping_line_id' => 1,
                'voyage_id' => 1,
                'fumigation_required' => false,
                'fumigation_certificate_required' => false,
                'document_type' => 'Export Declaration',
                'loading_person' => 'Jane Smith',
                'loading_person_cell' => '9123456789',
            ]
        ];

        // Insert sample booking records into the bookings table
        foreach ($bookings as $booking) {
            Booking::create($booking);
        }
    }
}
