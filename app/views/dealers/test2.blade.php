@extends("layout")
@section("content")
    <script type="text/javascript">
      function countCheckboxes ( ) {
        var form = document.getElementById('testForm');
        var count = 0;
        for(var n=0;n < form.length;n++){
          if(form[n].checked){
            count++;
          }
        }
        document.getElementById('checkCount').innerHTML = count;
      }
      window.onload = countCheckboxes;
    </script>


<table class="table table-striped table-bordered">
    <tr>
        <td><strong>Months</strong></td>
        <td><strong>Rate</strong></td>
        <td><strong>Records</strong></td>
        <td><strong>Assigned</strong></td>
    </tr>
</table>
      <span id="checkCount"></span>

    <form name="testForm" id="testForm">
<input type="checkbox" class="checkBoxClass"
            name="deal_id_33" value="23423"
            id="Checkbox33" onclick="countCheckboxes()"/>
      <input type="checkbox" name="12312" value="b" onclick="countCheckboxes()" /> B<br />
      <input type="checkbox" name="3433" value="c" onclick="countCheckboxes()" /> C<br />
    </form>

@stop
