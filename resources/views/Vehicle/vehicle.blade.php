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
                        <div class="col-12">
                            <div class="scrollbar pb-3 table_outer" id="style-2">
                                <table class="table table-striped table-bordered table-sm small nowrap"
                                    style="width: 100%" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID </th>
                                            <th>Vehicle Brand</th>
                                            <th>Vehicle Model</th>
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
                                            <td>{{$list->model_name}}</td>
                                            <td>{{$list->model_name}}</td>
                                            <td>{{$list->vehicle_num }}</td>                                           
                                            <td>{{$list->price_per_km}}</td>
                                            <td>{{$list->fuel_type}}</td>
                                            <td>{{$list->model_year}}</td>
                                            <td>{{$list->seating_capacity}}</td>
                                             <td class="text-center">
                                                {!! $list->air_conditioner ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}
                                            </td>
                                            <td class="text-center">
                                                {!! $list->air_bags ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}
                                            </td>
                                            <td class="text-center">
                                                {!! $list->antilock_braking_system ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}
                                            </td>
                                            <td class="text-center">
                                                {!! $list->power_windows ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}
                                            </td>
                                            <td class="text-center">
                                                {!! $list->cd_player ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>' !!}
                                            </td>

                                            <td>{{ $list->rag_date }}</td>
                                            <td>
                                                {!! $list->car_availability ? '<span class="badge bg-success">Available</span>' : '<span class="badge bg-danger">Unavailable</span>' !!}
                                            </td>

                                            <td class="text-end">
                                                @can('update_vehicle')     
                                                <button name="edit" id="{{$list->id}}"
                                                    class="edit btn btn-primary btn-sm" type="submit"><i
                                                        class="fas fa-pencil-alt"></i></button>
                                                    <button name="add_image" id="{{$list->id}}"
                                                    class="add_image btn btn-secondary btn-sm" type="submit"><i
                                                        class="fas fa-image"></i></button>
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
                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <label class="form-label">Brand <span class="text-danger">*</span></label>
                            <select name="brand" id="brand" class="form-select form-select-sm selecter2" required>
                                <option value="">Select Brand</option>
                                @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Model <span class="text-danger">*</span></label>
                            <select name="model" id="model" class="form-select form-select-sm selecter2" required>
                                <option value="">Select Model</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Model Year <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-sm" name="model_year" id="model_year" placeholder="2015" min="1900" max="{{ date('Y')+1 }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Vehicle Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="vehicle_num" id="vehicle_num" placeholder="PL 9965" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <label class="form-label">Fuel Type <span class="text-danger">*</span></label>
                            <select name="fuel_type" id="fuel_type" class="form-select form-select-sm" required>
                                <option value="">Select</option>
                                <option value="Petrol">Petrol</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Electric">Electric</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Price Per KM <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text">Rs.</span>
                                <input type="number" class="form-control" name="price_per_km" id="price_per_km" placeholder="100" required>
                            </div>
                        </div>                     
                        <div class="col-md-3">
                            <label class="form-label">Seating Capacity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control form-control-sm" name="seating_capacity" id="seating_capacity" placeholder="5" min="1" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Vehicle Available</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="car_availability" id="car_availability" checked>
                                <label class="form-check-label">Available</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <label class="form-label">Air Conditioner</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="air_conditioner" id="air_conditioner">
                                <label class="form-check-label">Available</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Air Bags</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="air_bags" id="air_bags">
                                <label class="form-check-label">Available</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">ABS</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="antilock_braking_system" id="antilock_braking_system">
                                <label class="form-check-label">Available</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Power Windows</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="power_windows" id="power_windows">
                                <label class="form-check-label">Available</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <label class="form-label">CD Player</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="cd_player" id="cd_player">
                                <label class="form-check-label">Available</label>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="action" id="action" value="Add">
                    <input type="hidden" name="hidden_id" id="hidden_id">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm px-4">
                            <i class="fas fa-save me-1"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="imageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Images</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-5">
                        <span id="form_result"></span>
                        <form action="{{ url('vehicle') }}" method="POST" id="formTitle" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3 mb-3">
                                <label for="formFile" class="form-label">Image</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>
                             <div class="row g-3 mb-3">
                                <label class="form-label">Preview <span class="text-danger">*</span></label>
                                <img id="imagePreview" src="#" alt="Image Preview" class="img-thumbnail" style="display:none; max-width: 100%; height: auto;" />
                            </div>
                            <input type="hidden" name="action" id="action" value="Add">
                            <input type="hidden" name="hidden_id" id="hidden_id">

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary btn-sm px-4">
                                    <i class="fas fa-plus me-1"></i> Add
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-7">
                        <hr class="border-dark">
                        <div class="scrollbar pb-3" id="style-2">
                            <table class="table table-bordered table-striped table-sm nowrap w-100" id="imageTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th> 
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td class="text-center text-muted" colspan="3">No Images found!</td>
                                </tbody>
                            </table>
                        </div>
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
        $('#Vehicle').addClass('mm-active');
        $('#vehicle_link').addClass('navbtnactive');

        let vehicle_brand = $('#brand');
        let vehicle_model = $('#model');

        vehicle_model.select2({
            dropdownParent: $('#formModal'),
            placeholder: 'Select...',
            width: '100%',
            allowClear: true,
            ajax: {
                url: '{{url("vehicle_model_list_sel2")}}',
                dataType: 'json',
                data: function (params) {
                    return {
                        term: params.term || '',
                        page: params.page || 1,
                        vehicle_brand: vehicle_brand.val()
                    }
                },
                cache: true
            }
        });

        $('#dataTable').DataTable();

        $('#create_record').click(function(){
            $('.modal-title').text('Add New Vehicle');
            $('#action_button').html('Add');
            $('#action').val('Add');
            $('#form_result').html('');
            $('#formTitle')[0].reset();

            $('#formModal').modal('show');
        });

        $('#formTitle').on('submit', function (event) {
            event.preventDefault();

            let form = this;
            let formData = new FormData(form);
            let action = $('input[name="action"]').val();
            let action_url = action === 'Add' 
                ? "{{ route('vehicleInsert') }}" 
                : "{{ route('vehicleUpdate') }}";

            formData.set('air_conditioner', $('input[name="air_conditioner"]').is(':checked') ? 1 : 0);
            formData.set('air_bags', $('input[name="air_bags"]').is(':checked') ? 1 : 0);
            formData.set('antilock_braking_system', $('input[name="antilock_braking_system"]').is(':checked') ? 1 : 0);
            formData.set('power_windows', $('input[name="power_windows"]').is(':checked') ? 1 : 0);
            formData.set('cd_player', $('input[name="cd_player"]').is(':checked') ? 1 : 0);
            formData.set('car_availability', $('input[name="car_availability"]').is(':checked') ? 1 : 0);

            $.ajax({
                url: action_url,
                method: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#form_result').html('');
                },
                success: function (data) {
                    if (data.errors) {
                        let html = '<div class="alert alert-danger">';
                        $.each(data.errors, function (key, value) {
                            html += '<p>' + value + '</p>';
                        });
                        html += '</div>';
                        $('#form_result').html(html);
                    }

                    if (data.success) {
                        round_success_noti(data.success);
                        $('#formTitle')[0].reset();
                        $('#form_result').html('');
                        $('#formModal').modal('hide');

                        // Optional: if you want full page reload instead
                        setTimeout(() => location.reload(), 1000);
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    $('#form_result').html('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
                }
            });
        });

        $(document).on('click', '.edit', function () {
            var id = $(this).attr('id');
            $('#form_result').html('');
            $('#model').val('').trigger('change')
            $.ajax({
                url: "vehicleEdit/" + id,
                dataType: "json",
                success: function (data) {
                    $('#brand').val(data.result.brand_id);
                    var model_id = data.result.model_id;
                    var model_name = data.result.model_name;
                    if (model_id && model_name) {
                        var option = new Option(model_name, model_id, true, true);
                        $('#model').append(option).trigger('change');
                    }

                    $('#vehicle_num').val(data.result.vehicle_num);
                    $('#price_per_km').val(data.result.price_per_km);
                    $('#fuel_type').val(data.result.fuel_type);
                    $('#model_year').val(data.result.model_year);
                    $('#seating_capacity').val(data.result.seating_capacity);
                    $('#air_conditioner').prop('checked', data.result.air_conditioner == 1);
                    $('#air_bags').prop('checked', data.result.air_bags == 1);
                    $('#antilock_braking_system').prop('checked', data.result.antilock_braking_system == 1);
                    $('#power_windows').prop('checked', data.result.power_windows == 1);
                    $('#cd_player').prop('checked', data.result.cd_player == 1);
                    $('#car_availability').prop('checked', data.result.car_availability == 1);
                    $('#hidden_id').val(id);
                    $('.modal-title').text('Edit Vehicle');

                    $('#action_button').html('Edit');
                    $('#action').val('Edit');
                    $('#formModal').modal('show');
                }
            })
        });

        $(document).on('click', '.add_image', function () {
            var id = $(this).attr('id');
            $('#imageModal').modal('show');
        });

        $('#formFile').on('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').attr('src', e.target.result).removeClass('d-none');
            }
            reader.readAsDataURL(file);
        }
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

    function loadImageTable(vehicleId) {
        $('#imageTable tbody').empty(); 

        $.ajax({
            url: '/get_vehicle_images/' + vehicleId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.data.length > 0) {
                    let html = '';
                    $.each(response.data, function(index, item) {
                        html += `<tr>
                            <td>${index + 1}</td>
                            <td><img src="/storage/${item.image}" class="img-thumbnail" style="max-height: 70px;"></td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteImage(${item.id})">Delete</button>
                            </td>
                        </tr>`;
                    });
                    $('#imageTable tbody').html(html);
                } else {
                    $('#imageTable tbody').html('<tr><td class="text-center text-muted" colspan="3">No Images found!</td></tr>');
                }
            }
        });
    }

    function deleteImage(id) {
        if (confirm('Are you sure you want to delete this image?')) {
            $.ajax({
                url: '/delete_vehicle_image/' + id,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    round_success_noti(response.success);
                    loadImageTable($('#hidden_id').val());
                }
            });
        }
    }


</script>
@endsection