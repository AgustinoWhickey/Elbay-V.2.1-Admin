<?php

namespace App\Models;


class Post 
{
    private static $blog_post = [
        [
            "title" => "First Post",
            "slug" => "first-post",
            "author" => "Agus Tino Wicaksono",
            "body" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eveniet, hic voluptate enim ut rem odio ea? Alias odio veritatis illum fugit numquam inventore dolore corrupti soluta veniam nisi iure, tempora at voluptas, nulla ducimus voluptatem a blanditiis consequuntur in officiis expedita. Magni mollitia fuga a sunt praesentium fugit ratione voluptatum hic assumenda exercitationem, deleniti expedita. Eaque repellendus et consectetur deleniti mollitia, vel repudiandae reiciendis! Dolore cumque dolores voluptatem dicta perspiciatis ducimus vel veniam totam tempora consequuntur, pariatur sed commodi facilis!" 
        ],
        [
            "title" => "Second Post",
            "slug" => "second-post",
            "author" => "Whickey August",
            "body" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eveniet, hic voluptate enim ut rem odio ea? Alias odio veritatis illum fugit numquam inventore dolore corrupti soluta veniam nisi iure, tempora at voluptas, nulla ducimus voluptatem a blanditiis consequuntur in officiis expedita. Magni mollitia fuga a sunt praesentium fugit ratione voluptatum hic assumenda exercitationem, deleniti expedita. Eaque repellendus et consectetur deleniti mollitia, vel repudiandae reiciendis! Dolore cumque dolores voluptatem dicta perspiciatis ducimus vel veniam totam tempora consequuntur, pariatur sed commodi facilis!" 
        ],
    ];

    public static function all(){
        return collect(self::$blog_post);
    }

    public static function find($slug) {
        $posts = static::all();
        
        // $new_post = [];
        // foreach($posts as $post) {
        //     if($post['slug'] === $slug) {
        //         $new_post = $post;
        //     }
        // }
        // return $new_post;

        return $posts->firstWhere('slug', $slug);
    }
}
