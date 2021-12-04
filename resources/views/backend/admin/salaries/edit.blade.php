@extends('backend.layouts.app')

@section('title', 'Update Employee')
@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4>{{ __('Update Employee') }}</h4>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                                <a class="btn btn-outline-primary mb-2"
                                    href="{{ route('admin.employees.index') }}">{{ __('Employee List') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @include('includes.error')
                        <form method="post" action="{{ route('admin.employees.update', $employee->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Buildings') }}</label>
                                                <select class="form-control form-small tagging" name="building_id" required
                                                    id="building_id">
                                                    <option value="">{{ __('Select One Building') }}</option>
                                                    @foreach ($buildings as $item)
                                                        <option value="{{ $item->id }}" @if ($employee->building_id == $item->id) {{ 'selected' }} @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Name') }}</label>
                                                <input type="text" name="name" placeholder="{{ __('Name') }}"
                                                    class="form-control" required autocomplete="off"
                                                    value="{{ $employee->name }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('E-mail') }}</label>
                                                <input type="email" name="email" placeholder="{{ __('E-mail') }}"
                                                    class="form-control" required autocomplete="off"
                                                    value="{{ $employee->email }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Phone') }}</label>
                                                <input type="text" name="phone" placeholder="{{ __('Phone') }}"
                                                    class="form-control" required autocomplete="off"
                                                    value="{{ $employee->phone }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('NID') }} </label>
                                                <input type="text" name="nid" placeholder="{{ __('NID') }}"
                                                    class="form-control" required autocomplete="off"
                                                    value="{{ $employee->nid }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Designation') }}</label>
                                                <select class="form-control form-small tagging" name="designation_id"
                                                    required id="designation_id">
                                                    <option value="">{{ __('Select One Designation') }}</option>
                                                    @foreach ($designations as $item)
                                                        <option value="{{ $item->id }}" @if ($employee->designation_id == $item->id) {{ 'selected' }} @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Salary') }}</label>
                                                <input type="number" name="salary" placeholder="{{ __('Salary') }}"
                                                    class="form-control" autocomplete="off"
                                                    value="{{ $employee->salary }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-12 mx-auto">
                                            <div class="form-group mb-0">
                                                <label for="t-text">{{ __('Join Date') }}</label>
                                                <input type="text" name="join_date" placeholder="{{ __('Join Date') }}"
                                                    class="form-control flatpickr flatpickr-input active" autocomplete="off"
                                                    value="{{ $employee->join_date }}" id="join_date">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-12 mx-auto">
                                            <div class="form-group mb-0">
                                                <label for="t-text">{{ __('Leave Date') }}</label>
                                                <input type="text" name="leave_date" placeholder="{{ __('Leave Date') }}"
                                                    class="form-control flatpickr flatpickr-input active" autocomplete="off"
                                                    value="{{ $employee->leave_date }}" id="leave_date">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-12 mx-auto">
                                            <div class="form-group">
                                                <label for="t-text">{{ __('Status') }}</label>
                                                <select class="form-control form-small tagging" name="status" required
                                                    id="status">
                                                    <option value="0" @if ($employee->status == 0) {{ 'selected' }} @endif> {{ __('Left Job') }}
                                                    </option>

                                                    <option value="1" @if ($employee->status == 1) {{ 'selected' }} @endif> {{ __('On Duty') }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mx-auto mb-2">
                                            <div class="form-group">
                                                <label for="present_address">{{ __('Present Address') }}</label>
                                                <textarea class="form-control"
                                                    placeholder="{{ __('Present Address') }}" rows="3"
                                                    name="present_address"
                                                    autocomplete="off">{{ $employee->present_address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12 mx-auto mb-2">
                                            <div class="form-group">
                                                <label for="permanent_address">{{ __('Permanent Address') }}</label>
                                                <textarea class="form-control"
                                                    placeholder="{{ __('Permanent Address') }}" rows="3"
                                                    name="permanent_address"
                                                    autocomplete="off">{{ $employee->permanent_address }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 layout-top-spacing">
                                    <div class="education layout-spacing ">
                                        <div class="widget-content widget-content-area">
                                            <h3 class="">{{ __('Employee Photo') }}</h3>
                                            <div class="text-center user-info">
                                                <img src="{{ asset($employee->photo) }}" alt="avatar" id="employee-photo"
                                                    style="width: 100px">
                                                <p class="text-danger">
                                                    *{{ __('Photo Can Not Be Greater Than 100 KB') }}</p>
                                                <input type="file" id="input-file-max-fs" class="dropify"
                                                    name="photo" onchange="readPicture(this)" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <center>
                                        <button class="btn btn-outline-danger mb-2"
                                            type="reset">{{ __('Reset') }}</button>
                                        <button class="btn btn-outline-primary mb-2"
                                            type="submit">{{ __('Update') }}</button>
                                    </center>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('footer')
    <script>
        function readPicture(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#employee-photo')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        flatpickr(document.getElementById('join_date'));
        flatpickr(document.getElementById('leave_date'));
    </script>

@endsection
