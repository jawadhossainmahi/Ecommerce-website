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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
                        <h5 class="content-header-title float-left pr-1 mb-0">Meddelanden</h5>
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" style="color: green;">Meddelandelista
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="users-list-wrapper">

                    <div class="users-list-table">
                        <div class="card">
                            <div class="card-body">
                                <!-- datatable start -->
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
                                    <table class="table zero-configuration" id="message-data">
                                        <thead>
                                            <tr>
                                                <th>*</th>
                                                <th>namn</th>
                                                <th>e-post</th>
                                                <th>ämne</th>
                                                <th>Beställningsnr</th>
                                                <th>meddelande</th>
                                                <th>Skapad vid</th>
                                                <th>Handling</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($messages as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->fname . ' ' . $item->lname }}</td>

                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->subject }}</td>
                                                    <td>{{ $item->orderno }}</td>
                                                    <td style="overflow-y: scroll; height: 7rem; display: block;">
                                                        {{ $item->message }}</td>
                                                    <td>{{ $item->created_at }}</td>

                                                    <td style="text-align: center; height: 46px;">
                                                        <a href="mailto:{{ $item->email }}"><i class="bx bx-edit-alt"
                                                                style="font-size: 18px; color: green;"></i></a>
                                                        <form
                                                            action="{{ route('admin.message.destroy', ['message' => $item->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                style="border: 0; background: 0; font-size: 18px; color: #03789d; padding: 0; "
                                                                type="submit"
                                                                onclick="return confirm('Are You Sure To Delete This  ?')"><i
                                                                    class="bi bi-trash" style="color: green;"></i></button>
                                                        </form>
                                                    </td>

                                                    {{-- <td style="text-align: center; height: 46px;">
                                                
                                            </td> --}}
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('app-assets/js/scripts/datatables/datatable.js') }}"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.3/iconify-icon.min.js"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.dateTime.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/moment/moment.min.js') }}"></script>

    <script>
        $(document).ready(function() {


            let minDate, maxDate;

            // Custom filtering function which will search data in column four between two values
            DataTable.ext.search.push(function(settings, data, dataIndex) {
                let min = minDate.val();
                let max = maxDate.val();
                let date = new Date(data[6]);

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
            let table = new DataTable('#message-data');
            document.querySelectorAll('#min, #max').forEach((el) => {
                el.addEventListener('change', () => table.draw());
            });



        });
    </script>
@endsection
