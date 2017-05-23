@extends('layouts.master-white')
@section('title')
Create
@stop
@section('navbar')
@include('layouts.navbar')
@stop
@section('script-include')
<script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"></script>
@stop
@section('style')
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
@stop
@section('content')
<div class="container-fluid" id="page-body" hidden>
  <div class="col-md-offset-3 col-md-6">
    <div class="panel panel-body panel-shadow" style="padding: 20px;padding-left: 40px;padding-right: 40px;">
      @if (count($errors) > 0)
          <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <ul style='margin-left: 10px;'>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <div class='col-md-12'>
        <ol class="breadcrumb">
            <li><a href="{{ url('faculty') }}">Faculty</a></li>
            <li>Create</li>
        </ol>
      </div>
      <div class="col-md-12">
        {{ Form::open([
          'class' =>'form-horizontal',
          'id'=>'registrationForm',
          'route'=>'faculty.store'
        ]) }}
        <div class="form-group">
          <div class="col-md-12">
          {{ Form::label('username','Identification Number') }}
          {{ Form::text('username',Input::old('username'),[
              'class' => 'form-control',
              'id' => 'username',
              'placeholder' => 'Identification Number'
          ])}}
          <p class="text-muted" style="font-size: 10px;"><span class="text-success">Note:</span>The Identification Number will be used as the username of the said person.</p>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
          {{ Form::label('firstname','Firstname') }}
          {{ Form::text('firstname',Input::old('firstname'),[
              'class' => 'form-control',
              'placeholder' => 'First name'
            ]) }}
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
          {{ Form::label('middlename','Middlename') }}
          {{  Form::text('middlename',Input::old('middlename'),[
                'class' => 'form-control',
                'placeholder' => 'Middle name'
              ])}}
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
          {{ Form::label('lastname','Lastname') }}
           {{ Form::text('lastname',Input::old('lastname'),[
              'class' => 'form-control',
              'placeholder' => 'Last name'
           ]) }}
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
          {{ Form::label('contactnumber','Mobile Number') }}
          {{ Form::text('contactnumber',Input::old('contactnumber'),[
              'class' => 'form-control',
              'placeholder' => 'Mobile Number'
          ]) }}
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
          {{ Form::label('email','Email') }}
          {{ Form::text('email',Input::old('email'),[
              'class' => 'form-control',
              'placeholder' => 'Email'
          ]) }}
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
          {{  Form::submit('Create',[
            'class' => 'btn btn-lg btn-primary btn-block',
            'id'=>'register'
          ]) }}
          </div>
        </div>
        {{ Form::close() }}
      </div>
    </div>
  </div><!-- Row -->
</div><!-- Container -->
@stop
@section('script')
<script>
  $(document).ready(function(){

    $( "#registrationForm" ).validate( {
      rules: {
        firstname: "required",
        lastname: "required",
        contactnumber: {
          required: true,
          minlength: 11,
          maxlength: 11
        },
        email: {
          required: true,
          email: true
        }
      },
      messages: {
        firstname: "Please enter your firstname",
        lastname: "Please enter your lastname",
        contactnumber: {
          required: "Please provide your contact number",
          minlength: "Contact Number must be 11-digit",
          minlength: "Contact Number must be 11-digit"
        },
        email: "Please enter a valid email address"
      },
      errorElement: "em",
      errorPlacement: function ( error, element ) {
        // Add the `help-block` class to the error element
        error.addClass( "help-block" );

        // Add `has-feedback` class to the parent div.form-group
        // in order to add icons to inputs
        element.parents( ".form-group" ).addClass( "has-feedback" );

        if ( element.prop( "type" ) === "checkbox" ) {
          error.insertAfter( element.parent( "label" ) );
        } else {
          error.insertAfter( element );
        }

        // Add the span element, if doesn't exists, and apply the icon classes to it.
        if ( !element.next( "span" )[ 0 ] ) {
          $( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
        }
      },
      success: function ( label, element ) {
        // Add the span element, if doesn't exists, and apply the icon classes to it.
        if ( !$( element ).next( "span" )[ 0 ] ) {
          $( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
        }
      },
      submitHandler: function(form) {
        // do other things for a valid form
        swal({
          title: "Are you sure?",
          text: "Account information will be added to the database.",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, submit it!",
          cancelButtonText: "No, cancel it!",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm) {
            form.submit();
          } else {
            swal("Cancelled", "Registration Cancelled", "error");
          }
        })
      },
      highlight: function ( element, errorClass, validClass ) {
        $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
        $( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
      },
      unhighlight: function ( element, errorClass, validClass ) {
        $( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
        $( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
      }
    } );

    $('#page-body').show();
  });
</script>
@stop
