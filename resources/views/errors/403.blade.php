@extends('layouts.base')

@section('title', '404')

@section('content')
    <main>
        <section class="vh-100 d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center d-flex align-items-center justify-content-center">
                        <div>
                            <h1 class="mt-5">Halaman tidak dapat Anda <span class="fw-bolder text-primary">Akses</span></h1>


                            <p class="lead my-4">
                                Eits, Anda tidak dapat mengunjungi halaman ini. <br>
                                Akses halaman ini dibatasi oleh role lain.
                            </p>

                            <a href="{{ route('dashboard.index') }}" class="btn btn-gray-800 d-inline-flex align-items-center justify-content-center mb-4">
                                <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                                Kembali ke Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection