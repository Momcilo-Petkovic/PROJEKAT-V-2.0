<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      
         // ADMIN AND MANAGER
         
         \App\Models\Admin::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'is_admin' => 1,
         ]);

         \App\Models\Admin::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'is_admin' => 0,
         ]);

         // TYPES

         \App\Models\Type::factory()->create([
            'type_name' => 'Klubovi',
         ]);
         \App\Models\Type::factory()->create([
            'type_name' => 'Kafane',
         ]);
         \App\Models\Type::factory()->create([
            'type_name' => 'Restorani',
         ]);
         \App\Models\Type::factory()->create([
            'type_name' => 'Kafići',
         ]);

         // GENRES

         \App\Models\Genre::factory()->create([
            'genre_name' => 'Rok',
         ]);
         \App\Models\Genre::factory()->create([
            'genre_name' => 'Pop',
         ]);
         \App\Models\Genre::factory()->create([
            'genre_name' => 'Hip Hop',
         ]);
         \App\Models\Genre::factory()->create([
            'genre_name' => 'House',
         ]);
         \App\Models\Genre::factory()->create([
            'genre_name' => 'Techno',
         ]);
         \App\Models\Genre::factory()->create([
            'genre_name' => 'Narodno',
         ]);

         // PLACES
         \App\Models\Place::factory()->create([
            'p_name' => 'Troy',
            'adress' => 'Trg kralja Milana',
            'work_time' => '17h-2h',
            'max_number_people' => '500',
            'allowed_age' => '18+',
            'phone_number	' => '+381665341166',
            'about' => 'Club Troy je noćni klub koji postoji od septembra 2017. godine a nalazi se u strogom centru Niša, Trg Kralja Milana bb, na samom šetalištu ispred spomenika Oslobodiocima grada Niša. Za vrlo kratko vreme dobio je epitet jednog od najboljih gradskih klubova. U početku kombinujući muzičke pravce, klub je bio domaćin većeg broja lokalnih i bolje poznatih DJ-eva kao i ne malog broja bendova i muzičara sa domaće estrade.',
            'prices' => 'Skupo',
            'image_url' => 'place_images/L1viGJyXOY3lNyOh6cyl37tBsgdsFsPM2f1ORpNm.jpg',
            'type_id' => 1,
         ]);

         \App\Models\Place::factory()->create([
            'p_name' => 'Biser',
            'adress' => 'Koste Stamenkovića',
            'work_time' => '7h-0h',
            'max_number_people' => '100',
            'allowed_age' => '0+',
            'phone_number	' => '+38118248205',
            'about' => 'Mesto starog stila. odličan roštilj, razumne cene i efikasni konobari. Ništa fensi i moderno, već kafana starog tipa.',
            'prices' => 'razumne cene',
            'image_url' => 'place_images/MzjW3elawRpoafszrvH2r3XcWPTog6Ag8QrPPn0x.jpg',
            'type_id' => 2,
         ]);

         \App\Models\Place::factory()->create([
            'p_name' => 'King Bo',
            'adress' => 'Obilićev venac',
            'work_time' => '12h-22h',
            'max_number_people' => '125',
            'allowed_age' => '0+',
            'phone_number	' => '+381691279999',
            'about' => 'Sečuanska kuhinja jedna je od najpopularnijih kuhinja ne samo u Kini već u čitavom svetu. Specijaliteti spremani u sečuanskom stilu karakteristični su po svom začinjenom, ljutom ukusu i sečuanskom biberu. Puno paprike, luka, djumbira, krastavca i kineskog kupusa takodje su specifični sastojci ove kulinarske tradicije u Kini. Za vas pripremamo piletinu, svinjetinu, teletinu i jagnjetinu na sečuanski način.',
            'prices' => 'Do 1080 RSD',
            'image_url' => 'place_images/ZWVzhzMGHBvPRBHXT7t6f98GYtxiocfRPkHmMLfn.jpg',
            'type_id' => 3,
         ]);

         \App\Models\Place::factory()->create([
            'p_name' => 'Box',
            'adress' => 'Nikole Pašića 5',
            'work_time' => '12h-22h',
            'max_number_people' => '150',
            'allowed_age' => '18+',
            'phone_number	' => '+38164789256',
            'about' => 'Klub sa povoljnim cenama u kojem se svakog vikenda održavaju žurke',
            'prices' => 'Do 1100 RSD',
            'image_url' => 'place_images/XWvOfLqcZrhALESZd7XnTYX9aMm7WH8T3L6CBJGK.jpg',
            'type_id' => 1,
         ]);

         \App\Models\Place::factory()->create([
            'p_name' => 'Lagano Caffe',
            'adress' => 'Trg Nikole Pasica',
            'work_time' => '9h-1h',
            'max_number_people' => '100',
            'allowed_age' => '0+',
            'phone_number	' => '+381649084633',
            'about' => 'Uživajte lagano u caffe-restoranu Lagano. Prijatna atmosfera, lagani obroci, idealno za odmor i međuobrok.',
            'prices' => 'Do 590 RSD',
            'image_url' => 'place_images/GtYfeAO4KWjeNikg6e6ZZ1TtQ4TYx49C37uT7k0l.jpg',
            'type_id' => 4,
         ]);

         \App\Models\Place::factory()->create([
            'p_name' => 'Mascaron',
            'adress' => 'Orlovica Pavla',
            'work_time' => '9h-22h',
            'max_number_people' => '100',
            'allowed_age' => '0+',
            'phone_number	' => '+38164895641',
            'about' => 'Restoran Mascaron, se nalazi u jednom od najatraktivnijih i najstarijih objekata u samom centru Niša, u ulici Orlovića Pavla broj 12. Smešten na dva sprata, sa kapacitetom od stotinak mesta, pored prijatnog ambijenta nudi bogatu internacionalnu kuhinju, mnogobrojne koktele, veliki izbor vina iz Srbije, kao i raznovrsni muzički program.',
            'prices' => 'Do 1100 RSD',
            'image_url' => 'place_images/11a55PlA0NCpIssjKt4aKjThSGDDzisJ2JtIFnmm.jpg',
            'type_id' => 3,
         ]);

         \App\Models\Place::factory()->create([
            'p_name' => 'Bolji život',
            'adress' => 'Ljubomira Nikolica',
            'work_time' => '7h-0h',
            'max_number_people' => '200',
            'allowed_age' => '0+',
            'phone_number	' => '+38169772941',
            'about' => 'Izdvajamo se po dugogodišnjem iskustvu i raznovrsnosti projekata koje smo realizovali. O kvalitetu našeg rada najbolje govori uspešna saradnja koju smo ostvarili sa mnogim zadovoljnim klijentima.',
            'prices' => 'Do 1500 RSD',
            'image_url' => 'place_images/AcRlixhqcPrJKRFygCt5jGulEHZpL6ctbIfjrgJJ.jpg',
            'type_id' => 2,
         ]);

         // PERFORMANCES

         \App\Models\Performance::factory()->create([
            'performer_name' => 'DJ Daba',
            'date' => '2022-09-19',
            'starts_at' => '22h',
            'ends_at' => '0h',
            'place_id ' => 1, // Troy
            'genre_id ' => 4,
         ]);

         \App\Models\Performance::factory()->create([
            'performer_name' => 'DJ Bokey',
            'date' => '2022-09-25',
            'starts_at' => '22h',
            'ends_at' => '0h',
            'place_id ' => 1, // Troy
            'genre_id ' => 4,
         ]);

         \App\Models\Performance::factory()->create([
            'performer_name' => 'DJ Goku',
            'date' => '2022-09-20',
            'starts_at' => '22h',
            'ends_at' => '2h',
            'place_id ' => 4, // Box
            'genre_id ' => 5,
         ]);

         \App\Models\Performance::factory()->create([
            'performer_name' => 'Mladen',
            'date' => '2022-09-13',
            'starts_at' => '22h',
            'ends_at' => '2h',
            'place_id ' => 4, // Box
            'genre_id ' => 3,
         ]);

         \App\Models\Performance::factory()->create([
            'performer_name' => 'Trubači',
            'date' => '2022-09-13',
            'starts_at' => '22h',
            'ends_at' => '0h',
            'place_id ' => 2, // Biser
            'genre_id ' => 6,
         ]);

         \App\Models\Performance::factory()->create([
            'performer_name' => 'Trubači',
            'date' => '2022-09-14',
            'starts_at' => '22h',
            'ends_at' => '0h',
            'place_id ' => 2, // Biser
            'genre_id ' => 6,
         ]);

         \App\Models\Performance::factory()->create([
            'performer_name' => 'Trubači i pevači',
            'date' => '2022-09-18',
            'starts_at' => '22h',
            'ends_at' => '0h',
            'place_id ' => 7, // Bolji život
            'genre_id ' => 6,
         ]);

         \App\Models\Performance::factory()->create([
            'performer_name' => 'Trubači i pevači',
            'date' => '2022-09-21',
            'starts_at' => '22h',
            'ends_at' => '0h',
            'place_id ' => 7, // Bolji život
            'genre_id ' => 6,
         ]);

         \App\Models\Performance::factory()->create([
            'performer_name' => 'Marko',
            'date' => '2022-09-29',
            'starts_at' => '20h',
            'ends_at' => '22h',
            'place_id ' => 3, // King Bo
            'genre_id ' => 2,
         ]);

         \App\Models\Performance::factory()->create([
            'performer_name' => 'Nikola',
            'date' => '2022-09-30',
            'starts_at' => '20h',
            'ends_at' => '22h',
            'place_id ' => 3, // King Bo
            'genre_id ' => 1,
         ]);
         
         \App\Models\Performance::factory()->create([
            'performer_name' => 'Pent House Bend',
            'date' => '2022-09-23',
            'starts_at' => '20h',
            'ends_at' => '0h',
            'place_id ' => 3, // Mascaron
            'genre_id ' => 1,
         ]);

         \App\Models\Performance::factory()->create([
            'performer_name' => 'Anastasija i Mirko',
            'date' => '2022-09-23',
            'starts_at' => '20h',
            'ends_at' => '0h',
            'place_id ' => 3, // Mascaron
            'genre_id ' => 2,
         ]);

         \App\Models\Performance::factory()->create([
            'performer_name' => 'DJ Maki',
            'date' => '2022-09-16',
            'starts_at' => '22h',
            'ends_at' => '2h',
            'place_id ' => 5, // Lagano Caffe
            'genre_id ' => 5,
         ]);

         \App\Models\Performance::factory()->create([
            'performer_name' => 'DJ Laza',
            'date' => '2022-09-11',
            'starts_at' => '22h',
            'ends_at' => '2h',
            'place_id ' => 5, // Lagano Caffe
            'genre_id ' => 6,
         ]);

         // RESERVATIONS

         \App\Models\Reservation::factory()->create([
            'first_name' => 'Momčilo',
            'last_name' => 'Petković',
            'user_phone' => '+381692060717',
            'performance_id' => 11,
         ]);

         \App\Models\Reservation::factory()->create([
            'first_name' => 'Nikola',
            'last_name' => 'Nedeljković',
            'user_phone' => '+381691234567',
            'performance_id' => 1,
         ]);

         \App\Models\Reservation::factory()->create([
            'first_name' => 'Luka',
            'last_name' => 'Lazarević',
            'user_phone' => '+381697654321',
            'performance_id' => 3,
         ]);

         \App\Models\Reservation::factory()->create([
            'first_name' => 'Dragan',
            'last_name' => 'Đorđević',
            'user_phone' => '+381691324354',
            'performance_id' => 5,
         ]);

         \App\Models\Reservation::factory()->create([
            'first_name' => 'Dušan',
            'last_name' => 'Veselinović',
            'user_phone' => '+381691548796',
            'performance_id' => 7,
         ]);

         \App\Models\Reservation::factory()->create([
            'first_name' => 'Veljko',
            'last_name' => 'Vračarević',
            'user_phone' => '+381696489133',
            'performance_id' => 9,
         ]);

         \App\Models\Reservation::factory()->create([
            'first_name' => 'Aleksa',
            'last_name' => 'Mladenović',
            'user_phone' => '+381698978466',
            'performance_id' => 13,
         ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
