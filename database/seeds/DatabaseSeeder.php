<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(AppFirstSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserProfilesTableSeeder::class);
        $this->call(FilesTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        $this->call(UserPermissionsTableSeeder::class);
        $this->call(UserUserRoleTableSeeder::class);
        $this->call(UserPermissionUserRoleTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(AuthorsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(BookTagTableSeeder::class);
        $this->call(AuthorBookTableSeeder::class);
        $this->call(SuppliersTableSeeder::class);
        $this->call(SupplierHeadquartersTableSeeder::class);
        $this->call(SupplierRatesTableSeeder::class);
        $this->call(PatientsTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(ServiceOrdersTableSeeder::class);
        $this->call(ExaminationTypesTableSeeder::class);
        $this->call(CustomerPatientTableSeeder::class);
        $this->call(ExaminationTestsTableSeeder::class);
        $this->call(ExaminationTestServiceOrderTableSeeder::class);
        $this->call(ExaminationTracksTableSeeder::class);
        $this->call(ServiceOrderFilesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(CountiesTableSeeder::class);
        $this->call(CustomerRatesTableSeeder::class);
        $this->call(ServiceOrderNotesTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(PositionUserTableSeeder::class);
        $this->call(RegionalsTableSeeder::class);
        $this->call(PositionRegionalTableSeeder::class);
        $this->call(RegionRegionalTableSeeder::class);
    }
}
