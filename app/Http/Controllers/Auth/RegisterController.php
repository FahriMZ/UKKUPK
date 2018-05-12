<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Perusahaan;
use App\Asesor;

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

    // Override default registration
    public function showRegistrationForm()
    {
        $perusahaan = Perusahaan::all();
        return view('auth.register', compact('perusahaan'));
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
            'email' => 'required|string|email|max:255|unique:users'
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
        // Default akun untuk asesor

        // Default username
        $username = date('dmY', strtotime($data['tanggal_lahir']));
        $username .= '-';
        $username .= Asesor::orderBy('id_asesor', 'desc')->first()['id_asesor'] + 1;
        $username .= '-';

        $nama_perusahaan = explode(' ', Perusahaan::where('id_perusahaan', $data['id_perusahaan'])->first()['nama_perusahaan']);

        foreach($nama_perusahaan as $perusahaan) {
            $username .= substr($perusahaan, 0, 1);
        }

        // Default password
        $password = Hash::make(123456);

        // $user = User::create([
        //     'username' => $data['username'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        //     'akses' => 'asesor'
        // ]);

        $user = User::create([
            'username' => $username,
            'email' => $data['email'],
            'password' => $password,
            'akses' => 'asesor'
        ]);

        $asesor = Asesor::create([
            'nama'              => $data['nama'],
            'id_user'           => $user->id_user,
            'id_perusahaan'     => $data['id_perusahaan'],
            'jenis_kelamin'     => $data['jenis_kelamin'],
            'tanggal_lahir'     => $data['tanggal_lahir'],
            'alamat'            => $data['alamat'],
            'kontak'            => $data['kontak']
        ]);

        if($user && $asesor) {
            return $user;
        }
    }
}
