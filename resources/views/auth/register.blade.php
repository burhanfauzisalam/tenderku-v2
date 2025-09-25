@extends('layouts.app')

@section('guest')

<section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg"
        style="background-image: url({{asset('assets/img/curved-images/curved14.jpg')}});">
        <span class="mask bg-gradient-dark opacity-6"></span>

    </div>
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                <div class="card z-index-0">
                    <div class="card-header text-center pt-4">
                        <h5>Register with</h5>
                    </div>
                    <div class="card-body">
                        <form role="form text-left" id="register-form">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Name" name="name" id="name"
                                    aria-label="Name" aria-describedby="name" value="{{ old('name') }}">
                                @error('name')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                                    aria-label="Email" aria-describedby="email-addon" value="{{ old('email') }}">
                                @error('email')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 position-relative">
                                <input type="password" class="form-control" placeholder="Password" name="password"
                                    id="password" aria-label="Password" aria-describedby="password-addon">
                                <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                                    onclick="togglePassword()" style="cursor: pointer;">
                                    <i class="fa-solid fa-eye" id="toggleIcon"></i>
                                </span>
                                @error('password')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 position-relative">
                                <input type="password" class="form-control" placeholder="Confirm Password"
                                    name="password_confirmation" id="password_confirmation"
                                    aria-label="Confirm Password" aria-describedby="password-addon">
                                <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                                    onclick="toggleConfirmPassword()" style="cursor: pointer;">
                                    <i class="fa-solid fa-eye" id="toggleConfirmIcon"></i>
                                </span>
                            </div>
                            <div class="form-check form-check-info text-left">
                                <input class="form-check-input" type="checkbox" name="agreement" id="flexCheckDefault"
                                    checked>
                                <label class="form-check-label" for="flexCheckDefault">
                                    I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and
                                        Conditions</a>
                                </label>
                                @error('agreement')
                                <p class="text-danger text-xs mt-2">First, agree to the Terms and Conditions, then try
                                    register again.</p>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                            </div>
                            <p class="text-sm mt-3 mb-0">Already have an account? <a href="login"
                                    class="text-dark font-weight-bolder">Sign in</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if (session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Registrasi Berhasil',
    text: '{{ session("success") }}',
    confirmButtonColor: '#3085d6',
})
</script>
@endif

@if (session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Registrasi Gagal',
    text: '{{ session("error") }}',
    confirmButtonColor: '#d33',
})
</script>
@endif

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $(document).on('submit', '#register-form', function(e) {
        e.preventDefault();
        const route = `{{route('register.process')}}`;
        const formData = $(this).serialize();
        // alert(route);
        $.ajax({
            url: route,
            method: 'POST',
            data: formData,
            dataType: 'JSON',
            beforeSend: function() {
                // disable tombol submit & ubah text
                $("button[type=submit]").prop("disabled", true).text("Processing...");
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registrasi Berhasil',
                        text: response.message,
                        confirmButtonColor: '#3085d6',
                    }).then(() => {
                        window.location.href =
                            "{{ route('login') }}"; // redirect ke login
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Registrasi Gagal',
                        text: response.message,
                        confirmButtonColor: '#d33',
                    });
                }
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = Object.values(xhr.responseJSON.errors).flat().join('\n');
                    Swal.fire({
                        icon: 'error',
                        title: 'Validasi Gagal',
                        text: errors,
                        confirmButtonColor: '#d33',
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Silakan coba lagi.',
                        confirmButtonColor: '#d33',
                    });
                }
            },
            complete: function() {
                // enable tombol submit kembali & reset text
                $("button[type=submit]").prop("disabled", false).text("Sign up");
            }
        });
    })
})

function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

function toggleConfirmPassword() {
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const toggleIcon = document.getElementById('toggleConfirmIcon');

    if (confirmPasswordInput.type === 'password') {
        confirmPasswordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        confirmPasswordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>

@endpush