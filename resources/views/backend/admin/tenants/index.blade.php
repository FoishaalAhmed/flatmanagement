@extends('backend.layouts.app')

@section('title', 'All Tenant')
@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4>{{ __('All Tenant') }}</h4>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                                <a class="btn btn-outline-primary mb-2"
                                    href="{{ route('admin.tenants.create') }}">{{ __('New Tenant') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area br-6">
                        <table id="multi-column-ordering" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">{{ __('Sl') }}</th>
                                    <th width="25%">{{ __('Building') }}</th>
                                    <th width="10%">{{ __('Floor') }}</th>
                                    <th width="10%">{{ __('Flat') }}</th>
                                    <th width="10%">{{ __('Name') }}</th>
                                    <th width="10%">{{ __('Rent') }}</th>
                                    <th width="10%">{{ __('Status') }}</th>
                                    <th width="10%">{{ __('Photo') }}</th>
                                    <th width="10%">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tenants as $key => $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->building }}</td>
                                        <td>{{ $item->floor }}</td>
                                        <td>
                                            <span class="shadow-none badge badge-success">{{ $item->flat }}</span>
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->rent }}</td>
                                        <td>
                                            @if ($item->status == 0)
                                                <span class="shadow-none badge badge-danger">{{ __('Inactive') }}</span>
                                            @else
                                                <span class="shadow-none badge badge-primary">{{ __('Active') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="usr-img-frame mr-2 rounded-circle">
                                                    <img alt="avatar" class="img-fluid rounded-circle"
                                                        src="{{ asset($item->photo) }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-primary mb-2 bs-tooltip"
                                                href="{{ route('admin.tenants.edit', $item->id) }}" data-toggle="tooltip"
                                                data-placement="top" title="" data-original-title="Edit"><i
                                                    class="far fa-edit"></i></a>
                                            <a class="btn btn-sm btn-outline-danger mb-2 bs-tooltip" data-toggle="tooltip"
                                                data-placement="top" title="" data-original-title="Delete" href=""
                                                onclick="if(confirm('Are You Sure To Delete?')){ event.preventDefault(); getElementById('delete-form-{{ $item->id }}').submit(); } else { event.preventDefault(); }"><i
                                                    class="far fa-times-circle"></i></a>
                                            <form action="{{ route('admin.tenants.destroy', [$item->id]) }}"
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
