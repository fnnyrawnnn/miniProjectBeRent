@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    {{-- hero --}}
    <div class="hero d-flex align-items-center">
        <div class="container-fluid">
            <div class="row">
                <div class="col text-center">
                    <h3 class="text-white fw-semibold mb-2">Holaaa</h3>
                    <h1 class="text-white fw-bold mb-4">Selamat Datang di BeRent</h1>
                    <p class="text-white mb-5 text-opacity-75">
                        BeRent adalah sebuah website yang menyediakan layanan penyewaan alat Bengkel secara online <br>
                        sehingga Kamu dan Bengkel dapat terhubung dengan cepat.
                    </p>
                    <a href="#" class="btn btn-primary btn-lg rounded-1 mt-3">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- keunggulan --}}
    <div class="keunggulan">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class=" text-center">
                        <h3 class="title">Keunggulan Aplikasi Kami</h3>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col col-lg-4 col-md-6 col-sm-12 ">
                    <div class="keunggulan-list text-center">
                        <img src="{{ asset('css/icon-connected.png') }}" alt="">
                        <h3>Connected</h3>
                        <p>BeRent membantu kamu untuk terhubung dengan kami sehingga memudahkan Anda
                            untuk menyewa alat bengkel
                        </p>
                    </div>
                </div>
                <div class="col col-lg-4 col-md-6 col-sm-12 ">
                    <div class="keunggulan-list text-center">
                        <img src="{{ asset('css/icon-transparan.png') }}" alt="">
                        <h3>Harga Transparan</h3>
                        <p>Tidak perlu takut dengan harga penyewaan kami, karena kamu bisa melihat harga dari
                            setiap paket alat bengkel yang tersedia</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="layanan">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class=" text-center">
                        <h3 class="title">Paket yang Kami Tawarkan</h3>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center motor">
                <div class="col col-lg-5 col-md-6 col-sm-12">
                    <img src="{{ asset('css/service-motor.jpg') }}" alt="" class="img-fluid">
                </div>
                <div class="col col-lg-5 col-md-6 col-sm-12 my-3">
                    <h3>Sewa Alat Bengkel secara Online</h3>
                    <p>Booking sewa alat bengkel secara online akan memperhemat waktumu untuk meminjam alat bengkel,
                        <br> jadi tunggu apa lagi?
                    </p>
                    <a href="/servicepage" class="btn btn-lg">Lihat Paket</a>
                </div>
            </div>
        </div>
    </div>
@endsection
