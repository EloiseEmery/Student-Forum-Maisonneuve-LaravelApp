<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ config('app.name') }}</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="/assets/favicon.ico" />
        <!-- Core th/eme CSS (includes Bootstrap)-->
        <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" />
    	<!-- Bootstrap Font Icon CSS -->
    	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
		<!-- Google fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    </head>
    <body>
		@php $locale = session()->get('locale'); @endphp
        <div class="d-flex" id="wrapper">
			<!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
				<div class="sidebar-heading border-bottom"><a href="{{ route('pages.home') }}"><img src="{{ URL::asset('assets/college-maisonneuve-etudiant.png') }}" alt="logo-etudiant" width="75px"/></a><br>@lang('lang.site_title')<br><small>Cmaisonneuve</small></div>
                <div class="list-group list-group-flush">
					<a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('etudiants.index') }}">@lang('lang.menu_item_first')</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('article.index') }}">@lang('lang.menu_item_second')</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('pages.a-venir') }}">@lang('lang.menu_item_third')</a>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-secondary" id="sidebarToggle"><i class="bi bi-caret-left"></i></button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-third" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-person-circle"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
									@guest
										<a class="dropdown-item" href="{{ route('auth.login') }}">@lang('lang.menu_item_fourth')</a>
									@else
										<a class="dropdown-item" href="{{ route('auth.dashboard') }}">@lang('lang.menu_item_fifth')</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="{{ route('auth.logout') }}">@lang('lang.menu_item_sixth')</a>
									@endguest
                                    </div>
                                </li>
								<div class="row">
									<li class="col-1 me-4"><a class="nav-link @if($locale == 'fr' ) text-primary @endif" href="{{ route('lang', 'fr') }}">Fr</a></li> 
									<li class="mt-2 col-1">|</li>
									<li class="col-1"><a class="nav-link @if($locale == 'en') text-primary @endif" href="{{ route('lang', 'en') }}">En</a></li>
								</div>
                            </ul>
                        </div>
                    </div>
                </nav>
				<main>
					<div class="container-content">
						<!-- Page content-->
						@yield('content')
					</div>
				</main>
				<footer class="bg-dark">
				<p class="text-center pt-3 pb-3 mb-0"><small class="text-light">
					3 800, rue Sherbrooke Est Montréal (Québec) H1X 2A2 | 514 254-7131<br>
					Copyright © 2022 - Éloïse Emery - TP1 Laravel. @lang('lang.footer_copyright')
				</small></p>
				</footer>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ URL::asset('js/scripts.js') }}"></script>
    </body>
</html>
