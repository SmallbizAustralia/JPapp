<?php

use Illuminate\Database\Seeder;

class ContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Mark week 0 (trial) and 1 as published
        for ($week = 0; $week <= 52; $week++) {
            factory(App\Models\Content::class)->create([
                'week' => $week,
                'type' => 'overview',
                'title' => 'Week ' . $week . ' Overview',
                'published' => $week <= 1 ? 1 : 0,
            ]);

            factory(App\Models\Content::class, 8)->create([
                'week' => $week,
                'type' => 'recipe',
                'source' => 'http://via.placeholder.com/300x200',
                'source_type' => 'image',
                'published' => $week <= 1 ? 1 : 0,
            ]);

            factory(App\Models\Content::class)->create([
                'week' => $week,
                'type' => 'training_split',
                'title' => 'Week ' . $week . ' Training Split',
                'source' => 'http://via.placeholder.com/300x200',
                'source_type' => 'image',
                'published' => $week <= 1 ? 1 : 0,
            ]);

            factory(App\Models\Content::class, 2)->create([
                'week' => $week,
                'type' => 'meal_plan',
                'title' => 'Week ' . $week . ' Nutrition',
                'published' => $week <= 1 ? 1 : 0,
            ]);

            for ($day = 1; $day <= 7; $day++) {
                factory(App\Models\Content::class)->create([
                    'week' => $week,
                    'day' => $day,
                    'type' => 'workout',
                    'title' => 'Week ' . $week . ' Daily Workouts',
                    'published' => $week <= 1 ? 1 : 0,
                ]);
            }
        }

        factory(App\Models\Content::class, 10)->create([
            'type' => 'education-nutrition',
            'source' => 'http://via.placeholder.com/300x200',
            'source_type' => 'image',
            'published' => 1,
        ]);
        factory(App\Models\Content::class, 10)->create([
            'type' => 'education-training',
            'source' => 'http://via.placeholder.com/300x200',
            'source_type' => 'image',
            'published' => 1,
        ]);
        factory(App\Models\Content::class, 10)->create([
            'type' => 'education-workout',
            'source' => 'http://via.placeholder.com/300x200',
            'source_type' => 'image',
            'published' => 1,
        ]);

        factory(App\Models\Content::class, 10)->create([
            'type' => 'exercise-demo',
            'published' => 1,
        ]);

        factory(App\Models\Content::class, 10)->create([
            'type' => 'becoming-elite',
            'published' => 1,
        ]);
    }
}
