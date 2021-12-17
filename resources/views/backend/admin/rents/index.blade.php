@extends('backend.layouts.app')

@section('title', 'All Rent')
@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4>{{ __('All Rent') }}</h4>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                                <a class="btn btn-outline-primary mb-2"
                                    href="{{ route('admin.rents.create') }}">{{ __('New Rent') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area br-6">
                        <table id="multi-column-ordering" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="10%">{{ __('Date') }}</th>
                                    <th width="15%">{{ __('Building') }}</th>
                                    <th width="10%">{{ __('Flat') }}</th>
                                    <th width="15%">{{ __('Tenant') }}</th>
                                    <th width="10%">{{ __('Month') }}</th>
                                    <th width="10%">{{ __('Year') }}</th>
                                    <th width="10%">{{ __('Rent') }}</th>
                                    <th width="10%">{{ __('Paid') }}</th>
                                    <th width="10%">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rents as $key => $item)
                                    <tr>
                                        <td>{{ date('d M, Y', strtotime($item->date)) }}</td>
                                        <td>{{ $item->building }}</td>
                                        <td>{{ $item->flat }}</td>
                                        <td>{{ $item->tenant }}</td>
                                        <td>{{ $item->month }}</td>
                                        <td>{{ $item->year }}</td>
                                        <td>{{ $item->rent }}</td>
                                        <td>{{ $item->paid }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-primary mb-2 bs-tooltip"
                                                href="{{ route('admin.rents.show', $item->id) }}"
                                                data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Show"><i class="far fa-eye"></i></a>
                                            <a class="btn btn-sm btn-outline-danger mb-2 bs-tooltip" data-toggle="tooltip"
                                                data-placement="top" title="" data-original-title="Delete" href=""
                                                onclick="if(confirm('Are You Sure To Delete?')){ event.preventDefault(); getElementById('delete-form-{{ $item->id }}').submit(); } else { event.preventDefault(); }"><i
                                                    class="far fa-times-circle"></i></a>
                                            <form action="{{ route('admin.rents.destroy', [$item->id]) }}"
                                                method="post" style="display: none;" id="delete-form-{{ $item->id }}">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
