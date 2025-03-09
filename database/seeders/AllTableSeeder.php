<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AllTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'firstname' => 'Demo',
            'lastname' => 'Demo',
            'username' => 'demo',
            'email' => 'demo@demo.com',
            'password' => Hash::make('demo'),
        ]);

        $category = Category::create([
            'name' => 'STEAK',
            'user_id' => $user->id,
            'image' => 'images/steak.jpg'
        ]);
        Category::create([
            'name' => 'BURGER',
            'user_id' => $user->id,
            'image' => 'images/burger.jpg'
        ]);
        Category::create([
            'name' => 'MAKARNA',
            'user_id' => $user->id,
            'image' => 'images/makarna.jpg'
        ]);
        Category::create([
            'name' => 'ATIŞTIRMALIK',
            'user_id' => $user->id,
            'image' => 'images/atistirmalik.jpg'
        ]);
        Category::create([
            'name' => 'TATLI',
            'user_id' => $user->id,
            'image' => 'images/tatli.jpg'
        ]);
        Category::create([
            'name' => 'SOĞUK İÇECEKLER',
            'user_id' => $user->id,
            'image' => 'images/soguk-icecekler.jpg'
        ]);
        Category::create([
            'name' => 'SICAK İÇECEKLER',
            'user_id' => $user->id,
            'image' => 'images/sicak-icecekler.jpg'
        ]);
        Category::create([
            'name' => 'DONDURMA',
            'user_id' => $user->id,
            'image' => 'images/dondurma.jpg'
        ]);

        $category->products()->createMany([
            [
                'user_id' => $user->id,
                'name' => 'Bonfile',
                'price' => 500,
                'image' => 'images/bonfile.jpg',
                'description' => '<p>Özenle seçilmiş, yumuşacık bonfile etimiz, özel baharatlarla marine edilerek mükemmel kıvamda pişirilir. Lezzetini artırmak için dilerseniz közlenmiş sebzeler, tereyağlı patates püresi veya el yapımı soslarımızla servis edebilirsiniz.</p> <ul> <li><strong>%100 Dana Eti</strong></li> <li><strong>Izgara & Sote Seçenekleri</strong></li> <li><strong>Özel Sunum</strong></li> </ul>'
            ],
            [
                'user_id' => $user->id,
                'name' => 'Antrikot (Ribeye)',
                'price' => 500,
                'image' => 'images/antrikott.jpg',
                'description' => '<p>Lezzeti ve yumuşaklığıyla et severlerin favorisi olan antrikot, dana sırt kısmından elde edilir. Yağ dokusu sayesinde son derece sulu ve aromatik bir tada sahiptir. Özel baharatlarla marine edilerek ızgarada veya döküm tavada mükemmel şekilde pişirilir.</p> <ul> <li><strong>%100 Dana Eti</strong></li> <li><strong>Izgara veya Döküm Tavada Pişirme Seçeneği</strong></li> <li><strong>Sulu ve Aromatik Lezzet</strong></li> </ul> <p>Yanında közlenmiş sebzeler, tereyağlı patates püresi veya özel soslarımızla servis edilebilir.</p>',
            ],
            [
                'user_id' => $user->id,
                'name' => 'Kontrfile',
                'price' => 350,
                'image' => 'images/kontrfile.jpg',
                'description' => '<p>Kontrfile, dana sırt kısmından elde edilen, az yağlı ve yoğun et lezzetine sahip özel bir biftek çeşididir. Sağlam dokusu sayesinde doyurucu ve besleyicidir. Özenle marine edilerek ızgarada veya döküm tavada mükemmel kıvamda pişirilir.</p> <ul> <li><strong>%100 Dana Eti</strong></li> <li><strong>Az Yağlı ve Yoğun Et Lezzeti</strong></li> <li><strong>Izgara veya Döküm Tavada Pişirme Seçeneği</strong></li> </ul> <p>Lezzetini tamamlamak için közlenmiş sebzeler, baharatlı patates veya özel soslarımızla servis edilebilir.</p>',
            ],
        ]);
    }
}
