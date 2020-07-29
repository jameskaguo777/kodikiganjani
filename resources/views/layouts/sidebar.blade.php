<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      Kodi<span> Kiganjani</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item {{ active_class(['*/admin']) }}">
        <a href="{{ url('/admin/') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">App Configuration</li>
      <li class="nav-item {{ active_class(['*/news/*']) }}">
        <a class="nav-link" data-toggle="collapse" href="#news" role="button" aria-expanded="{{ is_active_route(['*/news/*']) }}" aria-controls="news">
          <i class="link-icon" data-feather="mail"></i>
          <span class="link-title">News</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['*/news/*']) }}" id="news">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('news-create') }}" class="nav-link {{ active_class(['*/news/create']) }}">create</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('news-index') }}" class="nav-link {{ active_class(['*/news/index']) }}">View</a>
            </li>
            {{-- <li class="nav-item">
              <a href="{{ url('/email/compose') }}" class="nav-link {{ active_class(['email/compose']) }}">Compose</a>
            </li> --}}
          </ul>
        </div>
      </li>
      <li class="nav-item {{ active_class(['*/tax/calculator/*']) }}">
        <a href="{{ route('tax-calculator-index') }}" class="nav-link">
          <i class="link-icon" data-feather="message-square"></i>
          <span class="link-title">Tax Calculator</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['*/tax/calender/*']) }}">
        <a href="{{ route('tax-calender-index') }}" class="nav-link">
          <i class="link-icon" data-feather="calendar"></i>
          <span class="link-title">Tax Calendar</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['*/notification/index']) }}">
        <a href="{{ route('noti-index') }}" class="nav-link">
          <i class="link-icon" data-feather="calendar"></i>
          <span class="link-title">Notification</span>
        </a>
      </li>
      <li class="nav-item nav-category">App Info Page</li>
      <li class="nav-item {{ active_class(['*/inc_tax_fill/*']) }}">
        <a class="nav-link" href="{{ route('inc-tax-index') }}">
          <i class="link-icon" data-feather="feather"></i>
          <span class="link-title">Income Tax Return Filling</span>
          {{-- <i class="link-arrow" data-feather="chevron-down"></i> --}}
        </a>
        
      </li>
      <li class="nav-item {{ active_class(['*/reg_new_business/*']) }}">
        <a class="nav-link" href="{{ route('reg-business-index') }}" >
          <i class="link-icon" data-feather="pie-chart"></i>
          <span class="link-title">Registering New Business</span>
          {{-- <i class="link-arrow" data-feather="chevron-down"></i> --}}
        </a>
        
      </li>
      <li class="nav-item {{ active_class(['*/contacts/*']) }}">
        <a class="nav-link" href="{{ route('contacts-index') }}" >
          <i class="link-icon" data-feather="layout"></i>
          <span class="link-title">Contacts</span>
          {{-- <i class="link-arrow" data-feather="chevron-down"></i> --}}
        </a>
        
      </li>

      <li class="nav-item {{ active_class(['*/about_info/*']) }}">
        <a class="nav-link" href="{{ route('about-info-index') }}" >
          <i class="link-icon" data-feather="layout"></i>
          <span class="link-title">About info</span>
          {{-- <i class="link-arrow" data-feather="chevron-down"></i> --}}
        </a>
        
      </li>
     
      <li class="nav-item nav-category">Admin</li>
      <li class="nav-item {{ active_class(['general/*']) }}">
        <a class="nav-link" data-toggle="collapse" href="#general" role="button" aria-expanded="{{ is_active_route(['general/*']) }}" aria-controls="general">
          <i class="link-icon" data-feather="book"></i>
          <span class="link-title">Users</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse {{ show_class(['*/subscribers/*']) }}" id="general">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('sub-index') }}" class="nav-link {{ active_class(['*/subscribers/users']) }}">Subscribers</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('sub-expired') }}" class="nav-link {{ active_class(['*/subscribers/expired_subs']) }}">Expired Subscribers</a>
            </li>
            
          </ul>
        </div>
      </li>
      <li class="nav-item {{ active_class(['*/packages/*']) }}">
        <a class="nav-link" href="{{ route('packages-index') }}">
          <i class="link-icon" data-feather="unlock"></i>
          <span class="link-title">Packages</span>
          {{-- <i class="link-arrow" data-feather="chevron-down"></i> --}}
        </a>
       
      </li>

      <li class="nav-item {{ active_class(['*/payment_conf_index']) }}">
        <a class="nav-link" href="{{ route('pay-conf-index') }}" >
          <i class="link-icon" data-feather="layout"></i>
          <span class="link-title">Payment Configuration</span>
          {{-- <i class="link-arrow" data-feather="chevron-down"></i> --}}
        </a>
        
      </li>
    
      
    
    </ul>
  </div>
</nav>
