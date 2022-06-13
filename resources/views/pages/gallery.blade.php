@extends ('layouts.app')

@section('content')
<div id="gallery-page" class="container" style="margin-top: 20px">
    @if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(\Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <p>{{\Session::get('success')}}</p>
    </div>
    @endif
    <div class="viewer" style="display: none;">
        <h3>Viewer content</h3>
        <embed src="" type="application/pdf" style="width: 100%; height: 100vh;">
    </div>
    <div class="row mt-5">
        @if(!Auth::guest())
        <div class="col-md-4 col-lg-3 col-sm-12 mb-3">
            <a href="{{action('UploadController@upload','')}}">
                <div class="card text-center add-project">
                    <div>
                        <img src="imgs/plus-icon.png" alt="plus icon">
                        <p>Add a project</p>
                    </div>
                </div>
            </a>

            <div class="mt-3">
                <hr>
                <h4>Advanced Search</h4>
                <form role="form" enctype="multipart/form-data" action="advanceSearch2" method="get"
                    class="form border py-3 px-2 rounded bg-white">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="school">School or Faculty</label>
                        <select name="school" id="school" class="form-control" placeholder="Start typing">
                            @foreach($faculties as $faculty)
                            <option value="{{$faculty->faculty_name}}">{{$faculty->faculty_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="departments">Department</label>
                        <select id="departments" name="department" class="form-control" placeholder="Select department">
                        </select>
                    </div>
                    <button type="submit" class="form-control btn btn-primary">Search now</button>
                </form>
            </div>
        </div>

        @else
        <div class="col-md-3">
            <form role="form" enctype="multipart/form-data" action="advanceSearch2" method="get"
                class="form border py-3 px-2 rounded bg-white">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="school">School or Faculty</label>
                    <select name="school" id="school" class="form-control" placeholder="Start typing">
                        @foreach($faculties as $faculty)
                        <option value="{{$faculty->faculty_name}}">{{$faculty->faculty_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="departments">Department</label>
                    <select id="departments" name="department" class="form-control" placeholder="Select department">
                    </select>
                </div>
                <button type="submit" class="form-control btn btn-primary">Search now</button>
            </form>
        </div>

        @endif
        <div class="col-md-9">
            <div class="row">
                @foreach( $theses as $thesis)
                <div class="col-md-10 col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{$thesis->title}}<br>
                                <span class="date-posted"
                                    style="font-size:15px;padding-top:15px;color:steelblue">{{$thesis->year}}</span>
                            </h3>
                        </div>
                        <div class=" card-body">
                            <p class="abstract">
                                {{$thesis->description}}
                                <a href="#" class="see-more">See more</a>
                            </p>

                        </div>
                        <div class=" card-footer d-flex align-items-center">
                            <div class="row">
                                @if(!Auth::guest())
                                <form action="{{url($thesis->file_name)}}">
                                    <button class=" btn btn-success btn-sm ml-3">
                                        <i class="fa fa-download"> Download</i></button>
                                </form>
                                @endif
                                <button id="url" data-target="#view" data-toggle="modal"
                                    class="delete-modal btn btn-info btn-sm  ml-3" data-id="{{$thesis->file_name}}"
                                    data-name="{{$thesis->title}}">
                                    <i class="fa fa-eye"> View</i>
                                </button>
                                @if(!Auth::guest())
                                <button data-target="#delete" data-toggle="modal"
                                    class="delete-modal btn btn-danger btn-sm  ml-3" data-id="{{$thesis->thesis_id}}">
                                    <i class="fa fa-trash"> Drop</i>
                                </button>
                                @endif
                            </div>
                            <div class="metadata ml-auto align-self-end text-right d-flex flex-column">
                                <span class="text-dark">{{$thesis->faculty_name}}</span>
                                <span class="text-info">{{$thesis->department_name}}</span>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
            {{$theses->links('vendor.pagination.bootstrap-4')}}
        </div>
    </div>
</div>

<div class="lightbox"
    style="display: none; position: fixed;  place-items: center; top: 0; left: 0; right:0; bottom: 0; background: rgba(0,0,0,0.5); overflow: scroll;">
    <div class="box"
        style="padding: 50px 80px; width: 100%; height: auto; position: relative; margin: 0 auto; border: none; border-radius: 4px; background: white; z-index: 100;">
        <h1 class="text-center heading">Project Abstract</h1><span class="close"
            style="position: absolute;  top: 20px; right: 20px; padding: 0 8px 4px; cursor: pointer; background: orangered; color: white; border-radius: 4px;">&times;</span>
        <hr>
        <div class="content"></div>
    </div>
</div>

{{--form to delete post --}}
<div id="delete" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <b>
                    <h4 class="modal-title text-center" style="color: white">DELETE CONFIRMATION</h4>
                </b>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form class="form-horizontal" enctype="multipart/form-data" role="form" method="post" action="/delete">
                {{method_field('delete')}}
                {{ csrf_field() }}

                <div class="modal-body">
                    <b>
                        <p class="text-center">
                            Are you sure you want to delete this Thesis?
                        </p>
                    </b>
                    <input type="hidden" name="thesis_id" id="thesis" value="">
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="submit">
                            <i class="fa fa-plus">Yes, Delete</i>
                        </button>
                        <button class="btn btn-success" type="button" data-dismiss="modal">
                            <i class="fa fa-remove">No, Close</i>
                        </button>

                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

{{--form to view post --}}
<div id="view" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#08387F">
                <p id="title" class="modal-title text-center " style="color: white"></p>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div id="Iframe-Master-CC-and-Rs"
                    class="set-margin set-padding set-border set-box-shadow center-block-horiz">
                    <div class="responsive-wrapper
     responsive-wrapper-wxh-572x612" style="-webkit-overflow-scrolling: touch; overflow: auto;">
                        <div id="frame">
                            <iframe id="frame1" src="">
                                <p style="font-size: 110%;"><em><strong>ERROR: </strong>
                                        An &#105;frame should be displayed here but your browser version does not
                                        support &#105;frames. </em>Please update your browser to its most recent version
                                    and try again.</p>
                            </iframe>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>
</div>

<script src="{{asset('js/pdfobject.js')}}"></script>
<script>
const cardBody = document.querySelectorAll('.card-body');
const abstracts = document.querySelectorAll('.abstract');
const lightbox = document.querySelector('.lightbox');
const bodyHeight = cardBody[0].offsetHeight;

const viewBtns = document.querySelectorAll('.card-footer .view');
viewBtns.forEach(function(view) {
    view.addEventListener('click', function() {
        const viewer = document.querySelector('.viewer embed');
        viewer.setAttribute('src', this.dataset.file);

        // pdfobject trial and error
        // PDFObject.embed(this.dataset.file, ".content");
        console.log(viewer);
        document.querySelector('.lightbox .heading').style.display = 'none';
        document.querySelector('.lightbox .content').innerHTML = document.querySelector('.viewer')
            .innerHTML;
        lightbox.style.display = 'block';
        const header = document.querySelector('header');
        header.style.position = 'static';
    });
});

//
abstracts.forEach(function(abstract) {
    if (abstract.offsetHeight > bodyHeight) {
        // get its view more button
        const viewMore = abstract.querySelector('.see-more');
        viewMore.style.display = 'block';

        // Change box width to 80% to suit abstract format
        const box = document.querySelector('.lightbox .box');

        viewMore.addEventListener('click', function() {
            box.style.width = '80%';
            lightbox.style.display = 'grid';
            var content = document.querySelector('.lightbox .box .content');
            content.innerHTML = abstract.innerHTML;
            content.querySelector('.see-more').style.display = 'none';
        });

    }
});

const closebtn = document.querySelector('.lightbox .close');
closebtn.addEventListener('click', function() {
    lightbox.style.display = 'none';
    document.querySelector('header').style.position = "sticky";
    document.querySelector('.lightbox .box').style.width = '100%';
    document.querySelector('.lightbox .heading').style.display = 'block';
});
</script>
<script>
$(document).ready(function() {
    $("#school").on("change", function(e) {
        e.preventDefault();
        var Faculty = $(this).val();
        $.ajax({
            type: 'get',
            url: '/advanceSearch',
            data: {
                faculty: Faculty
            },
            success: function(data) {
                // assuming that your data is being return as json
                var departments = document.getElementById('departments');
                departments.innerHTML = "";
                //console.log(departments);
                data.forEach(function(dataItem) {

                    var option = document.createElement('option');
                    option.setAttribute('value', dataItem.department_name);
                    option.textContent = dataItem.department_name;
                    departments.appendChild(option);
                });

            }
        });
    });
});
</script>
@endsection