@extends('backend.layouts.subpage')

@section('content')
@php
    if (!empty($language)) {
       $language = $language[0];
    }else{
        $language ='all';
    }
    if (!empty($time)) {
       $time = $time;
    }else{
        $time ='';
    }
    
    if (!empty($date)) {
       $dates = $date;
    }else{
        $dates = date('Y-m-d', strtotime('+1 day'));
    }
    $date =  date("d-m-Y", strtotime($dates));
    // dd($language);
@endphp

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- In your Blade layout or view -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>

<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">
 <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
   <!-- Include Select2 CSS -->


   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
   
</head>
<body>
  

<style>  

.fas.fa-chevron-up,
.fas.fa-chevron-down {
    color: rgb(62, 66, 62) !important; 
}


th, td {  
    text - align: center;  
    border: 1 px solid black;  
    border - collapse: collapse;  
}  
h5 {
  margin-right:730px;
}


.language-filter {
    display: flex;
    align-items: center;
    gap: 10px;
}

#language {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #fff;
}

#language_submit,
.btn-danger {
    border-radius: 4px;
    padding: 5px 10px;
}
.select2-selection__choice{
    color:black !important;
}

label{
    margin-top: 8px;
}
</style> 

<div class="container">
     <div class="my-2">
          <h2>Mass Booking List</h2>
    </div>
    <br><br><br>
        <div class="container">
            <center>
            @if(request()->is('massbooking') || request()->is('massdatefilters*'))
            <form action="{{Route('newmassdatefilter')}}" method="GET">
                <div class="d-flex">
                <label>Date:</label>
                <div class="input-group date ml-2" style="width: 24%;">
                    <input type="text" id="selectedDate" name="date" class="form-input"  value="{{ $date ?? ''}}"  required>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fas fa-calendar" style="color: black;"></i>
                        </span>
                    </div>
                </div>
                <label class="ml-2">Time:</label>
                <select id="timeDropdown" name="time" class="ml-2 timeDropdown"> 
                    <option value="">Select All</option>
                </select>
                <label class="ml-2">Language:</label>
                <select id="language" name="language[]" class="language ml-2" required style="width: 25%;"  multiple="multiple">
                    {{-- <option value="" selected disabled>Select Language</option> --}}
                    <option value="all">Select All</option>
                    <option value="Tamil">Tamil</option>
                    <option value="English">English</option>
                    <option value="Kannada">Kannada</option>
                </select>
                <button type="submit" id="submit" class="btn btn-success ml-2">Submit</button>
                <a href="{{url('massbooking')}}" class="btn btn-danger ml-2">Reset</a>
                </form>
            @elseif(request()->is('advancemassbooking') || request()->is('massdatefilter*'))
            <form action="{{Route('massdatefilter')}}" method="GET">
                <label>Start Date:</label>
                <input type="text" id="start_date" name="start_date" class="datetimepicker" value="{{ $startDate ?? ''}}" required >
                <label>End Date:</label><input type="text" id="end_date" name="end_date" class="datetimepicker" value="{{$endDate ?? ''}}" required>
                <label>Language:</label>
                <select id="languagess" name="language" required>
                    <option value="all">Select All</option>
                    <option value="Tamil" {{ $language == 'Tamil' ? 'selected' : ''}}>Tamil</option>
                    <option value="English" {{ $language == 'English' ? 'selected' : ''}}>English</option>
                    <option value="Kannada" {{ $language == 'Kannada' ? 'selected' : ''}}>Kannada</option>
                </select>
                <button type="submit" id="submit" class="btn btn-success">Submit</button>
                <a href="{{url('massbooking')}}" class="btn btn-danger">Reset</a>
            </div>
                </form>
            @endif
        </center>         
            </div>
    
    <br/>
    <br/>
   
    
    
    
<div class="card-body">
     <table id="simple_table" class="table table-bordered table-striped ">
         <thead>
            {{-- @if(request()->is('massbooking') || request()->is('massdatefilters*'))
            <div class="d-flex ">
                <a href="/advancemassbooking" class="btn btn-info">Advanced Search</a>
            </div>
            @elseif (request()->is('advancemassbooking') || request()->is('massdatefilter*'))
            <div class="d-flex ">
                <a href="/massbooking" class="btn btn-primary">Quick Search</a>
            </div>
            @endif --}}
            
            <div class="d-flex justify-content-end mb-4">
                 <input type="button" id="export-pdf-button" class="btn btn-primary" onclick="generate()" value="Export To PDF" disabled>
            </div>
           
                <tr>
                  <th class="text-center bg-info">All<input type="checkbox" id="select-all-checkbox"> </th>
                  {{-- <th class="bg-info">No</th> --}}
                  <th class="bg-info">Name</th>
                  <th class="bg-info">Offered For</th>
                  <th class="bg-info">Intention</th>
                  <th class="bg-info">Language</th>
                  <th class="bg-info text-center">Mass Date & Time</th>
                  {{-- <th class="bg-info">Mobile</th> --}}
                  {{-- <th class="bg-info">Amount</th> --}}
                  <th class="bg-info">Status</th>
              </tr>
       </thead>
       <tbody id="searchdata">
        @foreach ($data as $key => $value)
            <?php
            $date = $value->DateTime;
            if ($date != null) {
                $date_time = date('d-m-Y h:i A', strtotime($value->DateTime));
            } else {
                $date_time = "";
            }
            $f_code = $value->f_code;
            $payment_status = '';
            if ($f_code == 'C') {
                $payment_status = 'Cancelled';
            } else if ($f_code == 'F') {
                $payment_status = 'Failed';
            } else {
                $payment_status = 'Success';
            }
            $current_time = strtotime(now());  // Get the current timestamp
            $mass_time = strtotime($value->DateTime);
    
            // Only show rows with future or present mass time
            if ($payment_status == 'Success') {
                ?>
                <tr>
                    <td class="text-center"><input type="checkbox" class="row-checkbox text-center"></td>
                    {{-- <td class="text-center">{{++$key}}</td> --}}
                    <td class="text-left">{{$value->name}}</td>
                    <td class="text-left">{{$value->intentionfor}}</td>
                    <td class="text-left">@if($value->others != null) {{$value->others}} @else {{$value->intention}} @endif</td>
                    <td class="text-center">{{$value->language}}</td>
                    <td class="text-center">{{$date_time}}</td>
                    {{-- <td class="text-left">{{$value->mobile}}</td> --}}
                    {{-- <td class="text-center">{{$value->amt}}</td> --}}
                    <td class="text-center">{{$payment_status}}</td>
                </tr>
                <?php
            }
            ?>
        @endforeach
    </tbody>
    
      </table>
    </div>
</div>

</body>

<script >
 function multipleFunc() {
            document.getElementById("mySelect").multiple = true;
         }
 $(".language").select2();

 $('#language').on("select2:select", function (e) {
        var data = e.params.data.text;
        
        if (data == 'Select All') {
            $("#language").val('all').trigger('change');
        }
    });
    var selectedLanguages = <?= json_encode($language); ?>;
    $('#language').val(selectedLanguages).trigger('change');
    

    $('#selectedDate').datepicker({
            format: 'dd-mm-yyyy', 
            autoclose: true
        });
  
        $('#selectedDate').on('change', function () {
            var selectedDate = $(this).val();
                $.ajax({
                url: '/get-mass-details',
                type: 'GET',
                data: {
                    selectedDate: selectedDate
                },
                success: function (response) {
                    
                    console.log(response.time);
                    const time = response.time;
                    const languages = response.language;
                    // console.log(language);
                    var dropdownlanguage = $('.language');
                    var dropdowntime = $('.timeDropdown');
                    const staticOption =  `<option value="all">Select All</option>`;
                  dropdownlanguage.empty();
                  dropdownlanguage.append(staticOption);
                  dropdownlanguage.val('all').trigger('change');
                  $.each(languages, function (index, value) {
                    dropdownlanguage.append($("<option />").val(value).text(value));
                 });

                 dropdowntime.empty();
                 const staticOptions =  `<option value="">Select All</option>`;
                 dropdowntime.append(staticOptions);
                 $.each(time, function (index, value) {
                    dropdowntime.append($("<option />").val(value).text(value));
                });
                },
                error: function () {
                    
                }
            });
        });
     
         var selectedDate = "{{ $dates }}";
        console.log(selectedDate);
        var gettime ="{{ $time }}";
        var getlang ="{{ $language }}";

        $.ajax({
                url: '/get-mass-details',
                type: 'GET',
                data: {
                    selectedDate: selectedDate
                },
                success: function (response) {
                    const time = response.time;
                    const language = response.language;
                    // console.log(language);
                    var dropdownlanguage = $('.language');
                    var dropdowntime = $('.timeDropdown');
                    const staticOption =  `<option value="all">Select All</option>`;
                  dropdownlanguage.empty();
                  dropdownlanguage.append(staticOption);
                   dropdownlanguage.val(getlang).trigger('change');
                  $.each(language, function (index, value) {
                    dropdownlanguage.append($("<option />").val(value).text(value));
                 });

                 dropdowntime.empty();
                 const staticOptions =  `<option value="">Select All</option>`;
                 dropdowntime.append(staticOptions);
                 $.each(time, function (index, value) {
                    dropdowntime.append($("<option />").val(value).text(value));
                });
                
                 $('#timeDropdown option[value="'+gettime+'"]').attr('selected','selected'); 
                 $('#language option[value="'+getlang+'"]').attr('selected','selected'); 
                },
                error: function () {
                    
                }
            });
    
//  $(document).ready(function() {
    
//     $("#selectedDate").change(function() {
//         const selectedDate = $(this).val();
//         updateDropdown(selectedDate);
//         updatelangDropdown(selectedDate);
//         $('#language').val('all').trigger('change');
//     });

//     function updateDropdown(selectedDate) {
//         const timeDropdown = $("#timeDropdown");

//         const timesByDay = {
//             'Monday': ['06:00 AM', '07:00 AM', '05:30 PM'],
//             'Tuesday': ['06:00 AM', '07:00 AM', '05:30 PM'],
//             'Wednesday': ['06:00 AM', '07:00 AM', '05:30 PM'],
//             'Thursday': ['06:00 AM', '07:00 AM', '05:00 PM','05:45 PM'],
//             'Friday': ['06:00 AM', '07:00 AM', '05:45 PM'],
//             'Saturday': ['06:00 AM', '07:00 AM', '05:30 PM'],
//             'Sunday': ['05:30 AM','06:15 AM','07:00 AM','08:00 AM','09:00 AM,','10:00 AM','11:30 AM','01:30 PM','02:40 PM','03:45 PM','04:30 PM','06:30 PM','07:30 PM','08:30 PM']
//         };

//         // Clear previous options
//         // const staticOption = '<option value="" disabled selected>Select Time</option>';

//         timeDropdown.empty();
//         // timeDropdown.append(staticOption);
//         const selectedDay = new Date(selectedDate).toLocaleDateString('en-US', { weekday: 'long' });
//         if (selectedDay in timesByDay) {
//             const times = timesByDay[selectedDay];
//             for (const time of times) {
//                 timeDropdown.append(`<option value="${time}">${time}</option>`);
//             }
//         }
//     }

//     function updatelangDropdown(selectedDate) {
//         const timeDropdown = $("#language");

//         const timesByDay = {
//             'Monday': ['English'],
//             'Tuesday': ['English','Kannada'],
//             'Wednesday': ['English'],
//             'Thursday': ['English', 'Kannada', 'Tamil'],
//             'Friday': ['English', 'Tamil'],
//             'Saturday': ['English'],
//             'Sunday': ['English', 'Kannada', 'Tamil']
//         };

//         // Clear previous options
//         const staticOption =  `
//             <option value="all">Select All</option>
//         `;

//         timeDropdown.empty();
//         timeDropdown.append(staticOption);
//         const selectedDay = new Date(selectedDate).toLocaleDateString('en-US', { weekday: 'long' });
//         if (selectedDay in timesByDay) {
//             const times = timesByDay[selectedDay];
//             for (const time of times) {
//                 timeDropdown.append(`<option value="${time}">${time}</option>`);
//             }
//         }
//     }
// });



    $('.datetimepicker').datetimepicker({ 
      format: 'DD-MM-YYYY hh:mm:ss A',
      locale: 'en',
      sideBySide: true,
      icons: {
          up: 'fas fa-chevron-up',
          down: 'fas fa-chevron-down',
          previous: 'fas fa-chevron-left',
          next: 'fas fa-chevron-right'
        }
    });

    $("#finddata").click(function(e){
      e.preventDefault();
        var url = "{{Route('search')}}";
        var formID = $(this).parents("form").attr("id");
        finddata(formID, url);
    });

    function finddata(formId, url){ 
      var formData = $("#"+formId+"").serializeArray();
     
        $.ajax({
          type: "GET",
          url: url,
          data: formData,
          success: function(response) {
             console.log(response.success);
             
             }
          });
    }
    $('table').DataTable();


 $(document).ready(function(){

      $("#myBtn").click(function() {
          $('#myModal').appendTo("body").modal('toggle');
      });
      $("#closeModal").click(function() {
          $('#myModal').modal('hide');
      });
      $("#CloseModalBTN").click(function() {
          $('#myModal').modal('hide');
      });

});

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
            doc.text( 240, 120, "Mass Intentions");
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


  
