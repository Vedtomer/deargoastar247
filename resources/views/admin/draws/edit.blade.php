@extends('admin.layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Draw</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Lucky Draw</li>
@endsection

@section('content')

    <div class="row layout-top-spacing">
        <div class="col-lg-8 mx-auto mt-4">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="errors">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <form class="row g-3" action="{{ route('draws.update', $draw->id) }}" method="post"
                        enctype="multipart/form-data" id="editDrawForm">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <label for="draw_time" class="form-label">Time <span class="text-danger">*</span></label>
                            <select class="select2 form-select customer form-control" id="draw_time" name="draw_time"
                                aria-label="Select Time" required>
                                <option value="">Select Time</option>
                                @for ($hour = 9; $hour <= 21; $hour++)
                                    @for ($minute = 0; $minute < 60; $minute += 30)
                                        @php
                                            $time = sprintf('%02d:%02d', $hour, $minute);
                                            $formattedTime = date('h:i A', strtotime($time));
                                            $storedTime = date('h:i A', strtotime($draw->draw_time));
                                        @endphp
                                        <option value="{{ $formattedTime }}"
                                            {{ $storedTime == $formattedTime ? 'selected' : '' }}>
                                            {{ $formattedTime }}
                                        </option>
                                        @if ($hour == 21 && $minute == 30)
                                        @break
                                    @endif
                                @endfor
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="date" value="{{ $draw->date }}" required
                            readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="a" class="form-label">A <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="a" name="a"
                            value="{{ substr($draw->a, -2) }}" required maxlength="2">
                    </div>
                    <div class="col-md-6">
                        <label for="b" class="form-label">B <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="b" name="b"
                            value="{{ substr($draw->b, -2) }}" required maxlength="2">
                    </div>
                    <div class="col-md-6">
                        <label for="c" class="form-label">C <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c" name="c"
                            value="{{ substr($draw->c, -2) }}" required maxlength="2">
                    </div>
                    <div class="col-md-6">
                        <label for="d" class="form-label">D <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="d" name="d"
                            value="{{ substr($draw->d, -2) }}" required maxlength="2">
                    </div>
                    <div class="col-md-6">
                        <label for="e" class="form-label">E <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="e" name="e"
                            value="{{ substr($draw->e, -2) }}" required maxlength="2">
                    </div>
                    <div class="col-md-6">
                        <label for="f" class="form-label">F <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="f" name="f"
                            value="{{ substr($draw->f, -2) }}" required maxlength="2">
                    </div>
                    <div class="col-md-6">
                        <label for="g" class="form-label">G <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="g" name="g"
                            value="{{ substr($draw->g, -2) }}" required maxlength="2">
                    </div>
                    <div class="col-md-6">
                        <label for="h" class="form-label">H <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="h" name="h"
                            value="{{ substr($draw->h, -2) }}" required maxlength="2">
                    </div>
                    <div class="col-md-6">
                        <label for="i" class="form-label">I <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="i" name="i"
                            value="{{ substr($draw->i, -2) }}" required maxlength="2">
                    </div>
                    <div class="col-md-6">
                        <label for="j" class="form-label">J <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="j" name="j"
                            value="{{ substr($draw->j, -2) }}" required maxlength="2">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('draws.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function enforceTwoDigitInput(event) {
        var input = event.target;
        // Remove any non-numeric characters
        input.value = input.value.replace(/[^0-9]/g, '');
        // Limit the length to 2 characters
        if (input.value.length > 2) {
            input.value = input.value.slice(0, 2);
        }
    }

    // Add event listeners for all fields
    ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j'].forEach(function(id) {
        document.getElementById(id).addEventListener('input', enforceTwoDigitInput);
    });

    document.getElementById('editDrawForm').addEventListener('submit', function(event) {
        var isValid = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j'].every(function(id) {
            return document.getElementById(id).value.length === 2;
        });

        if (!isValid) {
            event.preventDefault();
            alert('Please enter valid two-digit numbers for all fields from A to J.');
        }
    });
</script>

@endsection
