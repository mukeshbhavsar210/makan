<div class="card account-nav border-0 shadow mb-4 mb-lg-0">
    <div class="card-body p-0">
        <ul class="list-group list-group-flush ">
            <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                <a href="{{ route('account.createProperty') }}">Add Property</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                <a href="{{ route('account.property') }}">My Properties</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                <a href="{{ route('account.savedProperties') }}">Saved Property</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                <a href="{{ route('account.myPropertyApplications') }}">Interested</a>
            </li>
            <li class="list-group-item d-flex justify-content-between p-2">
                <a href="{{ route('account.profile') }}">Profile</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                <a href="{{ route('account.logout') }}">Logout</a>
            </li>            
        </ul>
    </div>
</div>

<div class="card border-0 shadow mb-4 p-2">
    <div class="text-center mt-3">

        @if (Auth::user()->image != '')
            <img src="{{ asset('profile_pic/thumb/'.Auth::user()->image) }}" alt="avatar"  class="rounded-circle img-fluid" style="width: 70px;">
        @else
            <img src="{{ asset('assets/images/avatar7.png') }}" alt="avatar"  class="rounded-circle img-fluid" style="width: 70px;">
        @endif

        <h5 class="mt-3 pb-0">{{ Auth::user()->name }}</h5>
        <p class="text-muted mb-1 fs-6">{{ Auth::user()->designation }}</p>
        <div class="d-flex justify-content-center mb-2">
            <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-primary">Change</button>
        </div>
    </div>
</div>
