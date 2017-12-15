@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Profile</div>

                    <div class="panel-body">

                        <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">

                            {{csrf_field()}}

                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" id="location" class="form-control" name="location" value="{{$info->location}}" required>
                            </div>

                            <div class="form-group">
                                <label for="about">About</label>
                                <textarea class="form-control" name="about" id="about" cols="30" rows="10" required> {{$info->about}}</textarea>
                            </div>


                            <div class="form-group">
                                <label for="avatar">Edit Avatar</label>
                                <input type="file" name="avatar" accept="image/*" id="avatar">
                            </div>


                            <div class="form-group">
                                <p class="text-center">
                                    <button class="btn btn-primary btn-group-lg" type="submit">
                                        Save Your Information
                                    </button>
                                </p>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer')
    <script>

        @if(Session::has('success'))

        new Noty({
            timeout: 1500,
            type: 'success',
            layout: 'top',
            text: '{{Session::get('success')}}',
        }).show();

        @endif


    </script>
    @endsection
