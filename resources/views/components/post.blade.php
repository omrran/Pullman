<div class="w-75 mt-1 mb-1 mx-auto">
    <div class="d-flex justify-content-start  bg-white p-1 rounded-border-post-header-custom">
        <img class="float-start rounded-circle " src="{{asset('photos/admin.png')}}"
             style="width: 50px;height: 50px" alt="">
        <div class="d-flex flex-column text-start">
            <h5 class="p-2 pb-0 mb-0">{{$companyName}}</h5>
            <small class="px-1">{{$postTime}}</small>
        </div>
    </div>
    <div class="w-100 border-0 m-0 h-auto bg-white p-2 text-start">
        {{$postContent}}
    </div>

    <div class="shadow d-flex   pt-1 pb-1  rounded-border-post-footer-custom w-100">
        <button type="submit" class="btn btn-w  p-0 w-25  mx-auto rounded-pill border-dark"><i
                class="fa fa-thumbs-o-up fs-4"></i> Like
        </button>
        <button type="submit" class="btn btn-w  p-0 w-25  mx-auto rounded-pill border-dark"><i
                class="fa fa-comment-o  fs-4"></i> Comment
        </button>
        {{--            <button type="submit" class="btn btn-primary  p-0 w-25  mx-auto rounded-pill"><i class="fa fa-thumbs-up fs-5"></i> </button>--}}
        {{--            <button type="submit" class="btn btn-secondary  p-0 w-25  mx-auto rounded-pill" title="comment"><i class="fa fa-comment fs-5"></i> </button>--}}
    </div>
</div>
