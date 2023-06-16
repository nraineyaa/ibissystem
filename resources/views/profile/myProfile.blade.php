@extends('layouts.app')
@section('content')


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<!-- Default Light Table -->
<title>IBIS-ms | My Profile </title>
<link rel="shortcut icon" href="bootstrap1\assets\images\logoibis.png" type="image/png" />

<br>
<div class="container">
    <div class="row justify-content-center">
        <div class=" col-md-8">
            <div class="card card-small mb-3 pt-0">
                <div class="card-header border-bottom text-center">
                    <div class="mb-3 mx-auto">
                        <img class="rounded-circle" src="asset/uploads/. {{Auth::user()->picture}}" alt=" User Avatar" width="110" height="110">
                    </div>
                    <h4 class="mb-0">{{ Auth::user()->name }}</h4>
                    <span class="text-muted d-block mb-2">{{ Auth::user()->category }}</span>
                    <button type="button" class="mb-2 btn btn-sm btn-pill btn-outline-primary mr-2" data-toggle="modal" data-target="#modalProfile">
                        <i class="material-icons mr-1"></i>Change Profile</button>
                    <button type="button" class="mb-2 btn btn-sm btn-pill btn-outline-primary mr-2" data-toggle="modal" data-target="#modalPassword">
                        <i class="material-icons mr-1"></i>Change Password</button>
                </div>

            </div>
        </div>


        <div class="col-lg-8">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Account Details</h6>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-3">
                        <div class="row">
                            <div class="col">
                                <form action="" enctype="multipart/form-data" method="post" id="updateProfile">
                                    @csrf
                                    @method('post')

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <b for="name">Name</b>
                                            <input type="text" class="form-control" id="name" name="name" value="{{auth()->user()->name}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <b for="name">Staff ID</b>
                                            <input type="staffId" class="form-control" id="staffID" readonly class="form-control-plaintext" name="staffID" value="{{auth()->user()->staffID}}" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <b for="feEmailAddress">Email</b>
                                            <input type="email" class="form-control" name="email" readonly class="form-control-plaintext" id="feEmailAddress" value="{{$userData->email}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <b for="feEmailAddress">Phone Number</b>
                                            <input type="text" name="phoneNum" class="form-control" id="phoneNum" value="{{$userData->phoneNum}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <b for="address">Address</b>
                                            <input type="address" name="address" class="form-control" id="address" value="{{$userData->address}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <b for="category">Category</b>
                                            <input type="category" class="form-control" name="category" readonly class="form-control-plaintext" id="category" value="{{$userData->category}}">
                                        </div>
                                    </div>

                                    <br>
                                    <div style="float: right;">
                                        <button type="button" class="btn btn-primary btn-md" id="btn" onclick="updateData(this)" data-link="{{ route('updateProfile', $userData->id) }}" data-idform="updateProfile" data-btnNameChange="Updating...">Update Account</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Default Light Table -->



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
                <h4 class="modal-title">Change Passwordaaaaaaaa</h4>
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