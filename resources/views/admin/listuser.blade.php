@extends('admin.app')

@section('title', 'List User')

@section('content')
<a href="{{ route('add.user') }}"
class="btn btn-info text-white" style="width: 20%; margin:0px 0px 10px 8px">Tambah User</a>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List User</h3>

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
                        <th scope="col">Phone Number</th>
                        <th scope="col">Image</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr class="align-items-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone_number }}</td>
                            <td>
                                @if ($item->image)
                                    <img src="{{ asset('profile_picture/' . $item->image) }}" alt="{{ $item->name }}"
                                        width="100">
                                @endif
                            </td>
                            <td>{{ $item->alamat }}</td>
                            <td><a href="/updateuser/{{ $item->id }}/edit" class="btn btn-warning text-white">Update</a>
                            <a href="/adminlistuser/{{ $item->id }}/delete"
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
