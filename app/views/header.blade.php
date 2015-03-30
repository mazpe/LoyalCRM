@section("header")
  <div class="header">
<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">
            <font color="orange">Loyal Driver CRM</font>
        </a>
    </div>
    <ul class="nav navbar-nav">
        @if (Auth::user()->hasRole('Admin'))
        <li><a href="{{ URL::to('dealergroups') }}">Dealer Groups</a></li>
        <li><a href="{{ URL::to('settings') }}">Settings</a></li>
        @endif
      @if (Auth::check())
        @if (Auth::user()->hasRole('Agent'))
        <li><a href="{{ URL::to('agents/'. Auth::user()->id) .'/profile' }}">{{ Auth::user()->name }}</a></li>
        @endif
        @if (Auth::user()->hasRole('Agent') || Auth::user()->hasRole('Admin'))
        <li><a href="{{ URL::to('reports') }}">Reports</a></li>
        @endif
        @if (Auth::user()->hasRole('Dealer'))
        <li><a href="{{ URL::to('dealers/'. Auth::user()->dealer_id.'/month/'. date('m')) }}">{{ Auth::user()->name }}</a></li>
        @endif
        <li>
            <a href="{{ URL::to('agents/'. Auth::user()->id) .'/leads' }}">
            Leads
            </a>
        </li>
        <li><a href="{{ URL::to('logout') }}">Logout</a></li>
      @else
        <li><a href="{{ URL::to('login') }}">Login</a></li>
      @endif
    </ul>
</nav>

  </div>
@show
