<!-- app/views/manufactures/index.blade.php -->

<html>
<head>
    <title>Loyal Driver - CRM</title>

    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('//code.jquery.com/ui/1.10.4/themes/black-tie/jquery-ui.css') }}
    {{ HTML::style('js/datetimepicker-master/jquery.datetimepicker.css') }}
    {{ HTML::style('css/dataTables.bootstrap.css') }}

    {{ HTML::script('//code.jquery.com/jquery-1.11.1.min.js') }}
    {{ HTML::script('//code.jquery.com/ui/1.10.4/jquery-ui.min.js') }}
    {{ HTML::script('js/datetimepicker-master/jquery.datetimepicker.js') }}
    {{ HTML::script('js/jquery.dataTables.js') }}     
    {{ HTML::script('js/dataTables.bootstrap.js') }}
    {{ HTML::script('js/portal.js') }}


    <script type="text/javascript">
        $(function(){
        
@if (Request::is('dealers/*/month/*')) 
            $('#selectbox_id').unbind('change').bind('change',function() {
                // TODO: ROUTE or URL to method assitnemnts.dealer
                window.location = '/dealers/{{ $dealer->id }}/month/' + $(this).val();
            });
@endif
    });

    </script>
<body>
    @include("header")
      <div class="container">
        @yield("content")
      </div>
    @include("footer")
  </body>
</html>
