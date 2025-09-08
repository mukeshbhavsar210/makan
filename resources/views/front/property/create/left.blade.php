<div class="progress-left">
    <div class="card-body">
        <a href="{{ route('properties.index') }}" class="link">Go Back</a> 

        <h5>Post your property</h5>
        <p>Sell or rent your property</p>

        <div>Progress Bar</div>

        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-tab_01" data-bs-toggle="pill" data-bs-target="#pills-basic" role="tab" aria-controls="pills-basic" aria-selected="true">
                    <div class="status-details">
                        <p class="tick"></p>
                        <p class="title">Basic Details<br />
                            <span class="status">Completed</span>
                        </p>
                    </div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-tab_02" data-bs-toggle="pill" data-bs-target="#pills-properties" role="tab" aria-controls="pills-properties" aria-selected="false">
                    <div class="status-details">
                        <p class="tick"></p>
                        <p class="title">Properties Details<br />
                            <span class="status">Completed</span>
                        </p>
                    </div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-tab_03" data-bs-toggle="pill" data-bs-target="#pills-price" role="tab" aria-controls="pills-price" aria-selected="false">
                    <div class="status-details">
                        <p class="tick"></p>
                        <p class="title">Price Details<br />
                            <span class="status">Completed</span>
                            <span class="status">Pending</span>
                        </p>
                    </div> 
                </a>
            </li>
        </ul>                                   
    </div>
</div>