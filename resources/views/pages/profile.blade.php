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
                                        <div class="grid-cols-12">
                                            <label class="form-control w-full">
                                                <div class="label py-0.5">
                                                    <span
                                                        class="label-text-alt text-xs font-semibold text-base-content/70">
                                                        ACCOUNT CREATION
                                                    </span>
                                                </div>
                                                <input type="text" class="input w-full"
                                                    value="{{ date('M d, Y h:i A',strtotime(Auth::user()->created_at)) }}"
                                                    readonly />
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
                                    <form method="POST" class="grid gap-4" id="form">
                                        @csrf
                                        <div class="grid-cols-12">
                                            <label class="form-control w-full">
                                                <div class="label py-0.5">
                                                    <span
                                                        class="label-text-alt text-xs font-semibold text-base-content/70">
                                                        CURRENT PASSWORD
                                                    </span>
                                                </div>
                                                <input type="password" class="input w-full" name="current_password"
                                                    id="current_password">
                                                <div id="current_password-error"
                                                    class="error-message label-text-alt text-error">
                                                </div>
                                            </label>
                                        </div>
                                        <div class="grid-cols-12">
                                            <label class="form-control w-full">
                                                <div class="label py-0.5">
                                                    <span
                                                        class="label-text-alt text-xs font-semibold text-base-content/70">
                                                        NEW PASSWORD
                                                    </span>
                                                </div>
                                                <input type="password" class="input w-full" name="new_password"
                                                    id="new_password">
                                                <div id="new_password-error"
                                                    class="error-message label-text-alt text-error">
                                                </div>
                                            </label>
                                        </div>
                                        <div class="grid-cols-12">
                                            <label class="form-control w-full">
                                                <div class="label py-0.5">
                                                    <span
                                                        class="label-text-alt text-xs font-semibold text-base-content/70">
                                                        CONFIRM PASSWORD
                                                    </span>
                                                </div>
                                                <input type="password" class="input w-full" name="confirm_password"
                                                    id="confirm_password">
                                                <div id="confirm_password-error"
                                                    class="error-message label-text-alt text-error">
                                                </div>
                                            </label>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <div class="form-control">
                                                <label class="label cursor-pointer gap-2">
                                                    <input type="checkbox" name="show"
                                                        class="checkbox checkbox-primary checkbox-sm"
                                                        id="showPassword" />
                                                    <span class="label-text text-sm">Show Password</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="grid-cols-12">
                                            <button type="submit" id="saveBtn"
                                                class="btn bg-blue-900 hover:bg-blue-950 border-blue-900 text-white disabled:opacity-50 flex items-center justify-center gap-2">
                                                <span class="btn-text">Save Changes</span>
                                            </button>
                                        </div>
                                    </form>
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
$('#showPassword').change(function() {
    togglePasswordVisibility(["current_password", "new_password", "confirm_password"]);
});

function togglePasswordVisibility(ids) {
    ids.forEach(id => {
        const input = document.getElementById(id);
        if (input) {
            input.type = input.type === "password" ? "text" : "password";
        }
    });
}

$('#form').submit(function(e) {
    e.preventDefault();
    let data = $(this).serialize();
    $('.error-message').html('');
    let btn = $('#saveBtn');
    $.ajax({
        url: "{{ route('password.change') }}",
        method: "POST",
        data: data,
        beforeSend: function() {
            btn.prop('disabled', true);
            btn.html(`
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://w3.org" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Processing...</span>
                `);
        },
        success: function(response) {
            if (response.status === 200) {
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
            btn.html('<span class="btn-text">Save Change</span>');
        }
    });
});
</script>
@endsection
