<?php

namespace App\Http\Controllers;

use App\Models\CompanyPost;
use App\Models\Passenger;
use App\Models\PassengerPost;
use App\Models\ReserveList;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PassengerController extends Controller
{
    const PASSENGER_STATUS = [
        'BLOCKED' => 'blocked',
        'UNBLOCKED' => 'unblocked'
    ];
    const IMAGE_NAME = 'passenger_account.jpg';

    public function checkPassengerLogin(Request $request)
    {
        $rules = [
            'phone' => 'required | numeric',
            'password' => 'required '
        ];

        $massages = [
            'phone.required' => 'this field required',
            'phone.numeric' => 'must be numeric format',
            'password.required' => 'this field required',
        ];

        $validate = Validator::make($request->all(), $rules, $massages);

        if ($validate->fails()) return redirect()->back()->withErrors($validate);

        $pass = Passenger::where('phone', $request->phone)->first();

        if (!is_null($pass)) {
            if (Hash::check($request->password, $pass->password)) {
                Session::put('LoggedPassenger', $pass->id);
                return redirect('/passenger-profile');
            } else {
                return redirect()->back()->with(['PasswordFailed' => 'Wrong Password !']);
            }

        } else {
            return redirect('/joinUs-passenger')->with(['EmailFailed' => 'This phone is not registered on the website']);

        }
    }

    public function joinPassenger(Request $request)
    {

        $rules = [
            'fName' => 'required ',
            'lName' => 'required ',
            'phone' => 'required | numeric|unique:passenger,phone',
            'idn' => 'required | numeric|unique:passenger,idn',
            'password' => 'required |min:5 | max:10'
        ];

        $massages = [
            // 'fName.required'=>'this field required',
            // 'lName.required'=> 'this field required',
            // 'phone.required'=>'must be email format',
            // 'phone.numeric'=>'this field required',
            // 'password.required'=>'this field required',
        ];


        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) return redirect()->back()->withErrors($validate);

        // here insert to database:
        Passenger::create([
            'fName' => $request->fName,
            'lName' => $request->lName,
            'phone' => $request->phone,
            'idn' => $request->idn,
            'imagePath' => self::IMAGE_NAME,
            'status' => self::PASSENGER_STATUS['UNBLOCKED'],
            'password' => Hash::make($request->password)
        ]);
        return redirect('/login-passenger')->with(['Success' => 'your register is done']);
    }

    public function passengerProfile()
    {
        if (Session::has('LoggedPassenger')) {
            $passenger = Passenger::where('id', Session::get('LoggedPassenger'))->first();
             $myReservations = ReserveList::where('passId', Session::get('LoggedPassenger'))->get();

            return view('passenger/passengerProfile', ['passenger' => $passenger, 'myReservations' => $myReservations]);
        }

    }

    public function writePostPassenger()
    {
        $passenger = Passenger::where('id', Session::get('LoggedPassenger'))->first();
        $myReservations = ReserveList::where('passId', Session::get('LoggedPassenger'))->get();

        return view('passenger/writePostPassenger', ['passenger' => $passenger, 'myReservations' => $myReservations]);
    }

    public function savePost(Request $request)
    {
        if (trim($request->all()['post']) == "") {
            return redirect()->back();
        }
//        if (Session::has('LoggedCompany')) {
//            CompanyPost::create(['compId' => Session::get('LoggedCompany'), 'content' => $request->post]);
//            return redirect('/company-profile/news');
//        }

        if (Session::has('LoggedPassenger')) {
            PassengerPost::create(['passId' => Session::get('LoggedPassenger'), 'content' => $request->post]);
            return redirect('/passenger-profile/news');
        }

    }

    public function passengerNews()
    {
        $passenger = Passenger::where('id', Session::get('LoggedPassenger'))->first();
        $openTrips = Trip::with('company')->where('status', 'open')
            ->orderBy('created_at', 'desc')->get();
        $companyPosts = CompanyPost::with('company')->orderBy('created_at', 'desc')->get();
        $passengerPosts = PassengerPost::with('passenger')->orderBy('created_at', 'desc')->get();

        $myReservations = ReserveList::where('passId', Session::get('LoggedPassenger'))->get();


        return view('passenger/passenger-news', [
            'passenger' => $passenger,
            'openTrips' => $openTrips,
            'passengerPosts' => $passengerPosts,
            'companyPosts' => $companyPosts,
            'myReservations' => $myReservations
        ]);
    }

    public function showATrip($tripId)
    {
        $trip = Trip::with('company')->where('id', $tripId)->first();
        $myReservations = ReserveList::where('passId', Session::get('LoggedPassenger'))->get();
        $passenger = Passenger::where('id', Session::get('LoggedPassenger'))->first();
        return view('passenger/showATrip', [
            'trip' => $trip,
            'myReservations' => $myReservations,
            'passenger' => $passenger,
        ]);

    }

    public function viewProfile()
    {
        $myReservations = ReserveList::where('passId', Session::get('LoggedPassenger'))->get();
        $passenger = Passenger::where('id', Session::get('LoggedPassenger'))->first();
        return view('passenger/viewProfile', [
                'myReservations' => $myReservations,
                'passenger' => $passenger
            ]
        );
    }

    public function editProfile()
    {
        $myReservations = ReserveList::where('passId', Session::get('LoggedPassenger'))->get();
        $passenger = Passenger::where('id', Session::get('LoggedPassenger'))->first();
        return view('passenger/editPassengerProfile', [
                'myReservations' => $myReservations,
                'passenger' => $passenger
            ]
        );
    }

    public function saveNewProfileInfo(Request $request)
    {

//        $test = $request->photo->guessExtension();
//        $test = $request->photo->getMimeType();
//        $test = $request->file('photo')->getMimeType();

        $rules = [
            'fName' => 'regex:/^([^0-9]*)$/ | nullable',
            'lName' => 'regex:/^([^0-9]*)$/| nullable',
            'phone' => 'numeric| nullable',
            'idn' => 'numeric| nullable ',
            'photo' => 'mimes:jpg,png,jpeg |max:5048' //specify file extension and size ;
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) return redirect()->back()->withErrors($validate);

        $pass_info = Passenger::where('id', Session::get('LoggedPassenger'))->first();

        //Make sure that the chosen phone number is unique
        $another_pass = Passenger::where('id', '!=', Session::get('LoggedPassenger'))
            ->where('phone', $request->phone)->first();
        if (!is_null($another_pass)) {
            return redirect('/passenger-profile/view-profile')->with(['failed_phone' => 'This phone belongs to someone else.']);
        }
        //Make sure that the chosen idn number is unique
        $another_pass2 = Passenger::where('id', '!=', Session::get('LoggedPassenger'))
            ->where('idn', $request->idn)->first();
        if (!is_null($another_pass2)) {
            return redirect('/passenger-profile/view-profile')->with(['failed_idn' => 'This IDN belongs to someone else.']);
        }

        //Work on putting a name for the image and store it somewhere
        if (!is_null($request->photo)) {
            $file_extension = $request->photo->getClientOriginalExtension();
            $file_name = $request->photo->getClientOriginalName();
            $request->photo->move(Public_path('photos'), $file_name);

        }
        //store new data
        $pass_info->fName = is_null($request->fName) ? $pass_info->fName : $request->fName;
        $pass_info->lName = is_null($request->lName) ? $pass_info->lName : $request->lName;
        $pass_info->phone = is_null($request->phone) ? $pass_info->phone : $request->phone;
        $pass_info->idn = is_null($request->idn) ? $pass_info->idn : $request->idn;
        $pass_info->idn = is_null($request->idn) ? $pass_info->idn : $request->idn;
        $pass_info->imagePath = is_null($request->photo) ? $pass_info->imagePath : $file_name;
        $pass_info->save();

//        return PassengerController::where('id', Session::get('LoggedPassenger'))->first();
        return redirect('/passenger-profile/view-profile')->with(['pass_profile_edit_done' => 'Your data has been modified successfully']);
    }

    public function logOutPass()
    {
        Session::forget(['LoggedPassenger']);
        return redirect('/home');
    }
}
