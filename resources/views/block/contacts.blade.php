@extends('layouts.app', [
    'active'    => 'contacts',
    'page_name' => 'contacts',
])

@section('content')
    <div class="container">
        @if(\App\Models\User::isAdmin(Auth::user()->id))
            <button type="button" class="btn-modal-event btnEdit   btn btn-primary" disabled>Edit contact Info</button>
            <button type="button" class="btn-modal-event btnDelete btn btn-danger" disabled>Delete contact</button>
            <button type="button" class="                btnAdd    btn btn-success">Add contact</button>
            <br>
            <br>
        @endif
        <div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="tel_number" class="col-form-label">tel_number</label>
                                <input name="tel_number" data-check="required|phone" id="tel_number"
                                       class="form-control">

                                <label for="last_name" class="col-form-label">last_name</label>
                                <input name="last_name" data-check="required|min:2|max:40|allow:[A-z ]" id="last_name"
                                       class="form-control">

                                <label for="first_name" class="col-form-label">first_name</label>
                                <input name="first_name" data-check="required|min:2|max:40|allow:[A-z ]" id="first_name"
                                       class="form-control">

                                <label for="middle_name" class="col-form-label">middle_name</label>
                                <input name="middle_name" data-check="required|min:2|max:40|allow:[A-z ]"
                                       id="middle_name" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button id="saveEditor" type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table--}}
        <table id="table" class="table table-bcontacted" style="width:100%">
            <thead>
            <tr>
                <th>id</th>
                <th>tel_number</th>
                <th>last_name</th>
                <th>first_name</th>
                <th>middle_name</th>
            </tr>
            </thead>
        </table>

    </div>
@endsection

@section('head')
    <style>
        .ch-msg {
            padding: 3px 0px 2px 6px;
            margin: 0 0 0 0;
            font-size: 12px;
            color: #dc3545;
        }
    </style>
@endsection

@section('footer')
    <script type="text/javascript">

        $(document).ready(function () {

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
            });

            let route = {
                'resource': '{{route('resource.get.contacts')}}',
                'add': '{{route('ajax.add.contact')}}',
                'edit': '{{route('ajax.edit.contact')}}',
                'delete': '{{route('ajax.delete.contact')}}'
            };

            // Modal + Table
            let table = $('#table').DataTable({
                "pageLength": 50,
                "processing": true,
                "serverSide": true,
                "ajax": route['resource'],
                "columns": [
                    {"data": 'id'},
                    {"data": 'tel_number'},
                    {"data": 'last_name'},
                    {"data": 'first_name'},
                    {"data": 'middle_name'},
                ],
            });

            function pullModal() {
                let rowData = table.row('.selected').data();
                $.each(rowData, function (key, value) {
                    $("#" + key).val(value);
                });
            }

            function getData(route) {
                let data = {'_token': $('meta[name="csrf-token"]').attr('content')};

                if (route == 'add') {
                    $('#modal .form-control').each(function (i, elem) {
                        let name = $(elem).attr('name');
                        data[name] = $('#modal #' + name).val();
                    });
                    console.log(data);
                }

                if (route == 'edit') {
                    data['id'] = table.row('.selected').data().id;
                    $('#modal .form-control').each(function (i, elem) {
                        let name = $(elem).attr('name');
                        data[name] = $('#modal #' + name).val();
                    });
                    console.log(data);
                }

                if (route == 'delete') {
                    data['id'] = table.row('.selected').data().id;
                }

                return data;
            }

            table.on('search.dt', function () {
                $('.btn-modal-event').attr("disabled", true);
            });
            $('#table tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                    $('.btn-modal-event').attr("disabled", true);
                } else {
                    table.$('tr.selected').removeClass('selected');
                    $('.btn-modal-event').removeAttr("disabled");
                    $(this).addClass('selected');
                }
            });

            //Set Route Action
            $('.btnAdd').click(function () {
                $('#modal .form-control').val();
                $('#modal').attr('route', 'add');
                $('#modal').modal('show');
            });

            $('.btnEdit').click(function () {
                pullModal();
                $('#modal').attr('route', 'edit');
                $('#modal').modal('show');
            });

            // SEND AJAX

            $(document).on('click', '#saveEditor', function () {

                console.log(va($(this)));

                if (va($(this))) {
                    let route_name = $('#modal').attr('route');
                    let data = getData(route_name);
                    sendAjax(route_name, data);
                }
            });

            $(document).on('click', '.btnDelete', function () {
                let data = getData('delete');
                swal({
                        title: "Are you sure?",
                        text: "Your will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: true
                    },
                    function () {
                        sendAjax('delete', data)
                    });
            });

            function sendAjax(route_name, send_data) {
                $.ajax({
                    type: "POST",
                    url: route[route_name],
                    data: send_data,
                    success: function (data) {
                        $('#modal').modal('hide');
                        table.draw();
                    },
                    error: function (data) {
                        let errors = data.responseJSON['errors'];
                        console.log(errors);
                        for (let key in errors) {
                            $('[name = "' + key + '"]').after('<p class="ch-msg">' + errors[key] + '</p>');
                        }
                    }
                });
            }

        });
    </script>
@endsection
