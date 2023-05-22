
@extends('appshell::layouts.private')
@section('title')
{{ __('Calender') }}
@stop
@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/timegrid/main.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<link rel="stylesheet" href="{{ url('/modules/Bookable/resources/assets/css/calendar.css') }}" />
@endpush
@section('content')
<div class="container-fluid mb-5">
    <div id='calendar'></div>
</div>
<div id="eventModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="event-form" data-action="{{ route('bookables.admin.calendar.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Event Title</h5>
                    <a href="#" class="close" rel="modal:close">&times;</a>

                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="eventTitle">Event Title:</label>
                        <input name="title" type="text" class="form-control" id="eventTitle" />
                    </div>
                    <div class="form-group">
                        <label for="eventStart">Start Date:</label>
                        <div class="row">
                            <div class="col">
                                <input type="date" name="startdate" placeholder="dd-mm-yyyy" value="" min="1997-01-01" max="2099-12-31" class="form-control" id="eventStart" />
                            </div>
                            <div class="col">
                                <input type="time" id="appt" name="starttime" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="eventEnd">End Date:</label>
                        <div class="row">
                            <div class="col">
                                <input type="date" name="enddate" placeholder="dd-mm-yyyy" value="" min="1997-01-01" max="2099-12-31" class="form-control" id="eventEnd" />
                            </div>
                            <div class="col">
                                <input type="time" id="appt" name="endtime" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@push('footer-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/interaction/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/timegrid/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
$(document).ready(function () {
    var SITEURL = "{{ url('/admin') }}";
    var modal = $('#eventModal');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = new FullCalendar.Calendar($('#calendar')[0], {
        plugins: ['interaction', 'dayGrid', 'timeGrid'],
        header: {
            left: 'dayGridMonth,timeGridWeek,timeGridDay',
            center: 'title'
        },
        editable: true,
        events: "{{ route('bookables.api.calendar.index') }}",
        displayEventTime: true,
        eventRender: function (info) {
            if (info.event.allDay === 'true') {
                info.event.allDay = true;
            } else {
                info.event.allDay = false;
            }
        },
        selectable: true,
        select: function (info) {
            modal.modal('show');
            modal.find('#eventTitle').val('');
            modal.find('#eventStart').val(info.startStr);
            modal.find('#eventEnd').val(info.startStr);
            var title = 'Event Title:';

        },
        eventDrop: function (info) {
            var start = info.event.startStr;
            var end = info.event.endStr;
            $.ajax({
                url: "{{ route('bookables.admin.calendar.ajax') }}",
                data: {
                    title: info.event.title,
                    start: start,
                    end: end,
                    id: info.event.id,
                    type: 'update'
                },
                type: "POST",
                success: function (response) {
                    displayMessage("Event Updated Successfully");
                }
            });
        },
        eventClick: function (info) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('bookables.admin.calendar.ajax') }}",
                    data: {
                        id: info.event.id,
                        type: 'delete'
                    },
                    success: function (response) {
                        info.event.remove();
                        displayMessage("Event Deleted Successfully");
                    }
                });
            }
        }
    });

    calendar.render();

    // Submit form event listener
    $('#event-form').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var url = form.data('action');

        // Perform form submission using AJAX
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function (response) {
                // Form submitted successfully, reload the calendar
                calendar.refetchEvents();
                 $("#eventModal").hide();
                 displayMessage("Event Added Successfully");
            },
            error: function (xhr, status, error) {
                // Handle error if form submission fails
                console.log(error);
            }
        });
    });
    
    function displayMessage(message) {
        toastr.success(message, 'Event');
    }
});
</script>
@endpush

@endsection