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
         @include('front.propertyMap.filters.filter')
         @include('front.propertyMap.propertyIndividual')
       </div>
    </div>
 </div>