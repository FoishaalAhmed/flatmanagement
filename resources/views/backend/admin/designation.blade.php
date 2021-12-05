@extends('backend.layouts.app')

@section('title', 'Designation')
@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4>{{ __('Designation') }}</h4>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                                <a class="btn btn-outline-primary mb-2" data-toggle="modal"
                                    data-target="#store-modal">{{ __('New Designation') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area br-6">
                        @include('includes.error')
                        <table id="multi-column-ordering" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 10%">{{ __('Sl') }}</th>
                                    <th style="width: 80%">{{ __('Designation') }}</th>
                                    <th style="width: 10%">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($designations as $key => $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-primary mb-2 bs-tooltip" data-toggle="modal"
                                                data-target="#update-modal" data-id="{{ $item->id }}"
                                                data-name="{{ $item->name }}" data-toggle="tooltip" data-placement="top"
                                                title="" data-original-title="Edit"><i class="far fa-edit"></i></a>

                                            <a class="btn btn-sm btn-outline-danger mb-2 bs-tooltip" data-toggle="tooltip"
                                                data-placement="top" title="" data-original-title="Delete" href=""
                                                onclick="if(confirm('Are You Sure To Delete?')){ event.preventDefault(); getElementById('delete-form-{{ $item->id }}').submit(); } else { event.preventDefault(); }"><i
                                                    class="far fa-times-circle"></i></a>
                                            <form action="{{ route('admin.designations.destroy', [$item->id]) }}"
                                                method="post" style="display: none;" id="delete-form-{{ $item->id }}">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
                            aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="store-modal">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myExtraLargeModalLabel">
                                            {{ __('New Designation') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-x">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.designations.index') }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 mx-auto">
                                                    <div class="form-group">
                                                        <label for="t-text">{{ __('Name') }}</label>
                                                        <input type="text" name="name" placeholder="{{ __('Name') }}"
                                                            class="form-control" required autocomplete="off"
                                                            value="{{ old('name') }}">
                                                    </div>
                                                </div>
                                                <div class="col-12 mx-auto">
                                                    <center>
                                                        <button class="btn btn-outline-danger mb-2"
                                                            data-dismiss="modal">{{ __('Cancel') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-outline-primary mb-2">{{ __('Save') }}</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="modal-footer">

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog"
                            aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="update-modal">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myExtraLargeModalLabel">
                                            {{ __('Update Designation') }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-x">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" id="update-form">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-12 mx-auto">
                                                    <div class="form-group">
                                                        <label for="t-text">{{ __('Name') }}</label>
                                                        <input type="text" name="name" placeholder="{{ __('Name') }}"
                                                            class="form-control" required autocomplete="off"
                                                            value="{{ old('name') }}" id="name">
                                                        <input type="hidden" name="id" id="id">
                                                    </div>
                                                </div>
                                                <div class="col-12 mx-auto">
                                                    <center>
                                                        <button class="btn btn-outline-danger mb-2"
                                                            data-dismiss="modal">{{ __('Cancel') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-outline-primary mb-2">{{ __('Update') }}</button>
                                                    </center>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $('#update-modal').on("show.bs.modal", function(event) {

            var e = $(event.relatedTarget);
            var id = e.data('id');
            var name = e.data('name');

            var action = "{{ URL::to('admin/designations/update') }}";

            $("#update-form").attr('action', action);
            $("#id").val(id);
            $("#name").val(name);

        });
    </script>
@endsection
