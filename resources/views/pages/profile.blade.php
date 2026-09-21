@extends('layouts.main')

@section('content')
<div class="page-body">
    <div class="container p-4">
        <div class="flex justify-between items-center mb-4">
            <div class="font-bold">{{ $title }}</div>
            <div class="flex justify-end">
                <a href="{{ url('/') }}" class="btn bg-blue-950 text-white">
                    <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Return
                </a>
            </div>
        </div>
        <div class="tabs tabs-box">
            <input type="radio" name="my_tabs_3" class="tab checked:!bg-blue-950 checked:!text-white"
                aria-label="Profile Information" checked="checked" />
            <div class="tab-content">
                <div class="grid gap-4">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 md:col-span-8">
                            <div class="card bg-base-100 shadow-sm">
                                <div class="card-body">
                                    <div class="card-title">Account Details</div>
                                    <div class="grid gap-4">
                                        <div class="grid-cols-12">
                                            <label class="form-control w-full">
                                                <div class="label py-0.5">
                                                    <span
                                                        class="label-text-alt text-xs font-semibold text-base-content/70">
                                                        COMPLETE NAME
                                                    </span>
                                                </div>
                                                <input type="text" class="input w-full" value="{{ Auth::user()->name }}"
                                                    readonly />
                                            </label>
                                        </div>
                                        <div class="grid-cols-12">
                                            <label class="form-control w-full">
                                                <div class="label py-0.5">
                                                    <span
                                                        class="label-text-alt text-xs font-semibold text-base-content/70">
                                                        EMAIL ADDRESS
                                                    </span>
                                                </div>
                                                <input type="email" class="input w-full"
                                                    value="{{ Auth::user()->email }}" readonly />
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <div class="card bg-base-100 shadow-sm">
                                <div class="card-body">
                                    <div class="card-title">Account Security</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="radio" name="my_tabs_3" class="tab checked:!bg-blue-950 checked:!text-white"
                aria-label="Audit Trail" />
            <div class="tab-content bg-base-100 border-base-300 p-6">
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full" id="tbl_logs">
                        <thead>
                            <th>Date & Time</th>
                            <th>Name</th>
                            <th>Activities</th>
                            <th>IP Address</th>
                            <th>User Agent</th>
                        </thead>
                        <tbody>
                            @foreach ($logs as $row)
                            <tr>
                                <td>{{ date('M d, Y h:i a',strtotime($row->created_at)) }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->activity }}</td>
                                <td>{{ $row->ip_address }}</td>
                                <td>{{ $row->agent }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('#tbl_logs').DataTable();
</script>
@endsection
