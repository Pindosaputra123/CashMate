@extends('layouts.template')

@section('content')
    <section class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Edit Profile
                    <div class="float-end">
                    </div>
                </div>
                <div class="card-body">
                    {!! Template::requiredBanner() !!}
                    <form id="form">
                        <div class="form-group">
                            <label for="old_password">Password Lama {!! Template::required() !!}</label>
                            <input type="password" class="form-control" id="old_password" name="old_password"
                                placeholder="Masukan Password Lama Anda">
                        </div>
                        <div class="form-group">
                            <label for="password">Password Baru {!! Template::required() !!}</label>
                            <input type="password" class="form-control" id="password"  name="password"
                                placeholder="Masukan Password Baru">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Konfirmasi Password {!! Template::required() !!}</label>
                            <input type="password" class="form-control" id="confirm_password"  name="confirm_password"
                                placeholder="Konfirmasi Password">
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
                    url: "{{ route('setting.update-password') }}",
                    type: "put",
                    data: data,
                    dataType: 'json'
                }).done(response => {
                    let message = response.message;
                    successNotification(message)
                    redirectUrlTo(1500, "{{ route('dashboard') }}")
                })
                .fail(error => {
                    ajaxErrorHandling(error, $formCreate)
                })
        });
    </script>
@endsection
