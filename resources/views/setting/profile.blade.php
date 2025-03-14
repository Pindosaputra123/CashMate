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
                            <label for="name">Name {!! Template::required() !!}</label>
                            <input type="text" class="form-control" id="name" value="{{ auth()->user()->name }}"
                                name="name" placeholder="Masukan Name Pegawai">
                        </div>
                        <div class="form-group">
                            <label for="email">Email {!! Template::required() !!}</label>
                            <input type="email" class="form-control" id="email" value="{{ auth()->user()->email }}"
                                name="email" placeholder="Masukan Email Pegawai">
                        </div>
                        <div class="form-group">
                            <label for="phone">No.Hp {!! Template::required() !!}</label>
                            <input type="number" class="form-control" id="phone" value="{{ auth()->user()->phone }}"
                                name="phone" placeholder="Masukan No.Hp Pegawai">
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
                    url: "{{ route('setting.update-profile') }}",
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
