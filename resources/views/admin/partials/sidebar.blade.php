 <aside id="sidebar-wrapper">

     <div class="sidebar-brand">
         <a href="/"><img src="/admin/assets/img/logo.png" alt="logo" style="width:190px; height:65px"
                 class="float-left m-2"></a>
     </div>

     <ul class="sidebar-menu">
         <li class="sidebar-item">
             <a class="nav-link {{ Request::is('/dashboard') || Request::is('dashboard') ? 'active' : '' }}"
                 href="/dashboard">
                 <i class="fas fa-fire"></i> <span class="align-middle">Dashboard</span>
             </a>
         </li>

         @if (auth()->user()->role->role == 'admin')
             <li class="menu-header">Data Master</li>
             <li class="sidebar-item">
                 <a class="nav-link {{ Request::is('/admin/dosen') || Request::is('/admin/dosen') ? 'active' : '' }}"
                     href="/admin/dosen">
                     <i class="fas fa-user"></i> <span class="align-middle">Dosen</span>
                 </a>
             </li>
             <li class="sidebar-item">
                 <a class="nav-link {{ Request::is('/admin/mahasiswa') || Request::is('/admin/mahasiswa') ? 'active' : '' }}"
                     href="/admin/mahasiswa">
                     <i class="fas fa-users"></i> <span class="align-middle">Mahasiswa</span>
                 </a>
             </li>
             <li class="sidebar-item">
                 <a class="nav-link {{ Request::is('/admin/unit-kerja') || Request::is('/admin/unit-kerja') ? 'active' : '' }}"
                     href="/admin/unit-kerja">
                     <i class="fas fa-building"></i> <span class="align-middle">Unit Kerja</span>
                 </a>
             </li>
             <li class="sidebar-item">
                 <a class="nav-link {{ Request::is('/admin/tenaga-pendidik') || Request::is('/admin/tenaga-pendidik') ? 'active' : '' }}"
                     href="/admin/tenaga-pendidik">
                     <i class="fas fa-user"></i> <span class="align-middle">Tenaga Pendidik</span>
                 </a>
             </li>
             <li class="sidebar-item">
                 <a class="nav-link {{ Request::is('/admin/program-studi') || Request::is('/admin/program-studi') ? 'active' : '' }}"
                     href="/admin/program-studi">
                     <i class="fas fa-graduation-cap"></i> <span class="align-middle">Program Studi</span>
                 </a>
             </li>
             <li class="sidebar-item">
                 <a class="nav-link {{ Request::is('/admin/periode') || Request::is('/admin/periode') ? 'active' : '' }}"
                     href="/admin/periode">
                     <i class="fas fa-calendar"></i> <span class="align-middle">Periode</span>
                 </a>
             </li>


             <li class="menu-header">Survey</li>
             <li class="dropdown">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book"></i>
                     <span>Data Survey</span></a>
                 <ul class="dropdown-menu">
                     <li><a class="nav-link {{ Request::is('/admin/survey') || Request::is('admin/survey') ? 'active' : '' }}"
                             href="/admin/survey">
                             <div class="bullet"></div> &nbsp; Semua Survey
                         </a></li>
                     <li><a class="nav-link {{ Request::is('/admin/survey/create') || Request::is('/admin/survey/create') ? 'active' : '' }}"
                             href="/admin/survey/create">
                             <div class="bullet"></div> &nbsp; Tambah Survey
                         </a></li>
                 </ul>
             </li>
             <li class="sidebar-item">
                 <a class="nav-link {{ Request::is('/admin/jenis-survey') || Request::is('/admin/jenis-survey') ? 'active' : '' }}"
                     href="/admin/jenis-survey">
                     <i class="fas fa-clipboard-list"></i> <span class="align-middle">Jenis Survey</span>
                 </a>
             </li>

             <li class="sidebar-item">
                 <a class="nav-link {{ Request::is('/admin/hasil-survey') || Request::is('/admin/hasil-survey') ? 'active' : '' }}"
                     href="/admin/hasil-survey">
                     <i class="fas fa-chart-pie"></i> <span class="align-middle">Hasil Survey</span>
                 </a>
             </li>
         @else
             <li class="sidebar-item">
                 <a class="nav-link {{ Request::is('/admin/isi-survey') || Request::is('/admin/isi-survey') ? 'active' : '' }}"
                     href="/admin/isi-survey">
                     <i class="fas fa-pencil-square"></i> <span class="align-middle">Mengisi Survey</span>
                 </a>
             </li>
         @endif
     </ul>

 </aside>
