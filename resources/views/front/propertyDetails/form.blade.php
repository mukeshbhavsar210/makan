<div class="rh-ultra-property-sidebar">
    <aside class="rh-property-sidebar rh-sidebar sidebar">
       <section class="widget rh_property_agent  ">
          <div class="rh-agent-thumb-title-wrapper">
             <a class="agent-image" href="">
               <img width="210" height="210" src="https://ultra-realhomes.b-cdn.net/wp-content/uploads/2020/05/Melissa-William-210x210.jpg" class="attachment-agent-image size-agent-image wp-post-image" alt="" decoding="async" srcset="https://ultra-realhomes.b-cdn.net/wp-content/uploads/2020/05/Melissa-William-210x210.jpg 210w, https://ultra-realhomes.b-cdn.net/wp-content/uploads/2020/05/Melissa-William-300x300.jpg 300w, https://ultra-realhomes.b-cdn.net/wp-content/uploads/2020/05/Melissa-William-150x150.jpg 150w, https://ultra-realhomes.b-cdn.net/wp-content/uploads/2020/05/Melissa-William.jpg 534w" sizes="(max-width: 210px) 100vw, 210px">                
            </a>
             
             <div class="rh-agent-title-wrapper">
                <div class="rh-side-title-box">
                   <span class="rh-agent-label">Agent</span>
                   <h3 class="rh_property_agent__title">
                      <a href="">{{ $job->company_name }}</a>
                   </h3>
                </div>
                <a class="rh-property-agent-link" href="">View My Listings</a>
             </div>
          </div>

          <div class="rh-property-agent-info-sidebar">
             <p class="contact office">
                <span>Office</span>
                <a href="tel:{{ $job->developer_landline }}">
                   <svg class="rh-ultra-dark" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                      <path d="M0 0h24v24H0V0z" fill="none"></path>
                      <path d="M19 17.47c-.88-.07-1.75-.22-2.6-.45l-1.19 1.19c1.2.41 2.48.67 3.8.75v-1.49zM6.54 5h-1.5c.09 1.32.35 2.59.75 3.8l1.2-1.2c-.24-.84-.39-1.71-.45-2.6z" opacity=".3"></path>
                      <path d="M20 21c.55 0 1-.45 1-1v-3.49c0-.55-.45-1-1-1-1.24 0-2.45-.2-3.57-.57-.1-.04-.21-.05-.31-.05-.26 0-.51.1-.71.29l-2.2 2.2c-2.83-1.45-5.15-3.76-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17zm-3.6-3.98c.85.24 1.72.39 2.6.45v1.49c-1.32-.09-2.59-.35-3.8-.75l1.2-1.19zM5.03 5h1.5c.07.89.22 1.76.46 2.59l-1.2 1.2c-.41-1.2-.67-2.47-.76-3.79z"></path>
                   </svg>
                   @if(!empty($job->developer_landline))
                     {{ $job->developer_landline }}
                  @endif                       
                </a>
             </p>
             <p class="contact mobile">
                <span>Mobile</span>
                <a href="tel: {{ $job->developer_mobile }}">
                   <svg class="rh-ultra-dark" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                      <path d="M0 0h24v24H0V0z" fill="none"></path>
                      <path d="M19 17.47c-.88-.07-1.75-.22-2.6-.45l-1.19 1.19c1.2.41 2.48.67 3.8.75v-1.49zM6.54 5h-1.5c.09 1.32.35 2.59.75 3.8l1.2-1.2c-.24-.84-.39-1.71-.45-2.6z" opacity=".3"></path>
                      <path d="M20 21c.55 0 1-.45 1-1v-3.49c0-.55-.45-1-1-1-1.24 0-2.45-.2-3.57-.57-.1-.04-.21-.05-.31-.05-.26 0-.51.1-.71.29l-2.2 2.2c-2.83-1.45-5.15-3.76-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17zm-3.6-3.98c.85.24 1.72.39 2.6.45v1.49c-1.32-.09-2.59-.35-3.8-.75l1.2-1.19zM5.03 5h1.5c.07.89.22 1.76.46 2.59l-1.2 1.2c-.41-1.2-.67-2.47-.76-3.79z"></path>
                   </svg>
                   @if(!empty($job->developer_mobile))
                     {{ $job->developer_mobile }}
                  @endif                      
                </a>
             </p>
             <p class="contact whatsapp">
                <span>WhatsApp</span>
                <a href="callto: {{ $job->developer_whatsapp }}">
                   <svg class="rh-ultra-dark" xmlns="http://www.w3.org/2000/svg" width="24" height="24">
                      <g>
                         <path d="M12 19.3c-1.3 0-2.6-.4-3.8-1l-.3-.2-2.8.7.7-2.7-.2-.3c-.7-1.2-1.1-2.5-1.1-3.9 0-4.1 3.3-7.4 7.4-7.4 2 0 3.8.8 5.2 2.2 1.4 1.4 2.3 3.3 2.3 5.2.1 4.1-3.3 7.4-7.4 7.4z" opacity=".3"></path>
                         <g>
                            <path d="M12 4.8c1.9 0 3.7.7 5 2.1 1.4 1.4 2.2 3.2 2.2 5 0 3.9-3.2 7.1-7.2 7.1-1.2 0-2.4-.3-3.4-.9l-.6-.3-.7.2-1.7.4.4-1.5.2-.7-.4-.7c-.6-1.1-.9-2.3-.9-3.6C4.9 8 8.1 4.8 12 4.8M12 3c-4.9 0-8.9 4-8.9 8.9 0 1.6.4 3.1 1.2 4.5L3 21l4.7-1.2c1.3.7 2.8 1.1 4.3 1.1 4.9 0 9-4 9-8.9 0-2.4-1-4.6-2.7-6.3S14.4 3 12 3z"></path>
                         </g>
                         <path d="M16.1 13.8c-.2-.1-1.3-.7-1.5-.7-.3-.1-.4-.1-.6.1-.1.2-.6.7-.7.9-.1.1-.3.2-.5.1-1.3-.7-2.2-1.2-3-2.7-.2-.4.2-.4.7-1.2.1-.1 0-.3 0-.4-.1-.1-.5-1.2-.7-1.7-.2-.4-.4-.4-.5-.4h-.4c-.1 0-.4.1-.6.3-.3.2-.8.7-.8 1.8s.8 2.2.9 2.3c.1.1 1.6 2.4 3.8 3.4 1.4.6 2 .7 2.7.6.4-.1 1.3-.5 1.5-1.1.2-.5.2-1 .1-1.1-.1 0-.2-.1-.4-.2z"></path>
                      </g>
                   </svg>
                   @if(!empty($job->developer_whatsapp))
                     {{ $job->developer_whatsapp }}
                  @endif                                           
                </a>
             </p>
             <p class="contact email">
                <span>Email</span>
                <a href="mailto:robot@inspirythemes.com">
                   <svg class="rh-ultra-dark" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                      <path d="M0 0h24v24H0V0z" fill="none"></path>
                      <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"></path>
                      <path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"></path>
                   </svg>
                   @if(!empty($job->developer_email))
                     <a href="mailto:{{ $job->developer_email }}">{{ $job->developer_email }}</a>
                  @endif                                              
                </a>
             </p>
          </div>
          <div class="rh-property-agent-enquiry-form rh-ultra-form">
             <form id="agent-form-id54" class="rh_widget_form agent-form" method="post" action="https://ultra.realhomes.io/wp-admin/admin-ajax.php" novalidate="novalidate">
                <p class="rh_widget_form__row rh-ultra-form-field-wrapper">
                   <label for="rh-enquiry-name">
                      <svg class="rh-ultra-dark" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                         <path d="M0 0h24v24H0V0z" fill="none"></path>
                         <path d="M12 4c-4.41 0-8 3.59-8 8 0 1.82.62 3.49 1.64 4.83 1.43-1.74 4.9-2.33 6.36-2.33s4.93.59 6.36 2.33C19.38 15.49 20 13.82 20 12c0-4.41-3.59-8-8-8zm0 9c-1.94 0-3.5-1.56-3.5-3.5S10.06 6 12 6s3.5 1.56 3.5 3.5S13.94 13 12 13z" opacity=".3"></path>
                         <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.07 18.28c.43-.9 3.05-1.78 4.93-1.78s4.51.88 4.93 1.78C15.57 19.36 13.86 20 12 20s-3.57-.64-4.93-1.72zm11.29-1.45c-1.43-1.74-4.9-2.33-6.36-2.33s-4.93.59-6.36 2.33C4.62 15.49 4 13.82 4 12c0-4.41 3.59-8 8-8s8 3.59 8 8c0 1.82-.62 3.49-1.64 4.83zM12 6c-1.94 0-3.5 1.56-3.5 3.5S10.06 13 12 13s3.5-1.56 3.5-3.5S13.94 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z"></path>
                      </svg>
                   </label>
                   <input id="rh-enquiry-name" type="text" name="name" placeholder="Name" class="required rh-ultra-field" title="* Please provide your name">
                </p>
                <!-- /.rh_widget_form__row -->
                <p class="rh_widget_form__row rh-ultra-form-field-wrapper">
                   <label for="rh-enquiry-email">
                      <svg class="rh-ultra-dark" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                         <path d="M0 0h24v24H0V0z" fill="none"></path>
                         <path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"></path>
                         <path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"></path>
                      </svg>
                   </label>
                   <input id="rh-enquiry-email" type="text" name="email" placeholder="Email" class="required rh-ultra-field" title="* Please provide valid email address">
                </p>
                <!-- /.rh_widget_form__row -->
                <p class="rh_widget_form__row rh-ultra-form-field-wrapper">
                   <label for="rh-enquiry-phone">
                      <svg class="rh-ultra-dark" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                         <path d="M0 0h24v24H0V0z" fill="none"></path>
                         <path d="M19 17.47c-.88-.07-1.75-.22-2.6-.45l-1.19 1.19c1.2.41 2.48.67 3.8.75v-1.49zM6.54 5h-1.5c.09 1.32.35 2.59.75 3.8l1.2-1.2c-.24-.84-.39-1.71-.45-2.6z" opacity=".3"></path>
                         <path d="M20 21c.55 0 1-.45 1-1v-3.49c0-.55-.45-1-1-1-1.24 0-2.45-.2-3.57-.57-.1-.04-.21-.05-.31-.05-.26 0-.51.1-.71.29l-2.2 2.2c-2.83-1.45-5.15-3.76-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17zm-3.6-3.98c.85.24 1.72.39 2.6.45v1.49c-1.32-.09-2.59-.35-3.8-.75l1.2-1.19zM5.03 5h1.5c.07.89.22 1.76.46 2.59l-1.2 1.2c-.41-1.2-.67-2.47-.76-3.79z"></path>
                      </svg>
                   </label>
                   <input id="rh-enquiry-phone" type="text" name="phone" placeholder="Phone" class="required rh-ultra-field" title="* Please provide valid phone number">
                </p>
                <!-- /.rh_widget_form__row -->
                <p class="rh_widget_form__row rh-ultra-form-field-wrapper rh-ultra-form-textarea">
                   <label for="rh-enquiry-phone">
                      <svg class="rh-ultra-dark" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                         <path d="M0 0h24v24H0V0z" fill="none"></path>
                         <path d="M4 18l2-2h14V4H4z" opacity=".3"></path>
                         <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"></path>
                      </svg>
                   </label>
                   <textarea id="rh-enquiry-message" cols="40" rows="6" name="message" placeholder="Message" class="required rh-ultra-field" title="* Please provide your message">Hello, I am interested in [Home in Merrick Way]</textarea>
                </p>
                <!-- /.rh_widget_form__row -->
                <div class="rh_inspiry_gdpr rh_widget_form__row clearfix"><span class="gdpr-checkbox-label">GDPR Agreement <span class="required-label">*</span></span><input type="checkbox" name="gdpr" id="rh_inspiry_gdpr" class="required" value="I consent to having this website store my submitted information so they can respond to my inquiry." title="* Please accept GDPR agreement"><label for="rh_inspiry_gdpr"><span class="rh-gdpr-text-inner-wrapper">I consent to having this website store my submitted information so they can respond to my inquiry.</span></label></div>
                <input type="hidden" name="nonce" value="5c694273c1">
                <input type="hidden" name="target" value="robot@inspirythemes.com">
                <input type="hidden" name="agent_id" value="54">
                <input type="hidden" name="author_name" value="Melissa William">
                <input type="hidden" name="property_id" value="45">
                <input type="hidden" name="action" value="send_message_to_agent">
                <input type="hidden" name="property_title" value="Home in Merrick Way">
                <input type="hidden" name="property_permalink" value="https://ultra.realhomes.io/property/home-in-merrick-way/">
                <button type="submit" name="submit" class="rh-ultra-filled-button rh-ultra-button submit-button">
                   <span class="btn-text">Send Message</span>
                   <span id="ajax-loader-agent-form-id54" class="ajax-loader">
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
                </button>
                <div class="error-container"></div>
                <div class="message-container"></div>
             </form>
          </div>
       </section>       
    </aside>
 </div>