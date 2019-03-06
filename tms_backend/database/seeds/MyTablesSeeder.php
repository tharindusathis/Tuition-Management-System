<?php

use Illuminate\Database\Seeder;

class MyTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Models\Aclass::class, 30)->create();
        //factory(App\Models\Enrolment::class, 30)->create();
        //factory(App\Models\TeacherPayment::class, 5)->create();
        //factory(App\Models\ClassLog::class, 30)->create();
        factory(App\Models\Attendance::class, 1)->create();
        //factory(App\Models\Timeslot::class, 40)->create();
        //factory(App\Models\Hall::class, 5)->create();
        //factory(App\Models\Admin::class, 10)->create();
        //factory(App\Models\Student::class, 100)->create();
        //factory(App\Models\Teacher::class, 20)->create();
        //factory(App\Models\Subject::class, 30)->create();

        // factory(App\Models\Timeslot::class, 10)->create()->each(function ($ts) {
        //     $ts->aclass()->save(factory(App\Models\aclass::class)->make());
        //     $ts->hall()->save(factory(App\Models\hall::class)->make());
        // });

        //  factory(App\User::class, 50)->create()->each(function ($u) {
        //     $u->roles()->save(factory(App\Role::class)->make());
        //  });


            //-----------------------------------------

            //  // Populate roles
            // factory(App\Role::class, 20)->create();

            // // Populate users
            // factory(App\User::class, 50)->create();

            // // Get all the roles attaching up to 3 random roles to each user
            // $roles = App\Role::all();

            // // Populate the pivot table
            // App\User::all()->each(function ($user) use ($roles) {
            //     $user->roles()->attach(
            //         $roles->random(rand(1, 3))->pluck('id')->toArray()
            //     );
            // });
    }
}
