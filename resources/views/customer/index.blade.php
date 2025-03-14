@extends('layouts.template')

@section('content')
    <section class="row mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Data Customer
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table1">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Customer</th>
                                    <th>Nama Customer</th>
                                    <th>Telepon</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('modal')
    <!--Update Modal -->
    <div class="modal fade text-left" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Update Customer</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="formUpdate">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Kode</label>
                                    <input type="text" name="code" class="form-control"
                                        placeholder="Masukan Kode Customer">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Masukan Nama Customer">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">No.Hp</label>
                                    <input type="number" name="telepon" id="telepon" class="form-control"
                                        placeholder="Masukan Harga Customer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#table1').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('customer.index') }}"
            },
            columns: [{
                    data: 'action',
                    name: 'action'
                },
                {
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'telepon',
                    name: 'telepon'
                },
            ],
            drawCallback: settings => {
                renderedEvent()
            }
        })

        const reloadDT = () => {
            $('#table1').DataTable().ajax.reload()
        }

        const modalUpdate = $('#modalUpdate')
        const formUpdate = $('#formUpdate')

        const formSubmit = ($modal, $form, $submit, $href, $method, $addedAction = null) => {
            $modal.modal('show')
            $form.off('submit')
            $form.on('submit', function(e) {
                e.preventDefault();
                clearInvalid();

                let formData = $(this).serialize();

                ajaxSetup();
                $.ajax({
                    url: $href,
                    method: $method,
                    data: formData,
                    dataType: 'json',
                }).done(response => {
                    let {
                        message
                    } = response;
                    successNotification(message);
                    reloadDT();
                    $modal.modal('hide')
                    clearFormCreate()
                    if (addedAction) {
                        addedAction();
                    }
                }).fail(error => {
                    ajaxErrorHandling(error, $form);
                })
            })
        }

        const renderedEvent = () => {
            $.each($('.delete'), (i, deleteBtn) => {
                $(deleteBtn).off('click')
                $(deleteBtn).on('click', function(e) {
                    let {
                        deleteMessage,
                        deleteHref
                    } = $(this).data();
                    confirmation(deleteMessage, function() {
                        ajaxSetup();
                        $.ajax({
                            url: deleteHref,
                            method: 'DELETE',
                            dataType: 'json'
                        }).done(response => {
                            let {
                                message
                            } = response;
                            successNotification(message);
                            reloadDT()
                        }).fail(error => {
                            ajaxErrorHandling(error);
                        })
                    })
                })
            })

            $.each($('.edit'), (i, editBtn) => {
                $(editBtn).off('click')
                $(editBtn).on('click', function() {
                    ajaxSetup()
                    let {
                        getHref,
                        updateHref
                    } = $(this).data()
                    $.get({
                        url: getHref,
                        dataType: 'json'
                    }).done(res => {
                        let customer = res.customer

                        modalUpdate.modal('show');
                        formUpdate.find(`[name="name"]`).val(customer.name);
                        formUpdate.find(`[name="telepon"]`).val(customer.telepon);
                        formUpdate.find(`[name="code"]`).val(customer.code);

                        formSubmit(
                            $('#modalUpdate'),
                            $('#formUpdate'),
                            $('#formUpdate').find(`[type="submit"]`),
                            updateHref,
                            'PUT'
                        )
                    }).fail(err => {
                        warningNotification('Silahkan Ulangi Kembali')
                    })
                })
            })
        }
    </script>
@endsection
