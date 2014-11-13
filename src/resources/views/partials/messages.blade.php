{{-- Created by anderson.mota on 13/11/2014. --}}
@if ($errors->has())
<div data-alert class="alert-box alert">
    <a href="#" class="close">&times;</a>
    @foreach ($errors->all() as $error)
        <span>{{$error}}</span><br/>
    @endforeach
</div>
@endif
@if(Session::has('message'))
<div data-alert class="alert-box success">
    <a href="#" class="close">&times;</a>
    <i class="fa fa-check"></i> {{Session::get('message')}}
</div>
@endif