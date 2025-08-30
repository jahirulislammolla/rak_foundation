<?php

namespace Database\Seeders;

use App\Models\Work;
use App\Models\WorkCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WorkSeeder extends Seeder {
    public function run(): void {
        $cats = ['Education','Health','Skill Development'];
        foreach ($cats as $i => $name) {
            WorkCategory::updateOrCreate(
                ['slug'=>Str::slug($name)],
                ['name'=>$name,'priority'=>$i+1,'is_active'=>true]
            );
        }

        $samples = [
            ['Orphaned People Helping','Education'],
            ['World Health Organization','Health'],
            ['Youth Skill Development','Skill Development'],
        ];
        foreach ($samples as $i => [$title, $catName]) {
            $cat = WorkCategory::where('name',$catName)->first();
            Work::updateOrCreate(
                ['slug'=>Str::slug($title)],
                [
                    'title'=>$title,
                    'work_category_id'=>$cat?->id,
                    'author_name'=>'John Doe',
                    'excerpt'=>'Dolor et eos labore stet justo sed...',
                    'body'=>"Full body for {$title}\n\nMore content here.",
                    'published_at'=>now()->subDays(10-$i),
                    'priority'=>$i+1,
                    'is_active'=>true,
                ]
            );
        }
    }
}

