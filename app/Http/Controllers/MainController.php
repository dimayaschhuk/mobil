<?php

namespace App\Http\Controllers;

use App\Group;
use App\Schedule;
use App\Student;
use App\Subject;
use App\Teacher_subject;
use App\User;
use App\Visiting;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    //Дана функція завантажує весь розклад вчителя
public function roz_all(){




    $t_s=Teacher_subject::where('users_id',Auth::user()->id)->get();
    $id=[];
    foreach ($t_s as $item){
        array_push($id,$item->id);
    }


    $schedule=Schedule::whereIn('teacher_subjects_id',$id)->orderBy('number')->get()->load(['group']);

    foreach ($schedule as $item){



        switch ($item->day_of_the_week) {
            case 'Mon':
                $r=[
                    'name'=>Subject::find(Teacher_subject::find($item->teacher_subjects_id)->subjects_id)->name,
                    'group'=>$item['group']->name,
                    'course'=>$item['group']->course,
                    'number'=>$item->number,
                    'group_id'=>$item['group']->id,
                    'schedule'=>$item->id

                ];

                $result[0]=['day'=>'Понеділок'];
                if (!array_key_exists("lesson", $result[0])) {
                    $result[0]['lesson']=[];
                    array_push($result[0]['lesson'],$r);
                }else{
                    array_push($result[0]['lesson'],$r);
                }




                break;
            case 'Tue':

                $r=[
                    'name'=>Subject::find(Teacher_subject::find($item->teacher_subjects_id)->subjects_id)->name,
                    'group'=>$item['group']->name,
                    'course'=>$item['group']->course,
                    'number'=>$item->number,
                    'group_id'=>$item['group']->id,
                    'schedule'=>$item->id

                ];

                $result[1]=['day'=>'Вівторок'];
                if (!array_key_exists("lesson", $result[1])) {
                    $result[1]['lesson']=[];
                    array_push($result[1]['lesson'],$r);
                }else{
                    array_push($result[1]['lesson'],$r);
                }



                break;
            case 'Wed':
                $r=[
                    'name'=>Subject::find(Teacher_subject::find($item->teacher_subjects_id)->subjects_id)->name,
                    'group'=>$item['group']->name,
                    'course'=>$item['group']->course,
                    'number'=>$item->number,
                    'group_id'=>$item['group']->id,
                    'schedule'=>$item->id

                ];

                $result[2]=['day'=>'Середа'];
                if (!array_key_exists("lesson", $result[2])) {
                    $result[2]['lesson']=[];
                    array_push($result[2]['lesson'],$r);
                }else{
                    array_push($result[2]['lesson'],$r);
                }
                break;
            case 'Thu':

                $r=[
                    'name'=>Subject::find(Teacher_subject::find($item->teacher_subjects_id)->subjects_id)->name,
                    'group'=>$item['group']->name,
                    'course'=>$item['group']->course,
                    'number'=>$item->number,
                    'group_id'=>$item['group']->id,
                    'schedule'=>$item->id

                ];

                $result[3]=['day'=>'Четверг'];
                if (!array_key_exists("lesson", $result[3])) {
                    $result[3]['lesson']=[];
                    array_push($result[3]['lesson'],$r);
                }else{
                    array_push($result[3]['lesson'],$r);
                }

                break;
            case 'Fri':

                $r=[
                    'name'=>Subject::find(Teacher_subject::find($item->teacher_subjects_id)->subjects_id)->name,
                    'group'=>$item['group']->name,
                    'course'=>$item['group']->course,
                    'number'=>$item->number,
                    'group_id'=>$item['group']->id,
                    'schedule'=>$item->id

                ];

                $result[4]=['day'=>'П`ятниця'];
                if (!array_key_exists("lesson", $result[4])) {
                    $result[4]['lesson']=[];
                    array_push($result[4]['lesson'],$r);
                }else{
                    array_push($result[4]['lesson'],$r);
                }

                break;
            case 'Sat':

                $r=[
                    'name'=>Subject::find(Teacher_subject::find($item->teacher_subjects_id)->subjects_id)->name,
                    'group'=>$item['group']->name,
                    'course'=>$item['group']->course,
                    'number'=>$item->number,
                    'group_id'=>$item['group']->id,
                    'schedule_id'=>$item->id

                ];

                $result[5]=['day'=>'Субота'];
                if (!array_key_exists("lesson", $result[5])) {
                    $result[4]['lesson']=[];
                    array_push($result[5]['lesson'],$r);
                }else{
                    array_push($result[5]['lesson'],$r);
                }

                break;
            case 'Sun':


                $r=[
                    'name'=>Subject::find(Teacher_subject::find($item->teacher_subjects_id)->subjects_id)->name,
                    'group'=>$item['group']->name,
                    'course'=>$item['group']->course,
                    'number'=>$item->number,
                    'group_id'=>$item['group']->id,
                    'schedule'=>$item->id

                ];

                $result[6]=['day'=>'Неділя'];
                if (!array_key_exists("lesson", $result[6])) {
                    $result[6]['lesson']=[];
                    array_push($result[6]['lesson'],$r);
                }else{
                    array_push($result[6]['lesson'],$r);
                }


                break;
        }
    }




    return $result;


}

    //Вертаєм всіх студентів з вибраної нам групи
    public function get_student(Request $request){

        $request->session()->put('schedule_id',$request['schedule_id']);
        return Student::where('groups_id',$request['group_id'])->get();
    }

    public function index_edit_my_magazine(){
        $result=[];
        switch (strftime("%a", strtotime(date('Y-m-d')))) {
            case 'Mon':

              $day='Понеділок';
                break;
            case 'Tue':

                $day='Вівторок';


                break;
            case 'Wed':

                $day='Середа';

                break;
            case 'Thu':

                $day='Четверг';
                break;
            case 'Fri':

                $day='П`ятниця';
                break;
            case 'Sat':

                $day='Субота';

                break;
            case 'Sun':

                $day='Неділя';

                break;
        }



            $t_s=Teacher_subject::where('users_id',Auth::user()->id)->get();
            $id=[];
            foreach ($t_s as $item){
                array_push($id,$item->id);
            }


        $schedule=Schedule::whereIn('teacher_subjects_id',$id)->where('day_of_the_week',strftime("%a", strtotime(date('Y-m-d'))))->orderBy('number')->get()->load(['group']);

        foreach ($schedule as $item){



            switch ($item->day_of_the_week) {
                case 'Mon':
                    $r=[
                        'name'=>Subject::find(Teacher_subject::find($item->teacher_subjects_id)->subjects_id)->name,
                        'group'=>$item['group']->name,
                        'course'=>$item['group']->course,
                        'number'=>$item->number,
                        'group_id'=>$item['group']->id,
                        'schedule'=>$item->id

                    ];

                    $result[0]=['day'=>'Понеділок'];
                    if (!array_key_exists("lesson", $result[0])) {
                        $result[0]['lesson']=[];
                        array_push($result[0]['lesson'],$r);
                    }else{
                        array_push($result[0]['lesson'],$r);
                    }




                    break;
                case 'Tue':

                    $r=[
                        'name'=>Subject::find(Teacher_subject::find($item->teacher_subjects_id)->subjects_id)->name,
                        'group'=>$item['group']->name,
                        'course'=>$item['group']->course,
                        'number'=>$item->number,
                        'group_id'=>$item['group']->id,
                        'schedule'=>$item->id

                    ];

                    $result[1]=['day'=>'Вівторок'];
                    if (!array_key_exists("lesson", $result[1])) {
                        $result[1]['lesson']=[];
                        array_push($result[1]['lesson'],$r);
                    }else{
                        array_push($result[1]['lesson'],$r);
                    }



                    break;
                case 'Wed':
                    $r=[
                        'name'=>Subject::find(Teacher_subject::find($item->teacher_subjects_id)->subjects_id)->name,
                        'group'=>$item['group']->name,
                        'course'=>$item['group']->course,
                        'number'=>$item->number,
                        'group_id'=>$item['group']->id,
                        'schedule'=>$item->id

                    ];

                    $result[2]=['day'=>'Середа'];
                    if (!array_key_exists("lesson", $result[2])) {
                        $result[2]['lesson']=[];
                        array_push($result[2]['lesson'],$r);
                    }else{
                        array_push($result[2]['lesson'],$r);
                    }
                    break;
                case 'Thu':

                    $r=[
                        'name'=>Subject::find(Teacher_subject::find($item->teacher_subjects_id)->subjects_id)->name,
                        'group'=>$item['group']->name,
                        'course'=>$item['group']->course,
                        'number'=>$item->number,
                        'group_id'=>$item['group']->id,
                        'schedule'=>$item->id

                    ];

                    $result[3]=['day'=>'Четверг'];
                    if (!array_key_exists("lesson", $result[3])) {
                        $result[3]['lesson']=[];
                        array_push($result[3]['lesson'],$r);
                    }else{
                        array_push($result[3]['lesson'],$r);
                    }

                    break;
                case 'Fri':

                    $r=[
                        'name'=>Subject::find(Teacher_subject::find($item->teacher_subjects_id)->subjects_id)->name,
                        'group'=>$item['group']->name,
                        'course'=>$item['group']->course,
'number'=>$item->number,
                        'group_id'=>$item['group']->id,
                        'schedule'=>$item->id

                    ];

                    $result[4]=['day'=>'П`ятниця'];
                    if (!array_key_exists("lesson", $result[4])) {
                        $result[4]['lesson']=[];
                        array_push($result[4]['lesson'],$r);
                    }else{
                        array_push($result[4]['lesson'],$r);
                    }

                    break;
                case 'Sat':

                    $r=[
                        'name'=>Subject::find(Teacher_subject::find($item->teacher_subjects_id)->subjects_id)->name,
                        'group'=>$item['group']->name,
                        'course'=>$item['group']->course,
'number'=>$item->number,
                        'group_id'=>$item['group']->id,
                        'schedule_id'=>$item->id

                    ];

                    $result[5]=['day'=>'Субота'];
                    if (!array_key_exists("lesson", $result[5])) {
                        $result[4]['lesson']=[];
                        array_push($result[5]['lesson'],$r);
                    }else{
                        array_push($result[5]['lesson'],$r);
                    }

                    break;
                case 'Sun':


                    $r=[
                        'name'=>Subject::find(Teacher_subject::find($item->teacher_subjects_id)->subjects_id)->name,
                        'group'=>$item['group']->name,
                        'course'=>$item['group']->course,
'number'=>$item->number,
                        'group_id'=>$item['group']->id,
                        'schedule'=>$item->id

                    ];

                    $result[6]=['day'=>'Неділя'];
                    if (!array_key_exists("lesson", $result[6])) {
                        $result[6]['lesson']=[];
                        array_push($result[6]['lesson'],$r);
                    }else{
                        array_push($result[6]['lesson'],$r);
                    }


                    break;
            }
        }




        return view('my_cabinet',array(
            'result'=>$result,
            'day'=>$day
        ));




    }
    public function search(Request $request)
    {

        switch ($request['status']){
            case 'subject':
                return Subject::all();
                break;
            case 'group':
                return Group::all();
                break;


        }




    }

    public function save(Request $request){



        foreach ($request['student_id'] as $item){

           if(!empty($visiting=Visiting::where('students_id',$item)->where('schedules_id', $request->session()->get('schedule_id'))->where('data',date('Y-m-d'))->get())){
               $visiting=new Visiting();
               $visiting->schedules_id= $request->session()->get('schedule_id');
               $visiting->students_id=$item;
               $visiting->status=1;
               $visiting->data=date('Y-m-d');
               $visiting->save();


           }else{

               $visiting->schedules_id= $request->session()->get('schedule_id');
               $visiting->students_id=$item;
               $visiting->status=1;
               $visiting->data=date('Y-m-d');
               $visiting->save();
           }
        }

        return 'Успішно збережено';

    }

    public function index(){
        $admin='false';
        $teacher='false';
        if(Gate::allows('admin')){
            $admin='true';
        }
        if(Gate::allows('teacher')) {
            $teacher = 'true';

        }





//
        return view('welcome', array(
            'teacher' => $teacher,
            'admin' => $admin,
        ));
    }

    public function out()
    {
        Auth::logout();
        return redirect()->route('login');
    }




public function result(Request $request){



    function dop_day($status,$day_min,$day_max,$id,$request){

        $days=['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];

         $days=array_slice($days, $day_min,$day_max);

         if($status==='subject'){
             $schedule=Schedule::whereIn('teacher_subjects_id',$id)->whereIn('day_of_the_week',$days)->get();

             $id=[];
             foreach ($schedule as $item){
                 array_push($id,$item->id);
             }

//             dd(Visiting::whereIn('schedules_id',$id)->where('status',1)->where('data','>',$request['data_min'])->where('data','<',$request['data_max'])->count());
             return Visiting::whereIn('schedules_id',$id)->where('status',1)->where('data','>',$request['data_min'])->where('data','<',$request['data_max'])->count();
         }else{
             $schedule=Schedule::where('groups_id',$id)->whereIn('day_of_the_week',$days)->get();
         }


        $schedule_id=[];
        $group=[];
        $count_group_and_key=[];


        foreach ($schedule as $item){
            array_push($schedule_id,$item->id);

            $key=array_search($item->groups_id, $group);

            if($key===false){
                array_push($group,$item->groups_id);
                $key=array_search($item->groups_id, $group);
                $c=['key'=>$key,'count'=>1];
                array_push($count_group_and_key,$c);


            }else{


                foreach($count_group_and_key as $keyr=>$value) {
                    if($key===$value['key']){
                        $count_group_and_key[$keyr]['count']++;
                    }



                }




            }






        }
        $need_count_visiting=0;


        foreach ($count_group_and_key as $item){

            $need_count_visiting=$need_count_visiting+Student::where('groups_id',$group[$item['key']])->count()*$item['count'];
            $this_count_visiting=Visiting::whereIn('schedules_id',$schedule_id)->where('data','>=',$request['data_min'])->where('data','<=',$request['data_max'])->count();
            $data[0]=$need_count_visiting;
            $data[1]=$this_count_visiting;


        }


        return $data;





    }


        $data_min=$request['data_min'];
        $data_max=$request['data_max'];
        $data = strtotime($data_max) - strtotime($data_min);
        switch (strftime("%a", strtotime($data_min))) {
        case 'Mon':

            $plus_day_min = 0;
            break;
        case 'Tue':

            $plus_day_min = 1;


            break;
        case 'Wed':

            $plus_day_min = 2;

            break;
        case 'Thu':

            $plus_day_min = 3;

            break;
        case 'Fri':

            $plus_day_min = 4;

            break;
        case 'Sat':

            $plus_day_min = 5;

            break;
        case 'Sun':

            $plus_day_min = 6;

            break;
    }

         switch (strftime("%a", strtotime($data_max))) {
        case 'Mon':

            $minus_day_max = 1;
            break;
        case 'Tue':

            $minus_day_max = 2;


            break;
        case 'Wed':

            $minus_day_max = 3;

            break;
        case 'Thu':

            $minus_day_max = 4;

            break;
        case 'Fri':

            $minus_day_max = 5;

            break;
        case 'Sat':
            $minus_day_max = 6;

            break;
        case 'Sun':
            $minus_day_max = 0;

            break;
    }
        if ($request['status'] === 'group') {

        $id = $request['id'];
    } else {
        $t_s = Teacher_subject::where('subjects_id', $request['id'])->get();

        if (count($t_s) > 0) {
            $id = [];
            foreach ($t_s as $item) {
                array_push($id, $item->id);
            }
        }

    }
        if($data /3600 / 24<7) {
        if ($request['status'] === 'group') {
            dd(dop_day($request['status'], $plus_day_min, 6, $id, $request));
            $a = dop_day($request['status'], $plus_day_min, 6, $id, $request);
            $a = $a + dop_day($request['status'], 0, $minus_day_max, $id, $request);

        }else {

            $a = dop_day($request['status'], $plus_day_min, 6, $id, $request);
            $a = $a + dop_day($request['status'], 0, $minus_day_max, $id, $request);

            return $a;
        }

        }else{

        $q=floor((((strtotime($data_max)/3600 / 24-$minus_day_max) - (strtotime($data_min)/3600 / 24+$plus_day_min))/7));

        if($q>0){
            if ($request['status'] === 'group') {
                $a = dop_day($request['status'], $plus_day_min, 6, $id, $request)[0];

                $a = $a + dop_day($request['status'], 0, $minus_day_max, $id, $request)[0];

                $a = $a + dop_day($request['status'], 0, 6, $id, $request)[0] * $q;

                $b = dop_day($request['status'], 0, 6, $id, $request)[1];

                $data[0] = $a;
                $data[1] = $b;

                return $data;
            }else{
                $a = dop_day($request['status'], $plus_day_min, 6, $id, $request);

                $a = $a + dop_day($request['status'], 0, $minus_day_max, $id, $request);

                $a = $a + dop_day($request['status'], 0, 6, $id, $request)[0] * $q;

               return $a;

            }

        }



    }

}

}
