<header class="top-header top-header-bg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-2 pr-0">
                        <div class="language-list">
                            <select class="language-list-item">
                                <option>English</option>
                                <option>العربيّة</option>
                                <option>Deutsch</option>
                                <option>Português</option>
                                <option>简体中文</option>
                            </select>	
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-10">
                        <div class="header-right">
                            <ul>
                                <li>
                                    <i class='bx bx-home-alt'></i>
                                    <a href="#">Love Road, Tejgaon, Bangladesh</a>
                                </li>
                                <li>
                                    <i class='bx bx-phone-call'></i>
                                    <a href="tel:+8801521307543">+880 1521 307543</a>

                                </li>


                            
  @auth

                                        <li>
                                            <i class='bx bxs-user-pin'></i>
                                             <a href="{{ route('dashboard') }}">Dashboard</a>
                                       </li>

                                         <li>
                                        <i class='bx bxs-user-rectangle'></i>
                                        <a href="{{ route('user.logout') }}">Logout</a>
                                        </li>

 @else

 @auth
 <li>
    <i class='bx bxs-user-pin'></i>
    <a href="{{ route('dashboard') }}">Dashboard</a>
</li>

<li>
    <i class='bx bxs-user-rectangle'></i>
    <a href="{{ route('user.logout') }}">Logout</a>
</li>

  @else

  <li>
    <i class='bx bxs-user-pin'></i>
    <a href="{{ route('login') }}">Login</a>
</li>

<li>
    <i class='bx bxs-user-rectangle'></i>
    <a href="{{ route('register') }}">Register</a>
</li>
      
  @endauth
                 
    
@endauth


                                <li>
                                    <i class='bx bx-envelope'></i>
                                    <a href="mailto:rafiulsiddique301@gmail.com">rafiulsiddique301@gmail.com</a>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>