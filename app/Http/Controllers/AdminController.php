<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyPost;
use App\Models\EventLog;
use App\Models\Passenger;
use App\Models\PassengerPost;
use App\Models\Post;
use App\Models\ReserveList;
use App\Models\Trip;
use App\Traits\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Context;

class AdminController extends Controller
{

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


    public function adminProfile()
    {
        if (Session::has('LoggedAdmin'))
            return view('admin/adminProfile', ['pageName' => 'Home Profile']);
    }

    public function adminProfile_companies()
    {
        $Comps = Company::select('id', 'compName', 'email', 'telephone', 'address', 'status')->where('status', '!=', Constants::COMPANY_STATUS['PENDING'])->get();

        return view('admin/adminCompanies', ['pageName' => 'Companies', 'Comps' => $Comps]);
    }

    public function adminProfile_blockComp($id)
    {
        $Comp = \App\Models\Company::where('id', $id)->first();
        $Comp->status = Constants::COMPANY_STATUS['BLOCKED'];
        $Comp->save();
        return redirect()->back();
    }

    public function adminProfile_unBlockComp($id)
    {
        $Comp = \App\Models\Company::where('id', $id)->first();
        $Comp->status = Constants::COMPANY_STATUS['UNBLOCKED'];
        $Comp->save();
        return redirect()->back();
    }

    public function adminProfile_passengers()
    {
        $passengers = Passenger::get();
        return view('admin/adminPassengers', ['pageName' => 'Passengers', 'passengers' => $passengers]);
    }

    public function adminProfile_blockPassenger($id)
    {
        $passenger = Passenger::where('id', $id)->first();
        $passenger->status = Constants::PASSENGER_STATUS['BLOCKED'];
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
        $passenger->status = Constants::PASSENGER_STATUS['UNBLOCKED'];
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

        $pendComps = Company::select('id', 'compName', 'email', 'telephone', 'address')->where('status', Constants::COMPANY_STATUS['PENDING'])->get();
//        return $pendComps;
        return view('admin/adminCompaniesRequests', ['pageName' => 'Companies Requests', 'pendingComps' => $pendComps]);
    }

    public function activateCompany($id)
    {

        $pendComp = Company::where('id', $id)->first();
        $pendComp->status = Constants::COMPANY_STATUS['UNBLOCKED'];
        return $pendComp->save();

    }

    public function adminProfile_logs()
    {
        $allLogs = EventLog::get();
        for ($i = 0; $i < count($allLogs); $i++) {
            if ($allLogs[$i]->actorType == Constants::ACTOR_TYPE['PASSENGER']) {
                $n = Passenger::select('fName', 'lName')->where('id', $allLogs[$i]->actorId)->first();
                $n = $n->fName . ' ' . $n->lName;
                $allLogs[$i]->actorType .= ' ' . $n;

            }
            if ($allLogs[$i]->actorType == Constants::ACTOR_TYPE['COMPANY']) {
                $n = Company::where('id', $allLogs[$i]->actorId)->first();
                $allLogs[$i]->actorType .= ' ' . $n->compName;
            }

        }
        return view('admin/adminLogs', ['pageName' => 'Logs', 'allLogs' => $allLogs]);
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
            'status' => Constants::TRIP_STATUS['OPEN'],
        ])->id;

    }

    public function showACompany($id)
    {
        $Comps = Company::select('id', 'compName', 'email', 'telephone', 'address', 'status')->where('id', $id)->get();
        return view('admin/adminCompanies', ['pageName' => 'Companies', 'Comps' => $Comps]);

    }

    public function showAPassenger($id)
    {
        $passengers = Passenger::where('id', $id)->get();
        return view('admin/adminPassengers', ['pageName' => 'Passengers', 'passengers' => $passengers]);
    }

    public function showATrip($id)
    {
        $trip = Trip::with('company')->where('id', $id)->first();
        return view('admin/showATrip', ['pageName' => 'Trip', 'trip' => $trip]);

    }

    public function showACompPost($id)
    {
        $post = CompanyPost::with('company')->where('id',$id)->first();
        return view('admin/showAPost',['pageName' => 'Company Post', 'post' => $post]);

    }

    public function showAPassPost($id)
    {
        $post = PassengerPost::with('passenger')->where('id',$id)->first();
        return view('admin/showAPost',['pageName' => 'Passenger Post', 'post' => $post]);

    }

    public function showAReserve($id)
    {
        $tripId = ReserveList::where('id',$id)->first()->id;
        $trip = Trip::with('company')->where('id', $tripId)->first();
        return view('admin/showATrip', ['pageName' => 'Reserve In Trip', 'trip' => $trip]);
    }


    public function logOutAdm()
    {
        Session::forget(['LoggedAdmin']);
        return redirect('/home');
    }

    public function getCompanies()
    {

        $companies = Company::where('status','!=',Constants::COMPANY_STATUS['PENDING'])->get();
        return view('companies', compact('companies'));
    }


}
