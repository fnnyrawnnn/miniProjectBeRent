@extends('layouts.app')

@section('title', 'Service')

@section('content')
    {{-- hero --}}
    <div class="hero d-flex align-items-center">
        <div class="container-fluid">
            <div class="row">
                <div class="col text-center">
                    <h1 class="text-white fw-bold mb-4">Layanan Kami</h1>
                    <p class="text-white mb-5 text-opacity-75">
                        Berikut adalah layanan yang bisa kami berikan untuk Anda
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- service --}}
    <div class="service">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class=" text-center">
                        <h3 class="title">Mau Sewa Alat Apa Hari Ini?</h3>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col col-lg-8">
                    <form action="" method="GET">
                        @csrf
                        <input type="text" class="form-control" placeholder="Cari bengkel disini" name="keyword">
                    </form>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-4 bengkel">
                @foreach ($pakets as $paket)
                    <div class="col">
                        <div class="card">
                            <img src="{{ asset('images/' . $paket->image) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $paket->name }}</h5>
                                <div class=" d-flex align-items-center location">
                                    <img src="{{ asset('css/icon-location.png') }}">
                                    <p>{{ $paket->description }}</p>
                                </div>
                                <a href="/detailpaketpage/{{ $paket->id }}" class="btn btn-primary">Lihat paket</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="my-5">
                <div class="mb-1">
                    {{ $pakets->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
