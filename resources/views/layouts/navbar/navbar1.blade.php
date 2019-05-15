<!-- Navbar to be remove  -->
<header class="animated slideInDown">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <div class="container">
        <a href="/">
            <img src="{{asset('imgs/bam.png')}}" class="uba-logo" style="max-width: 100%; width: 50px; height: 50px; margin-right: 10px;"></a>
        <h1 class="logo">UBa ETD</h1>
        <form action="/search" method="GET" class="ml-5" role="search" style="padding-left: 10px;padding-top: 4px">
            {{ csrf_field() }}

            <div class="input-group search">
                <input type="text" class="form-control" name="query"
                       placeholder="Search projects"> 
                <div class="input-group-append"> 
                    <button type="submit" class="btn input-group-text">
                        <i class="fa fa-search text-white"></i>
                    </button>
                </div>
            </div>
        </form>
        <nav class="navbar">
            <a href="{{action('GalleryController@create','')}}" class="btn btn-primary">Project Gallery</a>

            <div class="dropdown ml-3">
                <a href="#" class="profile-image dropdown-btn"><img src="imgs/typing.jpg" alt="Profile image"></a>
                <div class="dropdown-content">
                    <ul class="list-group">
                       <a class="list-group-item list-group-action" href="{{ action('Auth\LoginController@logout','') }}" rel="noopener noreferrer">Logout</a>
                        <a class="list-group-item list-group-item-action" href="{{action('ProfileController@create','')}}" rel="noopener noreferrer">Profile settings</a>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
<!-- End of navbar -->