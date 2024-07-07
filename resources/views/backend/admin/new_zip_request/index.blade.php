@extends('backend.admin.master')
@section('css')
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.dateTime.min.css') }}">

    <!-- END: Vendor CSS-->
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="breadcrumbs-top">
                        <h5 class="content-header-title float-left pr-1 mb-0">Postnummer</h5>
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" style="color: green;">Postnummerlista
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="users-list-wrapper">

                    {{-- <div class="col-md-1  my-3 d-flex align-items-center">
                    <a href="{{ route('admin.order.create') }}" class="btn btn-outline-primary" ><span ><i class='bx bxs-file-plus'></i></span></a>
                </div> --}}
                    <div class="users-list-table">
                        {{-- <button type="button" class="btn btn-danger shadow-none my-2" id="delete" style="border-radius:50px" >Bulk delete</button> --}}
                        <div class="card">
                            <div class="card-body">

                                <div class="form-floating">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="min">Start Date: </label>
                                            <input type="text" id="min" name="min">
                                        </div>
                                        <div class="col-6" style="left:200px">
                                            <label for="max">End Date: </label>
                                            <input type="text" id="max" name="max">
                                        </div>
                                    </div>

                                </div>
                                <!-- datatable start -->
                                <div class="table-responsive">
                                    <table class="table zero-configuration" id="post-data">
                                        <thead>
                                            <tr>

                                                <!--<th><input type="checkbox" id="bulk_delete" ></th>-->
                                                <th>No</th>
                                                <th>E-post</th>
                                                <th>Postnummer</th>
                                                <th>Begäran</th>
                                                <th>Option</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($posts as $key => $item)
                                                <?php $id = 1 + $key; ?>
                                                <tr>
                                                    <!--<td><input type="checkbox" name="ids" class="checkeds" id="bulk_delete" value="{{ $item->id }}"></td>-->
                                                    <td>{{ $id }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->postcode }}</td>
                                                    <td>{{ $item->created_at }}</td>



                                                    <td>
                                                        <a href="{{ route('admin.postnumber.destroy', $item->id) }}"
                                                            onclick="return confirm('Are You Sure To Delete This  ?')"><i
                                                                class="bx bx-trash-alt" style="color: green;"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
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

    <script src="{{ asset('app-assets/vendors/js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.dateTime.min.js') }}"></script>

    <script>
        $(document).ready(function() {


            let minDate, maxDate;

            // Custom filtering function which will search data in column four between two values
            DataTable.ext.search.push(function(settings, data, dataIndex) {
                let min = minDate.val();
                let max = maxDate.val();
                let date = new Date(data[3]);

                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            });

            // Create date inputs
            minDate = new DateTime('#min', {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime('#max', {
                format: 'MMMM Do YYYY'
            });
            let table = new DataTable('#post-data');
            document.querySelectorAll('#min, #max').forEach((el) => {
                el.addEventListener('change', () => table.draw());
            });



        });
    </script>

    <!--jquery-->
    {{-- <script>
    $(document).ready(function(){
 
 
 $("#bulk_delete").click(function(){
     $(".checkeds").prop("checked", $(this).prop("checked"));
    
 });
 
 $("#delete").click(function(e){
     e.preventDefault();
     
     var all_ids=[];
    //  if(!all_ids=""){
     $("input:checkbox[name=ids]:checked").each(function(){
         all_ids.push($(this).val());
     });
    //  console.log(all_ids);
     $.ajax({
        url:"/admin/postnummer/delete",
        type:"DELETE",
         headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:{
            "id":all_ids,
        "_token": "{{ csrf_token() }}"
        },
        success:function(response){
            console.log(response);
                            //  window.location.href="{{ env("BASE_URL") }}admin//index";
            
        }
     });
  });            
</script> --}}
@endsection
