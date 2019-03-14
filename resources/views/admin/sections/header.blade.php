<!-- top navigation -->
<div class="top_nav">
    <div style="background: #2A3F54" class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i style="color: white" class="fa fa-bars"></i></a>
            </div>

            <div id="logo-sections" class="navbar nav_title"><a href="#" class="site_title"><img height="50px"
                                                                                                          width="210px"
                                                                                                          src="{{asset('images/logo.png')}}"
                                                                                                          alt=""></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a style="color: #ffffff" href="{{route('logout')}}" class="user-profile" aria-expanded="false"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                        <span class=" fa fa-sign-out"></span>
                    </a>

                    <form id="logout-form" method="POST" action="{{route('logout')}}" role="form"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>

                </li>

                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                       aria-expanded="false">
                        <i style="color: white"  class="fa fa-bell"></i>
                        <span class="badge bg-green">6</span>
                    </a>
                    {{--<ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <li>
                            <a>
                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                                <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                            </a>
                        </li>
                        <li>
                            <div class="text-center">
                                <a>
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>--}}
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->

