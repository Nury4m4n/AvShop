<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = [
            [
                'user_id' => 2,
                'recipient_name' => 'John Doe',
                'recipient_email' => 'john.doe@example.com',
                'recipient_phone' => '08123456789',
                'recipient_address' => 'Jl. Jendral Sudirman No. 1',
                'total_amount' => 1000000.00,
                'status' => 'pending',
                'resi_number' => null,
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'Jane Doe',
                'recipient_email' => 'jane@example.com',
                'recipient_phone' => '08123456788',
                'recipient_address' => 'Jl. Kemerdekaan No. 456',
                'total_amount' => 1500000.00,
                'status' => 'paid',
                'resi_number' => 'RESI123456',
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'Alice Johnson',
                'recipient_email' => 'alice.johnson@example.com',
                'recipient_phone' => '08123456787',
                'recipient_address' => 'Jl. Gajah Mada No. 10',
                'total_amount' => 2000000.00,
                'status' => 'failed',
                'resi_number' => null,
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'Bob Smith',
                'recipient_email' => 'bob.smith@example.com',
                'recipient_phone' => '08123456786',
                'recipient_address' => 'Jl. Diponegoro No. 23',
                'total_amount' => 5000000.00,
                'status' => 'paid',
                'resi_number' => 'RESI123457',
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'Charlie Brown',
                'recipient_email' => 'charlie.brown@example.com',
                'recipient_phone' => '08123456785',
                'recipient_address' => 'Jl. Merdeka No. 100',
                'total_amount' => 3000000.00,
                'status' => 'pending',
                'resi_number' => null,
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'David Johnson',
                'recipient_email' => 'david.johnson@example.com',
                'recipient_phone' => '08123456784',
                'recipient_address' => 'Jl. Pahlawan No. 12',
                'total_amount' => 4000000.00,
                'status' => 'failed',
                'resi_number' => null,
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'Emma Watson',
                'recipient_email' => 'emma.watson@example.com',
                'recipient_phone' => '08123456783',
                'recipient_address' => 'Jl. Veteran No. 7',
                'total_amount' => 3500000.00,
                'status' => 'paid',
                'resi_number' => 'RESI123458',
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'Frank Miller',
                'recipient_email' => 'frank.miller@example.com',
                'recipient_phone' => '08123456782',
                'recipient_address' => 'Jl. Kesehatan No. 19',
                'total_amount' => 2500000.00,
                'status' => 'pending',
                'resi_number' => null,
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'Grace Lee',
                'recipient_email' => 'grace.lee@example.com',
                'recipient_phone' => '08123456781',
                'recipient_address' => 'Jl. Mawar No. 15',
                'total_amount' => 1000000.00,
                'status' => 'paid',
                'resi_number' => 'RESI123459',
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'Hannah Davis',
                'recipient_email' => 'hannah.davis@example.com',
                'recipient_phone' => '08123456780',
                'recipient_address' => 'Jl. Melati No. 24',
                'total_amount' => 6000000.00,
                'status' => 'failed',
                'resi_number' => null,
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'Ian White',
                'recipient_email' => 'ian.white@example.com',
                'recipient_phone' => '08123456779',
                'recipient_address' => 'Jl. Kenanga No. 8',
                'total_amount' => 1500000.00,
                'status' => 'pending',
                'resi_number' => null,
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'Jack Black',
                'recipient_email' => 'jack.black@example.com',
                'recipient_phone' => '08123456778',
                'recipient_address' => 'Jl. Cempaka No. 21',
                'total_amount' => 3500000.00,
                'status' => 'paid',
                'resi_number' => 'RESI123460',
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'Karen Green',
                'recipient_email' => 'karen.green@example.com',
                'recipient_phone' => '08123456777',
                'recipient_address' => 'Jl. Melur No. 10',
                'total_amount' => 1200000.00,
                'status' => 'failed',
                'resi_number' => null,
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'Leo King',
                'recipient_email' => 'leo.king@example.com',
                'recipient_phone' => '08123456776',
                'recipient_address' => 'Jl. Dahlia No. 3',
                'total_amount' => 4000000.00,
                'status' => 'pending',
                'resi_number' => null,
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'Megan Fox',
                'recipient_email' => 'megan.fox@example.com',
                'recipient_phone' => '08123456775',
                'recipient_address' => 'Jl. Anggrek No. 9',
                'total_amount' => 1800000.00,
                'status' => 'paid',
                'resi_number' => 'RESI123461',
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'Nathan Drake',
                'recipient_email' => 'nathan.drake@example.com',
                'recipient_phone' => '08123456774',
                'recipient_address' => 'Jl. Seroja No. 11',
                'total_amount' => 2000000.00,
                'status' => 'failed',
                'resi_number' => null,
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'Olivia Brown',
                'recipient_email' => 'olivia.brown@example.com',
                'recipient_phone' => '08123456773',
                'recipient_address' => 'Jl. Teratai No. 12',
                'total_amount' => 1500000.00,
                'status' => 'pending',
                'resi_number' => null,
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'Paul Walker',
                'recipient_email' => 'paul.walker@example.com',
                'recipient_phone' => '08123456772',
                'recipient_address' => 'Jl. Angsana No. 6',
                'total_amount' => 3500000.00,
                'status' => 'paid',
                'resi_number' => 'RESI123462',
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'Quincy Jones',
                'recipient_email' => 'quincy.jones@example.com',
                'recipient_phone' => '08123456771',
                'recipient_address' => 'Jl. Taman Sari No. 18',
                'total_amount' => 900000.00,
                'status' => 'failed',
                'resi_number' => null,
            ],
            [
                'user_id' => 2,
                'recipient_name' => 'Rachel Green',
                'recipient_email' => 'rachel.green@example.com',
                'recipient_phone' => '08123456770',
                'recipient_address' => 'Jl. Bunga Matahari No. 5',
                'total_amount' => 2500000.00,
                'status' => 'pending',
                'resi_number' => null,
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}