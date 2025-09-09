<div class="progress-left">
    <div class="card-body">
        <h5>Post your property</h5>

        <a href="{{ route('properties.index') }}" class="btn btn-primary">Go Back</a> 

        <p>Sell or rent your property</p>

        <div class="progress-wrapper">
            <div class="progress" style="height: 20px;">
                <div id="progress-bar" class="progress-bar bg-success" style="width: 0%"></div>
            </div>
        </div>

        <ul class="nav nav-pills step-bar" id="pills-tab" role="tablist">
            <li id="step-1" class="nav-item pending" role="presentation">
                <a class="nav-link active" id="pills-tab_01" data-bs-toggle="pill" data-bs-target="#pills-basic" role="tab" aria-controls="pills-basic" aria-selected="true">
                    <div class="status-details">
                        <div class="tick"></div>
                        <div class="title">
                            <p class="name">Basic Details</p>
                            <span class="status">Completed</span>
                        </div>
                    </div>
                </a>
            </li>
            <li id="step-2" class="nav-item pending" role="presentation">
                <a class="nav-link" id="pills-tab_02" data-bs-toggle="pill" data-bs-target="#pills-properties" role="tab" aria-controls="pills-properties" aria-selected="false">
                    <div class="status-details">
                        <div class="tick"></div>
                        <div class="title">
                            <p class="name">Price Details</p>
                            <span class="status">Completed</span>
                        </div>
                    </div>
                </a>
            </li>
            <li id="step-3" class="nav-item pending" role="presentation">
                <a class="nav-link" id="pills-tab_03" data-bs-toggle="pill" data-bs-target="#pills-price" role="tab" aria-controls="pills-price" aria-selected="false">
                    <div class="status-details">
                        <div class="tick"></div>
                        <div class="title">
                            <p class="name">Properties Details</p>
                            <span class="status">Pending</span>
                        </div>
                    </div> 
                </a>
            </li>
        </ul>                                   
    </div>
</div>