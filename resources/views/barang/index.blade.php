@extends('layouts.template')

@section('content')
    <section class="row mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Data Barang

                        <div class="float-end">
                            <button id="btnTambah" class="btn btn-primary btn-sm" >Tambah</button>
                        </div>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table1">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
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
    <!--Create Modal -->
    <div class="modal fade text-left" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Tambah Barang</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="formCreate">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Kode</label>
                                    <input type="text" name="kode" class="form-control"
                                        placeholder="Masukan Kode Barang">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Masukan Nama Barang">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input type="number" name="price" id="price" class="form-control"
                                        placeholder="Masukan Harga Barag">
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

    <!--Update Modal -->
    <div class="modal fade text-left" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Update Barang</h5>
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
                                    <input type="text" name="kode" class="form-control"
                                        placeholder="Masukan Kode Barang">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Masukan Nama Barang">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input type="number" name="price" id="price" class="form-control"
                                        placeholder="Masukan Harga Barag">
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
                url: "{{ route('barang.index') }}"
            },
            columns: [{
                    data: 'action',
                    name: 'action'
                },
                {
                    data: 'kode',
                    name: 'kode'
                },
                {
                    data: 'name',
                    mame: 'name'
                },
                {
                    data: 'price',
                    name: 'price'
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
                        let barang = res.barang

                        modalUpdate.modal('show');
                        formUpdate.find(`[name="name"]`).val(barang.name);
                        formUpdate.find(`[name="price"]`).val(barang.price);
                        formUpdate.find(`[name="kode"]`).val(barang.kode);

                        formSubmit(
                            $('#modalUpdate'),
                            $('#formUpdate'),
                            $('#formUpdate').find(`[type="submit"]`),
                            updateHref,
                            'PUT'
                        )
                    }).fail(err => {
                        console.log(err);
                    })
                })
            })
        }

        $('#btnTambah').on('click', function() {
            $('#modalCreate').modal('show')
        })

        formSubmit(
            $('#modalCreate'),
            $('#formCreate'),
            $('#formCreate').find(`[type='submit']`),
            "{{ route('barang.store') }}",
            'POST'
        )
    </script>
@endsection
