<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Sistem Informasi Survey</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="/admin/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/admin/assets/modules/fontawesome/css/all.min.css">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Datatable Jquery -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.4.1/css/dataTables.dateTime.min.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="/admin/assets/css/style.css">
    <link rel="stylesheet" href="/admin/assets/css/components.css">

    <!-- Switch Button CDN -->
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js">
    </script>


</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                @include('admin.partials.navbar')
            </nav>
            <div class="main-sidebar sidebar-style-2">
                @include('admin.partials.sidebar')
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    @yield('content')
                </section>
            </div>
            <footer class="main-footer">
                @include('admin.partials.footer')
            </footer>
        </div>
    </div>


    <!-- General JS Scripts -->
    <script src="/admin/assets/modules/jquery.min.js"></script>
    <script src="/admin/assets/modules/popper.js"></script>
    <script src="/admin/assets/modules/tooltip.js"></script>
    <script src="/admin/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="/admin/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="/admin/assets/modules/moment.min.js"></script>
    <script src="/admin/assets/js/stisla.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <!-- Select2 Jquery -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
        integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>

    <!-- Datatable JQuery -->
    <script type="text/javascript" src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- Sweet Alert -->
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(".swal-confirm").click(function(e) {
            e.preventDefault();
            var form = $(this).attr('data-form');
            Swal.fire({
                title: 'Hapus Data Ini ',
                text: "Anda tidak akan dapat mengembalikan data yang dihapus !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#' + form).submit();
                }
            })
        });
    </script>

    <!-- Template JS File -->
    <script src="/admin/assets/js/scripts.js"></script>
    <script src="/admin/assets/js/custom.js"></script>


    <!-- Link active class -->
    <script>
        var currentUrl = window.location.pathname;
        var activeElement = document.querySelector('.sidebar-menu a[href="' + currentUrl + '"]');

        if (!activeElement && currentUrl.includes('/')) {
            var urlParts = currentUrl.split('/');
            var baseUrl = '/' + urlParts[1] + '/' + urlParts[2];
            activeElement = document.querySelector('.sidebar-menu a[href="' + baseUrl + '"]');
        }

        if (activeElement) {
            activeElement.parentNode.classList.add('active');
        }
    </script>

</body>

</html>
