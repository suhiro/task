@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload</div>

                <div class="card-body">
                    
                    <form method="post" action="{{ route('upload.file') }}" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group">
                        <label for="csv_file">Upload csv</label>
                        <input type="file" class="form-control" id="csv_file" name="csv_file"  placeholder="Choose file">
                        <small class="form-text text-muted">Please upload a file in csv format</small>
                      </div>
                      <input type="submit" class="btn btn-primary" value="Submit">
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection