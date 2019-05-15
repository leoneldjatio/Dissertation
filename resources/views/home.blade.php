@extends ('layouts.app')

@section('content')
    <section id="hero">
        <div class="container">
            <div class="left">
                <div class="content">
                    <h1>Publish your desertations.</h1>
                    <p class="lead">Make your knowledge known to the world.</p>
                </div>
            </div>
            <div class="right">
                <h3>our image here.</h3>
            </div>
        </div>
    </section>

    <section id="recent_projects">
        <h1 class="text-center mb-5">Recent Projects...</h1>
        <div class="container">
            <div class="slider-container">
                <div class="slide card">
                    <img src="imgs/surface_book.jpg" alt="" class="project_img">
                    <div class="abstract">
                        <h2 class="project-title">Ad Hoc Networks</h2>
                        <p class="lead">A concise study</p>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eaque similique iure quod, alias quas sequi fuga voluptate eius asperiores facilis voluptatum illo, libero recusandae minus expedita vitae tenetur. Ad, pariatur.</p>
                        <div class="cta">
                            <button class="btn btn-danger">Read more</button>
                            <button class="btn btn-success">Download</button>
                        </div>
                    </div>
                </div>

                <div class="slide card">
                    <img src="imgs/surface_book.jpg" alt="" class="project_img">
                    <div class="abstract">
                        <h2 class="project-title">Ad Hoc Networks</h2>
                        <p class="lead">A concise study</p>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eaque similique iure quod, alias quas sequi fuga voluptate eius asperiores facilis voluptatum illo, libero recusandae minus expedita vitae tenetur. Ad, pariatur.</p>
                        <div class="cta">
                            <button class="btn btn-danger">Read more</button>
                            <button class="btn btn-success">Download</button>
                        </div>
                    </div>
                </div>

                <div class="slide card">
                    <img src="imgs/surface_book.jpg" alt="" class="project_img">
                    <div class="abstract">
                        <h2 class="project-title">Ad Hoc Networks</h2>
                        <p class="lead">A concise study</p>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eaque similique iure quod, alias quas sequi fuga voluptate eius asperiores facilis voluptatum illo, libero recusandae minus expedita vitae tenetur. Ad, pariatur.</p>
                        <div class="cta">
                            <button class="btn btn-danger">Read more</button>
                            <button class="btn btn-success">Download</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="controls">
                <button class="btn btn-circle btn-danger left">&lang;</button>
                <button class="btn btn-circle btn-danger right">&rang;</button>
            </div>
        </div>
    </section>
@endsection