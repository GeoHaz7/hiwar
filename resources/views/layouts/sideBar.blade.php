{{-- @extends('layouts.app') --}}

@auth
    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
        <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
        <div class="sidebar-content">
            <div class="sidebar-brand">
                <a href="#">pro sidebar</a>
                <div id="close-sidebar">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="sidebar-header">
                <div class="user-pic">
                    <img class="img-responsive img-rounded"
                        src="{{ $data->filename ? url('uploads/gallery') . '/' . $data->filename : URL::asset('assets/profile.jpeg') }}"
                        alt="User picture">
                </div>

                <div class="user-info">
                    <span class="user-name">{{ $data->full_name }}

                    </span>
                    <span
                        class="user-role">{{ Auth::user()->type == 2 ? 'Vendor' : (Auth::user()->type == 1 ? 'Admin' : 'Super Admin') }}</span>
                    <span class="user-status">
                        <i class="fa fa-circle"></i>
                        <span>Online</span>
                    </span>
                </div>
            </div>
            <!-- sidebar-header  -->
            {{-- <div class="sidebar-search">
                <div>
                    <div class="input-group">
                        <input type="text" class="form-control search-menu" placeholder="Search...">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sidebar-search  --> --}}
            <div class="sidebar-menu">
                <ul>
                    <li class="header-menu">
                        <span>General</span>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-person"></i>
                            <span>Vendors</span>
                            {{-- <span class="badge badge-pill badge-warning">New</span> --}}
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('vendor.list') }}">All Vendors
                                        {{-- <span
                                         class="badge badge-pill badge-success"
                                         >Pro</span> --}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('vendor.create') }}">Add Vendor
                                        {{-- <span class="badge badge-pill badge-success">Pro</span> --}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-scroll"></i>
                            <span>Pages</span>
                            {{-- <span class="badge badge-pill badge-warning">New</span> --}}
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('page.list') }}">All Pages
                                        {{-- <span
                                         class="badge badge-pill badge-success"
                                         >Pro</span> --}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('page.create') }}">Add Page
                                        {{-- <span class="badge badge-pill badge-success">Pro</span> --}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-box"></i>
                            <span>Products</span>
                            {{-- <span class="badge badge-pill badge-warning">New</span> --}}
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('product.list') }}">All Products
                                        {{-- <span
                                         class="badge badge-pill badge-success"
                                         >Pro</span> --}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('product.create') }}">Add Product
                                        {{-- <span class="badge badge-pill badge-success">Pro</span> --}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="far fa-newspaper"></i>
                            <span>News</span>
                            {{-- <span class="badge badge-pill badge-warning">New</span> --}}
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('news.list') }}">All News
                                        {{-- <span
                                         class="badge badge-pill badge-success"
                                         >Pro</span> --}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('news.create') }}">Add News
                                        {{-- <span class="badge badge-pill badge-success">Pro</span> --}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="far fa-image"></i>
                            <span>Album</span>
                            {{-- <span class="badge badge-pill badge-warning">New</span> --}}
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('album.list') }}">All Album
                                        {{-- <span
                                         class="badge badge-pill badge-success"
                                         >Pro</span> --}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('album.create') }}">Add Album
                                        {{-- <span class="badge badge-pill badge-success">Pro</span> --}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="header-menu">
                        <span>Extra</span>
                    </li>
                    <li>
                        </a>

                        <a href="{{ route('videoAlbum.list') }}">
                            <i class="fa fa-video"></i>
                            <span>Videos</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('album.list') }}">
                            <i class="fa fa-folder"></i>
                            <span>Albums</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('option.list') }}">
                            <i class="fa fa-book"></i>
                            <span>Options</span>
                            <span class="badge badge-pill badge-primary">Beta</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- sidebar-menu  -->
        </div>
        <!-- sidebar-content  -->
        <div class="sidebar-footer">
            <a href="#">
                <i class="fa fa-bell"></i>
                <span class="badge badge-pill badge-warning notification">3</span>
            </a>
            <a href="#">
                <i class="fa fa-envelope"></i>
                <span class="badge badge-pill badge-success notification">7</span>
            </a>
            <a href="#">
                <i class="fa fa-cog"></i>
                <span class="badge-sonar"></span>
            </a>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{-- {{ __('Logout') }}> --}}
                <i class="fa fa-power-off"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </nav>
@endauth
