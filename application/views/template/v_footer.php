<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
   <strong>Copyright &copy; 2019 <b>TRASPAC</b>.</strong> All rights reserved.
  </footer>

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo config_item('assets_bower');?>jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo config_item('assets_bower');?>jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo config_item('assets_bower');?>bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo config_item('assets_bower');?>raphael/raphael.min.js"></script>
<script src="<?php echo config_item('assets_bower');?>morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo config_item('assets_bower');?>jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo config_item('assets_plugins');?>jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo config_item('assets_plugins');?>jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo config_item('assets_bower');?>jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo config_item('assets_bower');?>moment/min/moment.min.js"></script>
<script src="<?php echo config_item('assets_bower');?>bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo config_item('assets_bower');?>bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo config_item('assets_plugins');?>bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo config_item('assets_bower');?>jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo config_item('assets_bower');?>fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo config_item('assets_dist');?>js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo config_item('assets_dist');?>js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo config_item('assets_dist');?>js/demo.js"></script>

<!-- DataTables -->
<script src="<?php echo config_item('assets_bower');?>datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo config_item('assets_bower');?>datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
</body>
</html>


<script>
	function calcBusinessDays(dDate1, dDate2) { // input given as Date objects
  var iWeeks, iDateDiff, iAdjust = 0;
  if (dDate2 < dDate1) return -1; // error code if dates transposed
  var iWeekday1 = dDate1.getDay(); // day of week
  var iWeekday2 = dDate2.getDay();
  iWeekday1 = (iWeekday1 == 0) ? 7 : iWeekday1; // change Sunday from 0 to 7
  iWeekday2 = (iWeekday2 == 0) ? 7 : iWeekday2;
  if ((iWeekday1 > 5) && (iWeekday2 > 5)) iAdjust = 1; // adjustment if both days on weekend
  iWeekday1 = (iWeekday1 > 5) ? 5 : iWeekday1; // only count weekdays
  iWeekday2 = (iWeekday2 > 5) ? 5 : iWeekday2;

  // calculate differnece in weeks (1000mS * 60sec * 60min * 24hrs * 7 days = 604800000)
  iWeeks = Math.floor((dDate2.getTime() - dDate1.getTime()) / 604800000)

  if (iWeekday1 < iWeekday2) { //Equal to makes it reduce 5 days
    iDateDiff = (iWeeks * 5) + (iWeekday2 - iWeekday1)
  } else {
    iDateDiff = ((iWeeks + 1) * 5) - (iWeekday1 - iWeekday2)
  }

  iDateDiff -= iAdjust // take into account both days on weekend

  return (iDateDiff + 1); // add 1 because dates are inclusive
}


// $("#dari, #sampai").change(function() {

//   var d1 = $("#dari").val();
//   var d2 = $("#sampai").val();

//   var minutes = 1000 * 60;
//   var hours = minutes * 60;
//   var day = hours * 24;

//   var startdate1 = new Date(d1);
//   var enddate1 = new Date(d2);


//   var newstartdate = new Date();
//   newstartdate.setFullYear(startdate1.getYear(), startdate1.getMonth(), startdate1.getDay());
//   var newenddate = new Date();
//   newenddate.setFullYear(enddate1.getYear(), enddate1.getMonth(), enddate1.getDay());
//   var days = calcBusinessDays(newstartdate, newenddate);
//   if (days > 0) {
//     $("#lama").val(days);
//   } else {
//     $("#lama").val(0);
//   }
// });
    $(document).ready(function() {
      var id;
      $("#daftar-atasan tr").click(function(){
       $(this).addClass('selected').siblings().removeClass('selected'); 
       id = $(this).attr('id');
      });

      $('#ok').on('click', function(e){
        if(id){
                jQuery.ajax({
                  url: "<?php echo site_url('cuti/get_data_atasan')?>/"+id,
                  type: "POST",
                  success:function(data){
                    $('#show').html(data);
                    $('#modal').modal('hide');
                  }
                });
        }else{
          alert("Harap pilih atasan terlebih dahulu!");
        }
      });

    });
</script>

<!-- <script>
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
      console.log(settings.nTable.id);
      if ( settings.nTable.id !== 'verif' ) {
        return true;
      }
        var min = $('#min').datepicker("getDate");
        var max = $('#max').datepicker("getDate");
        var startDate = new Date(data[8]);
        if (min == null && max == null) { return true; }
        if (min == null && startDate <= max) { return true;}
        if(max == null && startDate >= min) {return true;}
        if (startDate <= max && startDate >= min) { return true; }
        return false;
    }
);
 
/* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
      console.log(settings.nTable.id);
      if ( settings.nTable.id !== 'cuti' ) {
        return true;
      }
        var min1 = $('#min1').datepicker("getDate");
        var max1 = $('#max1').datepicker("getDate");
        var startDate1 = new Date(data[6]);
 
        if (min1 == null && max1 == null) { return true; }
        if (min1 == null && startDate1 <= max1) { return true;}
        if(max1 == null && startDate1 >= min1) {return true;}
        if (startDate1 <= max1 && startDate1 >= min1) { return true; }
        return false;
    }
);

$(document).ready( function () {
  var verif = $('#verif').DataTable( {
             "sScrollX": "100%",
             "columnDefs": [ {
                  "searchable": false,
                  "orderable": false,
                  "targets": 0
              } ],
              "columnDefs": [ {
                  "visible": false,
                  "targets": 8
              } ],
              "order": []
            });
          verif.on( 'order.dt search.dt', function () {
              verif.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                  cell.innerHTML = i+1;
              } );
          } ).draw();
  var cuti = $('#cuti').DataTable( {
             "sScrollX": "100%",
             "columnDefs": [ {
                  "searchable": false,
                  "orderable": false,
                  "targets": 0
              } ],
              "order": []
            });
            cuti.on( 'order.dt search.dt', function () {
              cuti.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                  cell.innerHTML = i+1;
              } );
          } ).draw();
            $("#min").datepicker({ onSelect: function () { verif.draw(); }, changeMonth: true, changeYear: true });
            $("#max").datepicker({ onSelect: function () { verif.draw(); }, changeMonth: true, changeYear: true });
            
            // $("#min1").datepicker({ onSelect: function () { cuti.draw(); }, changeMonth: true, changeYear: true });
            // $("#max1").datepicker({ onSelect: function () { cuti.draw(); }, changeMonth: true, changeYear: true });

            $('#min, #max').change(function () {
                verif.draw();
            });

            $('#jenis_cuti').on( 'change', function () {
                    verif
                        .column(6)
                        .search( this.value )
                        .draw();
            } );
            $('#status_cuti').on( 'change', function () {
                    verif
                        .column(7)
                        .search( this.value ? '^'+this.value+'$' : '', true, false )
                        .draw();
            } );
  } );
</script> -->
<!-- <script>
  /* Custom filtering function which will search data in column four between two values */
// $.fn.dataTable.ext.search.push(
//     function( settings, data, dataIndex ) {
//       console.log(settings.nTable.id);
//       if ( settings.nTable.id !== 'cuti' ) {
//         return true;
//       }
//         var min = parseInt( $('#min').val(), 10 );
//         var max = parseInt( $('#max').val(), 10 );
//         var startDate = new Date(data[8]); // use data for the age column
 
//         if ( ( min == null && max == null ) ||
//              ( min == null && startDate <= max ) ||
//              ( max == null && startDate >= min ) ||
//              ( startDate1 <= max1 && startDate1 >= min1 ) )
//         {
//             return true;
//         }
//         return false;
//     }
// );
 
// /* Custom filtering function which will search data in column four between two values */
// $.fn.dataTable.ext.search.push(
//     function( settings, data, dataIndex ) {
//       console.log(settings.nTable.id);
//       if ( settings.nTable.id !== 'verif' ) {
//         return true;
//       }
//         var min2 = parseInt( $('#min2').val(), 10 );
//         var max2 = parseInt( $('#max2').val(), 10 );
//         var startDate2 = new Date(data[8]); // use data for the age column
 
//         if ( ( min2 == null && max2 == null ) ||
//              ( min2 == null && startDate2 <= max2 ) ||
//              ( max2 == null && startDate2 >= min2 ) ||
//              ( startDate2 <= max1 && startDate2 >= min2 ) )
//         {
//             return true;
//         }
//         return false;
//     }
// );
 

// $(document).ready( function () {
//   // var cuti = $('#cuti').DataTable( {
//   //            "sScrollX": "100%",
//   //            "columnDefs": [ {
//   //                 "searchable": false,
//   //                 "orderable": false,
//   //                 "targets": 0
//   //             } ],
//   //             "order": []
//   //           });
//   //         //   cuti.on( 'order.dt search.dt', function () {
//   //         //     cuti.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
//   //         //         cell.innerHTML = i+1;
//   //         //     } );
//   //         // } ).draw();

//   // var verif = $('#verif').DataTable( {
//   //            "sScrollX": "100%",
//   //            "columnDefs": [ {
//   //                 "searchable": false,
//   //                 "orderable": false,
//   //                 "targets": 0
//   //             } ],
//   //             "columnDefs": [ {
//   //                 "visible": false,
//   //                 "targets": 8
//   //             } ],
//   //             "order": []
//   //           });
//   //         // verif.on( 'order.dt search.dt', function () {
//   //         //     verif.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
//   //         //         cell.innerHTML = i+1;
//   //         //     } );
//   //         // } ).draw();
  
//     // Event listener to the two range filtering inputs to redraw on input
//     // $('#min, #max').keyup( function() {
//     //     table.draw();
//     //     table2.draw();
//     // } );

  
//     // // Event listener to the two range filtering inputs to redraw on input
//     // $('#min2, #max2').keyup( function() {
//     //     table.draw();
//     //     table2.draw();
//     // } );

//      var table = $('#cuti').DataTable({
//       });
//      var table2 = $('#verif').DataTable({
//       });

//      $('#min2, #max2').keyup( function() {
//         table.draw();
//         table2.draw();
//     } );
// } );

</script> -->

<script>
  /* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
      console.log(settings.nTable.id);
      if ( settings.nTable.id !== 'verif' ) {
        return true;
      }
        var min = $('#min').datepicker("getDate");
        var max = $('#max').datepicker("getDate");
        var startDate = new Date(data[8]); // use data for the age column
 
        if (( min == null && max == null ) ||
             ( min == null && startDate <= max ) ||
             ( max == null && startDate >= min ) ||
             ( startDate <= max && startDate >= min ) )
        {
            return true;
        }
        return false;
    }
);
 
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
      console.log(settings.nTable.id);
      if ( settings.nTable.id !== 'cuti' ) {
        return true;
      }
        var min = $('#min2').datepicker("getDate");
        var max = $('#max2').datepicker("getDate");
        var startDate2 = new Date(data[6]); // use data for the age column
 
        if (( min == null && max == null ) ||
             ( min == null && startDate2 <= max ) ||
             ( max == null && startDate2 >= min ) ||
             ( startDate2 <= max && startDate2 >= min ) )
        {
            return true;
        }
        return false;
    }
);
 
 

$(document).ready( function () {
  var cuti = $('#cuti').DataTable( {
             "sScrollX": "100%",
             "columnDefs": [ {
                  "searchable": false,
                  "orderable": false,
                  "targets": 0
              } ],
              "order": []
            });
            cuti.on( 'order.dt search.dt', function () {
              cuti.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                  cell.innerHTML = i+1;
              } );
          } ).draw();

  var verif = $('#verif').DataTable( {
             "sScrollX": "100%",
             "columnDefs": [ {
                  "searchable": false,
                  "orderable": false,
                  "targets": 0
              } ],
              "columnDefs": [ {
                  "visible": false,
                  "targets": 8
              } ],
              "order": []
            });
            verif.on( 'order.dt search.dt', function () {
              verif.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                  cell.innerHTML = i+1;
              } );
          } ).draw();
  
    // Event listener to the two range filtering inputs to redraw on input
    $("#min").datepicker({ onSelect: function () { verif.draw(); }, changeMonth: true, changeYear: true });
    $("#max").datepicker({ onSelect: function () { verif.draw(); }, changeMonth: true, changeYear: true });
    $("#min2").datepicker({ onSelect: function () { cuti.draw(); }, changeMonth: true, changeYear: true });
    $("#max2").datepicker({ onSelect: function () { cuti.draw(); }, changeMonth: true, changeYear: true });        



    $('#min, #max').change(function () {
                verif.draw();
                cuti.draw();
            });
    $('#min2, #max2').change(function () {
                verif.draw();
                cuti.draw();
            });
  
  
    // Event listener to the two range filtering inputs to redraw on input
            $('#jenis_cuti').on( 'change', function () {
                    verif
                        .column(6)
                        .search( this.value )
                        .draw();
            } );
            $('#status_cuti').on( 'change', function () {
                    verif
                        .column(7)
                        .search( this.value )
                        .draw();
            } );
            $('#jenis_cuti2').on( 'change', function () {
                    cuti
                        .column(1)
                        .search( this.value )
                        .draw();
            } );
            $('#status_cuti2').on( 'change', function () {
                    cuti
                        .column(4)
                        .search( this.value )
                        .draw();
            } );

} );

</script>