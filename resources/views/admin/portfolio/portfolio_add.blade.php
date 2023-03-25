@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Portfolio Page</h4>
                        <form method="post" action="{{ route('store.portfolio') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="portfolio_name" class="col-sm-2 col-form-label">Portfolio Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="portfolio_name" name="portfolio_name">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="portfolio_title" class="col-sm-2 col-form-label">Portfolio Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="portfolio_title" name="portfolio_title">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="portfolio_description" class="col-sm-2 col-form-label">Portfolio Description</label>
                                <div class="col-sm-10">
                                    <textarea name="portfolio_description" id="elm1"></textarea>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="portfolio_image" class="col-sm-2 col-form-label">Portfolio Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="portfolio_image" name="portfolio_image">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="image_preview" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img class="rounded avatar-lg" id="image_preview" src="{{ url('upload/no-image.png') }}" alt="Card image cap">
                                </div>
                            </div>
                            <!-- end row -->
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Insert Portfolio Data">
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