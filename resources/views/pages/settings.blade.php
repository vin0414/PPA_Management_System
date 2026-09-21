@extends('layouts.main')

@section('content')
<div class="page-body">
    <div class="container p-4">
        <div class="flex justify-between items-center mb-4">
            <div class="font-bold">{{ $title }}</div>
            <div class="flex justify-end">
                <div class="dropdown">
                    <div tabindex="0" role="button" class="btn mr-2">
                        <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        New Entry
                    </div>
                    <ul tabindex="-1" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
                        <li><a onclick="project_modal.showModal()">New Project</a></li>
                        <li><a onclick="lead_modal.showModal()">New Lead Measure</a></li>
                        <li><a onclick="strategy_modal.showModal()">New Strategy</a></li>
                        <li><a onclick="output_modal.showModal()">New Output</a></li>
                        <li><a onclick="target_modal.showModal()">New Target</a></li>
                    </ul>
                </div>
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
                aria-label="Projects" checked="checked" />
            <div class="tab-content bg-base-100 border-base-300 p-6">
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full" id="tbl_project">
                        <thead>
                            <th>Category</th>
                            <th>Project Details</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach($projects as $row)
                            <tr>
                                <td>{{ $row->category }}</td>
                                <td>{{ $row->project_details }}</td>
                                <td>
                                    <button type="button" class="btn btn-error text-white remove_project"
                                        value="{{ encrypt($row->project_id) }}">
                                        <svg xmlns="http://w3.org" viewBox="0 0 24 24" width="24" height="24"
                                            fill="currentColor">
                                            <path
                                                d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <input type="radio" name="my_tabs_3" class="tab checked:!bg-blue-950 checked:!text-white"
                aria-label="Lead Measure" />
            <div class="tab-content bg-base-100 border-base-300 p-6">
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full" id="tbl_lead">
                        <thead>
                            <th>Projects</th>
                            <th>Lead Measure</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach($leads as $row)
                            <tr>
                                <td>{{ $row->project_details }}</td>
                                <td>{{ $row->lead }}</td>
                                <td>
                                    <button type="button" class="btn btn-error text-white remove_lead"
                                        value="{{ encrypt($row->lead_id) }}">
                                        <svg xmlns="http://w3.org" viewBox="0 0 24 24" width="24" height="24"
                                            fill="currentColor">
                                            <path
                                                d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <input type="radio" name="my_tabs_3" class="tab checked:!bg-blue-950 checked:!text-white"
                aria-label="Strategies" />
            <div class="tab-content bg-base-100 border-base-300 p-6">
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full" id="tbl_strategy">
                        <thead>
                            <th>Projects</th>
                            <th>Strategies</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach($strategies as $row)
                            <tr>
                                <td>{{ $row->project_details }}</td>
                                <td>{{ $row->name_of_strategy }}</td>
                                <td>
                                    <button type="button" class="btn btn-error text-white remove_strategy"
                                        value="{{ encrypt($row->strategy_id) }}">
                                        <svg xmlns="http://w3.org" viewBox="0 0 24 24" width="24" height="24"
                                            fill="currentColor">
                                            <path
                                                d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <input type="radio" name="my_tabs_3" class="tab checked:!bg-blue-950 checked:!text-white"
                aria-label="Output" />
            <div class="tab-content bg-base-100 border-base-300 p-6">
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full" id="tbl_output">
                        <thead>
                            <th>Projects</th>
                            <th>Expected Output</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach($output as $row)
                            <tr>
                                <td>{{ $row->project_details }}</td>
                                <td>{{ $row->output }}</td>
                                <td>
                                    <button type="button" class="btn btn-error text-white remove_output"
                                        value="{{ encrypt($row->output_id) }}">
                                        <svg xmlns="http://w3.org" viewBox="0 0 24 24" width="24" height="24"
                                            fill="currentColor">
                                            <path
                                                d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <input type="radio" name="my_tabs_3" class="tab checked:!bg-blue-950 checked:!text-white"
                aria-label="Targets" />
            <div class="tab-content bg-base-100 border-base-300 p-6">
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full" id="tbl_target">
                        <thead>
                            <th>Projects</th>
                            <th>Targets</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach($targets as $row)
                            <tr>
                                <td>{{ $row->project_details }}</td>
                                <td>{{ $row->target_details }}</td>
                                <td>
                                    <button type="button" class="btn btn-error text-white remove_target"
                                        value="{{ encrypt($row->target_id) }}">
                                        <svg xmlns="http://w3.org" viewBox="0 0 24 24" width="24" height="24"
                                            fill="currentColor">
                                            <path
                                                d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z" />
                                        </svg>
                                    </button>
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
<dialog id="project_modal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">New Project</h3>
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <div class="modal-content">
            <form method="POST" class="grid gap-2" id="frmProject">
                @csrf
                <div class="grid-cols-12">
                    <label class="form-control w-full">
                        <div class="label py-0.5">
                            <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                CATEGORY
                            </span>
                        </div>
                        <select class="select select-bordered w-full" name="category">
                            <option value="" disabled selected>Select category</option>
                            <option>LINANG</option>
                            <option>AGAPAY</option>
                            <option>BUKLOD</option>
                            <option>OPTIMA</option>
                            <option>NUMBALIK</option>
                            <option>GALING</option>
                        </select>
                        <div id="category-error" class="error-message label-text-alt text-error"></div>
                    </label>
                </div>
                <div class="grid-cols-12">
                    <label class="form-control w-full">
                        <div class="label py-0.5">
                            <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                PROJECT DETAILS
                            </span>
                        </div>
                        <textarea class="textarea w-full" name="details" placeholder="Enter here"></textarea>
                        <div id="details-error" class="error-message label-text-alt text-error"></div>
                    </label>
                </div>
                <div class="grid-cols-12">
                    <button type="submit" id="saveEntryBtn"
                        class="btn bg-blue-900 hover:bg-blue-950 border-blue-900 text-white disabled:opacity-50 flex items-center justify-center gap-2">
                        <span class="btn-text">Save Entry</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</dialog>
<dialog id="lead_modal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">New Lead Measure</h3>
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <div class="modal-content">
            <form method="POST" class="grid gap-2" id="frmLead">
                @csrf
                <div class="grid-cols-12">
                    <label class="form-control w-full">
                        <div class="label py-0.5">
                            <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                PROJECT
                            </span>
                        </div>
                        <select class="select select-bordered w-full" name="project">
                            <option value="" disabled selected>Select project</option>
                            @foreach($projects as $row)
                            <option value="{{ $row->project_id }}">{{ $row->project_details }}</option>
                            @endforeach
                        </select>
                        <div id="project-error" class="error-message label-text-alt text-error"></div>
                    </label>
                </div>
                <div class="grid-cols-12">
                    <label class="form-control w-full">
                        <div class="label py-0.5">
                            <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                LEAD MEASURE DETAILS
                            </span>
                        </div>
                        <textarea class="textarea w-full" name="lead_measure_details"
                            placeholder="Enter here"></textarea>
                        <div id="lead_measure_details-error" class="error-message label-text-alt text-error"></div>
                    </label>
                </div>
                <div class="grid-cols-12">
                    <button type="submit" id="saveBtn"
                        class="btn bg-blue-900 hover:bg-blue-950 border-blue-900 text-white disabled:opacity-50 flex items-center justify-center gap-2">
                        <span class="btn-text">Save Entry</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</dialog>
<dialog id="target_modal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">New Target</h3>
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <div class="modal-content">
            <form method="POST" class="grid gap-2" id="frmTarget">
                @csrf
                <div class="grid-cols-12">
                    <label class="form-control w-full">
                        <div class="label py-0.5">
                            <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                PROJECT
                            </span>
                        </div>
                        <select class="select select-bordered w-full" name="target_project">
                            <option value="" disabled selected>Select project</option>
                            @foreach($projects as $row)
                            <option value="{{ $row->project_id }}">{{ $row->project_details }}</option>
                            @endforeach
                        </select>
                        <div id="target_project-error" class="error-message label-text-alt text-error"></div>
                    </label>
                </div>
                <div class="grid-cols-12">
                    <label class="form-control w-full">
                        <div class="label py-0.5">
                            <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                TARGET DETAILS
                            </span>
                        </div>
                        <textarea class="textarea w-full" name="target_details" placeholder="Enter here"></textarea>
                        <div id="target_details-error" class="error-message label-text-alt text-error"></div>
                    </label>
                </div>
                <div class="grid-cols-12">
                    <button type="submit" id="btnSaveTarget"
                        class="btn bg-blue-900 hover:bg-blue-950 border-blue-900 text-white disabled:opacity-50 flex items-center justify-center gap-2">
                        <span class="btn-text">Save Entry</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</dialog>
<dialog id="strategy_modal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">New Strategy</h3>
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <div class="modal-content">
            <form method="POST" class="grid gap-2" id="frmStrategy">
                @csrf
                <div class="grid-cols-12">
                    <label class="form-control w-full">
                        <div class="label py-0.5">
                            <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                PROJECT
                            </span>
                        </div>
                        <select class="select select-bordered w-full" name="strat_project">
                            <option value="" disabled selected>Select project</option>
                            @foreach($projects as $row)
                            <option value="{{ $row->project_id }}">{{ $row->project_details }}</option>
                            @endforeach
                        </select>
                        <div id="strat_project-error" class="error-message label-text-alt text-error"></div>
                    </label>
                </div>
                <div class="grid-cols-12">
                    <label class="form-control w-full">
                        <div class="label py-0.5">
                            <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                Strategy
                            </span>
                        </div>
                        <textarea class="textarea w-full" name="strategy" placeholder="Enter here"></textarea>
                        <div id="strategy-error" class="error-message label-text-alt text-error"></div>
                    </label>
                </div>
                <div class="grid-cols-12">
                    <button type="submit" id="btnSave"
                        class="btn bg-blue-900 hover:bg-blue-950 border-blue-900 text-white disabled:opacity-50 flex items-center justify-center gap-2">
                        <span class="btn-text">Save Entry</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</dialog>
<dialog id="output_modal" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">New Output</h3>
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <div class="modal-content">
            <form method="POST" class="grid gap-2" id="frmOutput">
                @csrf
                <div class="grid-cols-12">
                    <label class="form-control w-full">
                        <div class="label py-0.5">
                            <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                PROJECT
                            </span>
                        </div>
                        <select class="select select-bordered w-full" name="output_project">
                            <option value="" disabled selected>Select project</option>
                            @foreach($projects as $row)
                            <option value="{{ $row->project_id }}">{{ $row->project_details }}</option>
                            @endforeach
                        </select>
                        <div id="output_project-error" class="error-message label-text-alt text-error"></div>
                    </label>
                </div>
                <div class="grid-cols-12">
                    <label class="form-control w-full">
                        <div class="label py-0.5">
                            <span class="label-text-alt text-xs font-semibold text-base-content/70">
                                OUTPUT DETAILS
                            </span>
                        </div>
                        <textarea class="textarea w-full" name="output_details" placeholder="Enter here"></textarea>
                        <div id="output_details-error" class="error-message label-text-alt text-error"></div>
                    </label>
                </div>
                <div class="grid-cols-12">
                    <button type="submit" id="btnSaveOutput"
                        class="btn bg-blue-900 hover:bg-blue-950 border-blue-900 text-white disabled:opacity-50 flex items-center justify-center gap-2">
                        <span class="btn-text">Save Entry</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</dialog>
<script>
$('#tbl_project').DataTable({
    "dom": '<"flex justify-between mb-4"lf>rt<"flex justify-between mt-4"ip>'
});
$('#tbl_lead').DataTable({
    "dom": '<"flex justify-between mb-4"lf>rt<"flex justify-between mt-4"ip>'
});
$('#tbl_strategy').DataTable({
    "dom": '<"flex justify-between mb-4"lf>rt<"flex justify-between mt-4"ip>'
});
$('#tbl_output').DataTable({
    "dom": '<"flex justify-between mb-4"lf>rt<"flex justify-between mt-4"ip>'
});
$('#tbl_target').DataTable({
    "dom": '<"flex justify-between mb-4"lf>rt<"flex justify-between mt-4"ip>'
});
</script>
<script>
$('#frmProject').submit(function(e) {
    e.preventDefault();
    let data = $(this).serialize();
    $('.error-message').html('');
    let btn = $('#saveEntryBtn');
    $.ajax({
        url: "{{ route('projects.save') }}",
        method: "POST",
        data: data,
        beforeSend: function() {
            btn.prop('disabled', true);
            btn.html(`
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://w3.org" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Saving...</span>
                `);
        },
        success: function(response) {
            if (response.status === 200) {
                $('#project_modal')[0].close();
                $('#frmProject')[0].reset();
                alertify.alert(
                    'Success',
                    response.message,
                    function() {
                        location.reload();
                    }
                );
            } else {
                var errors = response.errors;
                for (var field in errors) {
                    $('#' + field + '-error').html('<p>' + errors[field][0] + '</p>');
                    $('[name="' + field + '"]').addClass('is-invalid');
                }
            }
        },
        error: function(xhr, status, error) {
            alert('Something went wrong.');
        },
        complete: function() {
            // Use your variable here to reset the button
            btn.prop('disabled', false);
            btn.html('<span class="btn-text">Save Entry</span>');
        }
    });
});

$('.remove_project').on('click', function() {
    let value = $(this).val();
    alertify.confirm(
        'Confirm Deletion',
        'Are you sure you want to delete this record?',
        function() {
            $.ajax({
                url: "{{ route('projects.remove') }}",
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

$('#frmLead').submit(function(e) {
    e.preventDefault();
    let data = $(this).serialize();
    $('.error-message').html('');
    let btn = $('#saveBtn');
    $.ajax({
        url: "{{ route('lead.save') }}",
        method: "POST",
        data: data,
        beforeSend: function() {
            btn.prop('disabled', true);
            btn.html(`
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://w3.org" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Saving...</span>
                `);
        },
        success: function(response) {
            if (response.status === 200) {
                $('#lead_modal')[0].close();
                $('#frmLead')[0].reset();
                alertify.alert(
                    'Success',
                    response.message,
                    function() {
                        location.reload();
                    }
                );
            } else {
                var errors = response.errors;
                for (var field in errors) {
                    $('#' + field + '-error').html('<p>' + errors[field][0] + '</p>');
                    $('[name="' + field + '"]').addClass('is-invalid');
                }
            }
        },
        error: function(xhr, status, error) {
            alert('Something went wrong.');
        },
        complete: function() {
            // Use your variable here to reset the button
            btn.prop('disabled', false);
            btn.html('<span class="btn-text">Save Entry</span>');
        }
    });
});

$('.remove_lead').on('click', function() {
    let value = $(this).val();
    alertify.confirm(
        'Confirm Deletion',
        'Are you sure you want to delete this record?',
        function() {
            $.ajax({
                url: "{{ route('lead.remove') }}",
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

$('#frmStrategy').submit(function(e) {
    e.preventDefault();
    let data = $(this).serialize();
    $('.error-message').html('');
    let btn = $('#btnSave');
    $.ajax({
        url: "{{ route('strategies.save') }}",
        method: "POST",
        data: data,
        beforeSend: function() {
            btn.prop('disabled', true);
            btn.html(`
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://w3.org" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Saving...</span>
                `);
        },
        success: function(response) {
            if (response.status === 200) {
                $('#strategy_modal')[0].close();
                $('#frmStrategy')[0].reset();
                alertify.alert(
                    'Success',
                    response.message,
                    function() {
                        location.reload();
                    }
                );
            } else {
                var errors = response.errors;
                for (var field in errors) {
                    $('#' + field + '-error').html('<p>' + errors[field][0] + '</p>');
                    $('[name="' + field + '"]').addClass('is-invalid');
                }
            }
        },
        error: function(xhr, status, error) {
            alert('Something went wrong.');
        },
        complete: function() {
            // Use your variable here to reset the button
            btn.prop('disabled', false);
            btn.html('<span class="btn-text">Save Entry</span>');
        }
    });
});

$('.remove_strategy').on('click', function() {
    let value = $(this).val();
    alertify.confirm(
        'Confirm Deletion',
        'Are you sure you want to delete this record?',
        function() {
            $.ajax({
                url: "{{ route('strategies.remove') }}",
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

$('#frmOutput').submit(function(e) {
    e.preventDefault();
    let data = $(this).serialize();
    $('.error-message').html('');
    let btn = $('#btnSaveOutput');
    $.ajax({
        url: "{{ route('output.save') }}",
        method: "POST",
        data: data,
        beforeSend: function() {
            btn.prop('disabled', true);
            btn.html(`
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://w3.org" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Saving...</span>
                `);
        },
        success: function(response) {
            if (response.status === 200) {
                $('#output_modal')[0].close();
                $('#frmOutput')[0].reset();
                alertify.alert(
                    'Success',
                    response.message,
                    function() {
                        location.reload();
                    }
                );
            } else {
                var errors = response.errors;
                for (var field in errors) {
                    $('#' + field + '-error').html('<p>' + errors[field][0] + '</p>');
                    $('[name="' + field + '"]').addClass('is-invalid');
                }
            }
        },
        error: function(xhr, status, error) {
            alert('Something went wrong.');
        },
        complete: function() {
            // Use your variable here to reset the button
            btn.prop('disabled', false);
            btn.html('<span class="btn-text">Save Entry</span>');
        }
    });
});

$('.remove_output').on('click', function() {
    let value = $(this).val();
    alertify.confirm(
        'Confirm Deletion',
        'Are you sure you want to delete this record?',
        function() {
            $.ajax({
                url: "{{ route('output.remove') }}",
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

$('#frmTarget').submit(function(e) {
    e.preventDefault();
    let data = $(this).serialize();
    $('.error-message').html('');
    let btn = $('#btnSaveTarget');
    $.ajax({
        url: "{{ route('targets.save') }}",
        method: "POST",
        data: data,
        beforeSend: function() {
            btn.prop('disabled', true);
            btn.html(`
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://w3.org" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Saving...</span>
                `);
        },
        success: function(response) {
            if (response.status === 200) {
                $('#target_modal')[0].close();
                $('#frmTarget')[0].reset();
                alertify.alert(
                    'Success',
                    response.message,
                    function() {
                        location.reload();
                    }
                );
            } else {
                var errors = response.errors;
                for (var field in errors) {
                    $('#' + field + '-error').html('<p>' + errors[field][0] + '</p>');
                    $('[name="' + field + '"]').addClass('is-invalid');
                }
            }
        },
        error: function(xhr, status, error) {
            alert('Something went wrong.');
        },
        complete: function() {
            // Use your variable here to reset the button
            btn.prop('disabled', false);
            btn.html('<span class="btn-text">Save Entry</span>');
        }
    });
});

$('.remove_target').on('click', function() {
    let value = $(this).val();
    alertify.confirm(
        'Confirm Deletion',
        'Are you sure you want to delete this record?',
        function() {
            $.ajax({
                url: "{{ route('targets.remove') }}",
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
