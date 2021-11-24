@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">{{ __('company List') }}</div>

    <div class="card-body">        
        <a href="{{ route('companies.create') }}" class="btn btn-primary">Add New company</a>       
        
        <br /><br />
        <table class="table table-borderless table-hover">
            <tr class="bg-info text-light">
                <th class="text-center">ID</th>
                <th>Name</th>
                <th>Thumbnail</th>                
                <th>
                    Action
                </th>
            </tr>
            @forelse ($companies as $company)
            <tr>
                <td class="text-center">{{$company->id}}</td>
                <td>{{$company->name}}</td>
                <td><img src="{{asset('storage/logo/'.$company->logo)}}" style="max-height: 50px; max-width: 50px; border-radius: 15px;"></td>                
                <td>                    
                    <a href="{{ route('companies.edit',$company->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    
                    <form action="{{ route('companies.destroy', $company->id) }}" class="d-inline-block" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure to trash this company?')" class="btn btn-sm btn-danger">Delete</i></button>
                    </form>
                    
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="100%" class="text-center text-muted py-3">No Company Found</td>
            </tr>
            @endforelse
        </table>
        @if($companies->total() > $companies->perPage())
        <br><br>
        {{$companies->links()}}
        @endif

    </div>
</div>
@endsection
