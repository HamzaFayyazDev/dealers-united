<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MessageCapsule;
use App\Models\User;

class MessageCapsuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MessageCapsule::factory()->count(8)->recycle(User::factory()->create())->create();
    }
}
