{{-- @extends('layouts.app') --}}

@auth
    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
        <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
        <div class="sidebar-content">
            <div class="sidebar-brand">
                <a href="#">{{ __('generalBack.sidebarTitle') }}</a>
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
                        <span>{{ __('generalBack.general') }}</span>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-person"></i>
                            <span>{{ __('generalBack.vendors') }}</span>
                            {{-- <span class="badge badge-pill badge-warning">New</span> --}}
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('vendor.list') }}">{{ __('generalBack.allVendors') }}
                                        {{-- <span
                                         class="badge badge-pill badge-success"
                                         >Pro</span> --}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('vendor.create') }}">{{ __('generalBack.addVendor') }}
                                        {{-- <span class="badge badge-pill badge-success">Pro</span> --}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-scroll"></i>
                            <span>{{ __('generalBack.pages') }}</span>
                            {{-- <span class="badge badge-pill badge-warning">New</span> --}}
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('page.list') }}">{{ __('generalBack.allPages') }}
                                        {{-- <span
                                         class="badge badge-pill badge-success"
                                         >Pro</span> --}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('page.create') }}">{{ __('generalBack.addPage') }}
                                        {{-- <span class="badge badge-pill badge-success">Pro</span> --}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-box"></i>
                            <span>{{ __('generalBack.products') }}</span>
                            {{-- <span class="badge badge-pill badge-warning">New</span> --}}
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('product.list') }}">{{ __('generalBack.allProducts') }}
                                        {{-- <span
                                         class="badge badge-pill badge-success"
                                         >Pro</span> --}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('product.create') }}">{{ __('generalBack.addProduct') }}
                                        {{-- <span class="badge badge-pill badge-success">Pro</span> --}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="far fa-newspaper"></i>
                            <span>{{ __('generalBack.news') }}</span>
                            {{-- <span class="badge badge-pill badge-warning">New</span> --}}
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('news.list') }}">{{ __('generalBack.allNews') }}
                                        {{-- <span
                                         class="badge badge-pill badge-success"
                                         >Pro</span> --}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('news.create') }}">{{ __('generalBack.addNews') }}
                                        {{-- <span class="badge badge-pill badge-success">Pro</span> --}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="far fa-image"></i>
                            <span>{{ __('generalBack.album') }}</span>
                            {{-- <span class="badge badge-pill badge-warning">New</span> --}}
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="{{ route('album.list') }}">{{ __('generalBack.allAlbums') }}
                                        {{-- <span
                                         class="badge badge-pill badge-success"
                                         >Pro</span> --}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('album.create') }}">{{ __('generalBack.addAlbum') }}
                                        {{-- <span class="badge badge-pill badge-success">Pro</span> --}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="header-menu">
                        <span>{{ __('generalBack.extra') }}</span>
                    </li>
                    <li>
                        </a>

                        <a href="{{ route('videoAlbum.list') }}">
                            <i class="fa fa-video"></i>
                            <span>{{ __('generalBack.videos') }}</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('option.list') }}">
                            <i class="fa fa-book"></i>
                            <span>{{ __('generalBack.options') }}</span>
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
            <a href="{{ route('changeLangBack') }}">
                <i class="bi bi-translate"></i>
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
