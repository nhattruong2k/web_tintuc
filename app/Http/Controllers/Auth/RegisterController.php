<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminata\Http\Request;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use Carbon;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'alpha','string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'avatar' =>['sometimes', 'image', 'mimes:jpg,jpeg,bmp,svg,png','max:500'],
            'ninkname'=>['required', 'string', 'max:255'],
            'phone'=>['required', 'numeric', 'unique:users','regex:/(0)[0-9]{9}/','digits:10'],
            'gender'=>['required'],
        ],
        [
                'name.required'=>'xin vui lòng điền name thông tin ',
                'name.alpha'=> 'name phải là chữ',
                'password.required'=>'Xin vui lòng điền password',
                'password.min'=>'Phải có ít nhất 8 ký tự',
                'ninkname.required' => 'xin vui lòng điền nink name thông tin',
                'email.required' => 'xin vui lòng điền email thông tin',
                'email.unique'=>'email đã được sử dụng',
                'phone.required' => 'xin vui lòng điền phone thông tin ',
                'phone.digits' => 'Điện thoại phải có 10 chữ số',
                'phone.regex' => 'Định dạng số điện thoại không hợp lệ',
                'gender.required' => 'xin vui lòng điền giới tính thông tin ',
        ]
    );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function index(){
        $province_all = Province::all();
        $ward_all = Ward::all();
        $district_all = District::all();
        return view('vendor.adminlte.auth.register')->with(compact('province_all', 'ward_all', 'district_all'));
    }

    protected function create(array $data)
    {
        if(request()->has('avatar')){
            $avataruploaded = request()->file('avatar');
            $path = 'public/uploads/user/';
            $get_name_image = $avataruploaded->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image ));
            $new_image = $name_image.rand (0,99).'.'.$avataruploaded->getClientOriginalExtension();
            $avataruploaded->move($path, $new_image);
        }else{
            $new_image  = 'default-avatar.jpg';
        }
        $token = rand(0000, 9999);
        $date_created = Carbon\Carbon::now();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar'=>$new_image,
            'ninkname'=>$data['ninkname'],
            'phone'=>$data['phone'],
            'gender'=>$data['gender'],
            'token'=>$token,
            'date_created'=>$date_created,
        ]);
        if(request()->role == 'blogger'){
            $user->syncRoles('blogger');
        }
        return $user;
        // dd($user);
    }
}
