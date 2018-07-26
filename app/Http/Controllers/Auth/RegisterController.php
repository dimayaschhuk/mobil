<?php

namespace App\Http\Controllers\Auth;

use App\Subject;
use App\Teacher_subject;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data['lesson']!=''){


           $user=User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'status' => 'teacher',
                'password' => Hash::make($data['password']),
            ]);

            if(count($subject=Subject::where('name',$data['lesson'])->get())!=0){
                $t_s=new Teacher_subject();
                $t_s->users_id=$user->id;
                $t_s->subjects_id=$subject->id;
                $t_s->save();
            }else{
                $subject=new Subject();
                $subject->name=$data['lesson'];
                $subject->save();

                $t_s=new Teacher_subject();
                $t_s->users_id=$user->id;
                $t_s->subjects_id=$subject->id;
                $t_s->save();
            }

        }else{
            $user=User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'status' => 'user',
                'password' => Hash::make($data['password']),
            ]);
        }

        return $user;
    }
}
