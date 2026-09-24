@extends('layouts.main')

@section('content')
<div class="page-body">
    <div class="container p-4">
        <div class="flex justify-between items-center mb-4">
            <div class="font-bold">{{ $title }}</div>
            @auth
            <div class="flex justify-end">
                <a href="{{ route('proposals.create') }}" class="btn bg-blue-950 text-white">
                    <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Create
                </a>
            </div>
            @endAuth
        </div>
        <div class="grid gap-3">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <!-- Card 1: Total Proposals -->
                <div class="card bg-base-100 shadow-sm border border-t-4">
                    <div class="card-body">
                        <h2 class="text-xl font-bold">{{ $total }}</h2>
                        <p class="text-xs font-semibold tracking-wide uppercase text-base-content/70">Total
                            Proposals</p>
                    </div>
                </div>

                <!-- Card 2: Budget -->
                <div class="card bg-base-100 shadow-sm border border-t-4">
                    <div class="card-body">
                        <h2 class="text-xl font-bold">₱ {{ number_format($budget,2) }}</h2>
                        <p class="text-xs font-semibold tracking-wide uppercase text-base-content/70">Proposed
                            Budget</p>
                    </div>
                </div>

                <!-- Card 3: High Priority -->
                <div class="card bg-base-100 shadow-sm border border-t-4">
                    <div class="card-body">
                        <h2 class="text-xl font-bold">{{ $high }}</h2>
                        <p class="text-xs font-semibold tracking-wide uppercase text-base-content/70">High
                            Priority</p>
                    </div>
                </div>

                <!-- Card 4: Moderate Priority -->
                <div class="card bg-base-100 shadow-sm border border-t-4">
                    <div class="card-body">
                        <h2 class="text-xl font-bold">{{ $moderate }}</h2>
                        <p class="text-xs font-semibold tracking-wide uppercase text-base-content/70">Moderate
                            Priority</p>
                    </div>
                </div>

                <!-- Card 5: New Metric (e.g., Low Priority or Approved) -->
                <div class="card bg-base-100 shadow-sm border border-t-4">
                    <div class="card-body">
                        <h2 class="text-xl font-bold">{{ $low }}</h2>
                        <p class="text-xs font-semibold tracking-wide uppercase text-base-content/70">Low
                            Priority</p>
                    </div>
                </div>
            </div>
            <div class="grid-cols-12">
                <div class="card bg-base-100 w-full shadow-sm">
                    <div class="card-body">
                        <form method="GET" class="grid" id="form">
                            <div class="grid grid-cols-12 gap-4 mb-2">
                                <div class="col-span-12 md:col-span-2">
                                    <label class="form-control w-full">
                                        <div class="label py-0.5">
                                            <span class="label-text-alt text-xs font-bold text-base-content/70">
                                                PROJECT
                                            </span>
                                        </div>
                                        <select class="select select-bordered w-full" name="project">
                                            <option value="" selected>All Projects</option>
                                            <option
                                                {{ (isset($_GET['project']) && $_GET['project'] == "I-CARE") ? 'selected' : '' }}>
                                                I-CARE</option>
                                            <option
                                                {{ (isset($_GET['project']) && $_GET['project'] == "SINULID") ? 'selected' : '' }}>
                                                SINULID</option>
                                            <option
                                                {{ (isset($_GET['project']) && $_GET['project'] == "SAGIP") ? 'selected' : '' }}>
                                                SAGIP</option>
                                            <option
                                                {{ (isset($_GET['project']) && $_GET['project'] == "LINGAP") ? 'selected' : '' }}>
                                                LINGAP</option>
                                            <option
                                                {{ (isset($_GET['project']) && $_GET['project'] == "ISSHED") ? 'selected' : '' }}>
                                                ISSHED</option>
                                            <option
                                                {{ (isset($_GET['project']) && $_GET['project'] == "UX") ? 'selected' : '' }}>
                                                UX</option>
                                            <option
                                                {{ (isset($_GET['project']) && $_GET['project'] == "SALIKSIK") ? 'selected' : '' }}>
                                                SALIKSIK</option>
                                            <option
                                                {{ (isset($_GET['project']) && $_GET['project'] == "QMS-EOMS") ? 'selected' : '' }}>
                                                QMS-EOMS</option>
                                            <option
                                                {{ (isset($_GET['project']) && $_GET['project'] == "OK sa DepEd") ? 'selected' : '' }}>
                                                OK sa DepEd</option>
                                            <option
                                                {{ (isset($_GET['project']) && $_GET['project'] == "SECURE-PUSO") ? 'selected' : '' }}>
                                                SECURE-PUSO</option>
                                            <option
                                                {{ (isset($_GET['project']) && $_GET['project'] == "DRRM-SAFE") ? 'selected' : '' }}>
                                                DRRM-SAFE</option>
                                            <option
                                                {{ (isset($_GET['project']) && $_GET['project'] == "HUMANE") ? 'selected' : '' }}>
                                                HUMANE</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="col-span-12 md:col-span-2">
                                    <label class="form-control w-full">
                                        <div class="label py-0.5">
                                            <span class="label-text-alt text-xs font-bold text-base-content/70">
                                                PROPONENT
                                            </span>
                                        </div>
                                        <input type="search" class="input" name="proponent"
                                            placeholder="Search proponent" value="{{ request('proponent') }}" />
                                    </label>
                                </div>
                                <div class="col-span-12 md:col-span-2">
                                    <label class="form-control w-full">
                                        <div class="label py-0.5">
                                            <span class="label-text-alt text-xs font-bold text-base-content/70">
                                                TIER CATEGORY
                                            </span>
                                        </div>
                                        <select class="select select-bordered w-full" name="tier">
                                            <option value="" selected>All Tiers</option>
                                            <option
                                                {{ (isset($_GET['tier']) && $_GET['tier'] == "Tier 1 : Mandated") ? 'selected' : '' }}>
                                                Tier 1 : Mandated</option>
                                            <option
                                                {{ (isset($_GET['tier']) && $_GET['tier'] == "Tier 2 : Initiated") ? 'selected' : '' }}>
                                                Tier 2 : Initiated</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <label class="form-control w-full">
                                        <div class="label py-0.5">
                                            <span class="label-text-alt text-xs font-bold text-base-content/70">
                                                ACTIVITY TYPE
                                            </span>
                                        </div>
                                        <select class="select select-bordered w-full" name="activity">
                                            <option value="" selected>All Types</option>
                                            <option value="1"
                                                {{ (isset($_GET['activity']) && $_GET['activity'] == "1") ? 'selected' : '' }}>
                                                Capacity Building/Competitions/Conferences
                                            </option>
                                            <option value="2"
                                                {{ (isset($_GET['activity']) && $_GET['activity'] == "2") ? 'selected' : '' }}>
                                                Activity/Event</option>
                                            <option value="3"
                                                {{ (isset($_GET['activity']) && $_GET['activity'] == "3") ? 'selected' : '' }}>
                                                Reports/Meetings/Monitoring</option>
                                            <option value="4"
                                                {{ (isset($_GET['activity']) && $_GET['activity'] == "4") ? 'selected' : '' }}>
                                                Development</option>
                                        </select>
                                    </label>
                                </div>
                                <div class="col-span-12 md:col-span-2">
                                    <label class="form-control w-full">
                                        <div class="label py-0.5">
                                            <span class="label-text-alt text-xs font-bold text-base-content/70">
                                                PRIORITY LEVEL
                                            </span>
                                        </div>
                                        <select class="select select-bordered w-full" name="priority">
                                            <option value="" selected>All Levels</option>
                                            <option value="1"
                                                {{ (isset($_GET['priority']) && $_GET['priority'] == "1") ? 'selected' : '' }}>
                                                High Priority</option>
                                            <option value="2"
                                                {{ (isset($_GET['priority']) && $_GET['priority'] == "2") ? 'selected' : '' }}>
                                                Moderate Priority</option>
                                            <option value="3"
                                                {{ (isset($_GET['priority']) && $_GET['priority'] == "3") ? 'selected' : '' }}>
                                                Low Priority</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div>
                                    <button type="submit"
                                        class="btn bg-blue-900 hover:bg-blue-950 border-blue-900 text-white">
                                        Search
                                    </button>
                                    <a href="{{ url('/') }}" class="btn bg-default">
                                        Clear Filters
                                    </a>
                                </div>
                                <div class="flex justify-end">
                                    <a href="{{ url('download') }}" class="btn btn-default">Export
                                        CSV</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="grid-cols-12">
                <div class="overflow-visible rounded-md border border-gray-200 shadow-sm mb-4">
                    <table class="table overflow-visible table-zebra table-sm w-full" id="list">
                        <thead class="bg-blue-900 text-white text-xs">
                            <tr>
                                <th>PROPONENT</th>
                                <th>TITLE</th>
                                <th>GOAL</th>
                                <th>PILLAR</th>
                                <th>PROJECT</th>
                                <th>TIER</th>
                                <th>AMOUNT</th>
                                <th>SCORE</th>
                                <th>PRIORITY</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($list as $row)
                            <tr>
                                <td>{{ $row->proponent }}</td>
                                <td>{{ $row->activity_title }}</td>
                                <td>{{ $row->goal }}</td>
                                <td>{{ $row->pillar }}</td>
                                <td>{{ $row->project_details }}</td>
                                <td>{{ $row->tier }}</td>
                                <td>{{ number_format($row->amount,2) }}</td>
                                <td>{{ $row->score }}</td>
                                <td>
                                    @if($row->priority_level==1)
                                    <span class="badge badge-soft border-success badge-success text-xs">High</span>
                                    @elseif($row->priority_level==2)
                                    <span class="badge badge-soft border-warning badge-warning text-xs">Moderate</span>
                                    @else
                                    <span class="badge badge-soft border-neutral badge-neutral text-xs">Low</span>
                                    @endif
                                </td>
                                <td>
                                    @auth
                                    @if($permissions->role_name === "Super-admin")
                                    <div class="dropdown">
                                        <div tabindex="0" role="button" class="btn mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                viewBox="0 0 24 24">
                                                <title>more</title>
                                                <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="1.5"
                                                    d="M5 10c-1.1 0-2 .9-2 2s.9 2 2 2s2-.9 2-2s-.9-2-2-2m14 0c-1.1 0-2 .9-2 2s.9 2 2 2s2-.9 2-2s-.9-2-2-2m-7 0c-1.1 0-2 .9-2 2s.9 2 2 2s2-.9 2-2s-.9-2-2-2" />
                                            </svg>
                                            More
                                        </div>
                                        <ul tabindex="-1"
                                            class="dropdown-content menu bg-base-100 rounded-box z-1 w-40 p-2 shadow-sm">
                                            <li>
                                                <a
                                                    href="{{ url('proposals/edit',['token'=>encrypt($row->proposal_id)]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                        viewBox="0 0 24 24">
                                                        <title>edit</title>
                                                        <path fill="currentColor"
                                                            d="M5 21h14c1.1 0 2-.9 2-2v-7h-2v7H5V5h7V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2" />
                                                        <path fill="currentColor"
                                                            d="M7 13v3c0 .55.45 1 1 1h3c.27 0 .52-.11.71-.29l9-9a.996.996 0 0 0 0-1.41l-3-3a.996.996 0 0 0-1.41 0l-9.01 8.99A1 1 0 0 0 7 13m10-7.59L18.59 7L17.5 8.09L15.91 6.5zm-8 8l5.5-5.5l1.59 1.59l-5.5 5.5H9z" />
                                                    </svg>
                                                    Edit Proposal
                                                </a>
                                            </li>
                                            <li>
                                                <button type="button" class="text-error remove"
                                                    value="{{ $row->proposal_id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                        viewBox="0 0 24 24">
                                                        <title>delete</title>
                                                        <path fill="currentColor"
                                                            d="M18 19a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3V7H4V4h4.5l1-1h4l1 1H19v3h-1zM6 7v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2-2V7zm12-1V5h-4l-1-1h-3L9 5H5v1zM8 9h1v10H8zm6 0h1v10h-1z" />
                                                    </svg>
                                                    Remove
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                    @endif
                                    @endAuth
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center">No Available Proposal(s)</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $list->links('components.pagination') }}
            </div>
        </div>
    </div>
</div>
<script>
$('.remove').on('click', function() {
    let value = $(this).val();
    alertify.confirm(
        'Confirm Deletion',
        'Are you sure you want to delete this record?',
        function() {
            $.ajax({
                url: "{{ route('proposals.delete') }}",
                method: "POST",
                data: {
                    value: value,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    alertify.alert(
                        'Success',
                        response.message,
                        function() {
                            location.reload();
                        }
                    );
                },
                error: function(xhr, status, error) {
                    // Error notification
                    alertify.error('Server error: Could not complete request.');
                    console.error(error);
                }
            });
        },
        function() {
            // User clicked Cancel
            alertify.error('Action cancelled.');
        }
    );
});
</script>
@endsection
