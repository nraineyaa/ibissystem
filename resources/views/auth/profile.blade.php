@extends('layouts.sideNav')
@section('content')

<!-- Page Header -->
<div class="page-header row no-gutters pb-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0 d-flex">
        <h1 class="page-title ml-3">Edit Profile</h1>
    </div>
</div>
<!-- display all from registration -->
<div class="row">
    <div class="col-md-4">
        <div class="card card-small mb-3">
            <div class="card-header border-bottom text-center">
                <div class="mb-3 mx-auto">
                    <img class="rounded-circle" src="{{asset('uploads/'. Auth::user()->picture)}} " alt=" User Avatar" width="110" height="110">
                </div>
                <h4 class="mb-2">{{ Auth::user()->name }}</h4>
                <span class="text-muted d-block mb-4">{{ Auth::user()->category }}</span>
                <button type="button" class="mb-4 btn btn-sm btn-pill btn-outline-primary mr-2" data-toggle="modal" data-target="#modalProfile">
                    <i class="material-icons mr-1"></i>Change Profile</button>
                <button type="button" class="mb-4 btn btn-sm btn-pill btn-outline-primary mr-2" data-toggle="modal" data-target="#modalPassword">
                    <i class="material-icons mr-1"></i>Change Password</button>
            </div>

        </div>
    </div>

    <div class="col-md-8">
        <div class="card" style="padding: 20px;">
            <form method="get" action="{{ url('/editProfile' . '/' . $user->id) }}">
                <div class="form-row">
                    <div class="col-lg col-md-6 col-sm-6 mb-4">
                        <label for="name">Name</label>
                        <input type="name" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="col-lg col-md-6 col-sm-6 mb-4">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-lg col-md-6 col-sm-6 mb-4">
                        <label for="staffID">Employee ID</label>
                        <input type="text" class="form-control" id="staffID" name="staffID" value="{{ $user->staffID }}" required>
                    </div>
                    <div class="col-lg col-md-6 col-sm-6 mb-4">
                        <label for="phoneNum">Phone Number</label>
                        <input type="text" class="form-control" id="phoneNum" name="phoneNum" value="{{ $user->phoneNum }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}" readonly>
                </div>

                <div class="form-group">
                    <label for="inputAddress">User Type</label>
                    <input type="text" class="form-control" id="category" name="category" value="{{ $user->category }}" readonly>
                </div>

                <button type="submit" class="btn btn-primary mr-2">Update</button>
                <a href="{{ route('dashboard') }}" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
</div>


<!-- Modal Change profile-->
<div class="modal fade" id="modalProfile" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change Profile Image</h4>
            </div>
            <div class="card-body">

                <form method="POST" enctype="multipart/form-data" action="{{route('updateAvatar')}}" onsubmit="upload()">
                    @csrf
                    @method('POST')
                    <div class="form-group row">


                        <div class="col-md-12">
                            <input type="file" class="form-control" name="avatar" id="avatarFile" aria-describedby="fileHelp" required>
                            <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="float: right;">
                        Upload
                    </button>


                </form>
            </div>
        </div>
    </div>

</div>

<!-- Modal Change Password-->
<div class="modal fade" id="modalPassword" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="card-body">

                <form method="POST" enctype="multipart/form-data" action="{{route('updatePassword')}}" onsubmit="upload()">
                    @csrf

                    <div class="form-group row">


                        <div class="col-md-12">
                            <small class="form-text text-muted">New Password</small>
                            <input type="password" class="form-control" id="password" name="password">

                        </div>
                        <div class="col-md-12">
                            <small class="form-text text-muted">Confirm-Password</small>
                            <input type="password" class="form-control" id="confirmPass" name="confirmPass">

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="float: right;">
                        Submit
                    </button>


                </form>
            </div>
        </div>
    </div>

</div>

<script>
    function upload() {

        let timerInterval
        Swal.fire({
            title: 'Updating...',
            showConfirmButton: false,
            html: 'Please wait while system updating your profile picture.',
            timerProgressBar: true,
            allowOutsideClick: false,
            willOpen: () => {
                Swal.showLoading()

            }
        })
    }



    function updateData(e) {

        var link = e.getAttribute('data-link')
        var idform = e.getAttribute('data-idform')
        var successLink = e.getAttribute('data-successLink')
        var btnBefore = e.innerHTML
        var btnNameChange = e.getAttribute('data-btnNameChange')

        var input = $("#" + idform + " :input").serialize();

        $.ajax({
            type: 'POST',
            url: link,
            data: input,
            beforeSend: function() {
                e.disabled = true;
                e.innerHTML = "<i class='fas fa-spinner fa-spin text-white'></i> <span class = 'nav-link-text' > " + btnNameChange + " </span>";
                //$('.ajax-loader').css("visibility", "visible");
            },

            success: function(data) {
                if (data.dataError == null) {
                    if (successLink != null) {
                        loadInPage(successLink);
                    }
                } else {
                    alert(data.title, data.text, 'warning', successLink)
                }

            },

            complete: function() {

                //dismiss loder
                e.disabled = false;
                e.innerHTML = btnBefore;
                //$('.ajax-loader').css("visibility", "hidden");
            },
            error: function(request, status, error) {
                //console.log(request.responseText);
            }

        });

        setTimeout(function() {
            location.reload();
        }, 500);
    }
</script>

@endsection