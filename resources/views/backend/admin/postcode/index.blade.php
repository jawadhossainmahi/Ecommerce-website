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
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <h5 class="content-header-title float-left pr-1 mb-0">{{ $pageTitle }}</h5>
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
                    <div class="col-md-1  my-3 d-flex align-items-center">
                        <a href="{{ route('admin.postcode.create') }}" class="btn btn-outline-success"><span><i
                                    class='bx bxs-file-plus'></i></span></a>
                    </div>
                    <div class="users-list-table">
                        <button type="button" class="btn btn-danger shadow-none my-2" id="delete"
                            style="border-radius:50px">Bulk delete</button>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bulkimport"
                            style="border-radius:50px">
                            Bulk import
                        </button>
                        <div class="card">
                            <div class="card-body">
                                <!-- datatable start -->
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
                                <div class="table-responsive">
                                    <table class="table" id="postcode">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="all_delete"></th>
                                                <th>*</th>
                                                <th>Postnummer</th>
                                                <th>Skapad vid</th>
                                                <th>Hantering</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($list as $item)
                                                <tr>
                                                    <td><input type="checkbox" name="ids" class="checkeds"
                                                            id="all_delete" value="{{ $item->id }}"></td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->postcode }}</td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <td>
                                                        <a
                                                            href="{{ route('admin.postcode.edit', ['postcode' => $item->id]) }}"><i
                                                                class="bx bx-edit-alt" style="color: green;"></i></a>
                                                        <a href="{{ route('admin.postcode.destroy', ['postcode' => $item->id]) }}"
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
    <!---->
    <!---->
    <!-- Modal -->
    <div class="modal fade" id="bulkimport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="fileForm" action="{{ route('upload.postcode') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bulkimport">Bulk Import</h5>
                        <!--<button type="button" class="" data-bs-dismiss="modal" aria-label="Close"></button>-->
                        <!--<i class="bi bi-x-lg " data-bs-dismiss="modal" aria-label="Close"></i>-->
                    </div>
                    <div class="modal-body">
                        <div>
                            <input required type="file" name="postcode_file_upload" id="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="save" class="btn btn-primary">Import</button>
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
            let table = new DataTable('#postcode');
            document.querySelectorAll('#min, #max').forEach((el) => {
                el.addEventListener('change', () => table.draw());
            });



        });
    </script>
    <!--bootstrap script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!--jquery-->
    <script>
        $(document).ready(function() {

            $("#all_delete").click(function() {
                $(".checkeds").prop("checked", $(this).prop("checked"));

            });

            $("#delete").click(function(e) {
                e.preventDefault();

                var all_ids = [];
                //  if(!all_ids=""){
                $("input:checkbox[name=ids]:checked").each(function() {
                    all_ids.push($(this).val());
                });
                //  console.log(all_ids);
                $.ajax({
                    url: "/admin/postnummer/alldelete",
                    type: "DELETE",
                    //         headers: {
                    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // },
                    data: {
                        "id": all_ids,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // console.log(response);
                        window.location.href = "{{ env('BASE_URL') }}admin/postnummer/index";

                    }
                });
                //  }

            });
            //  $("#save").on("click",function(e){
            //      e.preventDefault();
            //     var filedata=$('#file').val();


            //      $.ajax({
            //          url:"/admin/postnummer/upload",
            //          type:"POST",
            //           headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             },
            //          data:{filedata:filedata},
            //          success:function(response){
            //              console.log(response);
            //          }
            //      });
            //  });
        });
    </script>
@endsection
