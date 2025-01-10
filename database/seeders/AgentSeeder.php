<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Agent;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyId = Company::first()->id ?? 1;
        $agents = [
            [
                'shipping_line_id' => 1,
                'name' => 'Global Shipping Co.',
                'address' => '123 Main Street, Business Bay',
                'city_id' => 1, // Assume City with ID 1 exists
                'country_id' => 1, // Assume Country with ID 1 exists
                'contact_persons' => json_encode(['John Doe', 'Jane Smith']),
                'contact_numbers' => json_encode(['+123456789', '+987654321']),
                'email_ids' => json_encode(['contact@globalshipping.com', 'support@globalshipping.com']),
                'ports' => json_encode(['Port of Karachi', 'Port of Dubai']),
            ],
            [
                'shipping_line_id' => 1,
                'name' => 'Oceanic Freight Ltd.',
                'address' => '45 Marine Avenue, Downtown',
                'city_id' => 2, // Assume City with ID 2 exists
                'country_id' => 2, // Assume Country with ID 2 exists
                'contact_persons' => json_encode(['Alice Brown', 'Bob White']),
                'contact_numbers' => json_encode(['+441234567', '+442345678']),
                'email_ids' => json_encode(['info@oceanicfreight.com']),
                'ports' => json_encode(['Port of Los Angeles', 'Port of Singapore']),
            ],
        ];

        foreach ($agents as $agent) {
            $agent['company_id'] = $companyId;
            Agent::create($agent);
        }
    }
}
