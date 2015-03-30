<!-- app/views/login.blade.php -->

<!doctype html>
<html>
<head>
{{ HTML::style('css/bootstrap.css') }}
    
    <style type="text/css">
      /* Override some defaults */
      html, body {
        background-color: #eee;
      }
      body {
        padding-top: 40px; 
      }
      .container {
        width: 350px;
      }

      /* The white background content wrapper */
      .container > .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; 
        -webkit-border-radius: 10px 10px 10px 10px;
           -moz-border-radius: 10px 10px 10px 10px;
                border-radius: 10px 10px 10px 10px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }

      .login-form {
        margin-left: 65px;
      }

      legend {
        margin-right: -50px;
        font-weight: bold;
          color: #404040;
      }

      .alert {

         padding: 8px 35px 8px 14px;
         margin-bottom: 18px;
         color: #c09853;
         text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
         /*background-color: #fcf8e3;*/
         border: 1px solid #fbeed5;
         -webkit-border-radius: 4px;
         -moz-border-radius: 4px;
         border-radius: 4px;
        }

       .alert-heading {
          color: inherit;
        }

       .alert .close {
           position: relative;
           top: -2px;
           right: -21px;
           line-height: 18px;
       }

    </style>

    <title>Loyal Driver - CRM</title>
</head>
<body>

    <div class="container">
    <div class="content">
      <div class="row">
        <div class="login-form">
          <h2>Login <small>- Loyal Driver CRM</small></h2>
          

    {{ Form::open(array('url' => 'login')) }}
        <fieldset style="margin-right:60px">

        <!-- if there are login errors, show them here -->
        <p>
            @if( $errors->first('email') )
            <div class="alert">
            {{ $errors->first('email') }}
            </div>
            @endif
            @if( $errors->first('password') )
            <div class="alert">
            {{ $errors->first('password') }}
            </div>
            @endif
        </p>

        <p>
            <div class="form-group">
            {{ Form::label('email', 'Email Address') }}
            {{ Form::text('email', Input::old('email'), array('placeholder' => 'email@loyaldriver.com','class'=>'form-control')) }}
             </div> 
        </p>

        <p>
            <div class="form-group">
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password',array('type'=>'password', 'class'=>'form-control')) }}
            </div>
        </p>

        <p>{{ Form::submit('Submit!',array('class'=>'btn btn-primary')) }}</p>

        </fieldset>
    {{ Form::close() }}

        </div>
      </div>
    </div>
  </div> <!-- /container -->

</body>
</html>
