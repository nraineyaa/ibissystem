@extends('layouts.sideNav')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card card-small mb-4">
            <div class="card-header border-bottom">
                <h6 class="m-0">Activity Details</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-3">
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('addNewActivity') }}" enctype="multipart/form-data" method="POST" id="formNew" onsubmit="upload()">
                                @csrf
                                <input type="text" class="form-control" value="addActv" id="addActv" name="addActv" hidden>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="activityName">Name</label>
                                        <input type="text" class="form-control" id="activityName" name="activityName" placeholder="Activity Name" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="activityDate">Date</label>
                                        <input type="date" class="form-control" id="activityDate" name="activityDate" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="activityVenue">Location</label>
                                        <input type="text" class="form-control" id="activityVenue" name="activityVenue" placeholder="Activity Venue" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="activityCap">Pax</label>
                                        <input type="text" class="form-control" id="activityCap" name="activityCap" placeholder="Number of Participants" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="activityDesc">Description</label>
                                        <input type="text" class="form-control" id="activityDesc" name="activityDesc" placeholder="Describe the activity here..." required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <a data-toggle="tooltip" title="Only upload the proposal if the activity needs approval from higher-ups."><i class="fas fa-info-circle info-color"></i></a>
                                        &nbsp;
                                        <label for="file">Proposal</label>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                </div>

                                <div class="card-footer" style="float: right;">
                                    <!-- <a href="{{ route('fileUpload') }}" class="btn btn-danger btn-md">Upload File</a> -->
                                    <a href="{{ url()->previous() }}" class="btn btn-danger btn-md">Cancel</a>
                                    <button type="submit" class="btn btn-primary" id="formNew">Submit</button>
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
    function upload() {

        let timerInterval
        Swal.fire({
            title: 'Submitted...',
            showConfirmButton: false,
            html: 'Please wait while system submit the new activity proposal..',
            timerProgressBar: true,
            allowOutsideClick: false,
            willOpen: () => {
                Swal.showLoading()
            }
        })
    }
</script>


@endsection