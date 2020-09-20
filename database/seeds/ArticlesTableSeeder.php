<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 前提としてstorage/app/public内にdog.jpgが存在していること
        for($i = 1; $i <= 100; $i++) {
            
            if ( !Storage::disk('public')->exists('dog1.jpg') ) {
                if ( Storage::disk('public')->exists('dog.jpg') ) {
                    Storage::disk('public')->copy('dog.jpg', 'dog'. $i. '.jpg');
                } else {
                    throw new Exception('storage/app/public内にdog.jpgが存在しないのでSeedingを終了する');
                }
            }


            DB::table('articles')->insert([
                'article_title' => '管理者による記事【その'. $i. '】',
                'article_content' => '管理者による記事の管理者による記事の内容【その'. $i. '】',
                'article_path' => 'dog'. $i. '.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
