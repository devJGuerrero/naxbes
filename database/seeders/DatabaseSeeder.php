<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CurrencySeeder::class,
            RegionSeeder::class,
            SubregionSeeder::class,
            CountrySeeder::class,
            DepartmentSeeder::class,
            CitySeeder::class,
            CountryCurrencySeeder::class,
            CompanySeeder::class,
            PaymentProviderSeeder::class,
            PaymentMethodSeeder::class,
            PaymentProviderPaymentMethodSeeder::class,
            BankSeeder::class,
            BankPaymentMethodSeeder::class,
            WalletSeeder::class,
            WalletPaymentMethodSeeder::class,
            CustomerSeeder::class,
        ]);
    }
}
