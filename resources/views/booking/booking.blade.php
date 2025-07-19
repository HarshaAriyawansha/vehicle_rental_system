@extends('layouts.app')

@section('content')
@include('navbar.booking_nav')
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <div class="row">
                        <div class="col-12">
                            @can('create_booking')
                            <button type="button" class="btn btn-primary btn-sm fa-pull-right raised"
                                name="create_record" id="create_record"><i class="fas fa-plus me-2"></i>Add
                                Booking</button>
                            @endcan
                        </div>
                        <div class="col-12">
                            <hr class="border-dark">
                        </div>
<!--Database View-->
                        <div class="col-12">
                            <div class="scrollbar pb-3 table_outer" id="style-2">
                                <table class="table table-striped table-bordered table-sm small nowrap"
                                    style="width: 100%" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Booking ID </th>
                                            <th>Customer Name</th>
                                            <th>Customer L.No</th>
                                            <th>Vehicle Number </th>
                                            <th>Mileage </th>
                                            <th>Book Date</th>
                                            <th>Message</th>
                                            <th>Return Date </th>
                                            <th>New Mileage </th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($booking as $list)
                                        <tr>
                                            <td>{{$list->id}}</td>
                                            <td>{{$list->customer_name}}</td>
                                            <td>{{$list->customer_lno}}</td>
                                            <td>{{$list->vehicle_num}}</td>
                                            <td>{{$list->mileage}}</td>
                                            <td>{{$list->book_date}}</td>                                            
                                            <td>{{$list->message}}</td>
                                            <td>{{$list->return_date}}</td>
                                            <td>{{$list->new_mileage}}</td>
                                            <td class="text-end">
                                                @can('update_booking')                                               
                                                <button name="edit" id="{{$list->id}}" 
                                                class="edit btn btn-primary btn-sm" type="submit"><i
                                                        class="fas fa-pencil-alt"></i></button>
                                                @endcan
                                                @can('delete_booking')
                                                <button type="submit" name="delete" onclick="delete_confirmation_alert({{$list->id}});"
                                                    class="delete btn btn-danger btn-sm"><i
                                                        class="far fa-trash-alt"></i></button>
                                                @endcan
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
        </div>
    </div>
</div>

<div class="modal fade" id="formModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Booking</h5>
                <button type="button" class="btn-close raised" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <span id="form_result"></span>
                        <form action="{{url('booking')}}" method="POST" id="formTitle" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Nimal Perera">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Customer L.No</label>
                                <input type="text" class="form-control" id="customer_lno" name="customer_lno" placeholder="B4429965">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Vehicle Number</label>
                                <input type="text" class="form-control" id="vehicle_num" name="vehicle_num" placeholder="PL 9965">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Mileage</label>
                                <input type="text" class="form-control" id="mileage" name="mileage" placeholder="33360">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Book Date</label>
                                <input type="date" class="form-control" id="book_date" name="book_date" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Return Date</label>
                                <input type="date" class="form-control" id="return_date" name="return_date" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">New Mielage</label>
                                <input type="text" class="form-control" id="new_mileage" name="new_mileage" placeholder="39990">
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" name="action_button" id="action_button"
                                    class="btn btn-primary btn-sm fa-pull-right px-4 raised"><i
                                        class="fas fa-plus"></i>&nbsp;Add</button>
                            </div>
                            <input type="hidden" name="action" id="action" value="Add" />
                            <input type="hidden" name="hidden_id" id="hidden_id" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#Booking').addClass('mm-active');
        $('#booking_link').addClass('navbtnactive');

        $('#dataTable').DataTable();

        $('#create_record').click(function(){
            $('.modal-title').text('Add New Booking');
            $('#action_button').html('Add');
            $('#action').val('Add');
            $('#form_result').html('');
            $('#formTitle')[0].reset();

            $('#formModal').modal('show');
        });

        $('#formTitle').on('submit', function(event){
            event.preventDefault();
            var action_url = '';

            if ($('#action').val() == 'Add') {
                action_url = "{{ route('bookingInsert') }}";
            }
            if ($('#action').val() == 'Edit') {
                action_url = "{{ route('bookingUpdate') }}";
            }

            $.ajax({
                url: action_url,
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {

                    var html = '';
                    if (data.errors) {
                        html = '<div class="alert alert-danger">';
                        for (var count = 0; count < data.errors.length; count++) {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                        $('#form_result').html(html);
                    }
                    if (data.success) {
                        round_success_noti(data.success);
                        $('#formTitle')[0].reset();
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }   
                }
            });
        });

        $(document).on('click', '.edit', function () {
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url: "bookingEdit/" + id,
                dataType: "json",
                success: function (data) {
                    $('#booking_id').val(data.result.booking_id);
                    $('#hidden_id').val(id);
                    $('.modal-title').text('Edit Booking');
                    $('#action_button').html('Edit');
                    $('#action').val('Edit');
                    $('#formModal').modal('show');
                }
            })
        });
    });

    function delete_confirmation_alert(id) {
        Lobibox.confirm({
            msg: "Are you sure you want to delete this Record?",
            callback: function ($this, type) {
                if (type === 'yes') {
                    $.ajax({
                        url: '{!! route("bookingDelete") !!}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}', 
                            recordID: id
                        },
                        success: function (data) {
                                var html = '';
                                if (data.errors) {
                                    round_error_noti(data.errors);
                                }
                                if (data.success) {
                                    round_success_noti(data.success);
                                }
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                        }
                    })
                }
            }
        });
    }
</script>
@endsection