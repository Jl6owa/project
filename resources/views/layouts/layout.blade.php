
<!DOCTYPE html>
<html>
<head>
     <meta charset='utf-8'>
    <link rel="stylesheet" href="/storage/src/assets/dateTimePicker.css">
    <link rel="stylesheet" href="/storage/src/style2.css">
    <script type="text/javascript" src="/storage/src/scripts/components/jquery.min.js"></script>
    <script type="text/javascript" src="/storage/src/scripts/dateTimePicker.min.js"></script>
    <title></title>
</head>
<body>
    <div class="navbar">
        <div class="logo">
           <a href="/" class="addb">Get your crib</a> 
        </div>
   


             @if (Route::has('login'))
                <div class="rightsidebuttons">
                    @auth
                        <div class="userbutton">
                            
                        
                        <a href="{{ url('/home') }}"class="loginB" name="username">{{Auth::user()->name}}</a>
                          <div class="dropdown-content">
                            <a href="/home">Dashboard</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log-out</a>
                            

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>



                            </div>
                        </div>  
  

                        <a href="/addhome/create" class="addb">Add Appartment</a> 
                    @else
                        <a href="{{ route('login') }}" class="loginB">Log-In</a></a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="loginB">Register</a>
                        @endif
                    @endauth
                </div>
            @endif



         
        
    </div>
    <div class="content">

        @yield('content')
        
        </div>


    </div>
</body>
</html>