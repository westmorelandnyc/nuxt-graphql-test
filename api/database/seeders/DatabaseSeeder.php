<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Job;
use App\Models\User;
use App\Models\Location;
use App\Models\DailyReport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Sequence;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::table('jobs')->truncate();
        DB::table('locations')->truncate();
        DB::table('daily_reports')->truncate();
        DB::table('equipment')->truncate();

        $firstUser = User::factory()->foreman()->admin()->create([
            'name' => 'Eli',
            'email' => 'eli@test.com',
            'password' => bcrypt('test'),
        ]);
        $secondUser = User::factory()->admin()->create([
            'name' => 'Steve',
            'email' => 'steve@example.com'
        ]);

        User::factory()->foreman()->create();

        $firstJob = Job::factory()->create([
            'name' => 'Verizon Manhole',
            'project_manager' => $firstUser->id,
        ]);
        $secondJob = Job::factory()->create([
            'name' => 'Civil Job',
            'project_manager' => $secondUser->id,
        ]);
        
        Job::factory()->count(10)
            ->sequence(
                ['project_manager' => $firstUser->id],
                ['project_manager' => $secondUser->id]
            )
            ->create();
        $jobs = collect(Job::all());
        $jobs->each(function ($job) {
            Location::factory()->count(4)->create([
                'job_id' => $job->id
            ]);
        });
        Location::factory()->count(10)->create([
            'job_id' => $firstJob->id
        ]);
        Location::factory()->count(10)->create([
            'job_id' => $secondJob->id
        ]);

        DailyReport::factory()
            ->sequence(
                ['job_id' => $firstJob->id, 'foreman_id' => $firstUser->id],
                ['job_id' => $secondJob->id, 'foreman_id' => $secondUser->id],
            )
            ->sequence(fn (Sequence $sequence) => ['sort_order' => $sequence->index + 1])
            ->afterCreating(function (DailyReport $report) {
                $report->update(['name' => $report->id . ' - ' . $report->name]);
            })
            ->count(12)
            ->create();

    }
}
