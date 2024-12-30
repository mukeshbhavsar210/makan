<div id="properties-listing" class="rh-ultra-half-map-list">
    <div class="rh-ultra-list-wrapper">
       <div class="rh-page-head">
          <nav class="rh-page-breadcrumbs">
             <ol class="breadcrumbs">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Search Properties</li>
             </ol>
          </nav>
          <div class="rh-page-head-bottom">
             <div class="rh-page-head-column"><h1 class="rh-page-title">Search Properties</h1></div>
             <div class="rh-page-head-column"></div>
          </div>          
       </div>
       
       <div class="rh-ultra-list-box" style="margin-top: 20px;">
         
         @include('front.property.filters.filter')

          <div class="rh-custom-search-form-gutter clearfix"></div>
          <div class="rh-ultra-half-map-sorting">
             <p class="rh_pagination__stats"><span>1</span>to<span>4</span>out of<span>10</span>properties</p>
                         
             <div class="rh-ultra-sorting-side">
                <div class="rh_sort_controls">
                   <label for="sort-properties">Sort By:</label>
                   <div class="dropdown bootstrap-select show-tick inspiry_select_picker_trigger rh-ultra-select-dropdown rh-ultra-select-light bs3" style="width: 100%;">
                      <select name="sort-properties" id="sort-properties" class="inspiry_select_picker_trigger rh-ultra-select-dropdown rh-ultra-select-light show-tick" tabindex="-98">
                         <option value="default">Default Order</option>
                         <option value="title-asc">Property Title A to Z</option>
                         <option value="title-desc">Property Title Z to A</option>
                         <option value="price-asc">Price Low to High</option>
                         <option value="price-desc">Price High to Low</option>
                         <option value="date-asc">Date Old to New</option>
                         <option value="date-desc" selected="">Date New to Old</option>
                      </select>
                      <button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="combobox" aria-owns="bs-select-7" aria-haspopup="listbox" aria-expanded="false" data-id="sort-properties" title="Date New to Old">
                         <div class="filter-option">
                            <div class="filter-option-inner">
                               <div class="filter-option-inner-inner">Date New to Old</div>
                            </div>
                         </div>
                         <span class="bs-caret"><span class="caret"></span></span>
                      </button>
                      <div class="dropdown-menu open">
                         <div class="inner open" role="listbox" id="bs-select-7" tabindex="-1">
                            <ul class="dropdown-menu inner " role="presentation"></ul>
                         </div>
                      </div>
                   </div>
                </div>
                
                <div class="rh-ultra-view-type">
                   <a class="grid " href="https://ultra.realhomes.io/search-properties/?view=grid">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                         <path d="M1497,1029h4a2.006,2.006,0,0,1,2,2v4a2.006,2.006,0,0,1-2,2h-4a2.006,2.006,0,0,1-2-2v-4A2.006,2.006,0,0,1,1497,1029Zm0,10h4a2.006,2.006,0,0,1,2,2v4a2.006,2.006,0,0,1-2,2h-4a2.006,2.006,0,0,1-2-2v-4A2.006,2.006,0,0,1,1497,1039Zm10-10h4a2.006,2.006,0,0,1,2,2v4a2.006,2.006,0,0,1-2,2h-4a2.006,2.006,0,0,1-2-2v-4A2.006,2.006,0,0,1,1507,1029Zm0,10h4a2.006,2.006,0,0,1,2,2v4a2.006,2.006,0,0,1-2,2h-4a2.006,2.006,0,0,1-2-2v-4A2.006,2.006,0,0,1,1507,1039Z" transform="translate(-1495 -1029)"></path>
                      </svg>
                   </a>
                   <a class="list active" href="https://ultra.realhomes.io/search-properties/?view=list">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                         <path id="menu" d="M1539.01,1029a1.958,1.958,0,0,1,1.99,1.99,2.067,2.067,0,0,1-1.99,2.01A2,2,0,1,1,1539.01,1029Zm5.99,0h8a2,2,0,0,1,0,4h-8A2,2,0,0,1,1545,1029Zm-5.99,7a1.958,1.958,0,0,1,1.99,1.99,2.067,2.067,0,0,1-1.99,2.01A2,2,0,1,1,1539.01,1036Zm5.99,0h8a2.006,2.006,0,0,1,2,2h0a2.006,2.006,0,0,1-2,2h-8a2.006,2.006,0,0,1-2-2h0A2.006,2.006,0,0,1,1545,1036Zm-5.99,7a1.958,1.958,0,0,1,1.99,1.99,2.067,2.067,0,0,1-1.99,2.01A2,2,0,1,1,1539.01,1043Zm5.99,0h8a2.006,2.006,0,0,1,2,2h0a2.006,2.006,0,0,1-2,2h-8a2.006,2.006,0,0,1-2-2h0A2.006,2.006,0,0,1,1545,1043Z" transform="translate(-1537 -1029)"></path>
                      </svg>
                   </a>
                </div>
             </div>
          </div>

         @include('front.property.propertyIndividual')

       </div>
    </div>
 </div>