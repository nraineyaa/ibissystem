@extends('layouts.sideNav')
@section('content')



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <form enctype="multipart/form-data" method="POST" id="updateUser">
                    @csrf
                    @method('post')

                    <center>
                        <div class="mb-3 mx-auto">
                            <img class="rounded-circle" src="{{asset('uploads/'.$register->picture)}}" alt=" User Avatar" width="110" height="110">
                        </div>
                    </center>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Employee Email </label>
                            <input type="text" class="form-control" id="email" name="email" value="{{$register->email}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ic">Identification No</label>
                            <input type="text" class="form-control" id="ic" name="ic" value="{{$register->ic}}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$register->name}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Employee ID</label>
                            <input type="text" class="form-control" id="staffID" name="staffID" value="{{$register->staffID}}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="phoneNum">Phone Number</label>
                            <input type="text" class="form-control" id="phoneNum" name="phoneNum" value="{{$register->phoneNum}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="position">User Type</label>
                            <select class="form-control" name="category" id="category">

                                @if($register->category == "Supervisor")
                                <option value="Supervisor" selected>Supervisor</option>
                                <option value="Accountant">Accountant</option>
                                <option value="Human Resource">Human Resource</option>
                                <option value="Worker">Worker</option>

                                @elseif($register->category == "Supervisor")
                                <option value="Supervisor">Supervisor</option>
                                <option value="Accountant" selected>Accountant</option>
                                <option value="Human Resource">Human Resource</option>
                                <option value="Worker">Worker</option>

                                @elseif($register->category == "Human Resource")
                                <option value="Supervisor">Supervisor</option>
                                <option value="Accountant">Accountant</option>
                                <option value="Human Resource" selected>Human Resource</option>
                                <option value="Worker">Worker</option>

                                @elseif($register->category == "Worker")
                                <option value="Supervisor">Supervisor</option>
                                <option value="Accountant">Accountant</option>
                                <option value="Human Resource">Human Resource</option>
                                <option value="Worker" selected>Worker</option>

                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="salary">Salary</label>
                            <input type="text" class="form-control" id="salary" name="salary" value="{{$register->salary}}">
                        </div>
                        <div class="form-group col-md-6"> <label for="position">Employment Type</label>
                            <select class="form-control" name="category" id="category">

                                @if($register->employmentType == "Contract")
                                <option value="Contract" selected>Contract</option>
                                <option value="Permanent">Permanent</option>

                                @elseif($register->employmentType == "Permanent")
                                <option value="Contract">Contract</option>
                                <option value="Permanent" selected>Permanent</option>

                                @endif

                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{$register->address}}">
                        </div>
                    </div>

                    <br>
                    <div style="float: right;">
                        <a href="{{ url()->previous() }}" class="btn btn-danger btn-md">Cancel</a>
                        <button type="button" class="btn btn-primary btn-md" id="btn" onclick="updateData(this)" data-link="{{ route('updateUser', $register->id) }}" data-idform="updateUser" data-btnNameChange="Updating..."><span class="nav-link-text">Update</span></button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>


<script>
    // function activityOnLoad() {

    //     handleOnClick()
    //     imageCropper()
    // }

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
    }
</script>

@endsection