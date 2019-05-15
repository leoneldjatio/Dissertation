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
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                    <form action="" class="form border py-3 px-2 rounded bg-white">
                        <div class="form-group">
                            <label for="school">School or Faculty</label>
                            <input list="schools" name="school" id="school" class="form-control" placeholder="Start typing">
                            <datalist id="schools">
                                <option value="HTTC">Higher Teachers Traning College</option>
                                <option value="HTTTC">Higher Technical Teachers Traning College</option>
                                <option value="HICM">Higher Institute of Commerce and Management</option>
                                <option value="FS">Faculty of Science</option>
                                <option value="FA">Faculty of Arts</option>
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label for="department">Department</label>
                            <input list="departments" name="department" id="department" class="form-control" placeholder="Start typing">
                            <datalist id="departments">
                                <option value="Econs">Economics</option>
                                <option value="Mgt">Management and accounting</option>
                                <option value="MKt">Marketting</option>
                                <option value="BF">Banking and Finance</option>
                                <option value="FA">Faculty of Arts</option>
                            </datalist>
                        </div>
                        <input type="submit" name="advanced-search" class="form-control btn btn-primary" value="Search now">
                    </form>
                </div>
            </div>

            @else
                <div class="col-md-3">
                   <p>Search by</p>
                     <ul class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">School</a>
                        <a href="#" class="list-group-item list-group-item-action">Department</a>
                        <a href="#" class="list-group-item list-group-item-action">Date</a>
                    </ul>
                </div>

            @endif
            <div class="col-md-9">
                <div class="row">
            @foreach( $theses as $thesis)
            <div class="col-md-10 col-lg-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{$thesis->title}}<br><span class="date-posted">{{$thesis->created_at}}</span></h3>
                    </div>
                    <div class="card-body">
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
                            <button data-file="{{url($thesis->file_name)}}" href="#" class=" btn btn-info btn-sm ml-3 view">
                                <i class="fa fa-eye"> View</i>
                            </button>
                            @if(!Auth::guest())
                            <button data-target="#delete" data-toggle="modal" class="delete-modal btn btn-danger btn-sm  ml-3" data-id="{{$thesis->thesis_id}}">
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

    <div class="lightbox" style="display: none; position: fixed;  place-items: center; top: 0; left: 0; right:0; bottom: 0; background: rgba(0,0,0,0.5); overflow: scroll;">
        <div class="box" style="padding: 50px 80px; width: 100%; height: auto; position: relative;border: none; border-radius: 4px; background: white; z-index: 100;" >
            <h1 class="text-center heading">Project Abstract</h1><span class="close" style="position: absolute;  top: 20px; right: 20px; padding: 4px 8px; cursor: pointer; background: orangered; color: white; border-radius: 4px;">&times;</span><hr>
            <div class="content"></div>
        </div>
    </div>

    {{--form to delete post --}}
    <div id="delete" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <b><h4 class="modal-title text-center" style="color: white">DELETE CONFIRMATION</h4></b>
                    <button type="button" class="close"  data-dismiss="modal">&times;</button>
                </div>
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="post" action="/delete">
                    {{method_field('delete')}}
                    {{ csrf_field() }}

                    <div class="modal-body">
                        <b><p class="text-center">
                                Are you sure you want to delete this Thesis?
                            </p></b>
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

    <script src="{{asset('js/pdfobject.js')}}"></script>
    <script>
        const cardBody = document.querySelectorAll('.card-body');
        const abstracts = document.querySelectorAll('.abstract');
        const lightbox = document.querySelector('.lightbox');
        const bodyHeight = cardBody[0].offsetHeight;

        const viewBtns = document.querySelectorAll('.card-footer .view');
        viewBtns.forEach(function(view){
            view.addEventListener('click', function(){
                const viewer = document.querySelector('.viewer embed');
                viewer.setAttribute('src', this.dataset.file);
                
                // pdfobject trial and error
                // PDFObject.embed(this.dataset.file, ".content");
                console.log(viewer);
                document.querySelector('.lightbox .heading').style.display = 'none';
                document.querySelector('.lightbox .content').innerHTML = document.querySelector('.viewer').innerHTML;
                lightbox.style.display = 'block';
                const header = document.querySelector('header');
                header.style.position = 'static';
            });
        });

//
        abstracts.forEach(function(abstract){
           if(abstract.offsetHeight > bodyHeight ) {
               // get its view more button
               const viewMore = abstract.querySelector('.see-more');
               viewMore.style.display = 'block';

               // Change box width to 80% to suit abstract format
               const box = document.querySelector('.lightbox .box');

               viewMore.addEventListener('click', function(){
                    box.style.width = '80%';
                    lightbox.style.display = 'grid';
                    var content = document.querySelector('.lightbox .box .content');
                    content.innerHTML = abstract.innerHTML;
                    content.querySelector('.see-more').style.display = 'none';
               });

           }
        });

        const closebtn = document.querySelector('.lightbox .close');
        closebtn.addEventListener('click', function(){
            lightbox.style.display = 'none';
            document.querySelector('header').style.position = "sticky";
            document.querySelector('.lightbox .box').style.width = '100%';
            document.querySelector('.lightbox .heading').style.display = 'block';
        });

    </script>
@endsection