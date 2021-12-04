@extends('backend.layouts.app')

@section('title', 'New Employee Salary')
@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">

            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4>{{ __('New Employee Salary') }}</h4>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                                <a class="btn btn-outline-primary mb-2"
                                    href="{{ route('admin.employee-salaries.index') }}">{{ __('Employee Salary List') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        @include('includes.error')
                        <form method="post" action="{{ route('admin.employee-salaries.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group mb-0">
                                        <label for="t-text">{{ __('Date') }}</label>
                                        <input type="text" name="date" placeholder="{{ __('Date') }}"
                                            class="form-control flatpickr flatpickr-input active" autocomplete="off"
                                            value="{{ old('date') }}" id="date">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Employee') }}</label>
                                        <select class="form-control form-small tagging" name="employee_id" required
                                            id="employee_id">
                                            <option value="">{{ __('Select One Employee') }}</option>
                                            @foreach ($employees as $item)
                                                <option value="{{ $item->id }}" @if (old('employee_id') == $item->id) {{ 'selected' }} @endif
                                                    data-salary="{{ $item->salary }}"
                                                    data-designation="{{ $item->designation }}">
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Designation') }}</label>
                                        <input type="text" name="designation" placeholder="{{ __('Designation') }}"
                                            class="form-control" required autocomplete="off"
                                            value="{{ old('designation') }}" id="designation" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-3 mb-xl-0 mb-2">
                                    <label for="t-text">{{ __('Issue Month') }}</label>
                                    <select class="form-control tagging" name="month" required="">
                                        @foreach ($months as $item)
                                            <option value="{{ $item->name }}" @if (old('month') == $item->name) {{ 'selected' }} @endif>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-3 mb-xl-0 mb-2">
                                    <label for="t-text">{{ __('Year') }}</label>
                                    <select class="form-control tagging" name="year" required="">
                                        @for ($i = date('Y'); $i >= 1921; $i--)
                                            <option value="{{ $i }}" @if (old('year') == $i) {{ 'selected' }} @endif>
                                                {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-lg-3 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Salary') }}</label>
                                        <input type="number" name="salary" placeholder="{{ __('Salary') }}"
                                            class="form-control" autocomplete="off" value="{{ old('salary') }}"
                                            id="salary" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-12 mx-auto">
                                    <div class="form-group">
                                        <label for="t-text">{{ __('Paid') }}</label>
                                        <input type="number" name="paid" placeholder="{{ __('Paid') }}"
                                            class="form-control" autocomplete="off" value="{{ old('paid') }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <center>
                                        <button class="btn btn-outline-danger mb-2"
                                            type="reset">{{ __('Reset') }}</button>
                                        <button class="btn btn-outline-primary mb-2"
                                            type="submit">{{ __('Save') }}</button>
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
        $('#employee_id').change(function() {
            var designation = $(this).find(':selected').attr('data-designation');
            var salary = $(this).find(':selected').attr('data-salary');
            $('#designation').val(designation);
            $('#salary').val(salary);
        });

        flatpickr(document.getElementById('date'));
    </script>

@endsection
