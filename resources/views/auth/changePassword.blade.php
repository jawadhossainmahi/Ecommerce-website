@extends('auth.master')
{{-- title --}}

@section('title','Login')

{{-- page scripts --}}

@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/pages/authentication.css')}}">
@endsection

@section('content')
<!-- login page start -->
<section class="row flexbox-container">
    <div class="col-xl-7 col-10">
        <div class="card bg-authentication mb-0">
            <div class="row m-0">
                <!-- left section-login -->
                <div class="col-md-6 col-12 px-0">
                    <div class="card disable-rounded-right d-flex justify-content-center mb-0 p-2 h-100">
                        <div class="card-header pb-1">
                            <div class="card-title">
                                <h4 class="text-center mb-2">Återställ ditt lösenord</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="mb-2" action="{{ route('change.password') }}" method="POST">
                                @csrf
                                @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                                @endforeach
                                <div class="form-group">
                                    <label class="text-bold-600" for="current_password">Nuvarande lösenord</label>
                                    <input id="current_password" type="password" class="form-control" name="current_password"  placeholder="Enter Current-password">
                                </div>
                                <div class="form-group">
                                    <label class="text-bold-600" for="new_password">nytt lösenord</label>
                                    <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password"
                                        placeholder="Enter a new password">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="text-bold-600" for="exampleInputPassword2">Bekräfta Ny
                                       Lösenord</label>
                                    <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password"
                                        placeholder="Confirm your new password"></div>
                                <button type="submit" class="btn btn-primary glow position-relative w-100">Återställ min
                                    Lösenord<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- right section image -->
                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                    <img class="img-fluid" src="{{asset('app-assets/images/pages/reset-password.png')}}"
                        alt="branding logo">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- login page ends -->
@endsection
