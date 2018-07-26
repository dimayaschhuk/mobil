<?php

use Illuminate\Database\Seeder;
use \App\Group;
use \App\Teacher_subject;
use  \App\User;
use \App\Subject;
use \App\Schedule;

class AllSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $teacher=new User();
        $teacher->name='Діма';
        $teacher->email='dima@gmail.com';
        $teacher->status='admin';
        $teacher->password='$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm';
        $teacher->remember_token=str_random(10);
        $teacher->save();

        factory(App\User::class,'teacher',4)->create();



        $teacher_subject= new Teacher_subject();
        $teacher_subject->users_id=2;
        $teacher_subject->subjects_id=1;
        $teacher_subject->save();

        $teacher_subject= new Teacher_subject();
        $teacher_subject->users_id=3;
        $teacher_subject->subjects_id=2;
        $teacher_subject->save();

        $teacher_subject= new Teacher_subject();
        $teacher_subject->users_id=4;
        $teacher_subject->subjects_id=2;
        $teacher_subject->save();

        $teacher_subject= new Teacher_subject();
        $teacher_subject->users_id=5;
        $teacher_subject->subjects_id=3;
        $teacher_subject->save();

        $teacher_subject= new Teacher_subject();
        $teacher_subject->users_id=6;
        $teacher_subject->subjects_id=4;
        $teacher_subject->save();




        $teacher_subject= new Subject();
        $teacher_subject->name='Фізика';
        $teacher_subject->save();

        $teacher_subject= new Subject();
        $teacher_subject->name='Матиматика';
        $teacher_subject->save();

        $teacher_subject= new Subject();
        $teacher_subject->name='Англ. мова';
        $teacher_subject->save();

        $teacher_subject= new Subject();
        $teacher_subject->name='Укр. мова';
        $teacher_subject->save();








        $group= new Group();
        $group->name='PT';
        $group->course=1;
        $group->save();
        factory(App\Student::class,'student_2',20)->create();

        $group= new Group();
        $group->name='PI';
        $group->course=1;
        $group->save();
        factory(App\Student::class,'student_1',20)->create();



        $schedule= new Schedule();
        $schedule->groups_id=1;
        $schedule->day_of_the_week='Mon';
        $schedule->number=1;
        $schedule->teacher_subjects_id=1;
        $schedule->save();

        $schedule= new Schedule();
        $schedule->groups_id=1;
        $schedule->day_of_the_week='Mon';
        $schedule->number=2;
        $schedule->teacher_subjects_id=3;
        $schedule->save();


        $schedule= new Schedule();
        $schedule->groups_id=1;
        $schedule->day_of_the_week='Tue';
        $schedule->number=1;
        $schedule->teacher_subjects_id=4;
        $schedule->save();

        $schedule= new Schedule();
        $schedule->groups_id=1;
        $schedule->day_of_the_week='Tue';
        $schedule->number=2;
        $schedule->teacher_subjects_id=5;
        $schedule->save();

        $schedule= new Schedule();
        $schedule->groups_id=1;
        $schedule->day_of_the_week='Wed';
        $schedule->number=1;
        $schedule->teacher_subjects_id=2;
        $schedule->save();

        $schedule= new Schedule();
        $schedule->groups_id=1;
        $schedule->day_of_the_week='Wed';
        $schedule->number=2;
        $schedule->teacher_subjects_id=5;
        $schedule->save();

        $schedule= new Schedule();
        $schedule->groups_id=1;
        $schedule->day_of_the_week='Thu';
        $schedule->number=1;
        $schedule->teacher_subjects_id=4;
        $schedule->save();

        $schedule= new Schedule();
        $schedule->groups_id=1;
        $schedule->day_of_the_week='Thu';
        $schedule->number=2;
        $schedule->teacher_subjects_id=4;
        $schedule->save();

        $schedule= new Schedule();
        $schedule->groups_id=1;
        $schedule->day_of_the_week='Fri';
        $schedule->number=1;
        $schedule->teacher_subjects_id=3;
        $schedule->save();

        $schedule= new Schedule();
        $schedule->groups_id=1;
        $schedule->day_of_the_week='Fri';
        $schedule->number=2;
        $schedule->teacher_subjects_id=4;
        $schedule->save();









        $schedule= new Schedule();
        $schedule->groups_id=2;
        $schedule->day_of_the_week='Mon';
        $schedule->number=1;
        $schedule->teacher_subjects_id=5;
        $schedule->save();

        $schedule= new Schedule();
        $schedule->groups_id=2;
        $schedule->day_of_the_week='Mon';
        $schedule->number=4;
        $schedule->teacher_subjects_id=2;
        $schedule->save();


        $schedule= new Schedule();
        $schedule->groups_id=2;
        $schedule->day_of_the_week='Tue';
        $schedule->number=1;
        $schedule->teacher_subjects_id=5;
        $schedule->save();

        $schedule= new Schedule();
        $schedule->groups_id=2;
        $schedule->day_of_the_week='Tue';
        $schedule->number=2;
        $schedule->teacher_subjects_id=4;
        $schedule->save();

        $schedule= new Schedule();
        $schedule->groups_id=2;
        $schedule->day_of_the_week='Wed';
        $schedule->number=1;
        $schedule->teacher_subjects_id=3;
        $schedule->save();

        $schedule= new Schedule();
        $schedule->groups_id=2;
        $schedule->day_of_the_week='Wed';
        $schedule->number=2;
        $schedule->teacher_subjects_id=2;
        $schedule->save();

        $schedule= new Schedule();
        $schedule->groups_id=2;
        $schedule->day_of_the_week='Thu';
        $schedule->number=1;
        $schedule->teacher_subjects_id=4;
        $schedule->save();

        $schedule= new Schedule();
        $schedule->groups_id=2;
        $schedule->day_of_the_week='Thu';
        $schedule->number=2;
        $schedule->teacher_subjects_id=2;
        $schedule->save();

        $schedule= new Schedule();
        $schedule->groups_id=2;
        $schedule->day_of_the_week='Fri';
        $schedule->number=1;
        $schedule->teacher_subjects_id=5;
        $schedule->save();

        $schedule= new Schedule();
        $schedule->groups_id=2;
        $schedule->day_of_the_week='Fri';
        $schedule->number=1;
        $schedule->teacher_subjects_id=4;
        $schedule->save();




    }
}
