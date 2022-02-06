<?php

namespace App\Http\Controllers;

use App\Events\addNewPost;
use App\Events\addNewTrip;
use App\Models\Company;
use App\Models\CompanyPost;
use App\Models\EventLog;
use App\Models\Passenger;
use App\Models\PassengerPost;
use App\Models\ReserveList;
use App\Models\Trip;
use App\Traits\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{


    //default image name for new company
    const IMAGE_NAME = 'company_account.jpg';

    public function checkCompanyLogin(Request $request)
    {
        $rules = [
            'email' => 'required | email:rfc',
            'password' => 'required '
        ];

        $massages = [
            'email.required' => 'this field required',
            'email.email' => 'must be email format',
            'password.required' => 'this field required',
        ];

        $validate = Validator::make($request->all(), $rules, $massages);

        if ($validate->fails()) return redirect()->back()->withErrors($validate);

        $comp = Company::where('email', $request->email)->first();

        if (!is_null($comp)) {
            if ($comp->status == Constants::COMPANY_STATUS['PENDING']) {
                return redirect()->back()->with(['pendingAccount' => 'you account still pending....! ']);
            } elseif (!Hash::check($request->password, $comp->password)) {
                return redirect()->back()->with(['PasswordFailed' => 'Wrong Password !']);
            }
//            Session::forget('LoggedPassenger');//log out passenger login if it exist;
            Session::put('LoggedCompany', $comp->id);
            return redirect('/company-profile');


        } else {
            return redirect('/joinUs-company')->with(['EmailFailed' => 'This email is not registered on the website']);

        }

    }

    public function joinCompany(Request $request)
    {
        $rules = [
            'compName' => 'required |unique:company,compName',
            'email' => 'required | email:rfc|unique:company,email',
            'telephone' => 'required | numeric|unique:company,telephone',
            'address' => 'required',
            'password' => 'required |min:5 | max:10'
        ];

        $massages = [
            'compName.required' => 'this field required',
            'email.required' => 'this field required',
            'email.email' => 'must be email format',
            'address.required' => 'this field required',
            'password.required' => 'this field required',
        ];


        $validate = Validator::make($request->all(), $rules, $massages);

        if ($validate->fails()) return redirect()->back()->withErrors($validate);

        // here insert to database:
        Company::create([
            'compName' => $request->compName,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'imagePath' => Constants::IMAGE_NAME,
            'status' => Constants::COMPANY_STATUS['PENDING'],
            'password' => Hash::make($request->password),
        ]);
        return redirect('/login-company')->with(['Success' => 'your register is done']);
    }

    public function companyProfile()
    {
        if (Session::has('LoggedCompany')) {
            $company = Company::where('id', Session::get('LoggedCompany'))->first();
            return view('company.companyProfile', compact('company'));
        }
    }

    public function getTripForm()
    {
        if (Session::has('LoggedCompany')) {
            $company = Company::where('id', Session::get('LoggedCompany'))->first();
            return view('company.tripForm', compact('company'));
        }
    }

    public function filter($fullData, $condition)
    {
        $result = [];
        $c = 0;
        unset($condition['_token']);
        $numCondNotNull = count($condition) - count(array_filter(($condition), 'is_null'));

        foreach ($fullData as $date) {

            if (!is_null($condition['from']) && $date->from == $condition['from']) $c++;

            if (!is_null($condition['to']) && $date->to == $condition['to']) $c++;

            if (!is_null($condition['status']) && $date->status == $condition['status']) $c++;

            if (!is_null($condition['beforeDate']) && $date->time < $condition['beforeDate']) $c++;

            if (!is_null($condition['afterDate']) && $date->time > $condition['afterDate']) $c++;

            if ($c == $numCondNotNull) array_push($result, $date);

            $c = 0;

        }
        return $result;
    }

    public function addTrip(Request $request)
    {
        //check if the account is blocked or not
        if (Company::select('status')->where('id', Session::get('LoggedCompany'))->first()->status == Constants::COMPANY_STATUS['BLOCKED']) {
            return redirect()->back()->with(['addTripFailed' => 'your Account is Blocked']);
        }
        //validate :
        $rules = [
            'from' => 'required ',
            'to' => 'required ',
            'numSeats' => 'required ',
            'time' => 'required ',
            'priceASeat' => 'required ',
        ];
        $massages = [
            'from.required' => '* required',
            'to.required' => '* required',
            'numSeats.required' => '* required',
            'time.required' => '* required',
            'priceASeat.required' => '* required',
        ];
        $validate = Validator::make($request->all(), $rules, $massages);
        if ($validate->fails()) return redirect()->back()->withErrors($validate);
        //add new trip :
        $idTrip = Trip::create([
            'compId' => Session::get('LoggedCompany'),
            'from' => $request->from,
            'to' => $request->to,
            'numSeats' => $request->numSeats,
            'time' => $request->time,
            'priceASeat' => $request->priceASeat,
            'status' => Constants::TRIP_STATUS['OPEN'],
        ])->id;

        //register A log:
        event(new addNewTrip(
            Constants::EVENT_TYPE['NEW_TRIP'],
            Constants::ACTOR_TYPE['COMPANY'],
            Session::get('LoggedCompany'),
            Constants::OBJECT_TYPE['TRIP'],
            $idTrip
        ));

        if ($idTrip) {
            return redirect()->back()->with(['addTripDone' => 'you have been added trip with id : ' . $idTrip . ' successfully']);
        } else {
            return redirect()->back()->with(['addTripFailed' => 'Failed Add A Trip ']);

        }
    }

    public function oldTrips()
    {
        $company = Company::where('id', Session::get('LoggedCompany'))->first();
        $trips = Trip::select('id', 'from', 'to', 'numSeats', 'time', 'status', 'priceASeat')
            ->where('compId', Session::get('LoggedCompany'))->get();
        return view('company.oldTrips', ['company' => $company, 'trips' => $trips]);

    }

    public function oldFilteredTrips(Request $request)
    {
        $company = Company::where('id', Session::get('LoggedCompany'))->first();
        $trips = Trip::select('id', 'from', 'to', 'numSeats', 'time', 'status', 'priceASeat')
            ->where('compId', Session::get('LoggedCompany'))
            ->get();
        $filtersTrips = $this->filter($trips, $request->all());
        return view('company.oldTrips', ['company' => $company, 'trips' => $filtersTrips]);
    }

    public function writePost()
    {
        $company = Company::where('id', Session::get('LoggedCompany'))->first();
        return view('company.writePost', ['company' => $company]);
    }

    public function savePost(Request $request)
    {
        //check if the account is Blocked
        if (Company::select('status')->where('id', Session::get('LoggedCompany'))->first()->status == Constants::COMPANY_STATUS['BLOCKED']) {
            return redirect()->back()->with(['writePostFailed' => 'your Account is Blocked']);
        }

        if (trim($request->all()['post']) == "") {
            return redirect()->back();
        }
        if (Session::has('LoggedCompany')) {
            $idPost = CompanyPost::create(['compId' => Session::get('LoggedCompany'), 'content' => $request->post])->id;

            //register A log:
            event(new addNewPost(
                Constants::EVENT_TYPE['NEW_POST'],
                Constants::ACTOR_TYPE['COMPANY'],
                Session::get('LoggedCompany'),
                Constants::OBJECT_TYPE['POST'],
                $idPost
            ));

            return redirect('/company-profile/news');
        }

        if (Session::has('LoggedPassenger')) {
            PassengerPost::create(['passId' => Session::get('LoggedPassenger'), 'content' => $request->post]);
            return redirect('/passenger-profile/news');
        }

    }

    public function news()
    {

        $company = Company::where('id', Session::get('LoggedCompany'))->first();
        $openTrips = Trip::with('company')->where('status', 'open')
            ->orderBy('created_at', 'desc')->get();
        $companyPosts = CompanyPost::with('company')->orderBy('created_at', 'desc')->get();
        $passengerPosts = PassengerPost::with('passenger')->orderBy('created_at', 'desc')->get();

        return view('company.company-news', [
            'company' => $company,
            'openTrips' => $openTrips,
            'passengerPosts' => $passengerPosts,
            'companyPosts' => $companyPosts,
        ]);
    }

    public function editTrip(Request $request)
    {
        $trip = Trip::where('id', $request->id)->first();

        $trip->from = is_null($request->from) ? $trip->from : $request->from;
        $trip->to = is_null($request->to) ? $trip->to : $request->to;
        $trip->numSeats = is_null($request->numSeats) ? $trip->numSeats : $request->numSeats;
        $trip->time = is_null($request->time) ? $trip->time : $request->time;
        $trip->priceASeat = is_null($request->priceASeat) ? $trip->priceASeat : $request->priceASeat;
        $trip->status = is_null($request->status) ? $trip->status : $request->status;

        if (date('Y/m/d H:i:s') > $request->time) {
            return redirect()->back()->with(['editFaild' => 'edit faild Trip with ID :' . $request->id . ' because choose a gone time']);
        }
        $trip->save();
        return redirect('company-profile/old-trips');

    }

    public function viewProfile()
    {
        $company = Company::where('id', Session::get('LoggedCompany'))->first();
        return view('company/viewProfile', [
                'company' => $company
            ]
        );

    }

    public function editProfile()
    {
        $company = Company::where('id', Session::get('LoggedCompany'))->first();
        return view('company/editCompanyProfile', [
                'company' => $company
            ]
        );


    }

    public function saveNewProfileInfo(Request $request)
    {
        $rules = [
            'compName' => 'regex:/^([^0-9]*)$/ | nullable',
            'email' => 'email:rfc| nullable',
            'telephone' => 'numeric| nullable',
            'address' => ' nullable ',
            'imagePath' => 'mimes:jpg,png,jpeg |max:5048' //specify file extension and size ;
        ];

        $validate = Validator::make($request->all(), $rules);

        if ($validate->fails()) return redirect()->back()->withErrors($validate);

        $comp_info = \App\Models\Company::where('id', Session::get('LoggedCompany'))->first();

        //Make sure that the chosen phone number is unique
        $another_comp = Company::where('id', '!=', Session::get('LoggedCompany'))
            ->where('telephone', $request->telephone)->first();

        if (!is_null($another_comp)) {
            return redirect('/company-profile/view-profile')->with(['failed_telephone' => 'This Telephone belongs to someone else.']);
        }
        //Make sure that the chosen idn number is unique
        $another_comp2 = Company::where('id', '!=', Session::get('LoggedCompany'))
            ->where('email', $request->email)->first();
        if (!is_null($another_comp2)) {
            return redirect('/company-profile/view-profile')->with(['failed_email' => 'This Email belongs to someone else.']);
        }

        //Work on putting a name for the image and store it somewhere
        if (!is_null($request->imagePath)) {
            $file_extension = $request->imagePath->getClientOriginalExtension();
            $file_name = time() . $request->imagePath->getClientOriginalName();
            $request->imagePath->move(Public_path('photos'), $file_name);

        }
        //restore new data
        $comp_info->compName = is_null($request->compName) ? $comp_info->compName : $request->compName;
        $comp_info->email = is_null($request->email) ? $comp_info->email : $request->email;
        $comp_info->telephone = is_null($request->telephone) ? $comp_info->telephone : $request->telephone;
        $comp_info->address = is_null($request->address) ? $comp_info->address : $request->address;

        $comp_info->imagePath = is_null($request->imagePath) ? $comp_info->imagePath : $file_name;
        $comp_info->save();

        return redirect('/company-profile/view-profile')->with(['comp_profile_edit_done' => 'Your data has been modified successfully']);
    }

    public function activityLog()
    {
        $company = Company::where('id', Session::get('LoggedCompany'))->first();
        $myLogs = EventLog::where('actorType', Constants::ACTOR_TYPE['COMPANY'])
            ->where('actorId', Session::get('LoggedCompany'))->get();
        for ($i = 0; $i < count($myLogs); $i++) {
            $n = Company::where('id', $myLogs[$i]->actorId)->first();
            $myLogs[$i]->actorType .= ' ' . $n->compName;
        }
        return view('company/companyLog', ['company' => $company, 'myLogs' => $myLogs]);
    }

    public function logOutComp()
    {
        Session::forget(['LoggedCompany']);
        return redirect('/home');
    }
}
