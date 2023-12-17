<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create([
            'password' => '1234567890'
        ]);

        // \App\Models\Post::factory(10)->create();

        \App\Models\Category::factory()->create([
            'name' => 'Laravel',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'PHP',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'JavaScript',
        ]);

        

        $user = \App\Models\User::factory()->create([
            'name' => 'MOHAMMED MUSTAFA',
            'email' => 'test@example.com',
            // posts.test/mohammed-mustafa
            'slug' => 'mohammed-mustafa',
            'permission' => 3,
            'password' => '1234567890'
        ]);

        $user->posts()->create([
            'title' => 'My First Post',
            'body' => 'This is the content of the first post',
            'image' => 'cat.jpg'
        ]);

        $user->posts()->createMany([
            [
                'title' => 'My Second Post',
                'body' => 'This is the content of the Second post',
                'image' => 'cat.jpg'
            ],
            [
                'title' => 'My Third Post',
                'body' => 'This is the content of the Third post',
                'image' => 'cat.jpg'
            ]
        ]);






        $user->profile()->create([
            'website' => 'http://www.google.com',
            'bio' => 'My name Mohammed and I am a Software Engineer',
            'phone' => '+90983479837439'
        ]);

        // $post = \App\Models\Post::factory()->create([
        //     'title' => 'learn Laravel',
        //     'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto cupiditate dolorem dolores ipsam ullam exercitationem iure blanditiis sequi voluptatem quae placeat accusamus dolor quos sit adipisci eum, illo molestiae repellendus fuga esse consequuntur velit? Fuga saepe dolor, cupiditate laudantium libero vel illum. Accusantium quo numquam eveniet sunt architecto nulla suscipit, accusamus, dolorem quasi mollitia adipisci aspernatur eligendi odio officia? Nam expedita odit alias ipsum asperiores quam, consequatur, eos accusantium quas dicta ipsam at officiis, ab perspiciatis rem unde a eius ea reiciendis fuga iure excepturi. Sunt ex, dignissimos odio laudantium obcaecati, similique veniam delectus aliquam labore officiis sit error doloribus tempore quis quaerat dolorem, maxime quas unde molestiae commodi distinctio necessitatibus. Dolorem, ipsum magnam! Culpa aliquid, nulla magnam aut praesentium a officiis repudiandae tempore dolorum molestiae similique perferendis, quasi magni labore ratione ipsa totam. Rem sed natus necessitatibus blanditiis, magni inventore dolor recusandae obcaecati, repudiandae ad, nemo minima! Repellendus asperiores corporis, tempora quod vel ipsum nisi eius voluptas mollitia eligendi sapiente possimus, praesentium quo porro illo animi a deserunt vitae rerum doloremque temporibus distinctio? Eligendi natus, commodi adipisci dolores saepe similique repudiandae, quo debitis molestias dicta dignissimos iure, distinctio tempore fugiat ea ut ratione voluptas! Reiciendis voluptatum aspernatur et laudantium.',
        // ]);
        
    }
}
