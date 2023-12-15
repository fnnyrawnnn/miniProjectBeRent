<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BeRent | Admin Side</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/lte') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/lte') }}/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <!-- NAVBAR -->
        @include('admin.navbar')

        <!-- SIDEBAR -->
        @include('admin.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('title')</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
                <h3 class="card-title">Update User</h3>
            </section>

            <div class="card-header">
               <form method="POST" action="{{ route('update.user',['id' => $users->id]) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" value="{{ $users->name }}" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" aria-describedby="nameHelp">
                        @error('name')
                            <div id="nameHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" value="{{ $users->email }}" class="form-control @error('email') is-invalid @enderror" name="email"
                            id="email" aria-describedby="emailHelp">
                        @error('email')
                            <div id="emailHelp" class="form-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                         <label for="alamat" class="form-label">Alamat</label>
                         <input type="alamat" value="{{ $users->alamat }}" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                             id="alamat" aria-describedby="alamatHelp">
                         @error('alamat')
                             <div id="alamatHelp" class="form-text">{{ $message }}</div>
                         @enderror
                     </div>
 
                     <div class="mb-3">
                         <label for="phone_number" class="form-label">Phone Number</label>
                         <input type="phone_number" value="{{ $users->phone_number }}" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                             id="phone_number" aria-describedby="phone_numberHelp">
                         @error('phone_number')
                             <div id="phone_numberHelp" class="form-text">{{ $message }}</div>
                         @enderror
                     </div>
 
                     @if ($users->image)
                     <img src="{{ asset('profile_picture/' . $users->image) }}" alt="{{ $users->name }}"
                         width="100">
                    @endif

                     <div class="mb-3">
                          <label for="image" class="form-label">Profile Picture</label>
                          <input type="file" value="{{ $users->image }}" class="form-control @error('image') is-invalid @enderror"
                              aria-describedby="imageHelp"" id="image" name="image">
                          @error('image')
                          <div id="imageHelp" class="form-text">{{ $message }}</div>
                      @enderror
                      </div>
    
                    <div class="action-user d-flex justify-content-end align-items-center">
                         <button type="submit" class="btn btn-primary mt-3">Submit</button>
                     </div>
                </form>
          </div>



            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                @yield('content')
                @include('sweetalert::alert')
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('/lte') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/lte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/lte') }}/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/lte') }}/dist/js/demo.js"></script>
</body>

</html>
