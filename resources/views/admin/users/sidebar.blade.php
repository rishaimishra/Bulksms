<nav id="sidebarMenu" class="d-md-block bg-light">
  <div class="">
    <ul class="list-group">
      <li class="list-group-item active">
        <a class="" href="{{route('home')}}">
          <span data-feather="home"></span>
          Dashboard <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="list-group-item">
        @can('manage-users')
        <a class="" href="{{route('admin.import.show')}}">
          <span data-feather="file-text"></span>
          User Management
        </a>
        @endcan
      </li>
      <li class="list-group-item">
        <a class="" href="{{route('admin.import.form')}}">
          <span data-feather="shopping-cart"></span>
          Send sms
        </a>
      </li>
      <li class="list-group-item">
        <a class="" href="{{route('admin.import.form.bulksms')}}">
          <span data-feather="shopping-cart"></span>
          Send Bulk SMS
        </a>
      </li>

      <li class="list-group-item">
        <a class="" href="{{route('admin.allsms')}}">
          <span data-feather="shopping-cart"></span>
          SMS Outbox
        </a>
      </li>

      <li class="list-group-item">
        <a class="" href="{{route('admin.import.form.mail')}}">
          <span data-feather="shopping-cart"></span>
          Send email
        </a>
      </li>
      <li class="list-group-item">
        <a class="" href="{{route('admin.import.form.bulkmail')}}">
          <span data-feather="shopping-cart"></span>
          Send Bulk email
        </a>
      </li>

      <li class="list-group-item">
        <a class="" href="{{route('admin.allmails')}}">
          <span data-feather="shopping-cart"></span>
          Email Outbox
        </a>
      </li>
      <li class="list-group-item">
        <a class="" href="{{route('admin.import.templates')}}">
          <span data-feather="shopping-cart"></span>
          Template Messages
        </a>
      </li>
      <li class="list-group-item">
      <a class="" href="{{route('admin.import.blocknumber')}}">
          <span data-feather="users"></span>
          BlackList
        </a>
      </li>
      {{-- <li class="list-group-item">
        <a class="" href="#">
          <span data-feather="bar-chart-2"></span>
          Reports
        </a>
      </li>
      <li class="list-group-item">
        <a class="" href="#">
          <span data-feather="layers"></span>
          Integrations
        </a>
      </li> --}}
    </ul>
    {{-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
    <span>Saved reports</span>
    <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
      <span data-feather="plus-circle"></span>
    </a>
    </h6> --}}
    <ul class="list-group">
      {{-- <li class="list-group-item">
        <a class="" href="#">
          <span data-feather="file-text"></span>
          Current month
        </a>
      </li>
      <li class="list-group-item">
        <a class="" href="#">
          <span data-feather="file-text"></span>
          Last quarter
        </a>
      </li>
      <li class="list-group-item">
        <a class="" href="#">
          <span data-feather="file-text"></span>
          Social engagement
        </a>
      </li> --}}
      <li class="list-group-item">
        @can('manage-users')
        <a class="" href="{{route('admin.users.index')}}">
          <span data-feather="file-text"></span>
          Staff Management
        </a>
        @endcan
      </li>



    </ul>
  </div>
</nav>
