@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Footer Page</h4>
                        <form method="post" action="{{ route('update.footer') }}" >
                            @csrf

                            <input type="hidden" name="id" id="id" value="{{ $allfooter->id }}">
                            <div class="row mb-3">
                                <label for="number" class="col-sm-2 col-form-label">Number</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="number" name="number" value="{{ $allfooter->number }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="short_description" class="col-sm-2 col-form-label">Short description</label>
                                <div class="col-sm-10">
                                    <textarea name="short_description" id="short_description" required="" class="form-control" rows="5">{{ $allfooter->short_description }}</textarea>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="address" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="address" name="address" value="{{ $allfooter->address }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="email" id="email" name="email" value="{{ $allfooter->email }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="facebook" name="facebook" value="{{ $allfooter->facebook }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="twitter" name="twitter" value="{{ $allfooter->twitter }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="copyright" class="col-sm-2 col-form-label">Copyright</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="copyright" name="copyright" value="{{ $allfooter->copyright }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Footer">
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>

@endsection