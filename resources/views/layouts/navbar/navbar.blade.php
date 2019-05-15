@section('navbar')
    <header>
        <div class="container">
            <a href="/"><img src="{{asset('imgs/UBAlogo.png')}}" style="max-width: 100%; width: 50px; height: 50px; margin-right: 10px;"></a>
            <h1 class="logo"> UBa ETD</h1>
            <form action="/search" method="GET" role="search" style="padding-left: 10px;padding-top: 4px">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="query"
                           placeholder="Search projects"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <i class="fa fa-search"></i>
            </button>
        </span>
                </div>
            </form>
            <nav class="navbar">
                <a href="/" class="nav-link">home</a>
                <a href="{{action('GalleryController@create','')}}" class="nav-link">Browse Projects</a>
                <a href="#" class="nav-link">faqs</a>
                <a href="{{action('Auth\LoginController@login','')}}" class="btn btn-success">Sign In</a>
            </nav>
        </div>
    </header>
@endsection
