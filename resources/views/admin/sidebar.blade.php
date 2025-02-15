<div class="card account-nav border-0 shadow mb-4 mb-lg-0">
    <div class="card-body p-0">
        <ul class="list-group list-group-flush ">
            <li class="list-group-item d-flex justify-content-between p-3">
                <a href="{{ route('admin.areas') }}">Area</a>
            </li>
            <li class="list-group-item d-flex justify-content-between p-3">
                <a href="{{ route('cities.index') }}">City</a>
            </li>
            <li class="list-group-item d-flex justify-content-between p-3">
                <a href="{{ route('users.index') }}">Users</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('property.index') }}">Properties</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('account.myPropertyApplications') }}">Interested</a>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('account.logout') }}">Logout</a>
            </li>
        </ul>
    </div>
</div>
