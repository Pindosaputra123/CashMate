@extends('layouts.template')

@section('content')
    <section class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    Tambah Data
                    <div class="float-end">
                        <a href="{{ route('user.index') }}" class="btn btn-primary btn-sm">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form id="form">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Masukan Name Pegawai">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukan Email Pegawai">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Masukan password">
                        </div>
                        <div class="form-group">
                            <label for="phone">No.Hp</label>
                            <input type="number" class="form-control" id="phone" name="phone"
                                placeholder="Masukan No.Hp Pegawai">
                        </div>
                        
                        <hr>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        var $formCreate = $('#form');

        $formCreate.on('submit', function(e) {
            e.preventDefault();
            ajaxSetup()

            let data = $formCreate.serialize();
            $.ajax({
                    url: "{{ route('user.store') }}",
                    type: "POST",
                    data: data,
                    dataType: 'json'
                }).done(response => {
                    let message = response.message;
                    console.log(response.message);
                    successNotification(message)
                    redirectUrlTo(1500, "{{ route('user.index') }}")
                })
                .fail(error => {
                    console.log(error);
                    ajaxErrorHandling(error, $formCreate)
                })
        });
    </script>
@endsection
