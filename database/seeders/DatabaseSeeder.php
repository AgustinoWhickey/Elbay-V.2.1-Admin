<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();

        // Post::create([
        //     'title' => 'Judul Ketiga',
        //     'category_id' => 3,
        //     'slug' => 'judul-ketiga',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptates, consequatur.',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae suscipit cum distinctio </p><p>earum laboriosam natus commodi blanditiis deleniti, repellendus aspernatur nemo officiis nulla, dicta perferendis officia a totam qui libero.</p>'
        // ]);

        // User::create([
        //     'name' => 'Agus Tino',
        //     'email' => 'agustino@gmail.com',
        //     'password' => bcrypt('12345'),
        // ]);

        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming',
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal',
        ]);

        Post::factory(20)->create();

        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'category_id' => 1,
        //     'user_id' => 1,
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptates, consequatur.',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae suscipit cum distinctio </p><p>earum laboriosam natus commodi blanditiis deleniti, repellendus aspernatur nemo officiis nulla, dicta perferendis officia a totam qui libero.</p>'
        // ]);

        // Post::create([
        //     'title' => 'Judul Kedua',
        //     'category_id' => 1,
        //     'user_id' => 1,
        //     'slug' => 'judul-kedua',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptates, consequatur.',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae suscipit cum distinctio </p><p>earum laboriosam natus commodi blanditiis deleniti, repellendus aspernatur nemo officiis nulla, dicta perferendis officia a totam qui libero.</p>'
        // ]);

        // Post::create([
        //     'title' => 'Judul Ketiga',
        //     'category_id' => 2,
        //     'user_id' => 1,
        //     'slug' => 'judul-ketiga',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptates, consequatur.',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae suscipit cum distinctio </p><p>earum laboriosam natus commodi blanditiis deleniti, repellendus aspernatur nemo officiis nulla, dicta perferendis officia a totam qui libero.</p>'
        // ]);
    }
}
