<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 550px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
        
    /* On small screens, set height to 'auto' for the grid */
    @media screen and (max-width: 767px) {
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>

<!-- <nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Product-App</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Dashboard</a></li>
        <li><a href="#">Age</a></li>
        <li><a href="#">Gender</a></li>
        <li><a href="#">Geo</a></li>
      </ul>
    </div>
  </div>
</nav> -->

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <h2>Logo</h2>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="{{'adminDashboard'}}">Dashboard</a></li>
        <li><a href="{{url('category')}}">Category</a></li>
        <li><a href="{{url('product')}}">Product</a></li>
        <!-- <li><a href="#section3">Geo</a></li> -->
      </ul><br>
    </div>
    <br>
    
    <div class="col-sm-9">
      <div class="well">
        <h4>Dashboard</h4>
          @if(isset(Auth::user()->email))
          <div class="alert alert-danger success-block">
     <strong>Welcome {{ Auth::user()->email }}</strong>
     <a href="{{ url('/logout') }}" class=" btn btn-danger btn-xs pull-right">Logout</a>
    </div>
   @else
    <script>window.location = "/main";</script>
   @endif
    @if($errors->count())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $error }}</strong>
   </div>
    @endforeach
@endif
 @if(session()->has('flash_success'))
    <div class="alert alert-success">
        {{ session()->get('flash_success') }}
    </div>
@endif


      </div>
   
      </div>

         <div class="col-sm-9">
      <div class="well">
        <h1>Product</h1>

        <form  action="{{url('product/create')}}" method="post" enctype="multipart/form-data">
   @csrf 




   <div class="form-group">
       <label for="category_id">Choose a Category:</label>
       <select name="category_id" id="cars" class="form-control">

   <option value="">Select your option</option>
@foreach($category as $key=>$c)
  <option value={{$key}}>{{$c}}</option>
  @endforeach
</select>


    </div>



       <div class="form-group">
      <label for="name">Product Name:</label>
      <input type="name" class="form-control" id="name" placeholder="Enter name" name='name'>
    </div>

     <div class="form-group">
      <label for="name">Image:</label>
      <input type="file" class="form-control" name="image">
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
  </form>


       

      </div>
   
      </div>

          <div class="col-sm-12">
      <div class="well">
       
    

  <h4>Product List:</h4>
      <hr style="border:black 1px;">
  <table class="table table-responsive">
    <thead>
      <th>S.N.</th>
      <th>Category</th>
      <th>Name</th>
      <th>Picture</th>
      <th>Action</th>

    </thead>
    <tbody>
      @foreach($data as $key=>$d)
      <tr>
        <td>{{++$key}}</td>
        <td>{{$d->product_category->category_name ?? ""}}</td>
        <td>{{$d->product_name}}</td>
        <td><img src="{{url('public/product',$d->product_image)}}" height="200" width="200"></td>
  <td><a href="{{url('product/delete',$d->id)}}" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>

      </tr>
      @endforeach
    </tbody>
  </table>
       

      </div>
   
      </div>

      
    </div>
  </div>

</body>
</html>
