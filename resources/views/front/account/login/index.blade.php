<div class="rh_login_modal_wrapper rh_login_modal_ultra">
    <div class="rh_login_modal_box ">
        <span class="rh_login_close"><i class="fas fa-times"></i></span>
        <div class="container">
            <div class="row p-4">
                <div class="col-md-4">
                    Housing.com
                </div>
                <div class="col-md-8">                    
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Register Account</button>
                        </li>
                    </ul>
                       
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <form action="{{ route('account.authenticate') }}" method="post">
                                @csrf
                                
                                <div class="form-group">
                                    <label class="rh_modal_labels" for="username">Email</label>
                                    <input type="text" value="{{ old('email') }}" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@example.com">
                                    @error('email')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
            
                                <div class="form-group">
                                    <label class="rh_modal_labels rh_modal_label_password" for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password">
                                    @error('password')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <button class="btn btn-primary">Login</button>
                                <a href="{{ route('account.forgotPassword') }}" class="rh_forget_password_trigger">Forgot Password?</a>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <form action="" name="registrationForm" id="registrationForm">
                                <div class="row p-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="rh_modal_labels" for="name">Name</label>                                    
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="mb-2">Email*</label>
                                            <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Password*</label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password*</label>
                                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Enter Confirm Password">
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                                
                                <button class="btn btn-primary">Register Account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>