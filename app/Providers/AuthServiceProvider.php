<?php

namespace App\Providers;

use App\User;
//use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();
        $gate->define('admin',function (User $user){
            if($user->status==='admin'){
                return TRUE;
            }else{
                return FALSE;
            }

        });
        $gate->define('teacher',function (User $user){
            if($user->status==='teacher'){
                return TRUE;
            }else{
                return FALSE;
            }

        });
        //
    }
}
