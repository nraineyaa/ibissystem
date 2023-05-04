@extends('activity.ViewActv')

@section('inner_content')

<form onsubmit="" action="" method="post" id="form" enctype="multipart/form-data">
    @csrf
    @method('POST')

    <div class="row row-cols-5">

        <div class="col mt-auto">
            <label for="text-input" class=" form-control-label">Approval From</label>
        </div>

        <div class="col">
            <input type="date" name="dateFrom" class="form-control" required>
        </div>

        <div class="col mt-auto">
            <label for="text-input" class=" form-control-label">Approval To</label>
        </div>

        <div class="col">
            <input type="date" name="dateTo" class="form-control" required>
        </div>

        <div class="col">
            <button type="submit" class="btn btn-primary w-100" id="exportBtn"><i class="fas fa-download"></i> &nbsp;Download</button>
        </div>

    </div>

</form>

@endsection