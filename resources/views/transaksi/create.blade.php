@extends('layouts.template')

@section('content')
    <section class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form id="form">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="button" class='btn btn-primary mb-2' style='width: 100%'>
                                    Transaksi
                                </button>
                                <div class="form-group">
                                    <label for="kode">Kode transaski</label>
                                    <input type="text" class="form-control" id="kode" name="kode"
                                        value="{{ App\Models\Sale::createFormatTransaksi() }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <button type="button" class='btn btn-primary' style='width: 100%'>
                                    Customer
                                </button>

                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="cust_id">Customer</label>
                                            <select class="choices form-select" id="cust_id" name="cust_id">
                                                <option value="" selected>Silahkan Pilih Cust</option>
                                                @foreach ($cust as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->code . '-' . $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for=""></label>
                                            <button type="button" id="btnModalCust"
                                                class="btn btn-primary form-control">Add Cust</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Masukan Nama Customer">
                                </div>

                                <div class="form-group">
                                    <label for="telepon">Telepon</label>
                                    <input type="number" class="form-control" id="telepon" name="telepon"
                                        placeholder="Masukan No telpon Cust">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table id="table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">
                                            <button type="button" id="btnTambah" class="btn btn-primary">Tambah</button>
                                        </th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Harga Bandrol</th>
                                        <th><span class="text-danger">Dis</span><br>%</th>
                                        <th><span class="text-danger">Kon</span><br>(Rp)</th>
                                        <th>Harga Diskon</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Total Harga</label>
                                        <input type="number" class="form-control" id="totalPay" name="total" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Diskon</label>
                                        <input type="number" class="form-control" id="diskonPay" name="diskonPay" >
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Ongkir</label>
                                        <input type="number" class="form-control" id="ongkir" name="ongkir">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Total Bayar</label>
                                        <input type="number" class="form-control" id="total_bayar" name="total_bayar" readonly>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <hr>
                        <div class="mb-2">
                            <center>
                                <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                                <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('modal')
    {{-- Modal Create cust --}}
    <div class="modal fade text-left" id="modalGetCust" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Pilih Cust</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="formCust">
                    <div class="modal-body mt-2">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="code">Kode Cust</label>
                                    <input type="text" class="form-control" id="code" name="code"
                                        placeholder="Masukan Kode Customer">
                                </div>

                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Masukan Nama Customer">
                                </div>

                                <div class="form-group">
                                    <label for="telepon">Telepon</label>
                                    <input type="number" class="form-control" id="telepon" name="telepon"
                                        placeholder="Masukan No telpon Cust">
                                </div>
                            </div>
                        </div>

                        <br>
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

    {{-- Modal Keranjang --}}

    <div class="modal fade text-left" id="modalKeranjang" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Pilih Barang</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="formKeranjang">
                    <div class="modal-body mt-2">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kodeBarang">Kode - Name</label>
                                    <select class="choices form-select" id="barang" name="barang">
                                        <option value="" selected>Silahkan Pilih barang</option>
                                        @foreach ($barangs as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->kode . '-' . $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Kode Barang</label>
                                    <input type="text" name="kode_barang" class="form-control"
                                        placeholder="Silahkan Pilih Barang" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Name Barang</label>
                                    <input type="text" name="name_barang" class="form-control"
                                        placeholder="Silahkan Pilih Barang" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <input type="text" name="qty" class="form-control"
                                        placeholder="Masukan Jumlah Barang" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Harga Bandrol</label>
                                    <input type="text" name="price" class="form-control"
                                        placeholder="Silahkan Pilih Barang" readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Diskon (%)</label>
                                    <input type="text" name="diskon" class="form-control"
                                        placeholder="Silahkan Masukan Persentase Diskon" required>
                                </div>
                            </div>
                        </div>

                        <br>
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
        let choices = document.querySelectorAll(".choices")
        let initChoice
        for (let i = 0; i < choices.length; i++) {
            if (choices[i].classList.contains("multiple-remove")) {
                initChoice = new Choices(choices[i], {
                    delimiter: ",",
                    editItems: true,
                    maxItemCount: -1,
                    removeItemButton: true,
                })
            } else {
                initChoice = new Choices(choices[i])
            }
        }

        var $btnModalCust = $('#btnModalCust')
        $btnModalCust.on('click', function() {
            $('#modalGetCust').modal('show')
        })

        $('#form').find(`[name="cust_id"]`).on('change', function() {
            let id = $(this).val();

            if (id) {
                $.get({
                        url: `{{ route('getCust') }}?id=${id}`,
                        dataType: 'json'
                    })
                    .done(response => {
                        let [customer] = response.cust

                        $('#form').find(`[name="name"]`).val(customer.name)
                        $('#form').find(`[name="telepon"]`).val(customer.telepon)
                    })
            }
        });

        $('#formCust').on('submit', function(e) {
            e.preventDefault();
            ajaxSetup()

            let data = $('#formCust').serialize();
            $.ajax({
                    url: "{{ route('customer.store') }}",
                    type: "POST",
                    data: data,
                    dataType: 'json'
                }).done(response => {
                    let message = response.message;
                    windowReload(100)
                    successNotification(message)
                })
                .fail(error => {

                    ajaxErrorHandling(error, $formCreate)
                })
        });

        $('#btnTambah').on('click', function() {
            $('#modalKeranjang').modal('show');
        })

        $('#formKeranjang').find(`[name="barang"]`).on('change', function() {
            let id = $(this).val();

            if (id) {
                $.get({
                        url: `{{ route('getBarang') }}?id=${id}`,
                        dataType: 'json'
                    })
                    .done(response => {
                        let [barang] = response.data

                        $('#formKeranjang').find(`[name="name_barang"]`).val(barang.name)
                        $('#formKeranjang').find(`[name="kode_barang"]`).val(barang.kode)
                        $('#formKeranjang').find(`[name="price"]`).val(barang.price)
                    })
            }
        })

        $('#formKeranjang').on('submit', function(e) {
            e.preventDefault()

            let name = $('#formKeranjang').find(`[name="name_barang"]`).val()
            let kode = $('#formKeranjang').find(`[name="kode_barang"]`).val()
            let price = parseFloat($('#formKeranjang').find(`[name="price"]`).val())
            let qty = parseFloat($('#formKeranjang').find(`[name="qty"]`).val())
            let diskon = parseFloat($('#formKeranjang').find(`[name="diskon"]`).val())

            let nominalDiskon = price * (diskon / 100)

            let finalPrice = price - nominalDiskon

            let totalPrice = finalPrice * qty

            var newRow =
                '<tr><td> <button type="button" class="btn btn-danger btn-sm remove">Hapus</button>  </td> <td class="kode">' +
                kode + '</td><td class="name">' + name + '</td><td class="qty">' + qty + '</td><td class="price">' + price + '</td><td class="persen">' + diskon +
                '</td><td class="nominalDiskon">' + nominalDiskon + '</td><td class="finalPrice">' + finalPrice + '</td><td class="totalPrice">' +
                totalPrice + '</td></tr>'

            $('#table').find('tbody').append(newRow);
            renderedEvent()
            getTotal()
            $('#table tbody tr').keyup(function() {
                getTotal();
            })
            $('#modalKeranjang').modal('hide')
        })

        const renderedEvent = () => {
            $('.remove').off('click')
            $('.remove').on('click', function() {
                $(this).parents('tr').remove()
                renderedEvent()
                getTotal()
            })
        }

        // const formatRp = (angka) => {
        //     return new Intl.numberFormat('en-ID', {
        //     style: 'currency',
        //     currency: 'IDR',
        //     minimumFractionDigits: 0
        //     }).format(angka)
        // }

        const getTotal = () => {
            $(function(){
                let nominal = 0;
                $('.totalPrice').each(function() {
                    var total = $(this).text();
                    nominal += parseFloat(total)
                })

                $('#totalPay').val(nominal)
            })
        }

        $('.totalPrice').keyup(function() {
            getTotal();
        })

        $('#diskonPay').on('input', function(){
            let diskon = $(this).val();
            let totalPay = $('#totalPay').val();
            let total_bayar = totalPay - diskon;
            $('#total_bayar').val(total_bayar);
            
            $('#ongkir').on('input', function(){
                let ongkir = $(this).val();
                let totalPay = $('#total_bayar').val();
                let total = total_bayar - ongkir;
                $('#total_bayar').val(total);
            })
        })


        $('#form').on('submit', function(e) {
            e.preventDefault();
            

            var tableData = [];

            let data = $('#form').serialize();
            
            $('#table').find('tbody').find('tr').each(function() {
                var row = $(this);
                var rowData = {
                    kode: row.find('.kode').text(),
                    name: row.find('.name').text(),
                    qty: row.find('.qty').text(),
                    price: row.find('.price').text(),
                    diskon: row.find('.persen').text(),
                    nominalDiskon: row.find('.nominalDiskon').text(),
                    hargaDiskon: row.find('.finalPrice').text(),
                    totalHarga: row.find('.totalPrice').text(),
                };
                
                tableData.push(rowData);
            });
            ajaxSetup();
            $.ajax({
                url: "{{ route('incoming_sale.store') }}",
                method: "POST",
                data: data + "&dataTable=" + JSON.stringify(tableData),
                dataType: "json",
            }).done(res => {
                let message = res.message
                successNotification(message);

                windowReload(2000);
            }).fail(err => {
                ajaxErrorHandling(err, $('#form'))
            })

        })
    </script>
@endsection
