<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-xl-6">

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card tryal-gradient">

                            <div class="card-body tryal row">
                                <div class="col-xl-7 col-sm-6">
                                    <h2>Selamat Datang, @auth
                                            {{ auth()->user()->name }}
                                        @endauth</h2>
                                    <span>Terus pantau kegiatan penerimaan mahasiswa baru politeknik enjinering
                                        indorama</span>
                                    {{-- <a href="{{route('data-registration')}}" class="btn btn-rounded  fs-18 font-w500">Lihat
                                        pendaftar</a> --}}
                                </div>
                                <div class="col-xl-5 col-sm-6">
                                    <img src="{{ asset('sipenmaru/images/chart.png') }}" alt=""
                                        class="sd-shape">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


