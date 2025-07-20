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
                            @can('create_model')
                            <button type="button" class="btn btn-primary btn-sm fa-pull-right raised"
                                name="create_record" id="create_record"><i class="fas fa-plus me-2"></i>Add
                                Model</button>
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
                                            <th>Brand Name</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($brands as $list)
                                        <tr>
                                            <td>{{$list->id}}</td>
                                            <td>{{$list->brand_name}}</td>
                                            <td class="text-end">
                                                <button name="view" id="{{$list->id}}" class="view btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
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
    <div class="modal-dialog modal-dialog-centered model-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Model</h5>
                <button type="button" class="btn-close raised" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="form_div">
                    <div class="col">
                        <span id="form_result"></span>
                        <form id="formTitle" class="form-horizontal">
                            @csrf
                            <div class="md-3">
                                <label class="form-label">Brand</label>
                                <select name="brand" id="brand" class="form-select form-select-sm selecter2" onchange="loadModelTable(this.value);">
                                    <option value="">Select</option>
                                     @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Model Name*</label>
                                <input type="text" class="form-control" id="model_name" name="model_name"
                                    placeholder="Model Name">
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
                <div class="row mt-2">
                    <hr class="border-dark">
                    <div class="scrollbar pb-3" id="style-2">
                        <table class="table table-bordered table-striped table-sm nowrap w-100" id="modelTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Models</th> 
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td class="text-center text-muted" colspan="3">No models found! Please select a brand.</td>
                            </tbody>
                        </table>
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
        $('#model_link').addClass('navbtnactive');

        $('#dataTable').DataTable();

        $('#create_record').click(function(){
            $('.modal-title').text('Add New Model');
            $('#action_button').html('Add');
            $('#action').val('Add');
            $('#form_result').html('');
            $('#formTitle')[0].reset();
            $('#form_div').removeClass('d-none');
            $('#modelTable tbody').empty();
            $('#formModal').modal('show');
        });

        $('#formTitle').on('submit', function(event){
            event.preventDefault();
            var action_url = '';

            if ($('#action').val() == 'Add') {
                action_url = "{{ route('model_insert') }}";
            }
            if ($('#action').val() == 'Edit') {
                action_url = "{{ route('model_update') }}";
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
                        var id = $('#brand').val();
                        loadModelTable(id);
                        round_success_noti(data.success);
                        $('.modal-title').text('Add New Model');
                        $('#action_button').html('Add');
                        $('#action').val('Add');
                        $('#form_result').html('');
                        $('#formTitle')[0].reset();
                    }   
                }
            });
        });

        $(document).on('click', '.edit', function () {
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url: "model_edit/" + id,
                dataType: "json",
                success: function (data) {
                    $('#brand').val(data.result.brand_id);
                    $('#model_name').val(data.result.model_name);
                    $('#hidden_id').val(id);
                    $('.modal-title').text('Edit Model');
                    $('#action_button').html('Edit');
                    $('#action').val('Edit');
                    $('#form_div').removeClass('d-none');
                    $('#formModal').modal('show');
                }
            })
        });

        $(document).on('click', '.view', function () {
            $('#modelTable tbody').empty();
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url: "model_edit/" + id,
                dataType: "json",
                success: function (data) {
                    $('#brand').val(data.result.brand_id);
                    $('#model_name').val(data.result.model_name);
                    $('#hidden_id').val(id);
                    $('.modal-title').text('View Model');
                    $('#form_div').addClass('d-none');
                    $('#formModal').modal('show');
                    loadViewModelTable(id);
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
                        url: '{!! route("model_delete") !!}',
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
                                var brand_id = $('#brand').val();
                                loadModelTable(brand_id);
                        }
                    })
                }
            }
        });
    }

    function loadModelTable(id) {
        let html = '';
        $('#modelTable tbody').empty();
        if(id){
            $.ajax({
                url: "get_model_by_brand/" + id,
                method: "GET",
                success: function (response) {
                    if (response.result.length > 0) {
                        $.each(response.result, function (index, model) {
                            html += '<tr>';
                            html += '<td>' + (index + 1) + '</td>';
                            html += '<td>' + model.model_name + '</td>';
                            html += '<td class="text-end">';

                            if (response.can_edit) {
                                html += '<button name="edit" id="' + model.id + '" class="edit btn btn-primary btn-sm" type="button">';
                                html += '<i class="fas fa-pencil-alt"></i></button> ';
                            }

                            if (response.can_delete) {
                                html += '<button type="button" onclick="delete_confirmation_alert(' + model.id + ');"';
                                html += ' class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>';
                            }

                            html += '</td>';
                            html += '</tr>';
                        });
                    }else{
                        html += '<tr>';
                        html += '<td colspan="3" class="text-center text-muted">No models found for this brand.</td>';
                        html += '</tr>'; 
                    }
                    $('#modelTable tbody').html(html);
                }
            })
        } else {
            html += '<tr>';
            html += '<td colspan="3" class="text-center text-muted">No models found! Please select a brand.</td>';
            html += '</tr>';
            $('#modelTable tbody').html(html);
        }
    }

     function loadViewModelTable(id) {
        let html = '';
        $('#modelTable tbody').empty();
        if(id){
            $.ajax({
                url: "get_model_by_brand/" + id,
                method: "GET",
                success: function (response) {
                    if (response.result.length > 0) {
                        $.each(response.result, function (index, model) {
                            html += '<tr>';
                            html += '<td>' + (index + 1) + '</td>';
                            html += '<td>' + model.model_name + '</td>';
                            html += '</tr>';
                        });
                    }else{
                        html += '<tr>';
                        html += '<td colspan="3" class="text-center text-muted">No models found for this brand.</td>';
                        html += '</tr>'; 
                    }
                    $('#modelTable tbody').html(html);
                }
            })
        } else {
            html += '<tr>';
            html += '<td colspan="3" class="text-center text-muted">No models found! Please select a brand.</td>';
            html += '</tr>';
            $('#modelTable tbody').html(html);
        }
    }
</script>
@endsection