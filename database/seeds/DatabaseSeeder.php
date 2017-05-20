<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(RoleUserTableSeeder::class);
         $this->call(CurrenciesTableSeeder::class);
         $this->call(ReservationTypesTableSeeder::class);
         $this->call(ReservationStatusesTableSeeder::class);
         $this->call(TypeVacationsTableSeeder::class);
         $this->call(PlaceTourismsTableSeeder::class);
//         $this->call(ItineraryTableSeeder::class);
//         $this->call(TourismablesTableSeeder::class);
//         $this->call(TypeablesTableSeeder::class);
//         $this->call(PackageToursTableSeeder::class);
//         $this->call(ItineraryPackageTourTableSeeder::class);
    }
}
