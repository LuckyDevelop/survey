@extends('layouts.main')

@section('page')
    <section class="pt-7">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-md-start text-center py-6">
                    <h1 class="mb-4 fs-9 fw-bold">Sistem Informasi Survey</h1>
                    <p class="mb-6 lead text-secondary">Membawa pendidikan ke arah yang lebih baik melalui survey.
                        Dengan staf akademik dan mahasiswa sebagai fokus utama, sistem kami
                        memberdayakan institusi pendidikan untuk mengumpulkan, menganalisis, dan bertindak atas data
                        yang relevan</p>
                    <div class="text-center text-md-start"><a class="btn btn-warning me-3 btn-lg" href="#!"
                            role="button">Isi Survey</a></div>
                </div>
                <div class="col-md-6 text-end"><img class="pt-7 pt-md-0 img-fluid" src="assets/img/hero/hero-img.jpg"
                        alt="" /></div>
            </div>
        </div>
    </section>


    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="pt-5 pt-md-9 mb-6" id="feature">

        <div class="bg-holder z-index--1 bottom-0 d-none d-lg-block"
            style="background-image:url(assets/img/category/shape.png);opacity:.5;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
            <h1 class="fs-9 fw-bold mb-4 text-center"> Jenis Survey
            </h1>
        </div>
        </div><!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ==========================================

                <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="pt-5" id="validation">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 mt-5 pt-5">
                    <h2 class="mb-2 fs-7 fw-bold">Survey Penyelanggara Pendidikan</h2>
                    <p class="mb-4 fw-medium text-secondary">
                        Survey ini bertujuan untuk mengevaluasi penyelenggaraan pendidikan dari unit kerja yang
                        memberikan layanan di kampus. Ditujukan kepada mahasiswa untuk mengumpulkan umpan
                        balik terkait kualitas pengajaran, fasilitas pendidikan, sistem administrasi, dan aspek
                        lainnya terkait pengalaman belajar mereka di institusi pendidikan tersebut.
                    </p>
                </div>
                <div class="col-lg-6"><img class="img-fluid" src="assets/img/validation/validation.jpg" alt="" />
                </div>
            </div>
        </div><!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->


    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="pt-5" id="manager">

        <div class="container">
            <div class="row">
                <div class="col-lg-6"><img class="img-fluid" src="assets/img/manager/manager.jpg" alt="" />
                </div>
                <div class="col-lg-6 mt-5 pt-5">
                    <p class="fs-7 fw-bold mb-2">Survey Evaluasi Dosen</p>
                    <p class="mb-4 fw-medium text-secondary">
                        Survey ini dilakukan oleh mahasiswa untuk mengevaluasi kinerja dosen dalam menyampaikan
                        materi perkuliahan, cara mengajar, ketersediaan waktu konsultasi, dan aspek-aspek lain yang
                        berhubungan dengan pengajaran. Tujuannya adalah untuk membantu peningkatan kualitas
                        pengajaran dan memberikan umpan balik kepada dosen untuk meningkatkan kinerjanya di kelas.
                    </p>
                </div>
            </div>
        </div><!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->


    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="pt-5" id="marketer">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 mt-5 pt-5">
                    <p class="mb-2 fs-8 fw-bold">Survey Tracer Study</p>
                    <p class="mb-4 fw-medium text-secondary">Survey ini dilakukan setelah mahasiswa lulus untuk
                        melacak jejak karir mereka setelah kelulusan. Biasanya melibatkan kuesioner terstruktur yang
                        bertujuan untuk mengumpulkan informasi tentang pekerjaan pertama setelah lulus, kesesuaian
                        bidang pekerjaan dengan program studi, pendapatan, tingkat kepuasan, dan aspek lain yang
                        relevan dalam mengevaluasi efektivitas pendidikan dan kesiapan lulusan untuk memasuki dunia
                        kerja.</p>
                </div>
                <div class="col-lg-6"><img class="img-fluid" src="assets/img/marketer/marketer.jpg" alt="" /></div>
            </div>
        </div><!-- end of .container-->

    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->
@endsection
