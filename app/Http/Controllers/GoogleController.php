<?php

namespace App\Http\Controllers;

use App\Model\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
            /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect('/');

            }else{

                $userId ='M-'.Carbon::now()->format('ymdHis');
                $newUser = User::create([

                    'user_id' => $userId,
                    'google_id'=> $user->id,
                    'user_nick' => 'u-'.Carbon::now()->format('ymdHis'),
                    'user_role' => 3,
                    'user_nama' => $user->name,
                    'user_mail' => $user->email,
                    'user_alamat'=> '-',
                    'user_job' => '-',
                    'user_phone' => 'p-'.Carbon::now()->format('ymdHis'),
                    'user_password'=> Hash::make('123qweasd'),
                ]);

                Auth::login($newUser);

                return redirect('/');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
