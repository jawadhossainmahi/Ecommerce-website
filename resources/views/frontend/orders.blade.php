@extends('frontend.master')


@section('content')

<style>
    .nav-pills .nav-link {
    background: 0 0;
    border-radius: 5px;
    padding: 10px 41px;
    color: black;
    font-family: livshem-font;
  }
.nav-pills .nav-link.active {
    color: #fff;
    background-color: #268639;
    border-radius: 5px;
    padding: 10px 41px;
    font-family: livshem-font;
  }
  
 .order-content h3 {
  color: black;
  font-size: 20px;
  font-weight: 600;
  font-family: livshem-font;
}
.recurring-list li .recurring-inner span i{
    color: rgb(189, 0, 0);
    margin-right: 20px;
    cursor: pointer;
    font-size: 18px;
}

.recurring-list li .recurring-inner {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  margin: 10px 0 10px 0px;
  background-color: #FDFDFD;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.151);
}


@media(max-width:450px) {
    .recurring-list li .recurring-inner span i{
        margin-right: 0px;
    }
}
</style>


   <section class="order">
        <div class="">
            <div class="row w-100 m-0 px-2">
                
                <div class="max-w-screen-xl mx-auto px-[16px] py-[12px]">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Kommande</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Levererade</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class=" nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Avbeställda</button>
                        </li>
                      </ul>


                      <div class="tab-content" id="">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <section class="order"> 
                                    <div class="row">
                                        <div class="order-content col-lg-12 ">
                                            <h3>Kommande leveranser <span></span></h3>

                                            <div class="row">
                                                <ol class="recurring-list">
                                                    <li>
                                                        <div class="flex justify-between p-3 text-sm" >
                                                            
                                                            <h4 class="w-14">Datum</h4>
                                                            <h2 class="w-1/2">Order nummer</h2>
                                                            <span class="w-16">Visa mer</span>
                                                            
                                                        </div>
                                                    </li>
                                                    @forelse($pending_orders as $order)
                                                    <li  data-bs-toggle="tooltip" data-bs-placement="right" title="Leveransdatum: {{ $order->getdeliverytime->date }}">
                                                        <div class="recurring-inner text-xs sm:text-sm" >
                                                            @php
                                                            $date=$date=date_create($order->created_at);;
                                                            
                                                            @endphp
                                                            <h4>{{ date_format($date,"jS M Y") }}</h4>
                                                            <h2><span class="order-number" id="{{ $order->id }}">{{$order->custom_order_id}}</span></h2>
                                                            <span><a href="{{ route('order-details', ['order_id'=>$order->id]) }}">Visa mer</a></span>
                                                            
                                                        </div>
                                                    </li>
                                                    @empty
                                                    <li>
                                                        <div class="recurring-inner" >
                                                            Ingen kommande leveranser hittades
                                                        </div>
                                                    </li>
                                                    @endforelse
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                            </section>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <section class="order"> 
                                <div class="row">
                                    <div class="order-content col-lg-12 ">
                                        <h3>Levererade ordrar <span></span></h3>

                                        <div class="row">
                                            <ol class="recurring-list">
                                                <li>
                                                    <div class="flex justify-between p-3 text-sm" >
                                                        
                                                        <h4 class="w-14">Datum</h4>
                                                        <h2 class="w-1/2">Order nummer</h2>
                                                        <span class="w-16">Visa mer</span>
                                                        
                                                    </div>
                                                </li>
                                            @forelse($delivered_orders as $order)
                                                    <li>
                                                        <div class="recurring-inner text-xs sm:text-sm" >
                                                            @php
                                                            $date=$date=date_create($order->created_at);;
                                                            
                                                            @endphp
                                                            <h4>{{ date_format($date,"jS M Y") }}</h4>
                                                            <h2><span>{{$order->custom_order_id}}</span></h2>
                                                            <span><a href="{{ route('order-details', ['order_id'=>$order->id]) }}">Visa mer</a></span>
                                                            
                                                        </div>
                                                    </li>
                                            @empty
                                            <li>
                                                <div class="recurring-inner" >
                                                    Ingen levererade ordrar hittades
                                                </div>
                                            </li>
                                            @endforelse
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                        </section>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <section class="order"> 
                                <div class="row">
                                    <div class="order-content col-lg-12 ">
                                        <h3>Avbeställda ordrar <span></span></h3>

                                        <div class="row">
                                            <ol class="recurring-list">
                                                <li>
                                                    <div class="flex justify-between p-3 text-sm" >
                                                        
                                                        <h4 class="w-14">Datum</h4>
                                                        <h2 class="w-1/2">Order-nummer</h2>
                                                        <span class="w-16">Visa mer</span>
                                                        
                                                    </div>
                                                </li>
                                            @forelse($cancelled_orders as $order)
                                                   <li>
                                                       <div class="recurring-inner  text-xs sm:text-sm" >
                                                            @php
                                                            $date=$date=date_create($order->created_at);
                                                            
                                                            @endphp
                                                            <h4>{{ date_format($date,"jS M Y") }}</h4>
                                                            <h2><span>{{$order->custom_order_id}}</span></h2>
                                                            <span><a href="{{ route('order-details', ['order_id'=>$order->id]) }}">Visa mer</a></span>
                                                            
                                                        </div>
                                                    </li>
                                            @empty
                                            <li>
                                                <div class="recurring-inner" >
                                                    Ingen avbeställda ordrar hittades
                                                </div>
                                            </li>
                                            @endforelse
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                        </section>
                        </div>
                      </div>
                      
                </div>
            </div>
        </div>
    </section>
    
    
 
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteContent(target){
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'green',
                cancelButtonColor: '#676666',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    target.parentElement.parentElement.remove()
                    console.log(target)
                    }
                })
            }
    </script>
@endsection
