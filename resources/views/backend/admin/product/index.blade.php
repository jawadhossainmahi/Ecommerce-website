@extends('backend.admin.master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.dateTime.min.css') }}">
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="breadcrumbs-top">
                        <h5 class="content-header-title float-left pr-1 mb-0">Produkt</h5>
                        <div class="breadcrumb-wrapper d-none d-sm-block">
                            <ol class="breadcrumb p-0 mb-0 pl-1">
                                <li class="breadcrumb-item"><a href="/"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" style="color: green;">Produktlista
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="users-list-wrapper">
                    <div class="col-md-1  my-3 d-flex align-items-center ">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-outline-success"><span><i
                                    class='bx bxs-file-plus'></i></span></a>
                    </div>
                    @if (Session::has('batch'))
                        <div class="w-100 d-flex flex-column align-items-center justify-content-center"
                            id="progress-container">
                            <div>Progress: <span id="progress-text"></span> </div>
                            <progress max="100" id="progress-value"></progress>

                        </div>
                    @endif
                    <div class="users-list-table">
                        <button type="button" class="btn btn-primary my-1" data-bs-toggle="modal"
                            data-bs-target="#bulkimport" style="border-radius:50px">
                            Bulk import
                        </button>

                        <button id="export_products" type="button" class="btn btn-success my-1" style="border-radius:50px">
                            Export
                        </button>
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
                                    <table id="customer-table" class="complex-headers table">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="select-all"></th>
                                                <th>*</th>
                                                <th>UniqueID</th>
                                                <th>namn</th>
                                                <th>Produktbild</th>
                                                <th>kategori</th>
                                                <th>märka</th>
                                                <th>Vikt</th>
                                                <th>Pris</th>
                                                <th>Nedsatt pris</th>
                                                <th>Status</th>
                                                <th>Skapad vid</th>
                                                <th>Handling</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
    <div class="modal fade" id="bulkimport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="fileForm" action="{{ route('admin.product.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bulkimport">Bulk Import</h5>
                        <!--<button type="button" class="" data-bs-dismiss="modal" aria-label="Close"></button>-->
                        <!--<i class="bi bi-x-lg " data-bs-dismiss="modal" aria-label="Close"></i>-->
                    </div>
                    <div class="modal-body">
                        <h6>Select file product</h6>
                        <div>
                            <input required type="file" name="file" id="file">
                        </div>
                        <h6>Select file image</h6>
                        <div>
                            <input type="file" name="images[]" multiple id="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="save" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('app-assets/js/custom-charts.js') }}" type="module"></script>
    {{-- bootstrap  --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/datatables/datatable.js') }}"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.3/iconify-icon.min.js"></script>
    <!-- Include FileSaver.js -->
    <script src="https://code.iconify.design/iconify-icon/1.0.3/iconify-icon.min.js"></script>
    <script src="{{ asset('app-assets/vendors/js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.dateTime.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/script.js') }}" type="module"></script>
    <script>
        $(document).ready(function() {

            let minDate, maxDate;

            // Create date inputs
            minDate = new DateTime('#min', {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime('#max', {
                format: 'MMMM Do YYYY'
            });

            let table = new DataTable('#customer-table', {
                processing: true,
                serverSide: true,
                destroy: true, // Add this line to destroy any existing instance
                ajax: {
                    url: "/admin/product/index",
                    data: function(d) {
                        d.minDate = minDate.val();
                        d.maxDate = maxDate.val();
                    }
                },
                columns: [
                    { data: 'checkbox', name: 'checkbox', searchable: false, orderable: false },
                    { data: 'dt_auto_index', name: 'dt_auto_index', searchable: false, orderable: false },
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'image', name: 'image' },
                    { data: 'category_name', name: 'category_name' },
                    { data: 'tag_name', name: 'tag_name' },
                    { data: 'weight', name: 'weight' },
                    { data: 'price', name: 'price' },
                    { data: 'discount_price', name: 'discount_price' },
                    { data: 'status', name: 'status' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'handle', name: 'handle', searchable: false, orderable: false },
                    // Add more columns as needed
                ],
            });
            document.querySelectorAll('#min, #max').forEach((el) => {
                el.addEventListener('change', () => table.draw());
            });

        });
    </script>
    <script>
        if ($('#progress-value')) {
            console.log("{{ session('batch') }}")


            var batchId = "{{ session('batch') }}";
            const batchInterval = setInterval(function() {

                if (batchId) {
                    updateProgress(batchId);
                } else {
                    clearInterval(batchInterval)
                }

            }, 2000);
        }

        function updateProgress(batchId) {
            $.ajax({
                url: '/api/batch/progress/' + batchId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log("Data: " + data.progress)
                    if (data.progress !== null) {
                        var progressValue = Math.round(data.progress) + '%';
                        console.log(progressValue)
                        $('#progress-value').text(progressValue);
                        $('#progress-text').text(progressValue);
                        $('#progress-value').val(data.progress);
                        if (data.progress > 99) {
                            {{ Session::forget('batch') }}
                            // clearInterval(batchInterval)

                        }

                    } else {
                        // Batch may not have started processing yet
                        $('#progress-value').text('0%');
                        $('#progress-value').val('0%');

                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error fetching progress:', error);
                    {{ Session::forget('batch') }}
                }
            });
        }

        // Replace the following line with your actual batch ID from the PHP variable


        // Periodically update the progress every 2 seconds (adjust as needed)
    </script>

    <script>
        let table = new DataTable('#all-products', {
            buttons: [{
                    text: 'Select all',
                    action: function() {
                        table.rows().select();
                    }
                },
                {
                    text: 'Select none',
                    action: function() {
                        table.rows().deselect();
                    }
                }
            ],
            dom: 'Bfrtip',
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }],
            select: {
                style: 'os',
                selector: 'td:first-child'
            },
            order: [
                [1, 'asc']
            ]
        });
    </script>
@endsection
