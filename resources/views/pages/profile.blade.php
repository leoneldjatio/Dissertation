@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-5 w-75 mx-auto">
            <div class="card-header text-center">
                <h3 class="card-title">Update Profile</h3>
            </div>
            <div class="card-body">
                @foreach($users as $user)
                @if($user->id == $id)
                <form method="post" role="form" enctype="multipart/form-data" action="/update/{{$user->id}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="name" placeholder="Username" value="{{$user->name}}" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$user->email}}" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required disabled="disabled">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" id="show-password" class="form-check-input" onclick="myFunction()">
                        <label for="show-password" class="form-check-label">Show Password</label>
                    </div>
                    <div class="form-group text-center">
                        <a href="/gallery" class="btn btn-secondary">Back</a>
                        <button type="button" class="btn btn-success edit-profile">Edit Profile <i class="fa fa-pencil ml-1"></i></button>
                    </div>
                </form>
                    @endif
                    @endforeach
            </div>
        </div>
    </div>
<script type="text/javascript">
    const editProfileBtn = document.getElementsByClassName("edit-profile")[0];
    const inputs = document.getElementsByClassName('form-control');
    console.log(inputs);

    editProfileBtn.addEventListener('click', function(){
        for(let i = 1; i < inputs.length; i++) {
            inputs[i].removeAttribute('disabled');
        }

        this.innerHTML = "Update profile <i class='fa fa-check ml-1'></i>";
        this.setAttribute('type', 'submit');
    });
</script>

    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection