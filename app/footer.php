<!-- footer -->
<footer class="footer text-center">
    All Rights Reserved. Developed by <a target = "_blank" href="#">Sakib and Kawsar</a>
</footer>
</div>
</div>
<!-- All Jquery -->
<script src="assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<script src="dist/js/pages/dashboards/dashboard1.js"></script> 
<!-- Charts js Files -->
<script src="assets/libs/flot/excanvas.js"></script>
<script src="assets/libs/flot/jquery.flot.js"></script>
<script src="assets/libs/flot/jquery.flot.pie.js"></script>
<script src="assets/libs/flot/jquery.flot.time.js"></script>
<script src="assets/libs/flot/jquery.flot.stack.js"></script>
<script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
<script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script src="dist/js/pages/chart/chart-page-init.js"></script>
<script src="assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="dist/js/pages/mask/mask.init.js"></script>
<script src="assets/libs/select2/dist/js/select2.full.min.js"></script>
<script src="assets/libs/select2/dist/js/select2.min.js"></script>
<script src="assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
<script src="assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
<script src="assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
<script src="assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
<script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="assets/libs/quill/dist/quill.min.js"></script>
<script>
    $(".select2").select2({
        //minimumInputLength: 2
    });

    /*colorpicker*/
    $('.demo').each(function () {

        $(this).minicolors({
            control: $(this).attr('data-control') || 'hue',
            position: $(this).attr('data-position') || 'bottom left',

            change: function (value, opacity) {
                if (!value)
                    return;
                if (opacity)
                    value += ', ' + opacity;
                if (typeof console === 'object') {
                    console.log(value);
                }
            },
            theme: 'bootstrap'
        });

    });
    /*datwpicker*/
    jQuery('.mydatepicker').datepicker();
	
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
	jQuery('#datepicker-autoclose1').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#datepicker-autoclose2').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#datepicker-autoclose3').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#datepicker-autoclose4').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    
    var quill = new Quill('#editor', {
        theme: 'snow'
    });

</script>
<!-- CK Editor -->
<script src="assets/ckeditor/ckeditor.js"></script>
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    $(function () {
        CKEDITOR.replace('editor2')
        $('.textarea').wysihtml5()
    })
    $(function () {
        CKEDITOR.replace('editor3')
        $('.textarea').wysihtml5()
    })
    $(function () {
        CKEDITOR.replace('editor4')
        $('.textarea').wysihtml5()
    })
</script>

<!-- this page js -->
<script src="assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
<script src="assets/extra-libs/multicheck/jquery.multicheck.js"></script>
<script src="assets/extra-libs/DataTables/datatables.min.js"></script>

<script src="assets/extra-libs/buttondt/buttons.flash.min.js"></script>
<script src="assets/extra-libs/buttondt/buttons.html5.min.js"></script>
<script src="assets/extra-libs/buttondt/buttons.print.min.js"></script>
<script src="assets/extra-libs/buttondt/dataTables.buttons.min.js"></script>

<script src="assets/extra-libs/buttondt/jszip.min.js"></script>
<script src="assets/extra-libs/buttondt/pdfmake.min.js"></script>
<script src="assets/extra-libs/buttondt/vfs_fonts.js"></script>
<script>
    $('#zero_config').DataTable();
</script>
<script>
    $(document).ready(function () {
        $('#buttonUserLoginHis').DataTable({
            responsive: true,
//            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
//	    dom: 'lfrtiBp',	
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'pdf',
                    title: 'Prime College of Nursing User Login History',
                    filename: 'User_Login_History_pcnd',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    }
                }, {
                    extend: 'excel',
                    title: 'Prime College of Nursing<br>User Login History',
                    filename: 'User_Login_History_pcnd'
                }, {
                    extend: 'copy',
                    filename: 'Prime College of Nursing User Login History</h1>'
                },
                {
                    extend: 'print',
                    title: '<h1>Prime College of Nursing<br>User Login History</h1>',
                    filename: 'User_Login_History_pcnd',
                    exportOptions: {
                        columns: ':visible',
                    },
                    customize: function (win) {
                        $(win.document.body).find('table').addClass('display').css('font-size', '9px');
                        $(win.document.body).find('tr:nth-child(odd) td').each(function (index) {
                            $(this).css('background-color', '#D0D0D0');
                        });
                        $(win.document.body).find('h1').css('text-align', 'center');
                    }
                }
            ]
        });
    });
</script>

<script src="assets/libs/toastr/build/toastr.min.js"></script>
<script>
    $(function () {
        $('#ts-success').on('click', function () {
            toastr.success('Have fun storming the castle!', 'Miracle Max Says');
        });

        $('#ts-info').on('click', function () {
            toastr.info('We do have the Kapua suite available.', 'Turtle Bay Resort');
        });

        $('#ts-warning').on('click', function () {
            toastr.warning('My name is Inigo Montoya. You killed my father, prepare to die!');
        });

        $('#ts-error').on('click', function () {
            toastr.error('I do not think that word means what you think it means.', 'Inconceivable!');
        });
    });
</script>

<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
<script src="assets/libs/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="dist/js/pages/calendar/cal-init.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>