@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Employee List') }}</div>

    <div class="card-body">        
        <a href="{{ route('employees.create') }}" class="btn btn-primary">Add New employee</a>       
        
        <br /><br />
        <table class="table table-borderless table-hover">
            <tr class="bg-info text-light">
                <th class="text-center">ID</th>
                <th>First Name</th>                
                <th>Last Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Company Name</th>
                <th>
                    Action
                </th>
            </tr>
            @forelse ($employees as $employee)
            
            <tr>
                <td class="text-center">{{$employee->id}}</td>
                <td>{{$employee->first_name}}</td>
                <td>{{$employee->last_name}}</td>
                <td>{{$employee->email}}</td>
                <td>{{$employee->mobile}}</td>
                <td>{{isset($employee->companies->name) ? $employee->companies->name : ''}}</td>
                <td>                    
                    <a href="{{ route('employees.edit',$employee->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    
                    <form action="{{ route('employees.destroy', $employee->id) }}" class="d-inline-block" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure to trash this employee?')" class="btn btn-sm btn-danger">Delete</i></button>
                    </form>
                    
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="100%" class="text-center text-muted py-3">No employee Found</td>
            </tr>
            @endforelse
        </table>
        @if($employees->total() > $employees->perPage())
        <br><br>
        {{$employees->links()}}
        @endif

    </div>
</div>
@endsection
