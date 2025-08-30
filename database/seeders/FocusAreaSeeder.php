<?php
namespace Database\Seeders;

use App\Models\FocusArea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FocusAreaSeeder extends Seeder {
    public function run(): void {
        $items = [
            ['Education','fa-solid fa-graduation-cap'],
            ['Health','fa-solid fa-heart-pulse'],
            ['Skill Development','fa-solid fa-code'],
            ['Support People','fa-solid fa-hands-helping'],
            ['Environment','fa-solid fa-leaf'],
            ['Social Welfare','fa-solid fa-people-group'],
        ];

        foreach ($items as $i => [$title,$icon]) {
            FocusArea::updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'icon_class' => $icon,
                    'short_description' => 'Amet justo dolor lorem kasd amet magna sea.',
                    'description' => 'Full description about '.$title.'.',
                    'order' => $i + 1,
                    'is_active' => true,
                ]
            );
        }
    }
}
