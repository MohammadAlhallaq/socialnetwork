@extends('layouts.app')



@section('content')

    <div class="container">
        <div class="col-lg-4">
            <div class="panel panel-default">


                <div class="panel-heading">
                    {{$user->name}}'s Profile.
                </div>

                <div class="panel-body text-center" >
                    <img src="{{$user->avatar}}" width="70px" height="70px" style="border-radius:50%; " alt="">
                </div>

                <p class="text-center">
                    {{$user->profile->location}}
                </p>



                        <p class="text-center">
                            @if(Auth::id() == $user->id)

                                <a href="{{route('profile.edit')}}" class="btn btn-primary btn-group-lg">Edit Your Profile</a>

                            @endif
                        </p>

            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <friend :auth_user="{{Auth::id()}}" :profile_user_id="{{$user->id}}" ></friend>
                </div>
            </div>
        </div>
    </div>

    @endsection


