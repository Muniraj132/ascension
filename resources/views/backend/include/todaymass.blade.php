@extends('backend.layouts.subpage')

@section('content')


 <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
               <a href="{{url('massbookings')}}">
              <div class="inner">
                <h3>150</h3>
                <p>TODAY MASS</p></a>
              </div>
              <div class="icon">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53
                </h3>
                <p>Contribution (WEEKLY)</p>
              </div>
              <div class="icon">
                <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>
                <p>Contribution (MONTHLY)</p>
              </div>
              <div class="icon">
                <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>
                <p>Contribution (ANNUAL)</p>
              </div>
              <div class="icon">
                <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
 <div class="container">
  <div class="row" >
      <div class="card-body">
        <table id="simple_table" class="table table-bordered table-striped">
        <thead>
        <div class="d-flex justify-content-end mb-4">
            <input type="button" class="btn btn-primary" onclick="generate()" value="Export To PDF" /> 
        </div>
            <th class="bg-info">No</th>
            <th class="bg-info">Name</th>
            <th class="bg-info">Dateand Time</th>
            <th class="bg-info">language</th>
            <th class="bg-info">Intention</th>
            <th class="bg-info">Intention For</th>
            <th class="bg-info">Email</th>
            <th class="bg-info">Phone Number</th>
            <th class="bg-info">Payment status</th>
            <th class="bg-info">payment Reference</th>
        </tr>
    </thead>
    <tbody>

         @foreach ($data as $key=> $value)
       <?php 
      $date_time = date('d-m-Y h:i A', strtotime($value->DateTime));

     ?>   <tr>    
                <td class="text-center">{{$value->id}}</td>
                <td class="text-left">{{$value->name}}</td>
                <td class="text-center">{{$date_time}}</td>
                <td class="text-center">{{$value->language}}</td>
                <td class="text-center">{{$value->intention}}</td>
                <td class="text-center">{{$value->intentionfor}}</td>
                <td class="text-center">{{$value->email}}</td>
                <td class="text-center">{{$value->number}}</td>   
                <td class="text-center">{{$value->payment_status}}</td> 
                <td class="text-center">{{$value->payment_reference}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>
</div>
</body>
<script>
    $('table').DataTable();
</script>
<script type="text/javascript">  
function generate() {  
    var doc = new jsPDF('p', 'pt', 'letter');  
    var htmlstring = '';  
    var tempVarToCheckPageHeight = 0;  
    var pageHeight = 0;  
    pageHeight = doc.internal.pageSize.height;  
    specialElementHandlers = {  
        '#bypassme': function(element, renderer) {  
            return true  
        }  
    }; 
    var y = 20;  
    doc.setLineWidth(2);  
    doc.text(200, y = y + 30, "MassBooking List");  
    doc.autoTable({  
        html: '#simple_table',  
        startY: 60,  
        styles: {  
            minCellHeight: 10  
        }  
    })  
    doc.save('mass.pdf');  
}  
</script> 
</body>
</html>
@endsection

