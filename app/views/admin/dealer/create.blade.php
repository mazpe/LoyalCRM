@extends("layout")
@section("content")
  {{ Form::open() }}
    {{ $errors->first("name") }}<br />
    {{ Form::label("name", "Name") }}
    {{ Form::text("name") }}
    {{ Form::label("address_1", "Address 1") }}
    {{ Form::text("address_1") }}
    {{ Form::label("address_2", "Address 2") }}
    {{ Form::text("address_2") }}
    {{ Form::label("address_1", "Address 1") }}
    {{ Form::text("address_1") }}
    {{ Form::label("address_1", "Address 1") }}
    {{ Form::text("address_1") }}
    {{ Form::label("address_1", "Address 1") }}
    {{ Form::text("address_1") }}


    {{ Form::submit("Create") }}
  {{ Form::close() }}
@stop
