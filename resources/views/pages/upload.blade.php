@extends('layouts.app')

@section('content')

    <div class="container mb-5" id="upload-page">
        
        <form role="form" enctype="multipart/form-data" action="upload1" method="post" class="p-3 rounded">
            <h1 class="text-center m-4 mt-1">Add a new Project</h1>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group mb-2 d-flex">
                <div>
                    <input type="text" name="title" class="form-control mb-2" placeholder="Project title" required>
                    <input type="text" name="supervisor" class="form-control mb-2" placeholder="Project supervisor">
                    <input type="text" name="author" class="form-control mb-2" placeholder="Author/Student name">
                    <input type="number" name="number_of_pages" class="form-control mb-2" placeholder="Number of pages">
                </div>
                <div class="upload form-control ml-2 pb-2">
                    <div>
                        <img src="imgs/plus-icon.png" alt="plus icon">
                        <p class="filename">Add project document<br>(Pdf)</p>
                        <input type="file" name="file" class="form-control file-btn" required>
                    </div>
                </div>
            </div>

            <div class="form-group mb-2">
                <textarea name="description" type="text" id="" cols="30" rows="5" class="form-control" placeholder="Project abstract/summary"></textarea>
            </div>
            <div class="form-group mb-2 form-row">
                <div class="col form-group">
                    <input list="schools" name="faculty_name" class="form-control" placeholder="Select School/faculty">
                    <datalist id="schools">
                        @foreach($faculties as $faculty)
                            <option value="{{$faculty->faculty_name}}">{{$faculty->faculty_name}}</option>
                        @endforeach
                    </datalist>
                </div>

                <div class="col form-group">
                    <input list="department" name="department_name" class="form-control" placeholder="Select department">
                    <datalist id="schools">
                        @foreach($departments as $department)
                            <option value="{{$department->department_name}}">{{$department->department_name}}</option>
                        @endforeach
                    </datalist>
                </div>

                <div class="col form-group">
                    <input list="categories" name="category_name" class="form-control" placeholder="Select Option">
                    <datalist id="categories">
                        @foreach($categories as $category)
                            <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                        @endforeach
                    </datalist>
                </div>
            </div>
            <button type="submit" class="btn btn-success text-uppercase">Upload Project</button>
            <a href="{{action('GalleryController@create','')}}" class="btn back text-uppercase px-5 pull-right">Back</a>
        </form>
    </div>
    <script>
        const uploadbtn = document.querySelector('.upload');
        let filename = document.querySelector('.upload .filename')
        const fileBtn = document.querySelector('.file-btn');
        let uploadIcon = document.querySelector('.upload img');

        uploadbtn.onclick = function(e){
            fileBtn.click();
        }

        fileBtn.addEventListener('change', function(event) {
            if(event.target.value) {
                filename.innerHTML = event.target.value;
                let file = event.target.files[0];

                // if not a pdf file, raise an error
                if(!file.name.endsWith('.pdf')) {
                    fileBtn.value = ""; // no pdf file selected
                    filename.textContent = "File must be pdf";
                    // uploadbtn.classList.add('bg-danger', 'text-white');
                    uploadIcon.setAttribute('src', 'imgs/x-icon.png');
                    console.log(fileBtn.value);
                }else {
                    filename.textContent = file.name.split(".")[0];
                    //uploadbtn.classList.remove('bg-danger', 'text-white');
                    uploadIcon.setAttribute('src', 'imgs/tick-icon.png');
                    console.log(fileBtn.value);
                }
            }else {
                filename.innerHTML = 'Add project document<br />(Pdf)';
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection


