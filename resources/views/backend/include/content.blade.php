<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
        </div>
      </div>
    </div>
  <section class="content">
      <div class="container-fluid">        
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                  <i class="fas fa-book"></i>
               {{ $data->count() }}
                </h3>
                <p>TODAY MASS</p></a>
              </div>
              <div class="icon">
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  <i class="fas fa-rupee-sign"></i>{{ $week }}
                </h3> 
                <p>Contribution (WEEKLY)</p>
              </div>
              <div class="icon">
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>
                <i class="fas fa-rupee-sign"></i>{{ $month }}</h3>
                <p>Contribution (MONTHLY)</p>
              </div>
              <div class="icon">
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>
                  <i class="fas fa-rupee-sign"></i>{{ $year }}</h3>
                <p>Contribution (ANNUAL)</p>
              </div>
              <div class="icon">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
   <div class="container">
            @yield('content')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

   </div>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.0.0/jspdf.umd.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
  
<style>  
th, td {  
    text - align: center;  
    border: 1 px solid black;  
    border - collapse: collapse;  
}  
h4 {
  margin-right:629px;
}
</style> 


<div class="container">
   <div class="row" >
       <div class="card-body">
        <table id="simple_table" class="table table-bordered table-striped">
          <thead>

           <div class="d-flex justify-content-end mb-4">
        <h4>Today Intention List</h4><input type="button" id="export-pdf-button" class="btn btn-primary" onclick="generate()" value="Export To PDF" disabled>
     </div>  
          <tr>
              {{-- <th class="bg-info">No</th> --}}
              <th class="text-center bg-info">All &nbsp;<input type="checkbox" id="select-all-checkbox"> </th>
              <th class="bg-info">Name</th>
              <th class="bg-info">Intention</th>
              <th class="bg-info">Mass</th>
              <th class="bg-info">Date & Time</th>
              <th class="bg-info">Mobile Number</th>
          </tr>
      </thead>
      <tbody>
  
           @foreach ($data as $key=> $value)
         <?php 
  
  
  
        $date_time = date('d-m-Y h:i A', strtotime($value->DateTime));
  
       ?>   <tr>    
                  <td class="text-center"><input type="checkbox" class="row-checkbox text-center"></td>
                  {{-- <td class="text-center">{{++$key}}</td> --}}
                  <td class="text-left">{{$value->name}}</td>
                  <td class="text-left">{{$value->intention}}</td>
                  <td class="text-left">{{$value->language}}</td>
                  <td class="text-left">{{$date_time}}</td>
                  <td class="text-left">{{$value->mobile}}</td>
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



// function generate(e) {  

//     var doc = new jsPDF('p', 'pt', 'letter');  
//     var htmlstring = '';  
//     var tempVarToCheckPageHeight = 0;  
//     var pageHeight = 0;  
//     var now = moment().format("DD/MM/YYYY hh:mm A");
    
//     pageHeight = doc.internal.pageSize.height;  
//     specialElementHandlers = {  
//         '#bypassme': function(element, renderer) {  
//             return true  
//         }  
//     };  
//     margins = {  
//         top: 20,  
//         bottom: 30,  
//         left: 20,  
//         right: 10,  
//         width: 60  
//     };  
//     var y = 20;  
//     doc.setLineWidth(2);  
//     doc.text(200, y = y + 30, "Massbooking List"); 

//     doc.setTextColor(255,0,0);
//     doc.text(40, 30, "Ascension Church");
//     doc.text(430, 15, now);
//     doc.autoTable({  
//         html: '#simple_table',  
//         startY: 60,  
         
      
//         styles: {  
//             minCellHeight: 10  
//         }  
//     })  
//     doc.save('Todaymass.pdf');  
// }  
function generate() {
            var selectedRows = document.querySelectorAll(".row-checkbox:checked");
            var doc = new jsPDF('p', 'pt', 'letter');
            var pageWidth = doc.internal.pageSize.width;
            var pageHeight = doc.internal.pageSize.height;

            var borderWidth = 2; // Adjust the border width as needed
            var borderColor = [0, 0, 0]; // RGB values for the border color (black)
            var margin = 10;
            var fillColor = [255, 255, 255]; 
            doc.setLineWidth(borderWidth);
            
            doc.setDrawColor(borderColor[0], borderColor[1], borderColor[2]);
            doc.setFillColor(fillColor[0], fillColor[1], fillColor[2]);
            doc.rect(margin, margin, pageWidth - 2 * margin, pageHeight - 2 * margin, 'FD'); // 'FD' for fill and draw

            var ExportDate = moment().format("DD-MM-YYYY hh:mm A");
            var img = new Image();
            img.src = 'http://127.0.0.1:8000/images/bg-01.jpg';
           
            doc.addImage(img, 'JPEG', 175, 25, 40, 40)
            doc.setLineWidth(2);
            doc.setTextColor(142, 1, 6);
            doc.setFontType('bold'); 
            doc.text(220, 55, "Ascension Church - Bangalore");
            doc.setFontType('normal');
            doc.setTextColor(0, 0, 0);
            // doc.setFont('helvetica');
            doc.text( 240, 120, "Massbooking List");
            doc.setFontSize(10);
            doc.text(480, 90, ExportDate);
            var data = [];
            if (selectedRows.length > 0) {
                selectedRows.forEach(function(row) {
                    var columns = row.parentElement.parentElement.querySelectorAll("td");
                    var rowData = {
                        name: columns[1].textContent,
                        intentionfor: columns[2].textContent,
                        intention: columns[3].textContent,
                        language: columns[4].textContent,
                        DateTime: columns[5].textContent,
                        // Status: columns[6].textContent
                    };
                    data.push(rowData);
                });
            } else {
                var rows = document.querySelectorAll("#simple_table tbody tr");
                rows.forEach(function(row) {
                    var columns = row.querySelectorAll("td");
                    var rowData = {
                        // no: columns[1].textContent,
                        name: columns[1].textContent,
                        intentionfor: columns[2].textContent,
                        intention: columns[3].textContent,
                        language: columns[4].textContent,
                        DateTime: columns[5].textContent,
                        // Status: columns[6].textContent
                    };
                    data.push(rowData);
                });
            }

            var startY = 150;
            doc.autoTable({
                head: [['Name', 'Offered for', 'Intention','Language','Date & Time']],
                body: data.map(item => [item.name,  item.intentionfor, item.intention, item.language,item.DateTime]),
                startY: startY,
                styles: {
                minCellHeight: 15, // Minimum cell height
                halign: 'center', // Horizontal alignment
                valign: 'middle', // Vertical alignment
                lineWidth: 0.5, // Border width
                lineColor: [0, 0, 0], // Border color (black)
                fillColor: [244, 246, 249], // Background color for table cells
                textColor: [0, 0, 0], // Text color (black)
                fontStyle: 'normal', // Font style (normal, bold, italic, etc.)
                fontSize: 10, // Font size
                cellPadding: 5, // Padding within cells
            },
            headerStyles: {
                textColor: [255, 255, 255], 
                fillColor: [201, 51, 51], 
                fontStyle: 'bold', // Header font style (bold)
            }
            });

            doc.save('Todaymass.pdf');
        }
        var rowCheckboxes = document.querySelectorAll(".row-checkbox");
        rowCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener("change", function() {
                updateExportButtonState();
            });
        });

        function updateExportButtonState() {
            var selectAllCheckbox = document.getElementById("select-all-checkbox");
            var exportButton = document.getElementById("export-pdf-button");
            var anyCheckboxSelected = false;

            rowCheckboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    anyCheckboxSelected = true;
                    return;
                }
            });

            if (anyCheckboxSelected || selectAllCheckbox.checked) {
                exportButton.disabled = false;
            } else {
                exportButton.disabled = true;
            }
        }

        document.getElementById("select-all-checkbox").addEventListener("change", function() {
            var isChecked = this.checked;
            rowCheckboxes.forEach(function(checkbox) {
                checkbox.checked = isChecked;
            });
            updateExportButtonState();
        });
</script> 
