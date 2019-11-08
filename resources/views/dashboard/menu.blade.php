<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
    <div class="pull-left image">
        <img src="{{asset('dashboard/dist/img/avatar5.png')}}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
        <p>{{ auth()->user()->getName()}}</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu tree" data-widget="tree">
    <!-- Optionally, you can add icons to the links -->
    <li><a href="{{route('jm.index')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    <li class="header">Management APP</li>
    <li class="treeview">
        <a href="#"><i class="fa fa-bullhorn"></i> <span>Promises</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
        <li><a href="{{route('promises.list')}}"><i class="fa fa-navicon"></i> List</a></li>
        <li><a href="{{route('promises.create')}}"><i class="fa fa-edit"></i> Form</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#"><i class="fa fa-newspaper-o"></i> <span>Artikel</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
        <li><a href="{{route('artikel.list')}}"><i class="fa fa-navicon"></i> List</a></li>
        <li><a href="{{route('artikel.create')}}"><i class="fa fa-edit"></i> Form</a></li>
        </ul>
    </li>
    @if (auth()->user()->role == 'Admin')
    <li class="treeview">
        <a href="#"><i class="fa fa-database"></i> <span>Master Data</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
        <li><a href="{{route('master.periode')}}"><i class="fa fa-hourglass-half"></i> Periode</a></li>
        <li><a href="{{route('master.status')}}"><i class="fa  fa-question-circle"></i> Status</a></li>
        <li><a href="{{route('master.topik')}}"><i class="fa fa-comment"></i> Topik</a></li>
        </ul>
    </li>
    <li class="header">Management User</li>
    <li class="treeview">
        <a href="#"><i class="fa fa-user"></i> <span>User</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
        <li><a href="{{route('user.list')}}"><i class="fa fa-navicon"></i> List</a></li>
        </ul>
    </li>
    @endif
    </ul>
    <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>