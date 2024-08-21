@extends('frontend.master', ['categories'=> App\Models\Category::get()])


@section('page-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/authentication.css') }}">
@endsection

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 500px">
        <div class="my-5 px-5 w-full max-w-md bg-white text-black flex flex-col justify-center space-y-4 pt-6 pb-4 rounded-3xl overflow-hidden border">

            <div class="flex flex-col justify-center items-center space-y-5">

                <div class="w-[80%] flex justify-center items-center">
                    <div class="text-base font-bold">
                        <h4 class="card-title text-center">{{ __('Verifiera din e-postadress') }}</h4>
                    </div>
                </div>

                @if (session('message'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ __('En ny verifieringslänk har skickats till din e-postadress.') }}
                    </div>
                @endif
                <div class="text-center">
                    {{ __('Innan du fortsätter, kontrollera din e-post för en verifieringslänk.') }}
                    {{ __('Om du inte fått mejlet') }},
                </div>
                <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <!--<button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klicka här för att begära en annan') }}</button>.-->
                    <button type="submit" class="btn btn-link p-2 m-0 align-baseline rounded-md text-white" style="background: green; text-decoration: none;">{{ __('klicka här för att begära en annan') }}</button>.
                </form>

            </div>

        </div>
    </div>
@endsection
