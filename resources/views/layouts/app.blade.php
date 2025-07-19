<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title> Admin Panel </title>

    <script>
            const savedTheme = sessionStorage.getItem("theme") || "light";
            document.documentElement.setAttribute("data-bs-theme", savedTheme);
    </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <script data-search-pseudo-elements defer
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <!-- CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link href="{{ asset('sass/main.css') }}" rel="stylesheet" />
    <link href="{{ asset('sass/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('sass/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('sass/bordered-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('sass/responsive.css') }}" rel="stylesheet" />
    <!-- <link href="{{ asset('css/select2.css') }}" rel="stylesheet"/> -->
    <!-- Plugins -->
    <link href="{{ asset('plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/metismenu/mm-vertical.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/metismenu/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/notifications/css/lobibox.min.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/css/intlTelInput.css">
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/js/intlTelInput.min.js"></script>

    <link id="sweetalert-dark-theme" rel="stylesheet" href="">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js"></script>
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Include jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Scripts -->
    @yield('style')
</head>

<body>
    <div id="app">
        <div>
            @include('layouts.header')
            @include('layouts.side_bar')
        </div>
        <main class="main-wrapper">
            @yield('content')
        </main>
        <div class="overlay btn-toggle"></div>
        <footer class="page-footer">
            <p class="mb-0">Dream Car Rent Copyright &copy;<?php echo date('Y'); ?></p>
        </footer>
    </div>


    <script src="{{ asset('js/perfect-scrollbar.js') }}"></script>
    <!--bootstrap js-->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('plugins/peity/jquery.peity.min.js') }}"></script>
    <script>
        $(".data-attributes span").peity("donut")
    </script>

    <!--notification js -->
    <script src="{{ asset('plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('plugins/notifications/js/notifications.min.js') }}"></script>
    <script src="{{ asset('plugins/notifications/js/notification-custom-script.js') }}"></script>
    <script src="{{ asset('plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- jspdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.22/jspdf.plugin.autotable.min.js"></script>

    <!-- excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/exceljs/dist/exceljs.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script src="{{ asset('js/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('js/select2.full.js') }}"></script>
    <script src="{{ asset('js/jquery.serializejson.js') }}"></script>
    <script src="{{ asset('slick/slick.js') }}"></script>
    <script src="{{ asset('js/print.js') }}"></script>
    <script src="{{ asset('js/jquery.hotkeys.js') }}"></script>
    <script src="{{ asset('js/table2csv.js') }}"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable@3.8.3/dist/jspdf.plugin.autotable.js"></script>

    <script>
        $(document).ready(function() {
            window.scripturl = '{{ asset('scripts') }}';
        });
        
        function updateDateTime() {
            const now = new Date();
            const formattedDateTime = now.toLocaleDateString() + ' ' + now.toLocaleTimeString();
            document.getElementById('live_date_time').textContent = formattedDateTime;
        }

        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>
    <script>
        actionText = '';
        var actionText = $('#actiontext').val().trim();
        if (actionText != '') {            
            round_success_noti(actionText); 
        }

        $(document).ready(function() {

            const $scrollContainer = $('.scrollbar');

            $scrollContainer.on('mousedown', function(e) {
                let startX = e.pageX - $scrollContainer.offset().left;
                let scrollLeft = $scrollContainer.scrollLeft();

                $scrollContainer.on('mousemove', function(e) {
                    const x = e.pageX - $scrollContainer.offset().left;
                    const walk = (x - startX) * 2;
                    $scrollContainer.scrollLeft(scrollLeft - walk);
                });

                $(document).on('mouseup', function() {
                    $scrollContainer.off('mousemove');
                    $(document).off('mouseup');
                });
            });
        });
    </script>
    <script>
        if (savedTheme == "light") {
            document.getElementById("LightTheme").checked = true;
        } else if (savedTheme == "dark") {
            document.getElementById("DarkTheme").checked = true;
        } else if (savedTheme == "semi-dark") {
            document.getElementById("SemiDarkTheme").checked = true;
        } else {
            document.getElementById("BoderedTheme").checked = true;
        }
    </script>
    @yield('script')
</body>

</html>
