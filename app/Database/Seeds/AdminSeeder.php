<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'RA Ar-Rayhan',
            'email' => 'ra-arrayhan@gmail.com',
            // 'password' => password_hash('123', PASSWORD_DEFAULT),
            'password' => '123',
        ];

        $this->db->table('admin')->truncate();
        $this->db->table('admin')->insert($data);
    }
}
