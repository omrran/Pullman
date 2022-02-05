<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyPost;
use App\Models\Passenger;
use App\Models\PassengerPost;
use App\Models\Post;
use App\Models\ReserveList;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{

    const COMPANY_STATUS = [
        'PENDING' => 'pending',
        'BLOCKED' => 'blocked',
        'UNBLOCKED' => 'unblocked'
    ];

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

    public function reserveASeat($tripId)
    {
        $trip = Trip::with('company')->where('id', $tripId)->first();
        $re = ReserveList::where('passId', Session::get('LoggedPassenger'))->where('tripId', $tripId)->get();

        if ($trip->numSeats == 0) {
            return response()->json([
                'res' => false
            ]);
        }
        if (count($re) != 0) {
            return response()->json([
                'res' => 'you already reserve a seat in this trip'
            ]);
        } else if (count($re) == 0) {
            $result = DB::transaction(function () use ($tripId, $trip) {
                ReserveList::create([
                    'tripId' => $tripId,
                    'passId' => Session::get('LoggedPassenger'),
                    'compName' => $trip->company->compName,
                    'time' => $trip->time
                ]);

                $trip->numSeats--;
                $trip->save();
                return true;
            });

            return response()->json([
                'res' => $result
            ]);

        }

    }


}
