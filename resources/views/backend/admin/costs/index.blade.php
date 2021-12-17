@extends('backend.layouts.app')

@section('title', 'All Cost')
@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div id="basic" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                <h4>{{ __('All Cost') }}</h4>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-6 col-6 text-right">
                                <a class="btn btn-outline-primary mb-2"
                                    href="{{ route('admin.costs.create') }}">{{ __('New Cost') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area br-6">
                        <table id="multi-column-ordering" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">{{ __('Sl') }}</th>
                                    <th width="10%">{{ __('Date') }}</th>
                                    <th width="10%">{{ __('Type') }}</th>
                                    <th width="15%">{{ __('Building') }}</th>
                                    <th width="15%">{{ __('Floor') }}</th>
                                    <th width="15%">{{ __('Flat') }}</th>
                                    <th width="10%">{{ __('Cause') }}</th>
                                    <th width="10%">{{ __('Amount') }}</th>
                                    <th width="10%">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($costs as $key => $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ date('d M, Y', strtotime($item->date)) }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->building }}</td>
                                        <td>{{ $item->floor }}</td>
                                        <td>{{ $item->flat }}</td>
                                        <td>{{ $item->cause }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>
                                            {{-- <a class="btn btn-sm btn-outline-primary mb-2 bs-tooltip"
                                                href="{{ route('admin.costs.edit', $item->id) }}" data-toggle="tooltip"
                                                data-placement="top" title="" data-original-title="Show"><i
                                                    class="far fa-edit"></i></a> --}}
                                            <a class="btn btn-sm btn-outline-danger mb-2 bs-tooltip" data-toggle="tooltip"
                                                data-placement="top" title="" data-original-title="Delete" href=""
                                                onclick="if(confirm('Are You Sure To Delete?')){ event.preventDefault(); getElementById('delete-form-{{ $item->id }}').submit(); } else { event.preventDefault(); }"><i
                                                    class="far fa-times-circle"></i></a>
                                            <form action="{{ route('admin.costs.destroy', [$item->id]) }}" method="post"
                                                style="display: none;" id="delete-form-{{ $item->id }}">
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
