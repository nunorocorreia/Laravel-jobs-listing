<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\EmployerFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create some tags first
        $tags = Tag::factory()->createMany([
            ['name' => 'Laravel'],
            ['name' => 'PHP'],
            ['name' => 'JavaScript'],
            ['name' => 'Vue.js'],
            ['name' => 'React'],
            ['name' => 'Full-Stack'],
            ['name' => 'Backend'],
            ['name' => 'Frontend'],
            ['name' => 'Remote'],
            ['name' => 'Senior']
        ]);

        // Create 10 employers
        $employers = Employer::factory(10)->create();

        // Create 20 jobs and attach random tags to each
        $jobs = Job::factory(20)
            ->recycle($employers)
            ->create()
            ->each(function ($job) use ($tags) {
                // Attach 2-4 random tags to each job
                $job->tags()->attach(
                    $tags->random(rand(2, 4))->pluck('id')->toArray()
                );
            });
    }
}
