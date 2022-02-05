{{-- <div class="card">
    <div><img src="{{asset('photos/logo.png')}}"></div>
    <div style="background-color: #3a9191">{{$name}}</div>
    <div style="background-color: #b43d86">{{$address}}</div>
    <div style="background-color: rgba(158,213,110,0.16)">{{$telephone}}</div>

</div> --}}

<div class="card bg-secondary m-3" style="width: 18rem;">
    <img src="{{asset('photos/'.$photo)}}" class="card-img-top img-thumbnail"  alt="...">
    <div class="card-body">
      <h5 class="card-title">{{$name}}</h5>
      <p class="card-text">Address :{{$address}}</p>
      <p class="card-text">Telephone :{{$telephone}}</p>
      {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
    </div>
  </div>
