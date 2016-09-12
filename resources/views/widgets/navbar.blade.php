<nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="{{ url('/') }}">ELB</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                  <ul class="nav navbar-nav navbar-right">
                        @if(Auth::check())
                              <li>
                                    <a href="{{ route('dashboard') }}">
                                          Welcome, {{ Auth::user()->full_name }}
                                    </a>
                              </li>
                              <li>
                                    <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">Log out
                                   </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                              </li>
                        @else
                              <li>
                                    <a href="{{ url('/login') }}">SIGN IN</a>
                              </li>
                        @endif
                  </ul>
            </div><!-- /.navbar-collapse -->
      </div>
</nav>