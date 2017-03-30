<?php

use Illuminate\Database\Seeder;

class ItineraryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('itineraries')->insert([
            [
                'name'=>'Monsopiad Cultural Village',
                'description'=>
                    'At the Village, visit the Tangkob or Grainery where the padi is housed. Kotos Di Monsopiad or Monsopiad\'s Main House is dedicated to the life and times of Monsopiad and his descendants. On display are ceramic jars, padi grinders, bamboo items as well as the costume of Bobohizan Inai Bianti, direct descendant of Monsopiad and very senior high priestess.

                    Other interesting exhibits include the massive monolith which invokes a dozen legends, the traditional restaurant and of course Siou Do Mohoing, or the House of Skulls, where all 42 \'trophies\' of Monsopiad hang from the rafters.',
                'duration'=>'2h',
                'price_children'=>50,
                'price_adult'=>75,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'=>'Kota Belud Firefles',
                'description'=>
                    'Nanamun River is located about 20 KM away from Kota Belud town, on the way to Kudat. The fireflies river cruise tour usually package together with Proboscis Monkey sighting at Kawa Kawa River. Tourist will usually visit Proboscis Monkey at Kawa Kawa river at  4.3o pm and had their dinner before proceed with fireflies river cruise at Nanamum River after the sun goes down.

                    The tour start at 7pm right after the sun goes down. It is truly amazing moment when we are surrounded by the brightly lit fireflies and when all the fireflies create the “Christmas Tree” effect.',
                'duration'=>'4h',
                'price_children'=>80,
                'price_adult'=>100,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'=>'Rumah Terbalik',
                'description'=>
                    'The house was opened to the public in early February 2012 and has since been attracting visitors from near and far. The house itself is hard to miss, having been flipped upside down, with its floor facing skyward. Everything inside the house, from furniture to household appliances, hover above your head, as the ceiling is actually the floor. Visitors will notice some distinguishing Sabahan décor and features showcased in this house. In the garage, a car is parked upside down. It might seem disorienting in the first few seconds, but the fascination of it all takes over. This architectural wonder has also been included in the Malaysia Book of Records for being the first of its kind in the nation. Visitors can enjoy a meal or afternoon snack at the Rumah Terbalik Café or pick up a souvenir at the Gift Shop. Guided tours are available.

                    Latest attraction within the compound of Rumah Terbalik is the 3D Wonders Museum. Experience Sabah in a fun and engaging way thanks to the special art that transforms images into immersive 3D environements. This 3D Wonders Museum is not only the largest 3D art exhibition in East Malaysia but also the first and only that focuses on education the public about the importance of protecting our biodiversity, ecosystem and natural resources. ',
                'duration'=>'2h',
                'price_children'=>35,
                'price_adult'=>50,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'=>'Desa Cattle Dairy Farm',
                'description'=>
                    'Located at the foothill of Mount Kinabalu, Desa Cattle Dairy Farm offers one of the most amazing scenery one could envision. Often chosen as a wedding photography destination, with the majestic Mount Kinabalu overlooking beautiful green pastures, the scenery is breathtaking, not forgetting the cool breeze that Kundasang has to offer.

                    The real attraction here is the cattle farm, producing about 900,00 litres of milk per year. The farm is 199 hectars and most of the milking cows are Friesians, the highest milk producers of all cattle breeds.',
                'duration'=>'2h',
                'price_children'=>56,
                'price_adult'=>75,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'=>'Marine Park',
                'description'=>
                    'The Marine Park is a cluster of islands; Pulau Gaya, Pulau Sapi, Pulau Manukan, Pulau Mamutik and Pulau Sulug. Pulau Gaya hosts the Gayana Eco Resort, Bunga Raya Resort and the Gaya Island resort by YTL. Visits to these premises require prior bookings. Pulau Sapi, Manukan and Mamutik host beach activities as well as snorkeling and diving. Island tours can be booked on the spot at the Jesselton Jetty except for diving which requires prior arrangements with a dive center. Island hopping is also an alternative. ',
                'duration'=>'2h',
                'price_children'=>30,
                'price_adult'=>40,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],


        ]);
    }
}
