@extends('layouts.app')
@section('content')
    <div id="gallery-page" class="container">
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
                       <p class="text-danger">Search by</p>
                        <ul class="list-group">
                            <li class="list-group-item">All projects</li>
                            <li class="list-group-item">Authors</li>
                            <li class="list-group-item">School</li>
                            <li class="list-group-item">Department</li>
                            <li class="list-group-item">Subject</li>
                        </ul>

                        <ul class="list-group mt-3 list-group-primary">
                            <li class="list-group-item list-group-item-primary text-success">BSc Dissertations <span class="label">2</span></li>
                            <li class="list-group-item">MSc Disserations</li>
                            <li class="list-group-item">PhD Disserations</li>
                        </ul>
                    </div>
                    

                </div>
            @endif
            <div class="col-md-9">
                <div class="row">
            @foreach($data as $datum)
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{$datum->title}}<br><span class="date-posted">{{$datum->created_at}}</span></h3>
                        </div>
                        <div class="card-body">
                            <p class="abstract">
                                {{$datum->description}}
                                <a href="#" class="see-more">See more</a>
                            </p>

                        </div>
                        <div class=" card-footer">
                            <div class="row">
                                @if(!Auth::guest())
                                    <a href="{{url($datum->file_name)}}" class=" btn btn-success btn-sm ml-3 btn-sm">
                                        <i class="fa fa-download"> Download</i>
                                    </a>
                                @endif
                                <button data-file="{{url($datum->file_name)}}" href="#" class=" btn btn-info btn-sm ml-3">
                                    <i class="fa fa-eye"> View</i>
                                </button>
                                @if(!Auth::guest())
                                    <button data-target="#deleteSearch" data-toggle="modal" class="delete-modal btn btn-danger ml-3 btn-sm" data-id="{{$datum->thesis_id}}">
                                        <i class="fa fa-trash"> Drop</i>
                                    </button>
                                @endif
                            </div>
                        </div>


                    </div>
                </div>
            @endforeach
                </div>
                {{$data->links('vendor.pagination.bootstrap-4')}}
            </div>

        </div>
    </div>

    <div class="lightbox" style="display: none; position: fixed;  place-items: center; top: 0; left: 0; right:0; bottom: 0; background: rgba(0,0,0,0.5);">
        <div class="box" style="padding: 50px 80px; width: 80%; height: auto; position: relative;border: none; border-radius: 4px; background: white; z-index: 100;" >
            <h1 class="text-center">Project Abstract</h1><span class="close" style="position: absolute;  top: 20px; right: 20px; padding: 4px 8px; cursor: pointer; background: orangered; color: white; border-radius: 4px;">&times;</span><hr>
            <div class="content"></div>
        </div>
    </div>

    {{--form to delete post --}}
    <div id="deleteSearch" class="modal fade" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="hidden" name="thesis_id" id="SearchDel" value="">
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


    <script>
        const cardBody = document.querySelectorAll('.card-body');
        const abstracts = document.querySelectorAll('.abstract');
        const lightbox = document.querySelector('.lightbox');
        const bodyHeight = cardBody[0].offsetHeight;

        const viewBtns = document.querySelectorAll('.card-footer .btn-sm ');
        viewBtns.forEach(function(view){
            view.addEventListener('click', function(){
                console.log(this.dataset.file);
                const viewer = document.querySelector('.viewer embed');
                viewer.setAttribute('src', this.dataset.file);
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