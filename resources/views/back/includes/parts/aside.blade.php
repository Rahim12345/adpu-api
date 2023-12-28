<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ route('admin.dashboard') }}">
                <img src="https://adpu.edu.az/images/adpu_files/frontend_files/logo/android-chrome-100x100.png" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item d-none d-md-flex me-3">
                <div class="btn-list">
                    <a href="https://github.com/tabler/tabler" class="btn" target="_blank" rel="noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-github" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" /></svg>
                        Source code
                    </a>
                    <a href="https://github.com/sponsors/codecalm" class="btn" target="_blank" rel="noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-pink" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                        Sponsor
                    </a>
                </div>
            </div>
            <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
            </a>
            <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
            </a>
            <div class="nav-item dropdown d-none d-md-flex me-3">
                <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
                    <span class="badge bg-red"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-card">
                    <div class="card">
                        <div class="card-body">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad amet consectetur exercitationem fugiat in ipsa ipsum, natus odio quidem quod repudiandae sapiente. Amet debitis et magni maxime necessitatibus ullam.
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm"
                          @if(auth()->user()->avatar)
                              style="background-image: url({{ asset('images/profiles/'.auth()->user()->avatar) }})"
                    @endif
                    >
                    @if(!auth()->user()->avatar)
                            {{ substr(auth()->user()->name,0,1).substr(auth()->user()->last_name,0,1) }}
                        @endif
                    </span>
                    <div class="d-none d-xl-block ps-2">
                        <div>Paweł Kuna</div>
                        <div class="mt-1 small text-muted">UI Designer</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('profil.index') }}" class="dropdown-item">Profile & account</a>
                    <a href="#" class="dropdown-item">Feedback</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">Settings</a>
                    <a href="#" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                        </span>
                        <span class="nav-link-title">
                            @lang('menu.home')
                        </span>
                    </a>
                </li>

                @if(\App\Helpers\MenuShower::getPermission('roles.index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('roles.index') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
	                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 11l2 2l4 -4" /></svg>
                        </span>
                            <span class="nav-link-title">
                            @lang('menu.roles')
                        </span>
                        </a>
                    </li>
                @endif
                @if(\App\Helpers\MenuShower::getPermission('users.index'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
	                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                        </span>
                            <span class="nav-link-title">
                            @lang('menu.users')
                        </span>
                        </a>
                    </li>
                @endif

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->segment(2) == 'pages' ? 'show' : '' }}" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="{{ request()->segment(2) == 'pages' ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.077 20h-5.077v-16h11v14h-5.077" /></svg>
                        </span>
                        <span class="nav-link-title">
                            @lang('menu.pages')
                        </span>
                    </a>
                    <div class="dropdown-menu {{ request()->segment(2) == 'pages' ? 'show' : '' }}">
                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle {{ request()->segment(2) == 'pages' && request()->segment(3) == 'home' ? 'show' : '' }}" href="#home-page" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="{{ request()->segment(2) == 'pages' && request()->segment(3) == 'home' ? 'true' : 'false' }}">
                                @lang('menu.home')
                            </a>
                            <div class="dropdown-menu {{ request()->segment(2) == 'pages' && request()->segment(3) == 'home' ? 'show' : '' }}">
                                <a href="{{ route('home-banner.index') }}" class="dropdown-item text-wrap">@lang('static.banner')</a>
                                <a href="{{ route('home-about.edit',['home_about'=>1]) }}" class="dropdown-item text-wrap">@lang('static.about')</a>
                                <a href="{{ route('home-faq.index') }}" class="dropdown-item text-wrap">@lang('static.faq')</a>
                                <a href="{{ route('home-special-program.index') }}" class="dropdown-item text-wrap">@lang('static.special_programs')</a>
                            </div>
                        </div>
                        <div class="dropend">
                            <a class="dropdown-item dropdown-toggle {{ request()->segment(2) == 'pages' && request()->segment(3) == 'about' ? 'show' : '' }}" href="#university-page" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded=" {{ request()->segment(2) == 'pages' && request()->segment(3) == 'about' ? 'true' : 'false' }}">
                                @lang('menu.university')
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropend">
                                    <a class="dropdown-item dropdown-toggle" href="#about-page" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                        @lang('menu.about')
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="" class="dropdown-item text-wrap">@lang('static.our_history')</a>
                                        <a href="" class="dropdown-item text-wrap">@lang('static.mission_and_vision')</a>
                                        <a href="" class="dropdown-item text-wrap">@lang('static.our_achievements')</a>
                                        <a href="" class="dropdown-item text-wrap">@lang('static.please_meet')</a>
                                        <a href="" class="dropdown-item text-wrap">@lang('static.rector_s_stat')</a>
                                        <a href="" class="dropdown-item text-wrap">@lang('static.newspaper')</a>
                                    </div>
                                </div>
                                <div class="dropend">
                                    <a class="dropdown-item dropdown-toggle" href="#management-page" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                        @lang('menu.management')
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="" class="dropdown-item text-wrap">@lang('static.rector')</a>
                                        <a href="" class="dropdown-item text-wrap">@lang('static.rectory')</a>
                                        <a href="" class="dropdown-item text-wrap">@lang('static.vice_rectors')</a>
                                        <a href="" class="dropdown-item text-wrap">@lang('static.scientific_council')</a>
                                        <a href="" class="dropdown-item text-wrap">@lang('static.structure')</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/filemanager') }}" target="_blank" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
	                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 3v4a1 1 0 0 0 1 1h4" /><path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" /><path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" /></svg>
                        </span>
                        <span class="nav-link-title">
                            Media
                        </span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>
