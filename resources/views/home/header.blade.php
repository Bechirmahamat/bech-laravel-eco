 <header class="header_section">
     <div class="container">
         <nav class="navbar navbar-expand-lg custom_nav-container ">
             <a class="navbar-brand" href="{{ route('home') }}"><span>Bech</span> <span class="text-danger">tech</span></a>
             <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                 <span class=""> </span>
             </button>
             <div class="collapse navbar-collapse" id="navbarSupportedContent">
                 <ul class="navbar-nav">
                     <li class="nav-item active">
                         <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                     </li>
                     <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button"
                             aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span
                                     class="caret"></span></a>
                         <ul class="dropdown-menu">
                             <li><a href="about.html">About</a></li>
                             <li><a href="testimonial.html">Testimonial</a></li>
                         </ul>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="product.html">Products</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="blog_list.html">Blog</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="{{ route('your_order') }}">Your orders</a>
                     </li>
                     <li class="nav-item ">
                         <a class="mr-3 text-primary mb-2 "href="{{ route('cart') }}"> <i class="bi bi-bag"
                                 aria-hidden="true"></i></a>
                     </li>
                     @if (Route::has('login'))
                         @auth

                             <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button"
                                     aria-haspopup="true" aria-expanded="true"> <span
                                         class="nav-label">{{ auth()->user()->name }} <span class="caret"></span></a>
                                 <ul class="dropdown-menu bechdrop">
                                     <li><a href="{{ route('profile.edit') }}">profile</a></li>
                                     <li>
                                         <form method="POST" action="{{ route('logout') }}">
                                             @csrf

                                             <a : href="{{ route('logout') }}"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                 {{ __('Log Out') }}
                                             </a>
                                         </form>
                                     </li>
                                 </ul>




                             </li>
                         @else
                             <li class="nav-item">
                                 <a class="btn btn-primary mr-1" id='logincss' href="{{ route('login') }}">login</a>
                             </li>
                             <li class="nav-item">
                                 <a class="btn btn-outline-success" href="{{ route('register') }}">register</a>
                             </li>

                         @endauth
                     @endif

                 </ul>
             </div>
         </nav>
     </div>
 </header>
