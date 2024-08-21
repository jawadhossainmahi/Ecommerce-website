@extends('frontend.master')




@section('content')

    @php
        $businessCust = auth()->user()->customer_type == 1;
    @endphp


    <!-- ---------------profile------------->

    <section class="profile mb-0">
        <div class="">
            <div class="row px-2 w-100 m-0">
                <div class="max-w-screen-xl mx-auto px-[16px] py-[12px]">
                </div>
            </div>
        </div>
    </section>
    <style>
        .toggle-password {
            float: right;
            right: 10px;
            margin-top: -43px;
            position: relative;
            z-index: 2;
        }

        .custom-input-border {
            border: 2px solid rgb(25, 125, 0);
        }

        .container {
            padding-top: 50px;
            margin: auto;
        }

        .icon-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            /* Adjust size as needed */
            height: 30px;
            /* Adjust size as needed */
            border-radius: 50%;
            background-color: #007033;
            /* Background color */
            color: #fff;
            /* Icon color */
            font-size: 20px;
            /* Icon size */
        }
    </style>
    <section class="profile mt-0">
        <div class="">
            <div class="row px-2 w-100 m-0">

                <div class="max-w-screen-xl mx-auto px-[16px] py-[12px]">

                    {{-- <p class="form-heading">Kontakt och aviseringar</p> --}}
                    <div class="email-box">
                        <h1 class="profile-heading h1 text-left">Min profil</h1>
                        <div class="mb-3">
                            <table class="table">
                                <tr class="border-top">
                                    <td class="bg-white align-middle">
                                        @if (auth()->user()->customer_type == 1)
                                        <label for="name" class="form-label mb-0">Företags namn</label>
                                        @else
                                        <label for="name" class="form-label mb-0">Nanmn</label>
                                        @endif
                                    </td>
                                    <td class="bg-white ">
                                        <div class="my-3">
                                            {{ auth()->user()->name . ' ' . auth()->user()->l_name }}
                                        </div>
                                    </td>
                                </tr>
                                @if (auth()->user()->customer_type == 1)
                                    <tr class="border-top">
                                        <td class="bg-white align-middle">
                                            <label for="organization" class="form-label mb-0">Organisations Nummer</label>
                                        </td>
                                        <td class="bg-white ">
                                            <div class="my-3">
                                                {{ auth()->user()->organization }}
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="bg-white align-middle">
                                        <label for="address" class="form-label mb-0">Adress</label>
                                    </td>
                                    <td class="bg-white ">
                                        <div class="my-3">
                                            {{ auth()->user()->address ?? '-' }}
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bg-white align-middle">
                                        <label for="exampleInputEmail1" class="form-label mb-0">Epost</label>
                                    </td>
                                    @if (request()->has('request_time') == encrypt(date('hd')) && request()->has('email'))
                                        <td class="bg-white ">
                                            @if (session('email-edit'))
                                                <div class="status alert alert-success">
                                                    {{ session('email-edit') }}
                                                </div>
                                            @endif
                                            <form action="{{ route('update.email', auth()->user()->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="my-3">
                                                        <input type="email" class="form-control w-100 bg-white" name="email" value ="{{ auth()->user()->email }}" placeholder="EPOST" autofocus required>
                                                        <input type="hidden" class="form-control w-100 bg-white" name="request_time" value ="{{ decrypt(request()->request_time) }}">
                                                    </div>
                                                    <div class="save-changes">
                                                        <button type="submit" class="btn btn-link text-success" style="text-decoration: none;">Uppdatera Epost</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    @else
                                        <td class="bg-white ">
                                            @if (session('email-edit'))
                                                <div class="status alert alert-success">
                                                    {{ session('email-edit') }}
                                                </div>
                                            @endif
                                            @if (session('email-edit-error'))
                                                <div class="status alert alert-danger">
                                                    {{ session('email-edit-error') }}
                                                </div>
                                            @endif
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="my-3">
                                                    {{ auth()->user()->email }}
                                                </div>
                                                <div class="save-changes">
                                                    <a href="{{ route('change.email', auth()->user()->email) }}" class="btn btn-link text-success" style="text-decoration: none;">Ändra</a>
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td class="bg-white align-middle">
                                        <label for="mobilenumber" class="form-label mb-0">Mobil</label>
                                    </td>
                                    <td class="bg-white ">
                                        @if (session('phone-edit'))
                                            <div class="status alert alert-success">
                                                {{ session('phone-edit') }}
                                            </div>
                                        @endif
                                        @if (session('phone-edit-error'))
                                            <div class="status alert alert-danger">
                                                {{ session('phone-edit-error') }}
                                            </div>
                                        @endif
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-none w-100" id="phone-input-box">
                                                <form action="{{ route('update.phone.number', auth()->user()->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="">
                                                        <div class="my-3">
                                                            <label for="phone_number">Mobil</label>
                                                            <input type="number" class="form-control w-100 bg-white" name="phone" id="phone_number" value ="{{ auth()->user()->phone ?? '' }}" placeholder="MOBILNUMMER">
                                                        </div>
                                                        <div class="save-changes gap-3">
                                                            <button type="submit" class="btn modal-btn-3" style="background-color: rgb(85, 174, 17); color: white; padding: 10px 30px; border-radius: 5px; transition: 0.3s;">Uppdatera nummer</button>
                                                            <button type="button" class="btn modal-btn-4" id="changeNumberCancelBtn" style="background-color: rgb(22 112 3); color: white; padding: 10px 30px; border-radius: 5px; transition: 0.3s;">Avbryt</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="my-3" id="phone-show">
                                                {{ auth()->user()->phone ?? 0 }}
                                            </div>
                                            <div class="save-changes" id="changeNumberBtnBox">
                                                <a href="javascript:;" id="changeNumberBtn" class="btn btn-link text-success" style="text-decoration: none;">Ändra</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bg-white align-middle border-bottom-0">
                                        <label for="password" class="form-label mb-0">Lösenord</label>
                                    </td>
                                    <td class="bg-white border-bottom-0" width="70%">
                                        @if (session('success'))
                                            <div class="status alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        @if (session('password_error'))
                                            <div class="error alert alert-danger">
                                                {{ session('password_error') }}
                                            </div>
                                        @endif
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="my-3" id="password-show">
                                                ********
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-none w-100" id="password-input-box">
                                                    <form action="{{ route('update.password', auth()->user()->id) }}" method="POST" id="changePasswordForm">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row align-items-center justify-content-between">
                                                            <div class="my-3 col-md-12 px-3">
                                                                <label for="old_password">Nuvarande lösenord</label>
                                                                <input type="password" class="form-control w-100 password-field bg-white" name="old_password" id="old_password" value ="" placeholder="Nuvarande lösenord" required>
                                                                <span class="btn border-0 toggle-password"><i class="fas fa-eye"></i></span>
                                                            </div>
                                                            <div class="col-md-6 px-3">
                                                                <label for="new_password">Nytt lösenord</label>
                                                                <input type="password" class="form-control w-100 password-field bg-white" name="new_password" id="new_password" value ="" placeholder="Nytt lösenord" required>
                                                                <span class="btn border-0 toggle-password"><i class="fas fa-eye"></i></span>
                                                            </div>
                                                            <div class="col-md-6 px-3">
                                                                <label for="repeat_new_password">Upprepa nytt lösenord</label>
                                                                <input type="password" class="form-control w-100 password-field bg-white" name="repeat_new_password" id="repeat_new_password" value ="" placeholder="Upprepa nytt lösenord" required>
                                                                <span class="btn border-0 toggle-password"><i class="fas fa-eye"></i></span>
                                                            </div>
                                                            <div class="save-changes gap-3 mt-3 pe-3">
                                                                <button type="submit" class="btn modal-btn-3" style="background-color: rgb(85, 174, 17); color: white; padding: 10px 30px; border-radius: 5px; transition: 0.3s;">Uppdatera lösenord</button>
                                                                <button type="button" class="btn modal-btn-4" id="changePasswordCancelBtn" style="background-color: rgb(22 112 3); color: white; padding: 10px 30px; border-radius: 5px; transition: 0.3s;">Avbryt</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="save-changes" id="changePasswordBtnBox">
                                                    <a href="javascript:;" id="changePasswordBtn" class="btn btn-link text-success" style="text-decoration: none;">Ändra</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="save-changes">

                        </div>

                    </div>


                    <!--<p class="form-heading">Användardata</p>-->
                    <!--<div class="email-box">-->

                    <!--    <form>-->
                    <!--        <div class="dob-form">-->
                    <!--            <div class="mb-3">-->
                    <!--                <label for="exampleInputEmail1" class="form-label mb-0">År:</label>-->
                    <!--                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="YYYY">-->
                    <!--            </div>-->

                    <!--            <div class="mb-3">-->
                    <!--                <label for="exampleInputEmail1" class="form-label mb-0">Månad:</label>-->
                    <!--                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="MM">-->
                    <!--            </div>-->

                    <!--            <div class="mb-3">-->
                    <!--                <label for="exampleInputEmail1" class="form-label mb-0">Dag:</label>-->
                    <!--                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="DD">-->
                    <!--            </div>-->
                    <!--        </div>-->

                    <!--        <div class="save-changes">-->
                    <!--            <a href="#" class="profile-btn btn">Skicka in</a>-->
                    <!--        </div>-->
                    <!--    </form>-->

                    <!--</div>-->



                    <div class="address-part">
                        <h3>Min Adress</h3>
                        @if (session('success'))
                            <div class="success alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="row">
                            @if ($delivery_addresses->count())
                                @foreach ($delivery_addresses as $delivery_address)
                                    <div class="col-lg-3 ">
                                        <div class="add-address">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h4>{{ $delivery_address->fname }} {{ $delivery_address->lname }}</h4>
                                            </div>

                                            <h5>{{ $delivery_address->street_address }}</h5>
                                            <h5>{{ $delivery_address->zip_code }} {{ $delivery_address->postal_address }}</h5>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="form-open my-0">
                                                    <div class="icon-circle">
                                                        <i class="bi bi-pencil-fill text-white rounded-5 px-2" style="font-size: 16px" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-{{ $delivery_address->id }}" aria-controls="offcanvasRightChange"></i>
                                                    </div>
                                                    <p>Förändra</p>
                                                </span>
                                                @if (!$loop->first)
                                                    <a href="{{ route('destroy.delivery', $delivery_address->id) }}" onclick="deleteDeliveryAddress('{{ $delivery_address->id }}', event)" class="btn btn-danger btn-sm py-0">Remove</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="col-lg-3 ">
                                <div class="add-address">
                                    <p>Lägg till adress</p>

                                    <span class="form-open">
                                        <i class="bi bi-plus-circle-fill" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"></i>
                                        <p>Lägg till</p>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @if ($delivery_addresses->count())
        @foreach ($delivery_addresses as $delivery_address)
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas-{{ $delivery_address->id }}" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-body p-0">
                    <section class="address-box">
                        <div class="address-box-head">
                            <h1>Redigera adress</h1>
                            <h5 data-bs-dismiss="offcanvas" aria-label="Close">Avbryt</h5>
                        </div>

                        <div class="row">
                            <form method="POST" action="{{ route('edit_address') }}">
                                @csrf
                                <div class="side-form col-lg-11 mx-auto px-4">

                                    <p>Leveransadress</p>


                                    <div class="row g-3">
                                        <div class="col-{{ $businessCust ? 12 : 6 }}">
                                            <input type="hidden" name="id" value="{{ $delivery_address->id }}">
                                            <input type="text" name="fname" placeholder="{{ $businessCust ? 'Företags namn*' : 'Förnamn*' }}" value="{{ $delivery_address->fname ?? auth()->user()->name }}" aria-label="{{ $businessCust ? 'Företags namn' : 'Förnamn' }}">
                                        </div>
                                        @if (!$businessCust)
                                            <div class="col-6">
                                                <input type="text" name="lname" placeholder="Efternamn*" value="{{ $delivery_address->lname }}" aria-label="Last name">
                                            </div>
                                        @endif
                                    </div>

                                    <input type="text" name="street_address" value="{{ $delivery_address->street_address }}" placeholder="Gatuadress*">

                                    <div class="row">
                                        <div class="col-12">
                                            <input type="text" name="zip_code" placeholder="Postnummer" value="{{ $delivery_address->postal_code }}" aria-label="Zip code">
                                        </div>
                                        <!--<div class="col-6">-->
                                        <!--    <input type="text" name="postal_address" placeholder="Postort*" aria-label="Postort*">-->
                                        <!--</div>-->
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <input type="text" name="mobile_number" placeholder="Mobilnummer*" value="{{ $delivery_address->phone }}" aria-label="Mobile number">
                                        </div>
                                        <!--<div class="col-6">-->
                                        <!--    <input type="number" name="home_phone" placeholder="Hemtelefon*" aria-label="Hemtelefon">-->
                                        <!--</div>-->
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-12">
                                            <input type="text" name="city" value="{{ $delivery_address->city }}" placeholder="Ort*" aria-label="Locality">
                                        </div>
                                    </div>

                                    <button class="add-btn">Lägg till</button>

                                </div>

                            </form>
                        </div>
                    </section>
                </div>
            </div>
        @endforeach
    @endif





    @include('frontend.layouts.new-address')

@endsection
@section('js')
    <script>
        function deleteDeliveryAddress(id, event) {
            event.preventDefault();

            if (confirm('Är du säker på att du vill ta bort denna leveransadress?')) {
                var url = "{{ route('destroy.delivery', ':id') }}";
                url = url.replace(':id', id);
                window.location.href = url;
            } else {
                return false;
            }
        }
        $("#changeNumberBtn").on('click', function() {
            $("#changeNumberBox").addClass('d-none');
            $("#phone-show").addClass('d-none');
            $("#phone_number").addClass('custom-input-border');
            $("#phone-input-box").removeClass("d-none");
            $("#changeNumberBtnBox").addClass("d-none");
        });
        $("#changeNumberCancelBtn").on('click', function() {
            $("#changeNumberBox").removeClass('d-none');
            $("#phone-show").removeClass('d-none');
            $("#phone_number").addClass('custom-input-border');
            $("#phone-input-box").addClass("d-none");
            $("#changeNumberBtnBox").removeClass("d-none");
        });
        $("#changePasswordBtn").on('click', function() {
            $("#changePasswordBox").addClass('d-none');
            $("#password-show").addClass('d-none');
            $("#password-input-box").removeClass("d-none");
            $("#changePasswordBtnBox").addClass("d-none");
            $("#changePasswordForm input").addClass('custom-input-border');
        });
        $("#changePasswordCancelBtn").on('click', function() {
            $("#changePasswordBox").removeClass('d-none');
            $("#password-show").removeClass('d-none');
            $("#password-input-box").addClass("d-none");
            $("#changePasswordBtnBox").removeClass("d-none");
            $("#changePasswordForm input").addClass('custom-input-border');
        });

        $(document).ready(function() {
            @if (session('password_error'))
                $("#changePasswordBtn").click();
            @endif
            $(".toggle-password").click(function() {
                let passwordField = $(this).siblings(".password-field");
                let fieldType = passwordField.attr("type");
                if (fieldType === "password") {
                    passwordField.attr("type", "text");
                    $(this).html('<i class="fas fa-eye-slash"></i>');
                } else {
                    passwordField.attr("type", "password");
                    $(this).html('<i class="fas fa-eye"></i>');
                }
            });
        });
    </script>
@endsection
