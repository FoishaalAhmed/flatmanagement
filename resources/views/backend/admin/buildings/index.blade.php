@extends('backend.layouts.app')

@section('title', 'All Building')
@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4>{{ __('All Building') }}</h4>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                                <a class="btn btn-outline-primary mb-2"
                                    href="{{ route('admin.buildings.create') }}">{{ __('New Building') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area br-6">
                        <table id="multi-column-ordering" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">{{ __('Sl') }}</th>
                                    <th width="25%">{{ __('Name') }}</th>
                                    <th width="10%">{{ __('Floor') }}</th>
                                    <th width="10%">{{ __('Flat') }}</th>
                                    <th width="10%">{{ __('Guard') }}</th>
                                    <th width="10%">{{ __('CCTV') }}</th>
                                    <th width="10%">{{ __('Parking') }}</th>
                                    <th width="10%">{{ __('Photo') }}</th>
                                    <th width="10%">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($buildings as $key => $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->floor }}</td>
                                        <td>{{ $item->flat }}</td>
                                        <td>{{ $item->guard }}</td>
                                        <td>{{ $item->cctv }}</td>
                                        <td>{{ $item->parking }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="usr-img-frame mr-2 rounded-circle">
                                                    <img alt="avatar" class="img-fluid rounded-circle"
                                                        src="{{ asset($item->photo) }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-primary mb-2"
                                                href="{{ route('admin.buildings.edit', $item->id) }}" title="Edit"><i
                                                    class="far fa-edit"></i></a>
                                            <a class="btn btn-sm btn-outline-danger mb-2" title="Delete" href=""
                                                onclick="if(confirm('Are You Sure To Delete?')){ event.preventDefault(); getElementById('delete-form-{{ $item->id }}').submit(); } else { event.preventDefault(); }"><i
                                                    class="far fa-times-circle"></i></a>
                                            <form action="{{ route('admin.buildings.destroy', [$item->id]) }}"
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
