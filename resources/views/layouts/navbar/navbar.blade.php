@section('navbar')
    <header>
        <div class="container">
            <a href="/"><img src="{{asset('imgs/bam.png')}}" style="max-width: 100%; width: 50px; height: 50px; margin-right: 10px;"></a>
            <h1 class="logo"> UBa ETD</h1>
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
                <a href="/" class="nav-link">home</a>
                <a href="{{action('GalleryController@create','')}}" class="nav-link">Browse Projects</a>
                <a href="#" class="nav-link">faqs</a>
                <a href="{{action('Auth\LoginController@login','')}}" class="btn btn-success">Sign In</a>
            </nav>
        </div>
    </header>
@endsection
