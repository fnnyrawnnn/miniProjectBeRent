@extends('admin.app')

@section('title', 'List Kategori')

@section('content')
<a href="{{ route('add.cat') }}"
class="btn btn-info text-white" style="width: 20%; margin:0px 0px 10px 8px">Tambah Kategori</a>
     <div class="card">
          <div class="card-header">
               <h3 class="card-title">List Kategori</h3>

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
                         </tr>
                    </thead>
                    <tbody>
                         @foreach ($categories as $item)
                         <tr class="align-items-center">
                              <td>
                                   <p>{{ $loop->iteration }}</p>
                              </td>
                              <td>
                                   <p>{{ $item->name }}</p>
                              </td>
                              <td><a href="/updatekategori/{{ $item->id }}/edit" class="btn btn-warning text-white">Update</a>
                              <a href="/kategori/{{ $item->id }}/delete"
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
