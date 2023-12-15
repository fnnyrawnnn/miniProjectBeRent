@extends('admin.app')

@section('title', 'Detail Bengkel')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Bengkel {{ $paket->name }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="data-bengkel mb-5">
                <h1 class="fw-bold">Data Bengkel</h1>
                <p>
                    <img src="{{ asset('picture/' . $paket->image) }}" style="width: 18rem; border-radius: 12px">
                </p>
                <p>Nama : {{ $paket->name }}</p>
                <p>Deskripsi : {{ $paket->description }}</p>
                <p>Alamat : {{ $paket->alamat }}</p>
            </div>

            <div class="data-transaksi-bengkel mb-5">
                <h1 class="fw-bold">Data Transaksi {{ $paket->name }}</h1>
                @foreach ($transaksi as $item)
                    @if ($item->paket->id == $paket->id)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">ID Transaksi</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Waktu Transaksi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tipe</th>
                                    <th scope="col">Kendaraan</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p>{{ $loop->iteration }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $item->id }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $item->user->name }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $item->waktu_booking }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $item->status }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $item->tipe_booking }}</p>
                                    </td>
                                    <td>
                                        <p>{{ $item->kendaraan->model }}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <h6 class="my-3 text-center fw-bold">{{ $paket->name }} belum memiliki transaksi</h6>
                    @endif
                @endforeach
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
