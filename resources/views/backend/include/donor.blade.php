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
h4 {
  margin-right:626px;
}
</style> 

<div class="container">
    <div class="row" >
         <div class="card-body">
             <table id="simple_table" class="table table-bordered table-striped">
                 <thead>
                       <div class="d-flex justify-content-end mb-4">
                           <h4>Donation Payments</h4>
                 <input type="button" id="export-pdf-button" class="btn btn-primary" onclick="generate()" value="Export To PDF" disabled>
                      </div> 
                        <tr>
                            <th class="text-center bg-info">All<input type="checkbox" id="select-all-checkbox"> </th>
                            <!-- <th class="bg-info">No</th> -->
                            <th class="bg-info">Name</th>
                            <th class="bg-info">Email</th>
                            <th class="bg-info">Payment Date</th>
                            <th class="bg-info">Mobile</th>
                            <th class="bg-info">Amount</th>
                            <th class="bg-info">Status</th>
                        </tr>
                </thead>
                <tbody>
                @foreach ($donors as $key=> $value)
                       <?php 
                 $donor_date =  date("d-m-Y h:i A", strtotime($value->date."UTC"));
                      $f_code = $value->f_code;
                 $payment_status = '';
            if ($f_code == 'C') {
                $payment_status = 'Cancelled';
            } else if ($f_code == 'F') {
                $payment_status = 'Failed';
            } else {
                $payment_status = 'Success';
            }
                     ?>   <tr>  
                                <td class="text-center"><input type="checkbox" class="row-checkbox text-center"></td>
                                <!-- <td class="text-center">{{++$key}}</td> -->
                                <td class="text-left">{{$value->name}}</td>
                                <td class="text-left">{{$value->email}}</td>
                                <td class="text-left">{{$value->date}}</td>     
                                <td class="text-left">{{$value->udf3}}</td> 
                                 <td class="text-left">{{$value->amt}}</td>
                                 <td class="text-center">{{$payment_status}}</td>
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
            img.src = '/images/bg-01.jpg';
           
            doc.addImage(img, 'JPEG', 175, 25, 40, 40)
            doc.setLineWidth(2);
            doc.setTextColor(142, 1, 6);
            doc.setFontType('bold'); 
            doc.text(220, 55, "Ascension Church - Bangalore");
            doc.setFontType('normal');
            doc.setTextColor(0, 0, 0);
            // doc.setFont('helvetica');
            doc.text( 240, 120, "Donation Payments");
            doc.setFontSize(10);
            doc.text(480, 90, ExportDate);
            var data = [];
            if (selectedRows.length > 0) {
                selectedRows.forEach(function(row) {
                    var columns = row.parentElement.parentElement.querySelectorAll("td");
                    var rowData = {
                       name: columns[1].textContent,
                        email: columns[2].textContent,
                        date: columns[3].textContent,
                        mobile: columns[4].textContent,
                        amt: columns[5].textContent,
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
                        email: columns[2].textContent,
                        date: columns[3].textContent,
                        mobile: columns[4].textContent,
                        amt: columns[5].textContent,
                        // Status: columns[6].textContent
                    };
                    data.push(rowData);
                });
            }

            var startY = 150;
            doc.autoTable({
                head: [['Name', 'Email',  'Payment Date', 'Mobile','Amount']],
                body: data.map(item => [item.name, item.email, item.date, item.mobile,item.amt]),
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
            headStyles: {
                textColor: [255, 255, 255], 
                fillColor: [201, 51, 51], 
                fontStyle: 'bold', // Header font style (bold)
            }
            });

            doc.save('Massbooking.pdf');
        }

        // Your checkbox and button state update script here
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

@endsection



  
