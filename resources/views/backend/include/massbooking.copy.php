@extends('backend.layouts.subpage')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.bootstrap.min.css">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>


  <div class="d-flex justify-content-end mb-4">
            <!-- <a class="btn btn-primary" href="{{ URL::to('/massbooking/pdf') }}">Export to PDF</a> -->
            <button class="btn btn-primary" id="submit">Export to  PDF</button>
        </div>
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <table id="content" summary="This table shows how to create responsive tables using Datatables' extended functionality" class="table table-bordered table-hover dt-responsive">
       
        <thead>
      <center><b><h2>Today Mass List</h2></b></center>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">Name</th>
            <th class="text-center">Mass id</th>
            <th class="text-center">Mass Intention</th>
            <th class="text-center">Email</th>
            <th class="text-center">Mobile Number</th>
            <th class="text-center">Prayer Category id</th>
            <th class="text-center">Payment status</th>
            <th class="text-center">payment Reference</th>
            <!-- <th class="text-center">Place</th> -->
        </tr>
    </thead>
    <tbody>
         @foreach ($data as $key=> $value)
      
            <tr>    
                <td class="text-center">{{$value->id}}</td>
                <td class="text-left">{{$value->name}}</td>
                <td class="text-left">{{$value->mass_id}}</td>
                <td class="text-center">{{$value->intention}}</td>
                <td class="text-center">{{$value->email}}</td>
                <td class="text-center">{{$value->mobile}}</td>
                <td class="text-center">{{$value->prayer_category_id}}</td>
                <td class="text-center">{{$value->payment_status}}</td> 
                <td class="text-center">{{$value->payment_reference}}</td>
            </tr>
        @endforeach
    </tbody>

</table>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>
<script>
    $('table').DataTable();
</script>
<script>
var doc = new jsPDF(); 
var specialElementHandlers = { 
    '#editor': function (element, renderer) { 
        return true; 
    } 
};
$('#submit').click(function () { 
    doc.fromHTML($('#content').html(), 15, 20, { 
        'width': 190, 
            'elementHandlers': specialElementHandlers 
    }); 
    doc.save('mass.pdf'); 
});
</script>
</html>
@endsection


<!-- api -->
<!--  @foreach ($data as $key=> $value)
      
            <tr>    
                <td class="text-center">{{$value->id}}</td>
                <td class="text-left">{{$value->name}}</td>
                <td class="text-left">{{$value->mass_intention}}</td>
                <td class="text-center">{{$value->mass_offered}}</td>
                <td class="text-center">{{$value->mass_time}}</td>
                <td class="text-center">{{$value->date}}</td>
                <td class="text-center">{{$value->email}}</td>
                <td class="text-center">{{$value->phone}}</td>
                <td class="text-center">{{$value->place}}</td> 
            </tr>
        @endforeach -->

  
