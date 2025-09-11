@extends('front.layouts.app')

@section('main')

<section class="content-header">
    <div class="container">           
        <div class="row">
            <div class="col-md-3 col-12">
                <div class="progress-left">
                    <div class="card-body">
                         <form action="" method="get" >
                            <div class="card-header">
                                <div class="card-title">
                                    <button type="button" onclick="window.location.href='{{ route('users.index') }}'" class="btn btn-default btn-sm">Reset</button>
                                </div>

                                <div class="card-tools">
                                    <div class="input-group input-group" style="width: 250px;">
                                        <input value="{{ Request::get('keyword') }}" type="text" name="keyword" class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-12">
                <div class="progress-right">
                    @include('front.layouts.message')

                    <table class="table table-hover text-nowrap border">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Photo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="border-0">
                            @if ($users->isNotEmpty())
                                @foreach ($users as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>
                                        <div class="profile-pic">
                                            @if ($value->image != '')
                                                <img src="{{ asset('uploads/profile/thumb/'.$value->image) }}" alt="avatar" class="profile-pic" >
                                            @else
                                                <div class="avatar" style="background-color: {{ $value->avatar_color ?? '#777' }};">{{ strtoupper(substr($value->name, 0, 1)) }}</div>
                                            @endif 
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="m-0">{{ $value->name }}</h5>

                                        @php
                                            $roleClass = match($value->role) {
                                                'User' => 'user',
                                                'Agent' => 'agent',
                                                'Builder' => 'builder',
                                                default => 'defaul',
                                            };
                                        @endphp

                                        <p class="role {{ $roleClass }}">{{ $value->role }}<br /></p>
                                    </td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->mobile }}</td>
                                    <td>
                                        <a href="{{ route('users.index.edit', $value->id) }}" class="btn btn-primary small-btn">Edit</a>
                                        <a href="#" onclick="deleteArea({{ $value->id }})" class="btn btn-danger small-btn">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                {{ $users->links() }}
            </div>
            </div>     
        </div> 
    </div>
</section>
@endsection
