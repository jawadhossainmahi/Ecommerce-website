@extends('frontend.master')

@section('content')


    <!--<div class="extrapriser">-->
        <div class="extrapriser overflow-hidden p-3">
            <div class="row">
                <div class="max-w-screen-xl mx-auto px-[16px] py-[12px]">
                    <h1 class="text-left">{{ \App\Models\Setting::first()->campaign_name ?? 'veckans extrapriser' }}</h1>
                </div>
            </div>

            <div class="row">

                <div class="">


                    <div class="home-cards max-w-screen-xl mx-auto px-[16px] py-[12px]">
                        <div class="">
                            <div id="veckans-extrapriser-cards" class="row px-1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!--</div>-->
    
    
    <div id="veckans-extrapriser-modal"></div>
    
    <a class="btn btn-success my-4 LoadMore hidden" id="VeckansLoadMore" >Ladda mer</a>

@endsection
@section('js')

    
@endsection
