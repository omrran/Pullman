<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyPost;
use App\Models\Passenger;
use App\Models\PassengerPost;
use App\Models\Post;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
//    const PENDING ='pending';
//    const BLOCKED ='blocked';
//    const UNBLOCKED ='unblocked';
    const COMPANY_STATUS = [
        'PENDING' => 'pending',
        'BLOCKED' => 'blocked',
        'UNBLOCKED' => 'unblocked'
    ];
    const PASSENGER_STATUS = [
        'BLOCKED' => 'blocked',
        'UNBLOCKED' => 'unblocked'
    ];
    //this value is used in oldTrips.blade.php
    const TRIP_STATUS = [
        'OPEN' => 'open',
        'CLOSED' => 'closed',
        'GONE' => 'gone'
    ];

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

        return $this->validationBeforeRegistration($request, $rules, $massages, '/login-company', 'addNewCompany');

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


        return $this->validationBeforeRegistration($request, $rules, $massages, '/login-passenger', 'addNewPassenger');
    }


    //custom function : validation and add new record to DB and and redirect to convenient path
    public function validationBeforeRegistration($request, $rules, $massages, $redirectTo, $addToDB)
    {

        $validate = Validator::make($request->all(), $rules, $massages);

        if ($validate->fails()) return redirect()->back()->withErrors($validate);

        // here insert to database:
        $this->$addToDB($request);
        return redirect($redirectTo)->with(['Success' => 'your register is done']);

    }

    public function addNewCompany($request)
    {
        Company::create([
            'compName' => $request->compName,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'status' => self::COMPANY_STATUS['PENDING'],
            'password' => Hash::make($request->password),
        ]);

    }

    public function addNewPassenger($request)
    {
        Passenger::create([
            'fName' => $request->fName,
            'lName' => $request->lName,
            'phone' => $request->phone,
            'idn' => $request->idn,
            'status' => self::PASSENGER_STATUS['UNBLOCKED'],
            'password' => Hash::make($request->password)
        ]);
    }

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
            if ($comp->status == self::COMPANY_STATUS['PENDING']) {
                return redirect()->back()->with(['pendingAccount' => 'you account still pending....! ']);
            } elseif (!Hash::check($request->password, $comp->password)) {
                return redirect()->back()->with(['PasswordFailed' => 'Wrong Password !']);
            }
            Session::put('LoggedCompany', $comp->id);
            return redirect('/company-profile');


        } else {
            return redirect('/joinUs-company')->with(['EmailFailed' => 'This email is not registered on the website']);

        }

    }

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

    public function checkAdminLogin(Request $request)
    {
        $admin = DB::table('admin')->select('id', 'password')->first();

        if (!is_null($admin)) {
            if ($request->password == $admin->password) {
                Session::put('LoggedAdmin', $admin->id);
                return redirect('/admin-profile');
            } else
                return redirect()->back()->with(['PasswordFailed' => 'Wrong Password !']);


        } else
            return "admin table is empty";


    }

    public function passengerProfile()
    {
        if (Session::has('LoggedPassenger')) {
            $pass = Passenger::where('id', Session::get('LoggedPassenger'))->first();

            return view('passengerProfile', compact('pass'));
        }

    }

    public function adminProfile()
    {
        if (Session::has('LoggedAdmin'))
            return view('adminProfile', ['pageName' => 'Home Profile']);
    }

    public function adminProfile_companies()
    {
        $Comps = Company::select('id', 'compName', 'email', 'telephone', 'address', 'status')->where('status', '!=', self::COMPANY_STATUS['PENDING'])->get();

        return view('adminCompanies', ['pageName' => 'Companies', 'Comps' => $Comps]);
    }

    public function adminProfile_blockComp($id)
    {
        $Comp = \App\Models\Company::where('id', $id)->first();
        $Comp->status = self::COMPANY_STATUS['BLOCKED'];
        $Comp->save();
        return redirect()->back();
    }

    public function adminProfile_unBlockComp($id)
    {
        $Comp = \App\Models\Company::where('id', $id)->first();
        $Comp->status = self::COMPANY_STATUS['UNBLOCKED'];
        $Comp->save();
        return redirect()->back();
    }

    public function adminProfile_passengers()
    {
        $passengers = Passenger::get();
        return view('adminPassengers', ['pageName' => 'Passengers', 'passengers' => $passengers]);
    }

    public function adminProfile_blockPassenger($id)
    {
        $passenger = Passenger::where('id', $id)->first();
        $passenger->status = self::PASSENGER_STATUS['BLOCKED'];
        $passenger->save();
        return [
            'id' => $passenger['id'],
            'fName' => $passenger['fName'],
            'lName' => $passenger['lName'],
            'phone' => $passenger['phone'],
            'idn' => $passenger['idn'],
            'status' => $passenger['status']
        ];
    }

    public function adminProfile_unBlockPassenger($id)
    {
        $passenger = Passenger::where('id', $id)->first();
        $passenger->status = self::PASSENGER_STATUS['UNBLOCKED'];
        $passenger->save();
        return [
            'id' => $passenger['id'],
            'fName' => $passenger['fName'],
            'lName' => $passenger['lName'],
            'phone' => $passenger['phone'],
            'idn' => $passenger['idn'],
            'status' => $passenger['status']
        ];
    }

    public function adminProfile_companies_requests()
    {

        $pendComps = Company::select('id', 'compName', 'email', 'telephone', 'address')->where('status', self::COMPANY_STATUS['PENDING'])->get();
//        return $pendComps;
        return view('adminCompaniesRequests', ['pageName' => 'Companies Requests', 'pendingComps' => $pendComps]);
    }

    public function activateCompany($id)
    {

        $pendComp = Company::where('id', $id)->first();
        $pendComp->status = self::COMPANY_STATUS['UNBLOCKED'];
        return $pendComp->save();

    }

    public function adminProfile_logs()
    {
        return view('adminLogs', ['pageName' => 'Logs']);
    }


    public function companyProfile()
    {
        if (Session::has('LoggedCompany')) {
            $company = Company::where('id', Session::get('LoggedCompany'))->first();
            return view('companyProfile', compact('company'));
        }
    }

    public function getTripForm()
    {
        if (Session::has('LoggedCompany')) {
            $company = Company::where('id', Session::get('LoggedCompany'))->first();
            return view('tripForm', compact('company'));
        }
    }

    public function addTrip(Request $request)
    {
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
        $idTrip = $this->addNewTrip($request);
        if ($idTrip) {
            return redirect()->back()->with(['addTripDone' => 'you have been added trip with id : ' . $idTrip . ' successfully']);
        } else {
            return redirect()->back()->with(['addTripFailed' => 'Failed Add A Trip ']);

        }
    }

    //add new trip and return its id ;
    public function addNewTrip($request)
    {
        return Trip::create([
            'compId' => Session::get('LoggedCompany'),
            'from' => $request->from,
            'to' => $request->to,
            'numSeats' => $request->numSeats,
            'time' => $request->time,
            'priceASeat' => $request->priceASeat,
            'status' => self::TRIP_STATUS['OPEN'],
        ])->id;

    }

    public function oldTrips()
    {
        $company = Company::where('id', Session::get('LoggedCompany'))->first();
        $trips = Trip::select('id', 'from', 'to', 'numSeats', 'time', 'status', 'priceASeat')
            ->where('compId', Session::get('LoggedCompany'))->get();
        return view('oldTrips', ['company' => $company, 'trips' => $trips]);

    }

    public function oldFilteredTrips(Request $request)
    {
        $company = Company::where('id', Session::get('LoggedCompany'))->first();
        $trips = Trip::select('id', 'from', 'to', 'numSeats', 'time', 'status', 'priceASeat')
            ->where('compId', Session::get('LoggedCompany'))
            ->get();
        $filtersTrips = $this->filter($trips, $request->all());
        return view('oldTrips', ['company' => $company, 'trips' => $filtersTrips]);
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

    public function writePost()
    {
        $company = Company::where('id', Session::get('LoggedCompany'))->first();
        return view('writePost', ['company' => $company]);
    }

    public function savePost(Request $request)
    {
        if (trim($request->all()['post']) == "") {
            return redirect()->back();
        }
        if (Session::has('LoggedCompany'))
            CompanyPost::create(['compId' => Session::get('LoggedCompany'), 'content' => $request->post]);
        if(Session::has('LoggedPassenger'))
            PassengerPost::create(['passId' => Session::get('LoggedPassenger'), 'content' => $request->post]);

        return redirect('/company-profile/news');
    }

    public function news()
    {
        $company = Company::where('id', Session::get('LoggedCompany'))->first();
        $openTrips = Trip::with('company')->where('status','open')->get();
        $companyPosts = CompanyPost::with('company')->get();
        $passengerPosts = PassengerPost::with('passenger')->get();

        return view('news', [
            'company' => $company,
            'openTrips' => $openTrips,
            'passengerPosts' => $passengerPosts,
            'companyPosts' => $companyPosts,
        ]);
    }

    public function logOutPass()
    {
        Session::forget(['LoggedPassenger']);
        return redirect('/home');
    }

    public function logOutComp()
    {
        Session::forget(['LoggedCompany']);
        return redirect('/home');
    }

    public function logOutAdm()
    {
        Session::forget(['LoggedAdmin']);
        return redirect('/home');
    }

    public function getCompanies()
    {

        $companies = Company::get();
        return view('companies', compact('companies'));
    }

}
