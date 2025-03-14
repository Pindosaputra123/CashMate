@extends('layouts.template')

@section('content')
    <section class="row mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Data User
                        <div class="float-end">
                            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">Tambah</a>
                        </div>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Aksi</th>
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
<!--Basic Modal -->
<div class="modal fade text-left" id="modalUpdate" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel1" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel1">Update User</h5>
            <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <form id="formUpdate">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama Pegawai">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Masukan Email Pegawai">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" id="phone" class="form-control" placeholder="Masukan No.Hp Pegawai">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukan No.Hp Pegawai">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" class="btn btn-primary ms-1" >
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
                url: "{{ route('user.index') }}"
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    mame: 'phone'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
            drawCallback: settings => {
                renderedEvent()
            }
        })

        const modalUpdate = $('#modalUpdate')
        const formUpdate = $('#formUpdate')

        const reloadDT = () => {
            $('#table1').DataTable().ajax.reload()
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
                    console.log(getHref + "||" + updateHref);
                    $.get({
                        url: getHref,
                        dataType: 'json'
                    }).done(res => {
                        let user = res.user

                        modalUpdate.modal('show');
                        formUpdate.find(`[name="name"]`).val(user.name);
                        formUpdate.find(`[name="email"]`).val(user.email);
                        formUpdate.find(`[name="phone"]`).val(user.phone);

                        
                        formUpdate.on('submit', function(e) {
                            e.preventDefault();
                            ajaxSetup();
                            
                            let data = $(this).serialize();

                            $.ajax({
                                url: updateHref,
                                method: 'put',
                                data: data,
                                dataType: 'json',
                            }).done(res => {
                                reloadDT()
                                modalUpdate.modal('hide')
                                let message = res.message
                                successNotification(message)
                            }).fail(err => {
                                ajaxErrorHandling(err, formUpdate)
                            })
                        })
                    }).fail(err => {
                        console.log(err);
                    })
                })
            })
        }
    </script>
@endsection
