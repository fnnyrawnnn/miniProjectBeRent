@extends('admin.app')

@section('title', 'List Paket')

@section('content')
<a href="{{ route('add.paket') }}"
class="btn btn-info text-white" style="width: 20%; margin:0px 0px 10px 8px">Tambah Paket</a>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List Paket</h3>

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
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Categori</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pakets as $item)
                        <tr class="align-items-center">
                            <td>
                                <p>{{ $loop->iteration }}</p>
                            </td>
                            <td>
                                <p>{{ $item->name }}</p>
                            </td>
                            <td>
                                <img src="{{ asset('picture/' . $item->image) }}" alt="" style="width: 10rem">
                            </td>
                            <td>
                                <p>Rp. {{ $item->price }}/hari</p>
                            </td>
                            <td>
                                <p>{{ $item->description }}</p>
                            </td>
                            <td>
                                <p>{{ $item->cat_id }}</p>
                            </td>
                            <td><a href="/updatepaket/{{ $item->id }}/edit" class="btn btn-warning text-white">Update</a>
                            <a href="/adminpaket/{{ $item->id }}/delete"
                                    class="btn btn-danger text-white">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
