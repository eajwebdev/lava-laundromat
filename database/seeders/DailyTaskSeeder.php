<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\DailyTask;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DailyTaskSeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('daily_tasks') || ! Schema::hasTable('branches')) {
            return;
        }

        $branch = Branch::firstOrCreate(
            ['code' => 'MAIN'],
            ['name' => 'Main Branch', 'machine_count' => 5, 'is_active' => true]
        );

        $tasks = [
            ['name' => 'Clean washer drums and detergent trays', 'requires_photo' => true],
            ['name' => 'Clear dryer lint filters', 'requires_photo' => true],
            ['name' => 'Wipe down folding tables and counters', 'requires_photo' => true],
            ['name' => 'Sweep and mop the floor area', 'requires_photo' => true],
        ];

        foreach ($tasks as $task) {
            DailyTask::updateOrCreate(
                ['branch_id' => $branch->id, 'name' => $task['name']],
                ['requires_photo' => $task['requires_photo'], 'is_active' => true]
            );
        }
    }
}
