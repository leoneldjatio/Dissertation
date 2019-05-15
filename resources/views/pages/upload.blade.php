@extends('layouts.app')

@section('content')

    <div class="container mb-5" id="upload-page">
        `<a href="{{action('GalleryController@create','')}}" class="btn btn-danger back mt-4">Back</a>
        <h1 class="text-center m-4">Add a new Project</h1>
        <form role="form" enctype="multipart/form-data" action="upload1" method="post">
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
            <div class="form-group mb-2">
                <select name="faculty_name" id="school" class="js-example-basic-single form-control" data-live-search="true" required>
                    <option value="" disabled selected>Faculty</option>
                    @foreach($faculties as $faculty)
                        <option value="{{$faculty->faculty_name}}">{{$faculty->faculty_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-2">
                <select name="department_name" id="option" class="js-example-basic-single form-control" required>
                    <option value="" disabled selected>Department</option>
                    @foreach($departments as $department)
                        <option value="{{$department->department_name}}">{{$department->department_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-2">
                <select name="category_name" id="option" class="js-example-basic-single form-control" required>
                    <option value="" disabled selected>Thesis Category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success text-uppercase mt-2">Upload Project</button>
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


