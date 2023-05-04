@extends('layouts.sideNav')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Update Activity Details</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                    <div class="row">
                        <div class="col">
                            <form enctype="multipart/form-data" method="POST" id="updateActivity">
                                @csrf
                                @method('post')
                                <div class="form-row">
                                    <div class="form-group col-md-10">
                                        <label for="activityName">Name</label>
                                        @if( auth()->user()->category== "Coordinator" || auth()->user()->category== "Hosd")
                                        <input type="text" class="form-control" id="activityName" name="activityName" value="{{$activity->activityName}}" readonly>
                                        @else
                                        <input type="text" class="form-control" id="activityName" name="activityName" value="{{$activity->activityName}}">
                                        @endif
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="activityName">Status</label>

                                        <!-- COMMITTEE START -->
                                        @if( auth()->user()->category== "Committee")
                                        @if($activity->activityStatus != "Published")
                                        <select name="activityStatus" id="activityStatus" class="form-control" required>
                                            @if($activity->activityStatus == "Submitted")
                                            <option value="Submitted" selected>Submitted</option>
                                            <option value="CO Approved" disabled>CO Approved</option>
                                            <option value="CO Rejected" disabled>CO Rejected</option>
                                            <option value="HOSD Approved" disabled>HOSD Approved</option>
                                            <option value="HOSD Rejected" disabled>HOSD Rejected</option>
                                            <option value="Published">Published</option>

                                            @elseif($activity->activityStatus == "CO Approved")
                                            <option value="Submitted" disabled>Submitted</option>
                                            <option value="CO Approved" disabled selected>CO Approved</option>
                                            <option value="CO Rejected" disabled>CO Rejected</option>
                                            <option value="HOSD Approved" disabled>HOSD Approved</option>
                                            <option value="HOSD Rejected" disabled>HOSD Rejected</option>
                                            <option value="Published" disabled>Published</option>

                                            @elseif($activity->activityStatus == "CO Rejected")
                                            <option value="Submitted" disabled>Submitted</option>
                                            <option value="CO Approved" disabled>CO Approved</option>
                                            <option value="CO Rejected" disabled selected>CO Rejected</option>
                                            <option value="HOSD Approved" disabled>HOSD Approved</option>
                                            <option value="HOSD Rejected" disabled>HOSD Rejected</option>
                                            <option value="Published" disabled>Published</option>

                                            @elseif($activity->activityStatus == "HOSD Approved")
                                            <option value="Submitted" disabled>Submitted</option>
                                            <option value="CO Approved" disabled>CO Approved</option>
                                            <option value="CO Rejected" disabled>CO Rejected</option>
                                            <option value="HOSD Approved" disabled selected>HOSD Approved</option>
                                            <option value="HOSD Rejected" disabled>HOSD Rejected</option>
                                            <option value="Published">Published</option>

                                            @elseif($activity->activityStatus == "HOSD Rejected")
                                            <option value="Submitted" disabled>Submitted</option>
                                            <option value="CO Approved" disabled>CO Approved</option>
                                            <option value="CO Rejected" disabled>CO Rejected</option>
                                            <option value="HOSD Approved" disabled>HOSD Approved</option>
                                            <option value="HOSD Rejected" disabled selected>HOSD Rejected</option>
                                            <option value="Published" disabled>Published</option>

                                            @endif
                                        </select>
                                        @else
                                        <input type="text" id="activityStatus" name="activityStatus" value="Published" class="form-control" style="text-transform:uppercase" readonly>
                                        @endif
                                        <!-- COMMITTEE END -->


                                        <!-- COORDINATOR START -->
                                        @elseif( auth()->user()->category== "Coordinator")
                                        <select name="activityStatus" id="activityStatus" class="form-control" required>
                                            @if($activity->activityStatus == "Submitted")
                                            <option value="Submitted" selected>Submitted</option>
                                            <option value="CO Approved">CO Approved</option>
                                            <option value="CO Rejected">CO Rejected</option>
                                            @elseif($activity->activityStatus == "CO Approved")
                                            <option value="CO Approved" selected>CO Approved</option>
                                            <option value="CO Rejected">CO Rejected</option>
                                            @elseif($activity->activityStatus == "CO Rejected")
                                            <option value="CO Approved">CO Approved</option>
                                            <option value="CO Rejected" selected>CO Rejected</option>
                                            @endif
                                        </select>
                                        <!-- COORDINATOR END -->

                                        <!-- HOSD START -->
                                        @elseif( auth()->user()->category== "Hosd")
                                        <select name="activityStatus" id="activityStatus" class="form-control" required>
                                            @if($activity->activityStatus == "CO Approved")
                                            <option value="CO Approved" selected>CO Approved</option>
                                            <option value="HOSD Approved">HOSD Approved</option>
                                            <option value="HOSD Rejected">HOSD Rejected</option>
                                            @elseif($activity->activityStatus == "HOSD Approved")
                                            <option value="HOSD Approved" selected>HOSD Approved</option>
                                            <option value="HOSD Rejected">HOSD Rejected</option>
                                            @elseif($activity->activityStatus == "HOSD Rejected")
                                            <option value="HOSD Approved">HOSD Approved</option>
                                            <option value="HOSD Rejected" selected>HOSD Rejected</option>
                                            @endif
                                        </select>
                                        <!-- COORDINATOR END -->


                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="activityDate">Date</label>
                                        @if( auth()->user()->category== "Coordinator" || auth()->user()->category== "Hosd")
                                        <input type="date" class="form-control" id="activityDate" name="activityDate" value="{{$activity->activityDate}}" readonly>
                                        @else
                                        <input type="date" class="form-control" id="activityDate" name="activityDate" value="{{$activity->activityDate}}">
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="activityVenue">Location</label>
                                        @if( auth()->user()->category== "Coordinator" || auth()->user()->category== "Hosd")
                                        <input type="text" class="form-control" id="activityVenue" name="activityVenue" value="{{$activity->activityVenue}}" readonly>
                                        @else
                                        <input type="text" class="form-control" id="activityVenue" name="activityVenue" value="{{$activity->activityVenue}}">
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="activityCap">Pax</label>
                                        @if( auth()->user()->category== "Coordinator" || auth()->user()->category== "Hosd")
                                        <input type="text" class="form-control" id="activityCap" name="activityCap" value="{{$activity->activityCap}}" readonly>
                                        @else
                                        <input type="text" class="form-control" id="activityCap" name="activityCap" value="{{$activity->activityCap}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="activityDesc">Description</label>
                                        @if( auth()->user()->category== "Coordinator" || auth()->user()->category== "Hosd")
                                        <input type="text" class="form-control" id="activityDesc" name="activityDesc" value="{{$activity->activityDesc}}" readonly>
                                        @else
                                        <input type="text" class="form-control" id="activityDesc" name="activityDesc" value="{{$activity->activityDesc}}">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    @if($activity->activityFile != null)
                                    <div class="form-group col-md-6">
                                        <a data-toggle="tooltip" title="Only upload the proposal if the activity needs approval from higher-ups."><i class="fas fa-info-circle info-color"></i></a>
                                        &nbsp;
                                        <label for="file">Proposal</label>
                                        <a href="{{asset('uploads/'. $activity->activityFile)}}">
                                            <input type="text" class="form-control" value="{{$activity->activityFile}}" readonly />
                                        </a>
                                    </div>
                                    @else
                                    <div class="form-group col-md-6">
                                        <a data-toggle="tooltip" title="Only upload the proposal if the activity needs approval from higher-ups."><i class="fas fa-info-circle info-color"></i></a>
                                        &nbsp;
                                        <label for="file">Proposal</label>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                    @endif
                                </div>
                                <div class="card-footer" style="float: right;">
                                    <a href="{{ url()->previous() }}" class="btn btn-info btn-md">Back</a>
                                    <button type="button" class="btn btn-primary btn-md" id="btn" onclick="updateData(this)" data-link="{{ route('updateActivity' , $activity->id) }}" data-idform="updateActivity" data-btnNameChange="Updating..."><span class="nav-link-text">Update</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
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