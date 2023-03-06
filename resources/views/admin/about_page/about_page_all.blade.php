@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">About Page</h4>
                        <form method="post" action="{{ route('update.about') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" id="id" value="{{ $aboutpage->id }}">
                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="title" name="title" value="{{ $aboutpage->title }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="short_title" class="col-sm-2 col-form-label">Short title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="short_title" name="short_title" value="{{ $aboutpage->short_title }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="short_description" class="col-sm-2 col-form-label">Short description</label>
                                <div class="col-sm-10">
                                    <textarea name="short_description" id="short_description" required="" class="form-control" rows="5">{{ $aboutpage->short_description }}</textarea>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="long_description" class="col-sm-2 col-form-label">Long description</label>
                                <div class="col-sm-10">
                                    <textarea name="long_description" id="elm1">{{ $aboutpage->long_description }}</textarea>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="about_image" class="col-sm-2 col-form-label">About image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="about_image" name="about_image" value="{{ $aboutpage->about_image }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="image_preview" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" id="image_preview" src="{{ ($aboutpage->about_image ? url($aboutpage->about_image) : url('upload/no-image.png')) }}" alt="Card image cap">
                                </div>
                            </div>
                            <!-- end row -->
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update About Page">
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#about_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#image_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection