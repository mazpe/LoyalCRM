
function last_call1() {
    alert("hello");

    var currentNoteValue = document.getElementsByName('note')[0].value
    var note = document.getElementById("note");
    note.value = currentNoteValue + " Last Call";
}

window.last_call2 = function() {
   alert("hello");
}

//<![CDATA[
window.onload=function(){
    window.last_call = function() {
        alert("hello");
    }

}//]]>

        $(function(){
$('tr .checkboxes:checked').each(function() {
    $(this).closest('tr').addClass('rowhighlight');
});
            $("#ckbCheckAll").click(function () {
                $(".checkBoxClass").prop('checked', $(this).prop('checked'));
            });
            $(".hidetext").click(function () {
                $(".criteria").toggle("slow")
            });
            $(".hide-setcampaign").click(function () {
                $(".setcampaign").toggle("slow")
            });
            $(".hide-show-agent-button").click(function () {
                $(".hide-show-agent").toggle("slow")
            });
            $(".hide-show-stages-button").click(function () {
                $(".hide-show-stages").toggle("slow")
            });


            var pickerOpts = {
            //appendText: "mm/dd/yyyy",
                defaultDate: "0",
                showOtherMonths: true
            };
            var dateTimePickerOpts = {
                timepicker: false,
            }
            $("#last_contact_from").datepicker(pickerOpts);
            $("#last_contact_to").datepicker(pickerOpts);

            $("#next_contact_from").datepicker(pickerOpts);
            $("#next_contact_to").datepicker(pickerOpts);

            $("#lastvisit_from").datepicker(pickerOpts);
            $("#lastvisit_to").datepicker(pickerOpts);

            $("#lastcalled_from").datepicker(pickerOpts);
            $("#lastcalled_to").datepicker(pickerOpts);

            $("#last_contact_date").datetimepicker({
                formatTime: 'g:i A',
            });
            $("#next_contact_date").datetimepicker({
                formatTime: 'g:i A',
            });
            //$("#appointment").datepicker(pickerOpts);
            $("#call_1").datepicker(pickerOpts);
            $("#call_2").datepicker(pickerOpts);
            $("#call_3").datepicker(pickerOpts);
            $("#call_4").datepicker(pickerOpts);
            $("#call_5").datepicker(pickerOpts);
            $("#call_6").datepicker(pickerOpts);
            $("#call_7").datepicker(pickerOpts);
            $("#call_8").datepicker(pickerOpts);


            $('#last_call_cb').click(function() //ll anchor tags
            { 
                $('#last_contact_note').val($('#last_contact_note').val()
                    +' Last Call'); 
            })

            $('#next_to_last').click(function() //ll anchor tags
            {
                $('#last_contact_type_id').val($('#next_contact_type_id').val());
                $('#last_contact_date').val($('#next_contact_date').val());
                $('#last_contact_note').val($('#next_contact_note').val());
            })

            $('#grid').dataTable( {
                "bProcessing": true,
                "bServerSide": true,
                //"sAjaxSource": "deals/gridajax",
                "sAjaxSource": "http://23.239.17.125:8000/deals/gridajax",
                "aaSorting": [[ 3, "desc" ]],
                "aoColumns": [
                    { 'sWidth': '60px' },
                    { 'sWidth': '130px', 'sClass': 'center' },
                    { 'sWidth': '180px', 'sClass': 'center' },
                    { 'sWidth': '60px', 'sClass': 'center' },
                    { 'sWidth': '90px', 'sClass': 'center' },
                    { 'sWidth': '80px', 'sClass': 'center' },
                    { 'sWidth': '80px', 'sClass': 'center' }
                ],
                //"sPaginationType": "bootstrap"
            });

    });

