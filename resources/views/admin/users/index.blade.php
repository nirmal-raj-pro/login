@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                
                <!-- will be used to show any messages -->
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif


            <div class="card">
                <div class="card-header">{{ __('User Dashboard ') }} 
                    <a class="float-right btn btn-primary" href="{{ route('users.create') }}" title="New User"> <i class="fas fa-plus-circle fa-lg "></i></a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-responsive-lg">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>User Role</th>
                            <th width="280px">Actions</th>
                        </tr>
                            @forelse($users as $user )
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td> 
                            <td><form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                    @method('DELETE')
                                        
                                        <a href="{{ route('users.show', $user->id) }}" title="show">
                                            <i class="fas fa-eye text-success fa-lg"></i>
                                        </a>

                                        <a href="{{ route('users.edit', $user->id) }}" title="edit">
                                            <i class="fas fa-edit fa-lg"></i>
                                        </a>

                                        <button type="submit" title="delete" style="border: none; background-color:transparent;" title="delete">
                                            <i class="fas fa-trash fa-lg text-danger"></i>
                                        </button>
                                    </form>
                                </td>
                        </tr>
                            @empty
                        <tr>  
                            <td colspan="8">No Records Found.</td>
                        </tr>
                            @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <!-- {!! $users->links() !!} -->

@endsection


