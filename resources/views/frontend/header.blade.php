  <div class="main-wrapper">
      <!-- Modal -->
      <div class="modal fade search-modal" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-body">
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                          <i class="fas fa-times"></i>
                      </button>
                      <div class="search-box">
                          <input type="text">
                          <button class="input">
                              <i class="fas fa-search"></i>
                          </button>
                      </div>
                  </div>
              </div>
          </div>
      </div>



      <div class="offcanvas-overlay"></div>
      <header class="header-section">
          <div class="header-top">
              <div class="container d-flex justify-content-between align-items-center">
                  <div class="topbar-start">
                      <ul class="lan-switch">
                          <li>
                              <a href="javascript:void(0)">العربية</a>
                          </li>
                          <li>
                              <a href="javascript:void(0)">English</a>
                          </li>
                      </ul>
                  </div>
                  <div class="topbar-end  d-lg-block d-none">
                      <ul class="topbar-social">
                          <li>
                              <a href="javascript:void(0)" class="social-link">
                                  <i class="fab fa-linkedin-in"></i>
                              </a>
                          </li>


                          <li>
                              <a href="javascript:void(0)" class="social-link">
                                  <i class="fab fa-instagram"></i>
                              </a>
                          </li>
                          <li>
                              <a href="javascript:void(0)" class="social-link">
                                  <i class="fab fa-twitter"></i>
                              </a>
                          </li>
                          <li>
                              <a href="javascript:void(0)" class="social-link">
                                  <i class="fab fa-facebook-f"></i>
                              </a>
                          </li>
                      </ul>
                  </div>
                  <div class="mobile-menu-toggle-wrap  d-lg-none d-block" id="menuToggler">
                      &#8801;
                  </div>
              </div>
          </div>
          <div class="header-bottom" id="sidebarMenu">
              <div class="container d-flex justify-content-between align-items-center flex-wrap">
                  <div class="menu-closer d-lg-none d-block" id="menuClose">&times;</div>
                  <div class="header-bottom-start">
                      <a href="javascript:void(0)" href="javascript:void(0)">
                          <img src="assets/img/site-logo.png" alt="">
                      </a>
                  </div>
                  <ul class="main-menu" id="mainMenu">
                      <li>
                          <a href="/">الرئيسية</a>
                      </li>

                      @foreach ($pages as $page)
                          @if ($page->sideMenu == 1)
                              <li>
                                  <a href="/front/page/{{ $page->page_slug }}">{{ $page->title }}</a>
                              </li>
                          @endif
                      @endforeach
                      <li>
                          <a href="{{ route('front.contact') }}">إتصل بنا</a>
                      </li>
                      <li>
                          <a href="javascript:void(0)" class="logo d-block" type="button" data-bs-toggle="modal"
                              data-bs-target="#search-modal">
                              <img src="assets/img/search-icon.png" alt="">
                          </a>
                      </li>
                  </ul>
              </div>
          </div>
      </header>
      <!--End header-section -->
