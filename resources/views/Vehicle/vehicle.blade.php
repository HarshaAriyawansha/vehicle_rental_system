@extends('layouts.app')

@section('content')
@include('navbar.vehicle_nav')
<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <div class="row">
                        <div class="col-12">
                            @can('create_vehicle')
                            <button type="button" class="btn btn-primary btn-sm fa-pull-right raised"
                                name="create_record" id="create_record"><i class="fas fa-plus me-2"></i>Add
                                Vehicle</button>
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
                                            <th>ID </th>
                                            <th>Vehicle Name</th>
                                            <th>vehicle Number </th>
                                            <th>Price Per KM</th>
                                            <th>Fuel Type </th>
                                            <th>Model Year </th>
                                            <th>Seating Capacity </th>
                                            <th>Air Conditioner </th>
                                            <th>Air Bags </th>
                                            <th>Antilock Braking System </th>
                                            <th>Power Windows </th>
                                            <th>CD Player </th>
                                            <th>Rag Date </th>
                                            <th>Car Availability </th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($vehicle as $list)
                                        <tr>
                                            <td>{{$list->id}}</td>
                                            <td>{{$list->vehicle_name}}</td>
                                            <td>{{$list->vehicle_num }}</td>                                           
                                            <td>{{$list->price_per_km}}</td>
                                            <td>{{$list->fuel_type}}</td>
                                            <td>{{$list->model_year}}</td>
                                            <td>{{$list->seating_capacity}}</td>
                                            <td>{{$list->air_conditioner}}</td>                                            
                                            <td>{{$list->air_bags}}</td>
                                            <td>{{$list->antilock_braking_system}}</td>
                                            <td>{{$list->power_windows}}</td>
                                            <td>{{$list->cd_player}}</td>
                                            <td>{{$list->rag_date}}</td>                                            
                                            <td>{{$list->car_availability}}</td>

                                            <td class="text-end">
                                                @can('update_vehicle')                                 
                                                <button name="edit" id="{{$list->id}}"
                                                    class="edit btn btn-primary btn-sm" type="submit"><i
                                                        class="fas fa-pencil-alt"></i></button>
                                                @endcan
                                                @can('delete_vehicle')
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

<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Vehicle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span id="form_result"></span>
                <form action="{{ url('vehicle') }}" method="POST" id="formTitle" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3 mb-2">
                        <div class="col-md-3">
                            <label class="form-label">Brand</label>
                            <select name="brand" id="brand" class="form-select form-select-sm selecter2">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Model</label>
                            <select name="model" id="model" class="form-select form-select-sm selecter2">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Vehicle Name</label>
                            <input type="text" class="form-control" name="vehicle_name" placeholder="Vehicle Name">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Vehicle Number</label>
                            <input type="text" class="form-control" name="vehicle_num" placeholder="PL 9965">
                        </div>
                    </div>

                    <div class="row g-3 mb-2">
                        <div class="col-md-3">
                            <label class="form-label">Price Per KM</label>
                            <input type="text" class="form-control" name="price_per_km" placeholder="Rs: 100">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Fuel Type</label>
                            <input type="text" class="form-control" name="fuel_type" placeholder="Petrol/Diesel">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Model Year</label>
                            <input type="text" class="form-control" name="model_year" placeholder="2015">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Seating Capacity</label>
                            <input type="text" class="form-control" name="seating_capacity" placeholder="5">
                        </div>
                    </div>

                    <div class="row g-3 mb-2">
                        <div class="col-md-3">
                            <label class="form-label">Air Conditioner</label>
                            <input type="checkbox" class="form-check-input" data-size="sm" checked data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Air Bags</label>
                            <input type="text" class="form-control" name="air_bags" placeholder="Yes / No">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">ABS</label>
                            <input type="text" class="form-control" name="antilock_braking_system" placeholder="Yes / No">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Power Windows</label>
                            <input type="text" class="form-control" name="power_windows" placeholder="Yes / No">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <label class="form-label">CD Player</label>
                            <input type="text" class="form-control" name="cd_player" placeholder="Yes / No">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Vehicle Available</label>
                            <input type="text" class="form-control" name="car_availability" placeholder="Yes / No">
                        </div>
                    </div>

                    <input type="hidden" name="action" value="Add" />
                    <input type="hidden" name="hidden_id" />

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary btn-sm px-4">
                            <i class="fas fa-plus"></i> Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#Vehicle').addClass('mm-active');
        $('#vehicle_link').addClass('navbtnactive');

        $('#dataTable').DataTable();

        $('#create_record').click(function(){
            $('.modal-title').text('Add New Vehicle');
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
                action_url = "{{ route('vehicleInsert') }}";
            }
            if ($('#action').val() == 'Edit') {
                action_url = "{{ route('vehicleUpdate') }}";
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
                url: "vehicleEdit/" + id,
                dataType: "json",
                success: function (data) {
                    $('#vehicle_name').val(data.result.vehicle_name);
                    $('#vehicle_num').val(data.result.vehicle_num);
                    $('#price_per_km').val(data.result.price_per_km);
                    $('#fuel_type').val(data.result.fuel_type);
                    $('#model_year').val(data.result.model_year);
                    $('#seating_capacity').val(data.result.seating_capacity);
                    $('#air_conditioner').val(data.result.air_conditioner);
                    $('#air_bags').val(data.result.air_bags);
                    $('#antilock_braking_system').val(data.result.antilock_braking_system);
                    $('#power_windows').val(data.result.power_windows);
                    $('#cd_player').val(data.result.cd_player);
                    $('#car_availability').val(data.result.car_availability);
                    $('#hidden_id').val(id);
                    $('.modal-title').text('Edit Vehicle');
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
                        url: '{!! route("vehicleDelete") !!}',
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