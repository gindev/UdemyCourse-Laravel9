@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<style type="text/css">
    .bootstrap-tagsinput .tag{
        margin-right: 2px;
        color: #b70000;
        font-weight: 700px;
    } 
</style>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Blog Page</h4>
                        <form method="post" action="{{ route('update.blog') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $blog->id }}">
                            <div class="row mb-3">
                                <label for="portfolio_name" class="col-sm-2 col-form-label">Blog Category</label>
                                <div class="col-sm-10">
                                    <select name="blog_category_id" class="form-select" aria-label="Default select example">
                                        <option selected="">Open this select menu</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}"{{ ($category->id == $blog->blog_category_id ? 'selected="selected"' : '') }}>{{ $category->blog_category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="blog_title" class="col-sm-2 col-form-label">Blog Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="blog_title" name="blog_title" value="{{ $blog->blog_title }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="blog_tags" class="col-sm-2 col-form-label">Blog Tags</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="blog_tags" name="blog_tags" value="{{ $blog->blog_tags }}" data-role="tagsinput">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="blog_description" class="col-sm-2 col-form-label">Blog Description</label>
                                <div class="col-sm-10">
                                    <textarea name="blog_description" id="elm1">{{ $blog->blog_description }}</textarea>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="blog_image" class="col-sm-2 col-form-label">Blog Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="blog_image" name="blog_image">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="image_preview" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" id="image_preview" src="{{ ($blog->blog_image ? asset($blog->blog_image) : url('upload/no-image.png')) }}" alt="Card image cap">
                                </div>
                            </div>
                            <!-- end row -->
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Blog Data">
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#blog_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#image_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection