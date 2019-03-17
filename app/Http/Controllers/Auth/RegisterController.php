<?php

namespace App\Http\Controllers\Auth;

use DB;
use Mail;
use App\User;
use App\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NewuserNotification;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

use Illuminate\Auth\Events\Registered;

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
    protected $redirectTo = '/home';

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
        $user=User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_token' => str_random(10),
        ]);
        $newusers=User::where('role_id','2')->get();
        foreach($newusers as $newuser){
        $newuser->notify(new NewuserNotification);
        }
        return $user;
    }
    protected function registered(Request $request, $user) {
		Profile::create([
			'user_id' => $user->id,
			'slug' => $user->id,
			'thumbnail' => 'images/profile/no-thumbnail.jpg',
        ]);
        return redirect('/home');
	}
    

    public function register(Request $request)
        {
    // Laravel validation
        $validator = $this->validator($request->all());
        if ($validator->fails()) 
        {
            $this->throwValidationException($request, $validator);
        }
        DB::beginTransaction();
        try
        {
            $user = $this->create($request->all());
            // After creating the user send an email with the random token generated in the create method above
            $email = new EmailVerification(new User(['email_token' => $user->email_token, 'name' => $user->name]));
            Mail::to($user->email)->send($email);
            DB::commit();
            return back();
        }
        catch(Exception $e)
        {
            DB::rollback(); 
            return back();
        }
    }
    public function verify($token)
    {
    // The verified method has been added to the user model and chained here
    // for better readability
    User::where('email_token',$token)->firstOrFail()->verified();
    return redirect('login');
    }
}
