<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Topic;
use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clear existing data for a clean demo environment
        Post::truncate();
        Discussion::truncate();
        Topic::truncate();
        User::truncate();

        // Seed 10 users with Arabic names written in English and different roles
        $usersData = [
            ['name' => 'Ahmed Al-Masri',        'username' => 'ahmed.masri',        'email' => 'ahmed.masri@example.com',        'role' => 'admin'],
            ['name' => 'Fatima Al-Zahrani',     'username' => 'fatima.zahrani',     'email' => 'fatima.zahrani@example.com',     'role' => 'admin'],
            ['name' => 'Omar Al-Khatib',        'username' => 'omar.khatib',        'email' => 'omar.khatib@example.com',        'role' => 'user'],
            ['name' => 'Laila Al-Harbi',        'username' => 'laila.harbi',        'email' => 'laila.harbi@example.com',        'role' => 'user'],
            ['name' => 'Yousef Al-Qassem',      'username' => 'yousef.qassem',      'email' => 'yousef.qassem@example.com',      'role' => 'user'],
            ['name' => 'Mariam Al-Najjar',      'username' => 'mariam.najjar',      'email' => 'mariam.najjar@example.com',      'role' => 'user'],
            ['name' => 'Khalid Al-Rashid',      'username' => 'khalid.rashid',      'email' => 'khalid.rashid@example.com',      'role' => 'user'],
            ['name' => 'Salma Al-Karim',        'username' => 'salma.karim',        'email' => 'salma.karim@example.com',        'role' => 'user'],
            ['name' => 'Hassan Al-Barakati',    'username' => 'hassan.barakati',    'email' => 'hassan.barakati@example.com',    'role' => 'user'],
            ['name' => 'Nour Al-Jabri',         'username' => 'nour.jabri',         'email' => 'nour.jabri@example.com',         'role' => 'user'],
        ];

        $users = collect($usersData)->map(function ($data) {
            return User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => $data['role'],
                'remember_token' => Str::random(10),
            ]);
        });

        // Create some topics
        $topics = collect([
            ['title' => 'Laravel & PHP',            'slug' => 'laravel-php'],
            ['title' => 'Vue 3 & Frontend',         'slug' => 'vue-3-frontend'],
            ['title' => 'DevOps & Docker',          'slug' => 'devops-docker'],
            ['title' => 'Algorithms & Data Structures', 'slug' => 'algorithms-data-structures'],
        ])->map(function ($topic) {
            return Topic::create($topic);
        });

        // Helper to pick users/relationships
        $adminAhmed = $users->firstWhere('username', 'ahmed.masri');
        $fatima     = $users->firstWhere('username', 'fatima.zahrani');
        $omar       = $users->firstWhere('username', 'omar.khatib');
        $laila      = $users->firstWhere('username', 'laila.harbi');
        $yousef     = $users->firstWhere('username', 'yousef.qassem');

        $topicLaravel   = $topics->firstWhere('slug', 'laravel-php');
        $topicVue       = $topics->firstWhere('slug', 'vue-3-frontend');
        $topicDocker    = $topics->firstWhere('slug', 'devops-docker');
        $topicAlgo      = $topics->firstWhere('slug', 'algorithms-data-structures');

        // 1. Question that includes PHP code (markdown)
        $discussion1 = Discussion::create([
            'user_id'  => $adminAhmed?->id,
            'topic_id' => $topicLaravel?->id,
            'title'    => 'How can I structure a Laravel service class for clean code?',
        ]);

        $post1 = Post::create([
            'discussion_id' => $discussion1->id,
            'user_id'       => $adminAhmed?->id,
            'body'          => <<<'MD'
I want to refactor a couple of fat controllers in my Laravel app.  
What is a clean way to move business logic into a separate **service class**?

For example, I now have something like:

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required',
        'body'  => 'required',
    ]);

    $post = Post::create($validated);

    // some complex business rules here...

    return redirect()->route('posts.show', $post);
}
```

How would you extract the complex logic into a `PostService` and keep the controller thin?
MD,
        ]);

        Post::create([
            'discussion_id' => $discussion1->id,
            'user_id'       => $fatima?->id,
            'parent_id'     => $post1->id,
            'body'          => <<<'MD'
Great question! A common pattern is to create an **application service** that receives a simple DTO or array.

For example:

```php
class PostService
{
    public function create(array $data): Post
    {
        // validate / transform data if needed

        $post = Post::create($data);

        // apply your business rules here

        return $post;
    }
}
```

Then in your controller:

```php
public function store(Request $request, PostService $service)
{
    $post = $service->create($request->validate([
        'title' => 'required',
        'body'  => 'required',
    ]));

    return redirect()->route('posts.show', $post);
}
```
MD,
        ]);

        // 2. Simple conceptual question without code
        $discussion2 = Discussion::create([
            'user_id'  => $omar?->id,
            'topic_id' => $topicVue?->id,
            'title'    => 'When should I use a global store vs local component state in Vue 3?',
        ]);

        $post2 = Post::create([
            'discussion_id' => $discussion2->id,
            'user_id'       => $omar?->id,
            'body'          => <<<'MD'
I am building a small SPA with Vue 3 and Inertia.  
Sometimes I am not sure if a piece of state should live in a **global store** (like Pinia) or just in the component.

Are there any simple rules of thumb that can help decide where to put the state?
MD,
        ]);

        Post::create([
            'discussion_id' => $discussion2->id,
            'user_id'       => $laila?->id,
            'parent_id'     => $post2->id,
            'body'          => <<<'MD'
A simple rule:  

- If multiple **unrelated components** need to read or write the same state → put it in a **global store**.  
- If the state is only relevant to one small UI area and can be reconstructed easily → keep it as **local component state**.

Also think about *lifetime*: if the state should survive navigation (e.g. filters, user preferences), a store is often a better choice.
MD,
        ]);

        // 3. Question with Docker / DevOps and a code block
        $discussion3 = Discussion::create([
            'user_id'  => $yousef?->id,
            'topic_id' => $topicDocker?->id,
            'title'    => 'How do I share one Docker network between Laravel, PostgreSQL, and Meilisearch?',
        ]);

        $post3 = Post::create([
            'discussion_id' => $discussion3->id,
            'user_id'       => $yousef?->id,
            'body'          => <<<'MD'
I want to run **Laravel**, **PostgreSQL**, and **Meilisearch** in the same `docker-compose.yml`.  
Right now my containers cannot talk to each other by hostname.

Is this `docker-compose.yml` structure correct?

```yaml
services:
  app:
    build: .
    depends_on:
      - postgres
      - meilisearch
    networks:
      - app-net

  postgres:
    image: postgres:16-alpine
    networks:
      - app-net

  meilisearch:
    image: getmeili/meilisearch:latest
    networks:
      - app-net

networks:
  app-net:
    driver: bridge
```

Do I need anything else to be able to use `postgres` and `meilisearch` as host names from the Laravel container?
MD,
        ]);

        Post::create([
            'discussion_id' => $discussion3->id,
            'user_id'       => $adminAhmed?->id,
            'parent_id'     => $post3->id,
            'body'          => <<<'MD'
Your compose file looks good.  
The important part is that all services share the **same custom network** (`app-net`), which you already have.

Inside the `app` container you can now connect using:

- `DB_HOST=postgres`
- `MEILISEARCH_HOST=http://meilisearch:7700`

Make sure your Laravel `.env` uses these host names instead of `127.0.0.1`, and that you recreate the containers after changing environment variables.
MD,
        ]);

        // 4. Algorithms question without code in the body, but with a code answer
        $discussion4 = Discussion::create([
            'user_id'  => $fatima?->id,
            'topic_id' => $topicAlgo?->id,
            'title'    => 'What is the time complexity of binary search and when should I use it?',
        ]);

        $post4 = Post::create([
            'discussion_id' => $discussion4->id,
            'user_id'       => $fatima?->id,
            'body'          => <<<'MD'
I keep hearing about **binary search** in interviews.  
What is its time complexity and in which situations is it appropriate to use it instead of a simple loop?
MD,
        ]);

        Post::create([
            'discussion_id' => $discussion4->id,
            'user_id'       => $omar?->id,
            'parent_id'     => $post4->id,
            'body'          => <<<'MD'
Binary search works on **sorted** collections and has time complexity **O(log n)**.

Here is a classic implementation in PHP:

```php
function binarySearch(array $items, int $target): ?int
{
    $low  = 0;
    $high = count($items) - 1;

    while ($low <= $high) {
        $mid = intdiv($low + $high, 2);

        if ($items[$mid] === $target) {
            return $mid;
        }

        if ($items[$mid] < $target) {
            $low = $mid + 1;
        } else {
            $high = $mid - 1;
        }
    }

    return null;
}
```

Use it any time you have a large **sorted** array and you need fast lookups by value.
MD,
        ]);
    }
}
