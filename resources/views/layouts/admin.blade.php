
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="index, follow" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:image" content=""/>
	<meta name="format-detection" content="telephone=no">
    @php
        $routeName = \Illuminate\Support\Facades\Route::currentRouteName();
        $routeTitle = $routeName
            ? ucwords(str_replace(['.', '-', '_'], ' ', $routeName))
            : 'Administration';
        $pageTitle = trim($__env->yieldContent('title')) !== '' ? trim($__env->yieldContent('title')) : $routeTitle;
    @endphp

    <title>{{ $pageTitle }} | Mobilier Addict</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset("assets/imgs/logo-2.png") }}">
	<link rel="stylesheet" href="{{ asset("assets/admin/vendor/chartist/css/chartist.min.css") }}">
    <link href="{{ asset("assets/admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/admin/css/style.css") }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    @stack('styles')



    <!-- CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->




    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">



        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{ route('admin.dashboard') }}" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('assets/logo/mobile/logo.png') }}" width="52" height="52" alt="Mobilier Addict" />
                <span class="brand-title" style="display:inline-block; color: #ffffff; font-weight: 700; font-size: 1.35rem; line-height: 1;">Mobilier Addict</span>
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->









		<!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                Dashboard
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
							<li class="nav-item">
								<div class="input-group search-area d-lg-inline-flex d-none">
									<div class="input-group-append">
										<span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
									</div>
									<input type="text" class="form-control" placeholder="Search here...">
								</div>
							</li>

							<li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link  ai-icon" href="javascript:void(0)" role="button" data-bs-toggle="dropdown">
                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M23.3333 19.8333H23.1187C23.2568 19.4597 23.3295 19.065 23.3333 18.6666V12.8333C23.3294 10.7663 22.6402 8.75902 21.3735 7.12565C20.1068 5.49228 18.3343 4.32508 16.3333 3.80679V3.49996C16.3333 2.88112 16.0875 2.28763 15.6499 1.85004C15.2123 1.41246 14.6188 1.16663 14 1.16663C13.3812 1.16663 12.7877 1.41246 12.3501 1.85004C11.9125 2.28763 11.6667 2.88112 11.6667 3.49996V3.80679C9.66574 4.32508 7.89317 5.49228 6.6265 7.12565C5.35983 8.75902 4.67058 10.7663 4.66667 12.8333V18.6666C4.67053 19.065 4.74316 19.4597 4.88133 19.8333H4.66667C4.35725 19.8333 4.0605 19.9562 3.84171 20.175C3.62292 20.3938 3.5 20.6905 3.5 21C3.5 21.3094 3.62292 21.6061 3.84171 21.8249C4.0605 22.0437 4.35725 22.1666 4.66667 22.1666H23.3333C23.6428 22.1666 23.9395 22.0437 24.1583 21.8249C24.3771 21.6061 24.5 21.3094 24.5 21C24.5 20.6905 24.3771 20.3938 24.1583 20.175C23.9395 19.9562 23.6428 19.8333 23.3333 19.8333Z" fill="#67636D"/>
										<path d="M9.98193 24.5C10.3863 25.2088 10.971 25.7981 11.6767 26.2079C12.3823 26.6178 13.1839 26.8337 13.9999 26.8337C14.816 26.8337 15.6175 26.6178 16.3232 26.2079C17.0289 25.7981 17.6136 25.2088 18.0179 24.5H9.98193Z" fill="#67636D"/>
								</svg>
									@php
										$unreadCount = auth()->user()?->unreadNotifications()->count() ?? 0;
										$notifications = auth()->user()?->notifications()->latest()->limit(10)->get() ?? collect();
									@endphp
								@if($unreadCount > 0)
									<span class="badge light text-white bg-primary rounded-circle">{{ $unreadCount }}</span>
								@endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div id="dlab_W_Notification1" class="widget-media dz-scroll p-3 height380">
									<ul class="timeline">
										@if($notifications->count() === 0)
											<li>
												<div class="timeline-panel">
													<div class="media-body">
														<small class="d-block">Aucune notification</small>
													</div>
												</div>
											</li>
										@else
											@foreach($notifications as $notification)
												@php
													$data = is_array($notification->data) ? $notification->data : [];
													$title = $data['title'] ?? 'Notification';
													$message = $data['message'] ?? '';
													$url = $data['url'] ?? null;
												@endphp
												<li>
													<div class="timeline-panel">
														<div class="media-body">
															<h6 class="mb-1">
																@if($url)
																	<a href="{{ $url }}" style="color: inherit;">
																		{{ $title }}
																	</a>
																@else
																	{{ $title }}
																@endif
															</h6>
															@if($message)
																<small class="d-block">{{ $message }}</small>
															@endif
															<small class="d-block">{{ $notification->created_at?->format('d/m/Y H:i') }}</small>
															@if(is_null($notification->read_at))
																<form method="POST" action="{{ route('admin.notifications.read', $notification->id) }}" class="mt-1">
																	@csrf
																	<input type="hidden" name="redirect_to" value="{{ $url ?? url()->current() }}">
																	<button type="submit" class="btn btn-link p-0" style="font-size: 12px;">Marquer comme lu</button>
																</form>
															@endif
														</div>
													</div>
												</li>
											@endforeach
										@endif


										</ul>
							</div>
							<div class="px-3 pb-2">
								<a href="{{ route('admin.notifications.index') }}" class="btn btn-admin-pink-outline w-100">Voir toutes les notifications</a>
							</div>
							@if($unreadCount > 0)
								<form method="POST" action="{{ route('admin.notifications.read-all') }}" class="px-3 pb-3">
									@csrf
									<button type="submit" class="btn btn-admin-pink w-100">Tout marquer comme lu</button>
								</form>
							@endif
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                    @if(auth()->user()->profile_picture)
                                        <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" width="20" height="20" class="rounded-circle" alt="{{ auth()->user()->name }}"/>
                                    @else
                                        <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 20px; height: 20px; font-size: 10px;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                    @endif
									<div class="header-info">
										<span>{{ auth()->user()->name }}</span>
										<small>{{ ucfirst(auth()->user()->role) }}</small>
									</div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="{{ route('admin.profile') }}" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ms-2">Profil </span>
                                    </a>

                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item ai-icon" style="border: none; background: none; width: 100%; text-align: left;">
                                            <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                            <span class="ms-2">Se déconnecter </span>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->









        		<!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">

				@php
					$userRole = auth()->user()->role;
					$isAdmin = in_array($userRole, ['admin', 'super_admin']);
					$isEditor = $userRole === 'editor';
					$isWriter = in_array($userRole, ['writer', 'author']);
					$openAdminHome = request()->routeIs('admin.dashboard');
					$openFacebookPixel = request()->routeIs('admin.settings.facebook-pixel.*');
					$openStats = request()->routeIs('admin.stats.*');
					$openNewsletter = request()->routeIs('admin.newsletter.*');
					$openArticles = request()->routeIs('admin.articles.*');
					$openCategories = request()->routeIs('admin.categories.*');
					$openProducts = request()->routeIs('admin.products.*');
					$openOrders = request()->routeIs('admin.orders.*');
					$openInvoices = request()->routeIs('admin.invoices.*');
					$openQuotes = request()->routeIs('admin.quotes.*');
					$openHome = request()->routeIs('admin.home_sections.*');
					$openPersonWeek = request()->routeIs('admin.person-week.*');
					$openJobs = request()->routeIs('admin.jobs.*');
					$openFlashNews = request()->routeIs('admin.flash-news.*');
					$openMenus = request()->routeIs('admin.menus.*');
					$openUsers = request()->routeIs('admin.users.*');
					$openRoles = request()->routeIs('admin.roles.*');
					$openSlider = request()->routeIs('admin.slider.*');
					$openSaveTheDate = request()->routeIs('admin.save-the-date.*');
					$openUsersGroup = $openUsers || $openRoles;
					$openHomeGroup = $openHome || $openSlider;
					$openCatalogueGroup = $openCategories || $openProducts || $openMenus;
					$openOrdersGroup = $openOrders || $openInvoices || $openQuotes;
				@endphp

				<ul class="metismenu" id="menu">
					<li class="{{ $openAdminHome ? 'mm-active' : '' }}">
						<a class="ai-icon" href="{{ route('admin.dashboard') }}" aria-expanded="false">
							<i class="flaticon-layout"></i>
							<span class="nav-text">Dashboard</span>
						</a>
					</li>

                    {{-- Catégories - lecture pour tous, gestion pour editors/admins --}}
					<li class="{{ $openCatalogueGroup ? 'mm-active' : '' }}"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="{{ $openCatalogueGroup ? 'true' : 'false' }}">
                        <i class="flaticon-381-folder"></i>
						<span class="nav-text">Catalogue</span>
                    </a>
					<ul aria-expanded="false" class="{{ $openCatalogueGroup ? 'mm-show' : '' }}">
						<li><a href="{{ route('admin.categories.index') }}">Catégories</a></li>
						@if(in_array(auth()->user()->role, ['editor', 'admin', 'super_admin']))
							<li><a href="{{ route('admin.categories.create') }}">Créer une catégorie</a></li>
						@endif
						<li><a href="{{ route('admin.products.index') }}">Produits</a></li>
						<li><a href="{{ route('admin.products.create') }}">Créer un produit</a></li>
						<li><a href="{{ route('admin.menus.index') }}">Menus</a></li>
					</ul>
                    </li>

					<li class="{{ $openOrdersGroup ? 'mm-active' : '' }}"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="{{ $openOrdersGroup ? 'true' : 'false' }}">
                        <i class="flaticon-381-list"></i>
                        <span class="nav-text">Commandes</span>
                    </a>
					<ul aria-expanded="false" class="{{ $openOrdersGroup ? 'mm-show' : '' }}">
						<li><a href="{{ route('admin.orders.index') }}">Commandes</a></li>
						<li><a href="{{ route('admin.invoices.index') }}">Factures</a></li>
						<li><a href="{{ route('admin.quotes.index') }}">Devis</a></li>
					</ul>
                    </li>

					<li class="{{ $openHomeGroup ? 'mm-active' : '' }}"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="{{ $openHomeGroup ? 'true' : 'false' }}">
                        <i class="flaticon-381-settings"></i>
                        <span class="nav-text">Home</span>
                    </a>
					<ul aria-expanded="false" class="{{ $openHomeGroup ? 'mm-show' : '' }}">
                        <li><a href="{{ route('admin.home_sections.index') }}">Sections</a></li>
						@if(in_array(auth()->user()->role, ['editor', 'admin', 'super_admin']))
							<li><a href="{{ route('admin.slider.index') }}">Sliders</a></li>
						@endif
						@if(in_array(auth()->user()->role, ['editor', 'admin', 'super_admin']))
							<li><a href="{{ route('admin.b2b.index') }}">B2B</a></li>
						@endif
                    </ul>
                    </li>

					<li class="{{ ($openNewsletter || $openFacebookPixel) ? 'mm-active' : '' }}"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="{{ ($openNewsletter || $openFacebookPixel) ? 'true' : 'false' }}">
						<i class="flaticon-newsletter"></i>
						<span class="nav-text">Marketing</span>
					</a>
						<ul aria-expanded="false" class="{{ ($openNewsletter || $openFacebookPixel) ? 'mm-show' : '' }}">
							<li><a href="{{ route('admin.newsletter.index') }}">Newsletter</a></li>
							<li><a href="{{ route('admin.settings.facebook-pixel.edit') }}">Facebook Pixel</a></li>
						</ul>
					</li>

					<li class="{{ $openStats ? 'mm-active' : '' }}">
						<a class="ai-icon" href="{{ route('admin.stats.index') }}" aria-expanded="false">
							<i class="flaticon-381-pie-chart"></i>
							<span class="nav-text">Statistiques</span>
						</a>
					</li>

					@if($isAdmin)
						<li class="{{ $openUsersGroup ? 'mm-active' : '' }}"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="{{ $openUsersGroup ? 'true' : 'false' }}">
							<i class="flaticon-user"></i>
							<span class="nav-text">Gestion Admin</span>
						</a>
							<ul aria-expanded="false" class="{{ $openUsersGroup ? 'mm-show' : '' }}">
								<li><a href="{{ route('admin.users.index') }}">Utilisateurs</a></li>
								<li><a href="{{ route('admin.roles.index') }}">Rôles</a></li>
							</ul>
						</li>
					@endif

					@php
						$showLegacyModules = false;
					@endphp
					@if($showLegacyModules)

                    {{-- Person Week - accessible aux editors et admins --}}
					@if(in_array(auth()->user()->role, ['editor', 'admin', 'super_admin']))
                        <li class="{{ $openPersonWeek ? 'mm-active' : '' }}"><a class="has-arrow" href="javascript:void()" aria-expanded="{{ $openPersonWeek ? 'true' : 'false' }}">
                            <i class="fa fa-user-circle-o"></i>
                            <span class="nav-text">Person Week</span>
                        </a>
						<ul aria-expanded="false" class="{{ $openPersonWeek ? 'mm-show' : '' }}">
                            <li><a href="{{ route('admin.person-week.index') }}">Voir toutes</a></li>
                            <li><a href="{{ route('admin.person-week.create') }}">Créer</a></li>
                        </ul>
                        </li>
                    @endif

                    {{-- Jobs - accessible aux editors et admins --}}
					@if(in_array(auth()->user()->role, ['editor', 'admin', 'super_admin']))
                        <li class="{{ $openJobs ? 'mm-active' : '' }}"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="{{ $openJobs ? 'true' : 'false' }}">
							    <i class="flaticon-contract"></i>
							    <span class="nav-text">Jobs</span>
						    </a>
							<ul aria-expanded="false" class="{{ $openJobs ? 'mm-show' : '' }}">
                                <li><a href="{{ route('admin.jobs.index') }}">Voir toutes</a></li>
                                <li><a href="{{ route('admin.jobs.create') }}">Créer</a></li>
                            </ul>
                        </li>
                    @endif

                    {{-- Flash News - accessible aux editors et admins --}}
					@if(in_array(auth()->user()->role, ['editor', 'admin', 'super_admin']))
                        <li class="{{ $openFlashNews ? 'mm-active' : '' }}"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="{{ $openFlashNews ? 'true' : 'false' }}">
							    <i class="flaticon-plugin"></i>
							    <span class="nav-text">Flash News</span>
						    </a>
							<ul aria-expanded="false" class="{{ $openFlashNews ? 'mm-show' : '' }}">
                                <li><a href="{{ route('admin.flash-news.index') }}">Voir toutes</a></li>
                                <li><a href="{{ route('admin.flash-news.create') }}">Créer</a></li>
                            </ul>
                        </li>
                    @endif

                    {{-- MENUS RÉSERVÉS AUX ADMINISTRATEURS UNIQUEMENT --}}
					@if(in_array(auth()->user()->role, ['admin', 'super_admin']))
                        <li class="{{ $openMenus ? 'mm-active' : '' }}"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="{{ $openMenus ? 'true' : 'false' }}">
							    <i class="flaticon-web"></i>
							    <span class="nav-text">Gestion Menus</span>
						    </a>
							<ul aria-expanded="false" class="{{ $openMenus ? 'mm-show' : '' }}">
                                <li><a href="{{ route('admin.menus.index') }}">Menus</a></li>
                            </ul>
                        </li>

						<li class="{{ $openUsers ? 'mm-active' : '' }}"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="{{ $openUsers ? 'true' : 'false' }}">
							    <i class="flaticon-user"></i>
							    <span class="nav-text">Gestion Admin</span>
						    </a>
							<ul aria-expanded="false" class="{{ $openUsers ? 'mm-show' : '' }}">
                                <li><a href="{{ route('admin.users.index') }}">Voir tous</a></li>
                                <li><a href="{{ route('admin.users.create') }}">Créer</a></li>
                                <li><a href="{{ route('admin.users.stats') }}">Statistiques</a></li>
                            </ul>
                        </li>

						<li class="{{ $openRoles ? 'mm-active' : '' }}"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="{{ $openRoles ? 'true' : 'false' }}">
							    <i class="flaticon-user-tag"></i>
							    <span class="nav-text">Gestion Rôles</span>
						    </a>
							<ul aria-expanded="false" class="{{ $openRoles ? 'mm-show' : '' }}">
                                <li><a href="{{ route('admin.roles.index') }}">Voir tous</a></li>
                                <li><a href="{{ route('admin.roles.create') }}">Créer</a></li>
                            </ul>
                        </li>

						<li class="{{ $openSlider ? 'mm-active' : '' }}"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="{{ $openSlider ? 'true' : 'false' }}">
							    <i class="flaticon-newsletter"></i>
							    <span class="nav-text">Slider Articles</span>
						    </a>
							<ul aria-expanded="false" class="{{ $openSlider ? 'mm-show' : '' }}">
                                <li><a href="{{ route('admin.slider.index') }}">Voir tous</a></li>
                                <li><a href="{{ route('admin.slider.create') }}">Ajouter</a></li>
                            </ul>
                        </li>

						<li class="{{ $openSaveTheDate ? 'mm-active' : '' }}"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="{{ $openSaveTheDate ? 'true' : 'false' }}">
                            <i class="flaticon-newsletter"></i>
                            <span class="nav-text">Save Date</span>
                        </a>
						<ul aria-expanded="false" class="{{ $openSaveTheDate ? 'mm-show' : '' }}">
                            <li><a href="{{ route('admin.save-the-date.index') }}">Voir toutes</a></li>
                            <li><a href="{{ route('admin.save-the-date.create') }}">Créer</a></li>
                        </ul>
                        </li>
                    @endif

					@endif

					<li class="{{ $openArticles ? 'mm-active' : '' }}"><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="{{ $openArticles ? 'true' : 'false' }}">
						<i class="flaticon-monitor"></i>
						<span class="nav-text">Contenus</span>
					</a>
						<ul aria-expanded="false" class="{{ $openArticles ? 'mm-show' : '' }}">
							<li><a href="{{ route('admin.articles.index') }}">Articles</a></li>
							<li><a href="{{ route('admin.articles.create') }}">Créer un article</a></li>
						</ul>
					</li>

                    {{-- Profil - accessible à tous --}}
                    <li>
						<a class="ai-icon" href="{{ route('admin.profile') }}" aria-expanded="false">
						    <i class="flaticon-user"></i>
						    <span class="nav-text">Mon Profil</span>
					    </a>
                    </li>
                </ul>

			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->





        @yield('content')






        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                 <p>Copyright © <a href="" target="_blank">Mobilier Addict</a> 2026</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
	<script src="{{ asset("assets/admin/vendor/global/global.min.js") }}"></script>
	<script src="{{ asset("assets/admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js") }}"></script>
	<script src="{{ asset("assets/admin/vendor/chart.js/Chart.bundle.min.js") }}"></script>

	<!-- Chart piety plugin files -->
    <script src="{{ asset("assets/admin/vendor/peity/jquery.peity.min.js") }}"></script>

	<!-- Apex Chart -->
	<script src="{{ asset("assets/admin/vendor/apexchart/apexchart.js") }}"></script>

	<!-- Dashboard 1 -->
	<script src="{{ asset("assets/admin/js/dashboard/dashboard-1.js") }}"></script>

    <script src="{{ asset("assets/admin/js/custom.min.js") }}"></script>
	<script src="{{ asset("assets/admin/js/deznav-init.js") }}"></script>


	<script>
		jQuery(document).ready(function(){
			setTimeout(function() {
				dezSettingsOptions.version = 'dark';
				new dezSettings(dezSettingsOptions);
			},1500)
		});
	</script>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const contentElement = document.getElementById('content');
            if (contentElement) {
                ClassicEditor
                    .create(contentElement, {
                        ckfinder: {
                            uploadUrl: '{{ route("admin.articles.upload-image") . "?_token=" . csrf_token() }}'
                        }
                    })
                    .then(editor => {
                        const form = contentElement.closest('form');
                        if (form) {
                            form.addEventListener('submit', function(e) {
                                contentElement.value = editor.getData();
                            });
                        }
                    })
                    .catch(error => {
                        console.error('There was a problem initializing the editor:', error);
                    });
            }
        });
    </script>

    {{-- Section pour les scripts personnalisés des vues --}}
    @stack('scripts')

</body>
</html>
