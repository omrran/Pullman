@extends('company.companyProfile')

@section('main content')
    @if(count($trips)==0)
        <div id="no" class="alert alert-warning">
            no Trips ...........!
            <strong class="text-danger bg-white rounded-circle p-1 float-end mouse-custom-hover" onclick="hide('no')"> X </strong>
        </div>
    @endif
    <div class="m-auto p-3  border rounded-bottom rounded-circle bg-blue text-light">
        Old Trips
    </div>
    <div class=" w-100 mx-auto border border-primary border-3 rounded-3 p-2 d-flex flex-wrap justify-content-center">
        <div class="w-95 bg-dark text-white px-2 fs-5 rounded-1 mouse-custom-hover" onclick="showfilterItems('filterItems')">
            <img src="{{asset('photos/filter.png')}}"
                 width="40px" height="40px" class="p-1">
            Filter
        </div>
        <div id="filterItems" class="w-95  border border-dark p-1 rounded-1  d-none">
            <form method="POST" action="/company-profile/old-trips-filter">
                @csrf
                <span>From :</span>
                <select name="from" class="form-select form-select-sm w-25 d-inline"
                        aria-label=".form-select-sm example">
                    <option selected value=""></option>
                    <option value="damascus">Damascus</option>
                    <option value="aleppo">Aleppo</option>
                    <option value="hama">Hama</option>
                    <option value="homs">Homs</option>
                    <option value="idlib">Idlib</option>
                    <option value="qounaitera">Qounaitera</option>
                    <option value="daraa">Daraa</option>
                    <option value="latakia">latakia</option>
                    <option value="tartous">Tartous</option>
                    <option value="al-souaidaa">al-souaidaa</option>
                    <option value="der-zor">Der-zor</option>
                    <option value="hasaka">Hasaka</option>
                    <option value="raqa">Raqa</option>
                </select>
                <span>To :</span>
                <select name="to" class="form-select form-select-sm w-25 d-inline"
                        aria-label=".form-select-sm example">
                    <option selected value=""></option>
                    <option value="damascus">Damascus</option>
                    <option value="aleppo">Aleppo</option>
                    <option value="hama">Hama</option>
                    <option value="homs">Homs</option>
                    <option value="idlib">Idlib</option>
                    <option value="qounaitera">Qounaitera</option>
                    <option value="daraa">Daraa</option>
                    <option value="latakia">latakia</option>
                    <option value="tartous">Tartous</option>
                    <option value="al-souaidaa">al-souaidaa</option>
                    <option value="der-zor">Der-zor</option>
                    <option value="hasaka">Hasaka</option>
                    <option value="raqa">Raqa</option>
                </select>
                <span>Status :</span>
                <select name="status" class="form-select form-select-sm w-25 d-inline"
                        aria-label=".form-select-sm example">
                    <option selected value=""></option>
                    <option value="open">Open</option>
                    <option value="closed">Closed</option>
                    <option value="gone">Gone</option>
                </select><br><br>
                <span>Before Date :</span><br>
                <input type="datetime-local" class="form-control w-50 mb-1"
                       style="display: inline"
                       name="beforeDate"/><br>

                <span>After Date :</span><br>
                <input type="datetime-local" class="form-control w-50 mb-1"
                       style="display: inline"
                       name="afterDate"/><br>
                <hr class="m-0 mb-1">
                <button type="submit" class="btn btn-primary w-25 p-0 mx-auto float-end">Go</button>

            </form>

        </div>

        @if(Session::has('editFaild'))
            <div class="alert alert-success mx-auto">
                <strong>Ops!</strong> {{Session::get('editFaild')}}
            </div>
        @endif
        @foreach($trips as $trip)
            <div id="" class="bg-body shadow-on-hover p-2 w-75  m-2 border rounded-3">
                <h5 class="text-start text-primary">
                    Trip ID : {{$trip->id}}
                </h5>

                <hr class="m-0">

                <div id="info{{$trip->id}}">
                    <p class="text-start m-2"><strong>From</strong> :{{$trip->from}} </p>
                    <p class="text-start m-2"><strong>To</strong> :{{$trip->to}} </p>
                    <p class="text-start m-2"><strong>Num Seats</strong> : {{$trip->numSeats}}</p>
                    <p class="text-start m-2"><strong>Price A Seat</strong> : {{$trip->priceASeat}}</p>
                    <p class="text-start m-2"><strong>Time</strong> : {{$trip->time}}</p>
                    <p class="text-start m-2"><strong>Status</strong> : {{$trip->status}}</p>
                </div>

                <form id="form{{$trip->id}}" action="{{url('/company-profile/edit-trip')}}" method="POST"
                      style="display:none">
                    @csrf
                    <input type="text"
                           value="{{$trip->id}}"
                           class="form-control w-50 mb-1"
                           style="display: none"
                           name="id"
                    /><br>
                    <strong>From<span style="visibility:hidden ">cccccc</span>:</strong>
                    <select name="from" class="form-select form-select-sm w-50 d-inline"
                            aria-label=".form-select-sm example" >
                        <option selected value="{{$trip->from}}">{{ucfirst($trip->from)}} </option>
                        <option value="damascus">Damascus</option>
                        <option value="aleppo">Aleppo</option>
                        <option value="hama">Hama</option>
                        <option value="homs">Homs</option>
                        <option value="idlib">Idlib</option>
                        <option value="qounaitera">Qounaitera</option>
                        <option value="daraa">Daraa</option>
                        <option value="latakia">latakia</option>
                        <option value="tartous">Tartous</option>
                        <option value="al-souaidaa">al-souaidaa</option>
                        <option value="der-zor">Der-zor</option>
                        <option value="hasaka">Hasaka</option>
                        <option value="raqa">Raqa</option>
                    </select><br>

                    <strong>To<span style="visibility:hidden ">ccccccccc</span>:</strong>
                    <select name="to" class="form-select form-select-sm w-50 d-inline"
                            aria-label=".form-select-sm example" >
                        <option selected value="{{$trip->to}}">{{ucfirst($trip->to)}} </option>
                        <option value="damascus">Damascus</option>
                        <option value="aleppo">Aleppo</option>
                        <option value="hama">Hama</option>
                        <option value="homs">Homs</option>
                        <option value="idlib">Idlib</option>
                        <option value="qounaitera">Qounaitera</option>
                        <option value="daraa">Daraa</option>
                        <option value="latakia">latakia</option>
                        <option value="tartous">Tartous</option>
                        <option value="al-souaidaa">al-souaidaa</option>
                        <option value="der-zor">Der-zor</option>
                        <option value="hasaka">Hasaka</option>
                        <option value="raqa">Raqa</option>
                    </select><br>

                    <strong>Num Seats :</strong>
                    <input type="number"
                           value="{{$trip->numSeats}}"
                           class="form-control w-50 mb-1"
                           style="display: inline"
                           name="numSeats"
                    /><br>

                    <strong>Price A Seat :</strong>
                    <input type="number"
                           value="{{$trip->priceASeat}}"
                           class="form-control w-50 mb-1"
                           style="display: inline"
                           name="priceASeat"/><br>


                    <strong>Time<span style="visibility:hidden ">cccccc</span>:</strong>
                    <input type="text"
                           value="{{$trip->time}}"
                           class="form-control w-50 mb-1"
                           style="display: inline"
                           name="time"
                           onfocus="convertInputTypeToDate(this)"
                    /><br>

                    <strong>Status<span style="visibility:hidden ">ccccc</span>:</strong>
                    <select name="status" class="form-select form-select-sm w-50 d-inline"
                            aria-label=".form-select-sm example">
                        <option selected value="{{$trip->status}}">{{ucfirst($trip->status)}}</option>
                        <option value="open">Open</option>
                        <option value="closed">Closed</option>
                        <option value="gone">Gone</option>
                    </select>
                    {{--                    <input type="text" value="{{$trip->status}}" class="form-control w-50 mb-1 d-inline"--}}
                    {{--                           name="status"/><br>--}}


                    <hr class="m-0">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-75 p-0">Save</button>
                        <div type="button" onclick="displayInfoTrip({{$trip->id}})"
                             class="btn btn-secondary   p-0 w-75">
                            Cancel
                        </div>
                    </div>


                </form>
                <hr class="m-0">
                <div id="edit{{$trip->id}}" type="button" onclick="displayEditForm(this,{{$trip->id}})"
                     class="btn btn-warning  mt-1 p-0 w-100 text-white">
                    Edit
                </div>
            </div>
        @endforeach
    </div>






@endsection
