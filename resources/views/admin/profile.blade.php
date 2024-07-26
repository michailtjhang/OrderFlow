@extends('layouts.admin')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        @if (empty(Auth::user()->profile_photo_path))
                        <img src="{{asset('img/no_photo.svg')}}" alt="Profile" class="rounded-circle">
                        @else
                        
                        <img class="rounded-circle" class="mx-5" src="{{asset('storage/photo_user/'.Auth::user()->profile_photo_path)}}" alt="Profile" style="aspect-ratio: 1/1; object-fit: cover;" width="69%">
                    
                        @endif
                        <h2 class="mt-3">
                            @if (empty(Auth::user()->username))
                            {{''}}
                            @else
                            {{Auth::user()->username}}
                            @endif
                        </h2>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form action="{{route('profile.update',$profile->id)}}" method="post" enctype="multipart/form-data">
                                    @method('PATCH')
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="foto" type="file" class="form-control @error('foto') is-invalid @enderror" id="profileImage">
                                            @error('foto')
                                            <span>
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="fullName" type="text" class="form-control @error('fullname') is-invalid @enderror" id="fullName" value="{{$profile->name}}">
                                            @error('fullname')
                                            <span>
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="nim" class="col-md-4 col-lg-3 col-form-label">NIM</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="nim" type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" value="{{$profile->nim}}">
                                            @error('nim')
                                            <span>
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Email" value="{{$profile->email}}">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>
                <script>
                    // Fungsi untuk merotasi gambar
                    function rotateImage() {
                      var img = document.getElementById('image');
                  
                      // Periksa orientasi gambar saat ini
                      var currentRotation = parseInt(img.getAttribute('data-rotation') || 0);
                  
                      // Hanya terapkan rotasi jika gambar awalnya landscape
                      if (currentRotation % 180 === 0) {
                        // Setel rotasi ke 90 derajat setiap kali fungsi dipanggil
                        var newRotation = currentRotation + 90;
                  
                        // Terapkan rotasi menggunakan CSS
                        img.style.transform = 'rotate(' + newRotation + 'deg)';
                  
                        // Simpan rotasi saat ini ke atribut data
                        img.setAttribute('data-rotation', newRotation);
                      }
                    }
                  
                    // Panggil fungsi rotateImage() misalnya saat tombol diklik
                    // var rotateButton = document.createElement('button');
                    window.onload = function() {
                    rotateImage();
                }
                  </script>

            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection