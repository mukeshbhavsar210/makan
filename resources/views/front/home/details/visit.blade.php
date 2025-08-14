
<div id="property-content-section-schedule-a-tour" class="property-content-section rh_property__sat_wrap margin-bottom-40px">
    <h4 class="rh_property__heading rh_property__sat-heading">Schedule A Tour</h4>
    <div class="rh_property__sat rh-ultra-form">
       <div class="sat_left_side">
          <form action="https://ultra.realhomes.io/wp-admin/admin-ajax.php" method="post" id="schedule-a-tour" novalidate="novalidate">
             <div class="schedule-fields rh-ultra-fields-split">
                <p class="rh_form__item rh-ultra-form-field-wrapper">
                   <label for="sat-date">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar rh-ultra-stroke-dark" viewBox="2 1 20 22">
                         <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                         <path d="M16 2v4M8 2v4M3 10h18"></path>
                      </svg>
                   </label>
                   <input type="text" name="sat-date" id="sat-date" class="required rh-ultra-field hasDatepicker" placeholder="Select Date" title="Select a suitable date." autocomplete="off" required="">
                </p>
                <p class="rh_form__item rh-sat-select-field rh-ultra-form-field-wrapper">
                   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="rh-ultra-stroke-dark feather feather-clock">
                      <circle cx="12" cy="12" r="10"></circle>
                      <polyline points="12 6 12 12 16 14"></polyline>
                   </svg>
                <div class="dropdown bootstrap-select show-tick sat_times rh-ultra-select-dropdown inspiry_select_picker_trigger bs3" style="width: 100%;">
                   <select name="sat-time" class="sat_times rh-ultra-select-dropdown inspiry_select_picker_trigger show-tick" tabindex="-98">
                      <option value="10:00 am">10:00 am</option>
                      <option value="10:15 pm">10:15 pm</option>
                      <option value="10:30 pm">10:30 pm</option>
                      <option value="12:00 pm">12:00 pm</option>
                      <option value="12:15 pm">12:15 pm</option>
                      <option value="12:30 pm">12:30 pm</option>
                      <option value="12:45 pm">12:45 pm</option>
                      <option value="01:00 pm">01:00 pm</option>
                      <option value="01:15 pm">01:15 pm</option>
                      <option value="01:30 pm">01:30 pm</option>
                      <option value="01:45 pm">01:45 pm</option>
                      <option value="02:00 pm">02:00 pm</option>
                      <option value="05:00 pm">05:00 pm</option>
                   </select>
                   <button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="combobox" aria-owns="bs-select-21" aria-haspopup="listbox" aria-expanded="false" title="10:00 am">
                      <div class="filter-option">
                         <div class="filter-option-inner">
                            <div class="filter-option-inner-inner">10:00 am</div>
                         </div>
                      </div>
                      <span class="bs-caret"><span class="caret"></span></span>
                   </button>
                   <div class="dropdown-menu open">
                      <div class="inner open" role="listbox" id="bs-select-21" tabindex="-1">
                         <ul class="dropdown-menu inner " role="presentation"></ul>
                      </div>
                   </div>
                </div>
                </p>
             </div>
             <div class="rh_sat_field tour-type">
                <div class="middle-fields">
                   <p class="tour-field in-person">
                      <input type="radio" id="sat-in-person" name="sat-tour-type" value="In Person" checked="">
                      <label for="sat-in-person">In Person</label>
                   </p>
                   <p class="tour-field video-chat">
                      <input type="radio" id="sat-video-chat" name="sat-tour-type" value="Video Chat">
                      <label for="sat-video-chat">Video Chat</label>
                   </p>
                </div>
             </div>
             <div class="user-info rh-ultra-fields-split">
                <p class="rh_form__item rh-ultra-form-field-wrapper">
                   <label for="sat-user-name">
                      <svg class="rh-ultra-dark" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                         <path d="M0 0h24v24H0V0z" fill="none"></path>
                         <path d="M12 4c-4.41 0-8 3.59-8 8 0 1.82.62 3.49 1.64 4.83 1.43-1.74 4.9-2.33 6.36-2.33s4.93.59 6.36 2.33C19.38 15.49 20 13.82 20 12c0-4.41-3.59-8-8-8zm0 9c-1.94 0-3.5-1.56-3.5-3.5S10.06 6 12 6s3.5 1.56 3.5 3.5S13.94 13 12 13z" opacity=".3"></path>
                         <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.51.88 4.93 1.78C15.57 19.36 13.86 20 12 20s-3.57-.64-4.93-1.72zm11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33C4.62 15.49 4 13.82 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.49-1.64 4.83zM12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z"></path>
                      </svg>
                   </label>
                   <input id="sat-user-name" type="text" name="sat-user-name" class="required rh-ultra-field" placeholder="Your Name" title="Provide your name" required="">
                </p>
                <p class="rh_form__item rh-ultra-form-field-wrapper">
                   <label for="sat-user-phone">
                      <svg class="rh-ultra-dark" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                         <path d="M0 0h24v24H0V0z" fill="none"></path>
                         <path d="M19 17.47c-.88-.07-1.75-.22-2.6-.45l-1.19 1.19c1.2.41 2.48.67 3.8.75v-1.49zM6.54 5h-1.5c.09 1.32.35 2.59.75 3.8l1.2-1.2c-.24-.84-.39-1.71-.45-2.6z" opacity=".3"></path>
                         <path d="M20 21c.55 0 1-.45 1-1v-3.49c0-.55-.45-1-1-1-1.24 0-2.45-.2-3.57-.57-.1-.04-.21-.05-.31-.05-.26 0-.51.1-.71.29l-2.2 2.2c-2.83-1.45-5.15-3.76-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17zm-3.6-3.98c.85.24 1.72.39 2.6.45v1.49c-1.32-.09-2.59-.35-3.8-.75l1.2-1.19zM5.03 5h1.5c.07.89.22 1.76.46 2.59l-1.2 1.2c-.41-1.2-.67-2.47-.76-3.79z"></path>
                      </svg>
                   </label>
                   <input id="sat-user-phone" type="text" name="sat-user-phone" class="rh-ultra-field" placeholder="Your Phone">
                </p>
             </div>
             <div class="user-info-full">
                <p class="rh_form__item rh-ultra-form-field-wrapper">
                   <label for="sat-user-email">
                      <svg class="rh-ultra-dark" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                         <path d="M0 0h24v24H0V0z" fill="none"></path>
                         <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"></path>
                         <path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"></path>
                      </svg>
                   </label>
                   <input id="sat-user-email" type="text" name="sat-user-email" class="required rh-ultra-field" placeholder="Your Email" title="Provide your email ID" required="">
                </p>
                <p class="rh_form__item rh-ultra-form-field-wrapper rh-ultra-form-textarea">
                   <label for="sat-user-message">
                      <svg class="rh-ultra-dark" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                         <path d="M0 0h24v24H0V0z" fill="none"></path>
                         <path d="M4 18l2-2h14V4H4z" opacity=".3"></path>
                         <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"></path>
                      </svg>
                   </label>
                   <textarea id="sat-user-message" class="rh-ultra-field" cols="40" rows="6" name="sat-user-message" placeholder="Message"></textarea>
                </p>
             </div>
             <div class="submit-wrap">
                <input type="hidden" name="action" value="schedule_a_tour">
                <input type="hidden" name="property-id" value="45">
                <input type="hidden" name="sat-nonce" value="0bc5c2e4d4">
                <input type="submit" id="schedule-submit" class="submit-button rh-btn rh-btn-primary rh_widget_form__submit" value="Schedule">
                <span id="sat-loader" class="ajax-loader">
                   <!-- By Sam Herbert (@sherb), for everyone. More @ http://goo.gl/7AJzbL -->
                   <!-- Todo: add easing -->
                   <svg viewBox="0 0 57 57" xmlns="http://www.w3.org/2000/svg" width="57" height="57" class="rh-ultra-stroke-dark">
                      <g fill="none" fill-rule="evenodd">
                         <g transform="translate(1 1)" stroke-width="2">
                            <circle class="rh-ultra-light" cx="5" cy="50" r="5">
                               <animate attributeName="cy" begin="0s" dur="2.2s" values="50;5;50;50" calcMode="linear" repeatCount="indefinite"></animate>
                               <animate attributeName="cx" begin="0s" dur="2.2s" values="5;27;49;5" calcMode="linear" repeatCount="indefinite"></animate>
                            </circle>
                            <circle class="rh-ultra-light" cx="27" cy="5" r="5">
                               <animate attributeName="cy" begin="0s" dur="2.2s" from="5" to="5" values="5;50;50;5" calcMode="linear" repeatCount="indefinite"></animate>
                               <animate attributeName="cx" begin="0s" dur="2.2s" from="27" to="27" values="27;49;5;27" calcMode="linear" repeatCount="indefinite"></animate>
                            </circle>
                            <circle class="rh-ultra-light" cx="49" cy="50" r="5">
                               <animate attributeName="cy" begin="0s" dur="2.2s" values="50;50;5;50" calcMode="linear" repeatCount="indefinite"></animate>
                               <animate attributeName="cx" from="49" to="49" begin="0s" dur="2.2s" values="49;5;27;49" calcMode="linear" repeatCount="indefinite"></animate>
                            </circle>
                         </g>
                      </g>
                   </svg>
                </span>
             </div>
             <div id="error-container" class="error-container"></div>
             <div id="message-container" class="message-container"></div>
          </form>
       </div>
       <!-- End of the left side -->
       <div class="sat_right_side property-info">
          <div class="sat_property-thumbnail">
             <img width="818" height="417" src="https://ultra-realhomes.b-cdn.net/wp-content/uploads/2022/06/architecture-home-merrick-way-818x417.jpg" class="attachment-property-detail-video-image size-property-detail-video-image wp-post-image" alt="" decoding="async">                
          </div>
          <div class="additional-info">
             <h5><strong>Discover your dream property</strong></h5>
             <p>Immerse yourself in the captivating ambiance of our properties. <strong>Book a personalized tour</strong> to explore the exquisite beauty and unique features of our property. </p>
             <p>Our knowledgeable staff will guide you through the property, answering any questions you may have.</p>
          </div>
       </div>
       <!-- End of the right side -->
    </div>
    <!-- End of .rh_property__sat -->
 </div>