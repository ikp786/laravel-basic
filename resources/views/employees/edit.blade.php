@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Employe') }}</div>
                <div class="card-body">
                    {!! Form::open(['method' => 'POST','route' => ['employees.update',$employees->id],'enctype="multipart/form-data"']) !!}
                    {{Form::token()}}
                    @method('PUT')
                    @csrf

                    {{ Form::hidden('employee_id',$employees->id) }}

                    <div class="form-group row">
                        {{ Form::label('First Name', null, ['class' => 'required col-md-4 col-form-label text-md-right']) }}

                        <div class="col-md-6">
                            {{ Form::text('first_name',$employees->first_name,['class' => 'form-control']) }}                          
                            @if($errors->has('first_name'))
                            <div class="text-danger">{{ $errors->first('first_name') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('Last Name', null, ['class' => 'required col-md-4 col-form-label text-md-right']) }}

                        <div class="col-md-6">
                            {{ Form::text('last_name',$employees->last_name,['class' => 'form-control']) }}                          
                            @if($errors->has('last_name'))
                            <div class="text-danger">{{ $errors->first('last_name') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                     {{ Form::label('Email', null, ['class' => 'required col-md-4 col-form-label text-md-right']) }}
                     <div class="col-md-6">
                        {{ Form::email('email',$employees->email,['class' => 'form-control']) }}
                        @if($errors->has('email'))
                        <div class="text-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                 {{ Form::label('Mobile', null, ['class' => 'required col-md-4 col-form-label text-md-right']) }}
                 <div class="col-md-6">
                    {{ Form::text('mobile',$employees->mobile,['class' => 'form-control']) }}
                    @if($errors->has('mobile'))
                    <div class="text-danger">{{ $errors->first('mobile') }}</div>
                    @endif
                </div>
            </div>

            <div class="form-group row">


                {{ Form::label('Company', null, ['class' => 'required col-md-4 col-form-label text-md-right']) }}

                <div class="col-md-6">                    
                    {{ Form::select('company_id', $companies, $employees->company_id, ['class' => 'form-control']) }}
                    @if($errors->has('company_id'))
                    <div class="text-danger">{{ $errors->first('company_id') }}</div>
                    @endif
                </div>
            </div>



            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
@endsection
