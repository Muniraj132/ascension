 @extends('backend.layouts.subpage')

@section('content')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>  

<style>  
th, td {  
    text - align: center;  
    border: 1 px solid black;  
    border - collapse: collapse;  
}  
</style> 

<div class="container">
   <div class="row" >
        <div class="card-body">
             <table id="simple_table" class="table table-bordered table-striped">
                 <thead>
                     <h2>Weekly Contribution</h2>
                          <div class="d-flex justify-content-end mb-4">
                              <input type="button" class="btn btn-primary" onclick="generate()" value="Export To PDF" />   
                          </div>
                            <tr>
                                <th class="bg-info">No</th>
                                <th class="bg-info">Name</th>
                                <th class="bg-info">Donation purpose</th>
                                <th class="bg-info">Place</th>
                                <th class="bg-info">Mobile Number</th>
                                <th class="bg-info">Amount</th>
                            </tr>
                </thead>
                <tbody>
                    @foreach ($week as $key=> $value)
                           <tr>    
                              <td class="text-center">{{++$key}}</td>
                              <td class="text-left">{{$value->name}}</td>  
                              <td class="text-left">{{$value->comments}}</td>
                              <td class="text-left">{{$value->address}}</td>
                              <td class="text-left">{{$value->mobile}}</td>
                              <td class="text-left">{{$value->amt}}</td>  
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
function generate(e) {  

    var doc = new jsPDF('p', 'pt', 'letter');  
    var htmlstring = '';  
    var tempVarToCheckPageHeight = 0;  
    var pageHeight = 0;  
    var ExportDate = moment().format("DD/MM/YYYY hh:mm A");
    pageHeight = doc.internal.pageSize.height;  
    specialElementHandlers = {  
        '#bypassme': function(element, renderer) {  
            return true  
        }  
    };  
    margins = {  
        top: 20,  
        bottom: 30,  
        left: 20,  
        right: 10,  
        width: 60  
    };  
    var y = 20;  
    doc.setLineWidth(2);  
    doc.text(200, y = y + 30, "Weekly Contribution List"); 

    doc.setTextColor(255,0,0);
    doc.text(40, 30, "Ascension Church");
    doc.text(430, 15, ExportDate);
    doc.autoTable({  
        html: '#simple_table',  
        startY: 60,  
         
      
        styles: {  
            minCellHeight: 10  
        }  
    })  

    doc.save('Weekly Contribution List.pdf');  
}  
</script> 

@endsection