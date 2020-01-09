
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>StagePfe</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/css/app.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>


      <div class="input-group input-group-sm" >
        <input class="form-control form-control-navbar" @keyup="searchit" v-model="search" style=" width: 100%;"  type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" @click="searchit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
 

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
          <i class="fa fa-bell-o"></i>
          <span class="badge badge-warning navbar-badge">{{(Auth::User()->unreadNotifications->count())}}
          
        
           
           
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Notifications</span>
          @can('isAdmin')
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-bell mr-2"></i> Demande de conge
            
          </a>
          @else
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-envelope mr-2"></i> Vos demandes
            
          </a>
          @endcan
          <div class="dropdown-divider"></div>
          @forelse (Auth::user()->unreadNotifications as $noty)
          <a href="#" class="dropdown-item">
              
             {{ $noty->data['message'] }}
            
            <span class="float-right text-muted text-sm">{{$noty->created_at->diffForHumans()}}</span>
            {{$noty->markAsRead()}}
          </a>@empty
             @endforelse
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="srtb.png" alt="SRTB" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SRTB </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="Default.png" class="img-circle elevation-2" alt="User Image"><br><br>
          <router-link to="/Profiles" class="d-block">{{ Auth::user()->name }}</router-link>
        </div>  
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview ">
          <router-link to="/dashboard" class="nav-link active ">
              <i class="nav-icon fas fa-tachometer-alt "></i>
              <p>
                Dashboard
               
              </p>
            </router-link>

          </li>


        
          
  @can('isAdmin')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cogs "></i>
              <p>
                Gestion De Conges
               <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/CongeAccepter" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Liste des Congés Accepter</p>
                </router-link>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <router-link to="/ConsulteCongeAdmin" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Les Demande de congés</p>
                </router-lnik>
              </li> 
            </ul>           
          </li>

          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cogs "></i>
              <p>
                Gestion Absences
               <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="Absence" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Absence justifier</p>
                </router-link>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <router-link to="AbsenceNonJusifier" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Absence non justifier</p>
                </router-lnik>
              </li> 
            </ul>    

            <ul class="nav nav-treeview">
              <li class="nav-item">
              <router-link to="/ConsulteAbsences" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Consulter les Absences</p>
                </router-lnik>
              </li> 
            </ul>          
          </li>
          

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users "></i>
              <p>
                Gestion De Personnel
               <i class="right fa fa-angle-left"></i>
              </p>
            </a>
           
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/Employer" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Liste Employé</p>
                </router-link>
              </li>
            </ul>
          </li>
        
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cogs "></i>
              <p>
                Gestion Recrutement
               <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <router-link to="/Recrutements" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Demandes de recrutement</p>
                </router-link>
              </li>

            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <router-link to="/RecrutementsAccepter" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Consulter les demande accepter</p>
                </router-link>
              </li> 
            </ul>            
          </li>
          @else
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cogs "></i>
              <p>
                 Conges
               <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <router-link to="/ConsulteConge" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Consulter Les Congés</p>
                </router-link>
              </li>

            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <router-link to="/Conges" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i>
                  <p>Demander de congés</p>
                </router-link>
              </li> 
            </ul>            
          </li>
          @endcan

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-cog "></i>
              <p>
                Parametres
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              

            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <router-link to="/Profiles" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Profile</p>
                </router-link>
              </li>

            </ul>
          </li>
          
         
         
         
            

            <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="nav-icon fa fa-power-off"></i>
                                                     <p>            
                                        {{ __('Logout') }}
                                        
                                        </p>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
          </li>
          
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
     
     

      @yield('content')
      <router-view :id="{{Auth::id()}}"></router-view>
     
      <vue-progress-bar></vue-progress-bar>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            
            <!-- /.card -->

            
            <!-- /.card -->
          </div>
               

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-block-down">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 Amine Dahmani.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

@auth
<script> window.user = @json(auth()->user()); </script>
@endauth

<!-- jQuery -->
<script src="{{asset('js/app.js')}}"></script>
<script>

@if(Session::has('success'))
    noty({

        type: 'success' , 
        layout : 'top' , 
        text : '{{Session::get('success')}}'
    })
@endif

</script>
</body>
</html>
