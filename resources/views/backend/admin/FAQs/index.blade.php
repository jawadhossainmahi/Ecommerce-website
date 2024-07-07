@extends('backend.admin.master')
@section('css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <!-- END: Vendor CSS-->
@endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">vanliga frågor</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" style="color: green;">Faqs Kategorilista
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            @if(session('success'))
    <div class="alert alert-success" id="success">
        {{ session('success') }}
    </div>
@endif

            <!-- users list start -->
            <section class="users-list-wrapper">
                {{-- <div class="col-md-1  my-3 d-flex align-items-center">
                    <a href="{{ route('admin.order.create') }}" class="btn btn-outline-primary" ><span ><i class='bx bxs-file-plus'></i></span></a>
                </div> --}}
                <div class="users-list-table">
                       <!-- Button trigger modal -->
                       <div class="col-md-1">  
                       <button type="button" class="btn my-2 ms-2" data-bs-toggle="modal" data-bs-target="#category" style="background: green; color: white;">
                                  Lägg till
                                 </button>
                                 </div>
                               
                    <div class="card">
                        <div class="card-body">
                         
                            <!-- datatable start -->
                            <div class="table-responsive">
                                <table class="table zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>*</th>
                                            <th>Namnkategori</th>
                                            <th>Handling</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                     @foreach($cat as $key => $value)
                                     <?php $id=1+$key; ?>
                                    
                                         <tr>
                                             <td>{{$id}}</td>
                                            <td><a href="{{ url('/admin/FAQs/category', ['cat_id'=>$value->cat_id]) }}" style="color: green;">{{$value->name_category}}</a></td>
                                             <td>
                                                <a href="{{ url('admin/FAQs/catedit',['cat_id'=>$value->cat_id]) }}" ><i
                                                class="bx bx-edit-alt" style="color: green;"></i></a>
                                                <a href="{{url('admin/FAQs/catdelete',['cat_id'=>$value->cat_id]) }}"  onclick="return confirm('Are You Sure To Delete This  ?')"><i
                                                class="bx bx-trash-alt" style="color: green;"></i></a>
                                            </td>
                                            @endforeach
                                            <!--<td><a href="{{ route('admin.order_his.index', ['user_id']) }}"></a></td>-->
                                            <!--<td>-->
                                                
                                     <!--          
                                                <span class="badge badge-success">Admin</span>
                                                
                                     <!--      
                                            <span class="badge badge-success">Customer</span>
                                            
                                     <!--       
                                                </td>
                                            <td></td>
                                            <td>
                                              
                                                
                                            </td>
                                            <!-- <td>-->
                                            <!--    <a href="" ><i-->
                                            <!--    class="bx bx-edit-alt"></i></a>-->
                                            <!--    <a href=""  onclick="return confirm('Are You Sure To Delete This  ?')"><i-->
                                            <!--    class="bx bx-trash-alt"></i></a>-->
                                            <!--</td>-->
                                         </tr>
                                     
                                    </tbody>
                                </table>
                            </div>
                            <!-- datatable ends -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- users list ends -->

        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="category" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="category">Lägg till Kategori</h5>
        <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
      </div> 
      <form id="catform" action="{{url('/')}}/admin/FAQs/insert" method="POST" enctype= "multipart/form-data">
          @csrf
      <div class="modal-body">
        <div class="mb-3 ">
         <label for="exampleFormControlTextarea1" class="form-label">kategori namn</label>
         <input type="text" class="form-control my-1" name="catname" id="catname" >
       
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-bs-dismiss="modal"  style="background: rgb(85, 174, 17); color: white;">Stå upp</button>
        <button type="" class="btn" id="saves"  style="background: green; color: white;">Spara</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/datatables/datatable.js') }}"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.3/iconify-icon.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
      setTimeout(function(){
          $("#success").fadeOut('slow');
      },2000);
  });
</script>
@endsection
