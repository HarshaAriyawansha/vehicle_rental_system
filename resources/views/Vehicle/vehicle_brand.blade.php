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
                            @can('create_brand')
                            <button type="button" class="btn btn-primary btn-sm fa-pull-right raised"
                                name="create_record" id="create_record"><i class="fas fa-plus me-2"></i>Add
                                Brand</button>
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
                                        @foreach($brand as $list)
                                        <tr>
                                            <td>{{$list->id}}</td>
                                            <td>{{$list->brand_name}}</td>
                                            <td class="text-end">
                                                @can('update_brand')
                                                <button name="edit" id="{{$list->id}}"
                                                    class="edit btn btn-primary btn-sm" type="submit"><i
                                                        class="fas fa-pencil-alt"></i></button>
                                                @endcan
                                                @can('delete_brand')
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
                <h5 class="modal-title" id="staticBackdropLabel">Add Brand</h5>
                <button type="button" class="btn-close raised" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <span id="form_result"></span>
                        <form id="formTitle" class="form-horizontal">
                            @csrf
                            <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Brand Name*</label>
                            <input type="text" class="form-control" id="brand_name" name="brand_name"
                                placeholder="Brand Name" >
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Image</label>
                            <input class="form-control" type="file" id="formFile">
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
        $('#Vehicle').addClass('mm-active');
        $('#brand_link').addClass('navbtnactive');

        $('#dataTable').DataTable();

        $('#create_record').click(function(){
            $('.modal-title').text('Add New Brand');
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
                action_url = "{{ route('brandInsert') }}";
            }
            if ($('#action').val() == 'Edit') {
                action_url = "{{ route('brandUpdate') }}";
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
                url: "brandEdit/" + id,
                dataType: "json",
                success: function (data) {
                    $('#brand_name').val(data.result.brand_name);
                    $('#hidden_id').val(id);
                    $('.modal-title').text('Edit Brand');
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
                        url: '{!! route("brandDelete") !!}',
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