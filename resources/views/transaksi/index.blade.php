@extends('layouts.template')

@section('content')
    <section class="row mt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Data Transaksi
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table1">
                            <thead>
                                <tr>
                                    <th style="width: 10%">No Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Nama Custtomer</th>
                                    <th>Jumlah Barang</th>
                                    <th>Subtotal</th>
                                    <th>Diskon</th>
                                    <th>Ongkir</th>
                                    <th>Total Bayar</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                        <div class="float-end mt-3">
                            <div class="form-group">
                                <label for="">Grand Total  : </label>
                                <input type="text" class="form-control" readonly value="Rp. {{ $grandTotal }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('script')
    <script>
        $('#table1').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('incoming_sale.index') }}"
            },
            columns: [
                {
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'cust_id',
                    name: 'cust_id'
                },
                {
                    data: 'jumlah_barang',
                    name: 'jumlah_barang'
                },
                {
                    data: 'subtotal',
                    name: 'subtotal'
                },
                {
                    data: 'diskon',
                    name: 'diskon'
                },
                {
                    data: 'ongkir',
                    name: 'ongkir'
                },
                {
                    data: 'total_bayar',
                    name: 'total_bayar'
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
        }
    </script>
@endsection
