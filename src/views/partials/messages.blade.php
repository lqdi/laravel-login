{{-- Created by anderson.mota on 13/11/2014. --}}
@if ($errors->has())
<div data-alert class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
</div>
@endif
@if(Session::has('message'))
<div data-alert class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <i class="fa fa-check"></i> {{Session::get('message')}}
</div>
@endif