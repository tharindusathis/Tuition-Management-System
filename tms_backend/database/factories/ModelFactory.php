<?php

$factory->define(App\Models\Admin::class, function (Faker\Generator $faker) {
    return [
        'fname' => $faker->firstNameMale,
        'lname' => $faker->lastName,
        'nic' => $faker->regexify('[6-9]{1}[0-9]{1}[0-9]{7}V'),
        'join_date' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = '-3 months'),
    ];
});

$factory->define(App\Models\Hall::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->regexify('HALL[0-9]{2}'),
        'note' => $faker->text($maxNbChars = 200),
    ];
});

$factory->define(App\Models\Student::class, function (Faker\Generator $faker) {
    $fname_student = $faker->firstName($gender = 'male'|'female');
    $mname_student = $faker->firstName($gender = 'male'|'female');
    $lname_student = $faker->lastName;
    $init_student = $faker->regexify('[A-Z]{1,3}');
    $init = "";
    $myArray = str_split($init_student);
    foreach ($myArray as $char) {
        $init .= ($char . ".");
    }
    $full_name = ($init . " " . $fname_student . " " . $mname_student . " " . $lname_student . " ");
    return [
        'dob' => $faker->dateTimeBetween($startDate = '-22 years', $endDate = '-15 years'),
        'join_date' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = '-3 years'),
        'contact_no' => $faker->regexify('947[0-8]{1}[1-9]{7}'),
        'parent_name' => $faker->name($gender = 'male'|'female'),
        'parent_contatct_no' => $faker->regexify('947[0-8]{1}[0-9]{7}'),
        'address' => $faker->address,
        'notes' => $faker->text($maxNbChars = 100),
        'fname' => $fname_student,
        'lname' => $lname_student,
        'full_name' => $full_name
    ];
});

$factory->define(App\Models\Subject::class, function (Faker\Generator $faker) {
    $grade = $faker->randomElement(['Grade 6','Grade 7','Grade 8','Grade 9','Grade 10','Grade 11','Open','Advanced Level Local','Advanced Level London']);
    $name = $faker->randomElement(['English','Science','Mathematics','Arts','History','IT','Economics','Health Science']);
    //if($milliseconds = round(microtime(true) * 1000)){}
    return [
        'name' => $name,
        'grade' => $grade,
        'syllabus_year' => $faker->randomElement(['2000','2003','2005','2017','2015']),
        'medium' => $faker->randomElement(['eng','sin','tam']),
    ];
});

$factory->define(App\Models\Teacher::class, function (Faker\Generator $faker) {
    return [
        'fname' => $faker->firstName($gender = 'male'|'female'),
        'lname' => $faker->lastName,
        'nic' => $faker->regexify('[6-8]{1}[0-9]{1}[0-9]{7}V'),
        'join_date' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = '-3 years'),
    ];
});

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->userName,
        'email' => $faker->safeEmail,
        'password' => bcrypt($faker->password),
        'type' => $faker->boolean,
        'state' => $faker->boolean,
        'admin_idadmin' => $faker->randomNumber(),
        'teacher_idteacher' => $faker->randomNumber(),
        'student_idstudent' => $faker->randomNumber(),
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
    ];
});

$factory->define(App\Models\TeacherPayment::class, function (Faker\Generator $faker) {
    $admins = App\Models\Admin::pluck('idadmin');
    return [
        'admin_idadmin' => $faker->randomElement($admins),
        'issue_date' => $faker->dateTimeBetween($startDate = '-2 months', $endDate = '-1 months'),
    ];
});

$factory->define(App\Models\StudentPayment::class, function (Faker\Generator $faker) {
    $admins = App\Models\Admin::pluck('idadmin');
    return [
        'admin_idadmin' => $faker->randomElement($admins),
        'issue_date' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = '-1 months'),
    ];
});
// $factory->define(App\Models\En::class, function (Faker\Generator $faker) {
//     $students = App\Models\Student::pluck('idstudent');
//     $class_logs = App\Models\ClassLog::pluck('idclass_log');
//     $state = numberBetween($min = 0, $max = 1);
//     return [
//         'student_idstudent' => $faker->randomElement($students),
//         'class_idclass' => $faker->randomElement($classes),
//         'date_joined' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-2 years'),
//     ];
// });

$factory->define(App\Models\Attendance::class, function (Faker\Generator $faker) {

    $students = App\Models\Student::pluck('idstudent');

    foreach ($students as $idstudent) {
        $classes = App\Models\Enrolment::where('student_idstudent',$idstudent)->pluck('class_idclass');
        foreach($classes as $class_idclass){
            $class_logs = App\Models\ClassLog::where('class_idclass', $class_idclass)->pluck('idclass_log');
            foreach($class_logs as $idclass_log){
                $state = $faker->numberBetween($min = 0, $max = 1);
                $check = App\Models\Attendance::where(['class_log_idclass_log' => $idclass_log ,'student_idstudent' => $idstudent]);
                if($check!=NULL)
                App\Models\Attendance::insert(['class_log_idclass_log' => $idclass_log ,'student_idstudent' => $idstudent, 'state'=>$state ]);
            }
        }
    }
    //$classes = App\Models\Aclass::pluck('idclass');
    return [
        'student_idstudent' => 500,
        'class_log_idclass_log' => 4,
    ];
});

$factory->define(App\Models\Aclass::class, function (Faker\Generator $faker) {
    $rate = $faker->numberBetween($min = 1, $max = 10);
    $teachers = App\Models\Teacher::pluck('idteacher');
    $subjects = App\Models\Subject::pluck('idsubject');
    $teacher_idteacher = $faker->randomElement($teachers);
    $subject_idsubject = $faker->randomElement($subjects);
    $t_name = App\Models\Teacher::where('idteacher', $teacher_idteacher)->value('fname');
    $s_name = App\Models\Subject::where('idsubject', $subject_idsubject )->value('name');
    $s_grade =App\Models\Subject::where('idsubject', $subject_idsubject )->value('grade');
    $c_name = ($s_name . " by " . $t_name . " (" . $s_grade . ")");
    return [
        'name' => $c_name,
        'hourly_rate' => ($rate * 100),
        'teacher_idteacher' => $teacher_idteacher,
        'subject_idsubject' => $subject_idsubject,
    ];
});

$factory->define(App\Models\ClassLog::class, function (Faker\Generator $faker) {
    while(True){
    $classes = App\Models\Aclass::pluck('idclass');
    $idclass = $faker->randomElement($classes);
    $timeslots = App\Models\Timeslot::where('class_idclass',$idclass)->pluck('idtimeslot');
    $idtimeslot = $faker->randomElement($timeslots);
    $date = $faker->dateTimeBetween($startDate = '-1 years', $endDate = '-6 months');
    if($idtimeslot != NULL) break;
    }
    return [
        'class_idclass' => $idclass,
        'timeslot_idtimeslot' => $idtimeslot,
        'date' => $date,
    ];
});
$factory->define(App\Models\Timeslot::class, function (Faker\Generator $faker) {
    $st_hour = $faker->numberBetween($min = 6, $max = 18);
    $en_hour = $st_hour + ($faker->numberBetween($min = 1, $max = 4));
    $classes = App\Models\Aclass::pluck('idclass');
    $halls = App\Models\Hall::pluck('idhall');
    return [
        'hall_idhall' => $faker->randomElement($halls),
        'class_idclass' => $faker->randomElement($classes),
        'weekday' => $faker->regexify('[1-7]'),
        'start_time' => $faker->time($st_hour * 1800 ),
        'end_time' => $faker->time($en_hour * 1800),
    ];
});
// // ONE TO ONE relationship (with Users already created)
// $factory->define(App\Profile::class, function (Faker\Generator $faker) {
//     return [
//         'user_id' => $faker->unique()->numberBetween(1, App\User::count()),
//         // Rest of attributes...
//     ];
// });

// // ONE TO MANY relationship (with Users already created)
// $factory->define(App\Posts::class, function (Faker\Generator $faker) {
//     $users = App\User::pluck('id')->toArray();
//     return [
//         'user_id' => $faker->randomElement($users),
//         // Rest of attributes...
//     ];
// });


//Git hub example
// $factory->define(App\User::class, function (Faker\Generator $faker) {
//     return [
//         'name' => $faker->name,
//         'username' => $faker->userName,
//         'email' => $faker->safeEmail,
//         'password' => bcrypt($faker->password),
//         'company_id' => factory(App\Company::class)->create()->id,
//         'remember_token' => str_random(10),
//     ];
// });