@extends('admin.layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Draw</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Lucky Draw</li>
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
                    <form class="row g-3" action="{{ route('draws.store') }}" method="post" enctype="multipart/form-data"
                        id="drawForm">
                        @csrf

                        <div class="col-md-6">
                            <label for="user_id" class="form-label">Time <span class="text-danger">*</span></label>
                            <select class="select2 form-select customer form-control" id="user_id" name="draw_time"
                                aria-label="Select Customer" required>
                                <option value="">Select Time</option>
                                @for ($hour = 9; $hour < 22; $hour++)
                                    @for ($minute = 0; $minute < 60; $minute += 30)
                                        <option value="{{ sprintf('%02d:%02d', $hour, $minute) }}">
                                            {{ date('h:i A', strtotime(sprintf('%02d:%02d', $hour, $minute))) }}
                                        </option>
                                    @endfor
                                @endfor

                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="date" class="form-label"> Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="date" value="{{ date('Y-m-d') }}" required
                                readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="a" class="form-label">A <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="a" name="a"
                                value="{{ old('a') }}" required maxlength="2">
                        </div>
                        <div class="col-md-6">
                            <label for="b" class="form-label">B <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="b" name="b"
                                value="{{ old('b') }}" required maxlength="2">
                        </div>
                        <div class="col-md-6">
                            <label for="c" class="form-label">C <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="c" name="c"
                                value="{{ old('c') }}" required maxlength="2">
                        </div>
                        <div class="col-md-6">
                            <label for="d" class="form-label">D <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="d" name="d"
                                value="{{ old('d') }}" required maxlength="2">
                        </div>
                        <div class="col-md-6">
                            <label for="e" class="form-label">E <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="e" name="e"
                                value="{{ old('e') }}" required maxlength="2">
                        </div>
                        <div class="col-md-6">
                            <label for="f" class="form-label">F <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="f" name="f"
                                value="{{ old('f') }}" required maxlength="2">
                        </div>
                        <div class="col-md-6">
                            <label for="g" class="form-label">G <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="g" name="g"
                                value="{{ old('g') }}" required maxlength="2">
                        </div>
                        <div class="col-md-6">
                            <label for="h" class="form-label">H <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="h" name="h"
                                value="{{ old('h') }}" required maxlength="2">
                        </div>
                        <div class="col-md-6">
                            <label for="i" class="form-label">I <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="i" name="i"
                                value="{{ old('i') }}" required maxlength="2">
                        </div>
                        <div class="col-md-6">
                            <label for="j" class="form-label">J <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="j" name="j"
                                value="{{ old('j') }}" required maxlength="2">
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
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

        document.getElementById('drawForm').addEventListener('submit', function(event) {
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
