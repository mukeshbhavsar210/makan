<div class="rh_login_modal_wrapper rh_login_modal_ultra">
    <div class="rh_login_modal_box ">
        <span class="rh_login_close"><i class="fas fa-times"></i></span>
        <div class="rh_login_sides rh_login_quote_side">
            <div class="rh_bg_layer"></div>
            <div class="rh_wapper_quote_contents">
                <div class="rh_login_quote_box">
                    
                </div>			
            </div>
        </div>
        <div class="rh_login_sides rh_login_form_side">
            <div class="rh_login_blog_name">Housing.com</div>
            <ul class="rh_login_tabs">
                <li class="rh_login_tab rh_login_target rh_active">Login</li>
            </ul>
            <div class="rh_wrapper_login_forms">
                <div class="rh_form_modal rh_login_form rh_login_modal_show">
    
                    <form action="{{ route('account.authenticate') }}" method="post">
                        @csrf
                        <label class="rh_modal_labels" for="username">Email</label>
                        <input type="text" value="{{ old('email') }}" name="email" id="email" class="rh_modal_field focus-class @error('email') is-invalid @enderror" placeholder="example@example.com">
                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
    
                        <div class="rh_wrapper_inline_labels">
                            <label class="rh_modal_labels rh_modal_label_password" for="password">Password</label>
                            <a href="{{ route('account.forgotPassword') }}" class="rh_forget_password_trigger">Forgot Password?</a>
                        </div>
                            
                        <input type="password" name="password" id="password" class="rh_modal_field @error('password') is-invalid @enderror" placeholder="Enter Password">
                        @error('password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                        
                        <div class="justify-content-between d-flex">
                            <button class="btn btn-primary mt-2">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="inspiry_social_login">
            </div>
            <div class="rh_modal_login_loader rh_modal_login_loader_hide rh_modal_login_ultra">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32px"
                    height="32px" viewBox="0 0 128 128" xml:space="preserve">
                    <rect x="0" y="0" width="100%" height="100%" fill="#FFFFFF" />
                    <g>
                        <path
                            d="M75.4 126.63a11.43 11.43 0 0 1-2.1-22.65 40.9 40.9 0 0 0 30.5-30.6 11.4 11.4 0 1 1 22.27 4.87h.02a63.77 63.77 0 0 1-47.8 48.05v-.02a11.38 11.38 0 0 1-2.93.37z"
                            fill="#1ea69a" fill-opacity="1" />
                        <animateTransform attributeName="transform" type="rotate" from="0 64 64" to="360 64 64"
                            dur="1000ms" repeatCount="indefinite"></animateTransform>
                    </g>
                </svg>
            </div>
            <div class="rh_login_modal_messages rh_login_message_show">
                <span class="rh_login_close_message"><i class="fas fa-times"></i></span>
                <p id="forgot-error" class="rh_modal__msg"></p>
                <p id="forgot-message" class="rh_modal__msg"></p>
                <p id="register-message" class="rh_modal__msg"></p>
                <p id="register-error" class="rh_modal__msg"></p>
                <p id="login-message" class="rh_modal__msg"></p>
                <p id="login-error" class="rh_modal__msg"></p>
            </div>
        </div>
    </div>
    </div>