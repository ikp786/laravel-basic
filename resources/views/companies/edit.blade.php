@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Company') }}</div>
                <div class="card-body">
                    {!! Form::open(['method' => 'POST','route' => ['companies.update',$companies->id],'enctype="multipart/form-data"']) !!}
                    {{Form::token()}}
                    @method('PUT')
                    @csrf

                    <div class="form-group row">
                        {{ Form::label('Company Name', null, ['class' => 'required col-md-4 col-form-label text-md-right']) }}

                        <div class="col-md-6">
                            {{ Form::text('name',$companies->name,['class' => 'form-control']) }}
                            @if($errors->has('name'))
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                       {{ Form::label('Company Email', null, ['class' => 'required col-md-4 col-form-label text-md-right']) }}
                       <div class="col-md-6">
                        {{ Form::email('email',$companies->email,['class' => 'form-control']) }}
                        @if($errors->has('email'))
                        <div class="text-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    {{ Form::label('Company Logo', null, ['class' => 'required col-md-4 col-form-label text-md-right']) }}
                    <div class="col-md-6">                    
                        {{ Form::file('logo',['class' => 'form-control']) }}
                        @if($errors->has('logo'))
                        <div class="text-danger">{{ $errors->first('logo') }}</div>
                        @endif
                    </div>
                </div>

                

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Upate') }}
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
