@extends('admin.layouts.app')

@section('content')
    <div class="seperator-header">
        <h4 class="">Lucky Draw Number</h4>
        {{-- <button id="add-list" class="btn btn-secondary" style="float: right;">
            <a href="{{ route('draws.create') }}" style="color: white; text-decoration: none;">Add Draw</a>
        </button> --}}
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    <div class="table-form" style="justify-content: center">
                        <div class="form-group row mr-3">
                            <label for="min" class="col-sm-5 col-form-label col-form-label-sm">Select Date:</label>
                            <div class="col-sm-7">
                                <input type="date" class="form-control form-control-sm" id="selectedDate" name="date"
                                    value="{{ $_GET['date'] ?? date('Y-m-d') }}" max="{{ date('Y-m-d') }}">
                            </div>

                        </div>
                    </div>
                    <table class="display table dt-table-hover" >
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>A</th>
                                <th>B</th>
                                <th>C</th>
                                <th>D</th>

                                <th class="text-center dt-no-sorting">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($draws as $draw)
                                <tr>
                                    <td>{{ $draw->draw_time }}</td>

                                    <td>{{  $draw->a }}</td>
                                    <td>{{  $draw->b }}</td>
                                    <td>{{  $draw->c }}</td>
                                    <td>{{  $draw->d }}</td>

                                    {{-- <td>{{ $draw->c }}</td>
                                    <td>{{ $draw->d }}</td> --}}
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            <li>
                                                <a href="{{ route('draws.edit', $draw->id) }}" class="bs-tooltip"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-original-title="Edit" aria-label="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit-2 ">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('draws.destroy', $draw->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a type="submit" class="bs-tooltip delete-btn" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-original-title="Delete"
                                                        aria-label="Delete">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-trash ">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path
                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Time</th>
                                <th>A</th>
                                <th>B</th>
                                <th>C</th>
                                <th>D</th>

                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script></script>
@endsection
