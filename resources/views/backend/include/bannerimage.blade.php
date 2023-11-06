@extends('backend.layouts.subpage')

@section('content')

  
 <div class="container">
   
    <div class="panel panel-primary">
      <!-- <div class="panel-heading"><h2>laravel 8 file upload example - ItSolutionStuff.com.com</h2></div> -->
      <div class="panel-body">
       
        <div style="display:none !important">
            {{ Form::open(array('url' => 'foo/bar')) }}
                <button type="submit">submit</button>
            {{ Form::close() }}
        </div>

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        @endif
  
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <h3 class="jumbotron">Image Upload </h3>
  <form method="post" action="{{ route('banner.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
               <div class="form-group">
                <label>Banner Name</label>
                <input type="text" class="form-control" name="name">
            </div>
          <input type="file" name="file_path" id="file_path" onchange="loadPreview(this);" class="form-control">
          <label for="profile_image"></label>
            <img id="preview_img" src="http://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png" class="" width="200" height="150"/>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
          <button type="submit" class="btn btn-success" style="margin-top:10px">Upload Image</button>
          </div>
        </div>
  </form>
  </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
  function loadPreview(input, id) {
    id = id || '#preview_img';
    if (input.files && input.files[0]) {
        var reader = new FileReader();
 
        reader.onload = function (e) {
            $(id)
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
        };
 
        reader.readAsDataURL(input.files[0]);
    }
 }
</script>

@endsection