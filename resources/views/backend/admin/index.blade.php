@extends('backend.admin.master')
@section('content')


<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Dashboard Ecommerce Starts -->
            <section id="dashboard-ecommerce">
                <div class="row">

                    <div class="col-xl-12 col-12 dashboard-users">
                        <ul class="row nav nav-tabs " id="charts-tabs" role="tablist" >
                            <!-- Statistics Cards Starts -->
                            <li class="nav-item col-lg-3 col-md-6 col-sm-6 m-0 p-0" role="presentation">
                                <a href="{{route('admin.order.deliveredopen')}}"><button class="nav-link active bg-transparent shadow-none m-0 w-100 p-0" id="home-tab" data-bs-toggle="tab" data-bs-target="#open-orders" type="button" role="tab" aria-controls="open-orders" aria-selected="true"><div class="card text-center">
                                        <div class="card-body py-1">
                                            <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                                <i class="bx bx-briefcase-alt font-medium-5"></i>
                                            </div>
                                            <div class="text-muted line-ellipsis">Open Orders</div>
                                            <h3 class="mb-0 total-open-orders">1.2k</h3>
                                        </div>
                                    </div>
                                </button>
                            </a>
                              </li>
                            <li class="nav-item col-lg-3 col-md-6 col-sm-6 m-0 p-0" role="presentation">
                              <a href="{{route('admin.order.deliveredorder')}}"><button class="nav-link bg-transparent shadow-none m-0 w-100 p-0" id="profile-tab" data-bs-toggle="tab" data-bs-target="#delivered-orders" type="button" role="tab" aria-controls="delivered-orders" aria-selected="false"> <div class="card text-center">
                                        <div class="card-body py-1">
                                            <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                                                <i class="bx bx-user font-medium-5"></i>
                                            </div>
                                            <div class="text-muted line-ellipsis">Delivered Orders</div>
                                            <h3 class="mb-0 total-delivered-orders">45.6k</h3>
                                        </div>
                                    </div>
                                </button>
                            </a>
                            </li>
                          <li class="nav-item col-lg-3 col-md-6 col-sm-6 m-0 p-0" role="presentation">
                            <a href="{{route('admin.order.total')}}"><button class="nav-link bg-transparent shadow-none m-0 w-100 p-0" id="contact-tab" data-bs-toggle="tab" data-bs-target="#total-payment" type="button" role="tab" aria-controls="total-payment" aria-selected="false"><div class="card text-center">
                                        <div class="card-body py-1">
                                            <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                                <i class="bx bx-briefcase-alt font-medium-5"></i>
                                            </div>
                                            <div class="text-muted line-ellipsis">Total Payment</div>
                                            <h3 class="mb-0 total-payment">1.2k</h3>
                                        </div>
                                    </div>
                                </button>
                            </a>
                            </li>
                              <li class="nav-item col-lg-3 col-md-6 col-sm-6 m-0 p-0" role="presentation">
                               <a href="{{route('admin.cust.index')}}"><button class="nav-link bg-transparent shadow-none m-0 w-100 p-0" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#new-customer" type="button" role="tab" aria-controls="new-customer" aria-selected="false"> <div class="card text-center">
                                        <div class="card-body py-1">
                                            <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                                                <i class="bx bx-user font-medium-5"></i>
                                            </div>
                                            <div class="text-muted line-ellipsis">New Customers</div>
                                            <h3 class="mb-0 total-new-customers">45.6k</h3>
                                        </div>
                                    </div>
                                </button>
                            </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </section>
            <section>
                <div class="row " id="myTabContent">
                    <div class="col-md-6 col-lg-6 p-0">
                        <div class="card" id="open-orders" role="tabpanel" aria-labelledby="open-orders" tabindex="0">
                    <div class="card-header d-flex justify-content-between align-items-center pb-0">
                        <h4 class="card-title">Open Orders</h4>
                        <div class="d-flex align-items-end justify-content-end">
                            <!--<span class="mr-25">$25,980</span>-->
                            <div class="form-floating">
                              <select class="form-select" id="open-orders-data" aria-label="Floating label select example">

                                <option value="year">Year</option>
                                <option value="month">Month</option>
                                <option value="day">Day</option>
                              </select>

                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <canvas id="open-orders-chart"></canvas>
                    </div>
                  </div>
                    </div>
                    <div class="col-md-6 col-lg-6 p-0">
                        <div class="card" id="delivered-orders" role="tabpanel" aria-labelledby="delivered-orders" tabindex="0"><div class="card-header d-flex justify-content-between align-items-center pb-0">
                        <h4 class="card-title">Delivered Orders</h4>
                        <div class="d-flex align-items-end justify-content-end">
                            <!--<span class="mr-25">$25,980</span>-->
                            <div class="form-floating">
                              <select class="form-select" id="delivered-orders-data" aria-label="Floating label select example">

                                <option value="year">Year</option>
                                <option value="month">Month</option>
                                <option value="day">Day</option>
                              </select>

                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <canvas id="delivered-orders-chart"></canvas>
                    </div>
                    </div>
                    </div>
                    <div class="col-md-6 col-lg-6 p-0">
                         <div class="card " id="total-payment" role="tabpanel" aria-labelledby="total-payment" tabindex="0">
                      <div class="card-header d-flex justify-content-between align-items-center pb-0">
                        <h4 class="card-title">Total Payment</h4>
                        <div class="d-flex align-items-end justify-content-end">
                            <!--<span class="mr-25">$25,980</span>-->
                            <div class="form-floating">
                              <select class="form-select" id="total-payment-data" aria-label="Floating label select example">

                                <option value="year">Year</option>
                                <option value="month">Month</option>
                                <option value="day">Day</option>
                              </select>

                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <canvas id="total-payment-chart"></canvas>
                    </div>
                    </div>
                    </div>
                    <div class="col-md-6 col-lg-6 p-0">
                        <div class="card" id="new-customer" role="tabpanel" aria-labelledby="new-customer" tabindex="0">
                      <div class="card-header d-flex justify-content-between align-items-center pb-0">
                            <h4 class="card-title">New Customers</h4>
                            <div class="d-flex align-items-end justify-content-end">
                                <!--<span class="mr-25">$25,980</span>-->
                                <div class="form-floating">
                              <select class="form-select" id="new-customer-data" aria-label="Floating label select example">

                                <option value="year">Year</option>
                                <option value="month">Month</option>
                                <option value="day">Day</option>
                              </select>

                            </div>
                            </div>
                        </div>
                        <div class="card-body pb-0">
                            <canvas id="new-customer-chart"></canvas>
                        </div>
                    </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('app-assets/js/custom-charts.js') }}" type="module"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
@endsection
