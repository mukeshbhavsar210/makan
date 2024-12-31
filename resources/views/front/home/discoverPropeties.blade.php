

<section
	class="elementor-section elementor-top-section elementor-element elementor-element-41045321 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
	data-id="41045321" data-element_type="section">
	<div class="elementor-container elementor-column-gap-default">
		<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-3fe37391"
			data-id="3fe37391" data-element_type="column">

				  

			<div class="elementor-widget-wrap elementor-element-populated">
				<div class="elementor-element elementor-element-79d20c86 elementor-widget elementor-widget-heading"
					data-id="79d20c86" data-element_type="widget" data-widget_type="heading.default">
					<div class="elementor-widget-container">
						<h2 class="elementor-heading-title elementor-size-default">Discover Properties
						</h2>
					</div>
				</div>
				<div class="elementor-element elementor-element-643c7d9d elementor-widget elementor-widget-heading"
					data-id="643c7d9d" data-element_type="widget" data-widget_type="heading.default">
					<div class="elementor-widget-container">
						
						<p class="elementor-heading-title elementor-size-default">Find Properties In
							Your Favourite Cities</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



<section class="elementor-section elementor-top-section elementor-element elementor-element-6596597 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
	data-id="6596597" data-element_type="section">
	<div class="elementor-container elementor-column-gap-custom">

		@if ($categories->isNotEmpty())
			@foreach ($categories as $category)
				<div class="elementor-column elementor-col-25 elementor-top-column elementor-element elementor-element-53aff573" >
					<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-16bfe2f8 elementor-widget elementor-widget-rhea-ultra-city"
							data-element_type="widget" data-widget_type="rhea-ultra-city.default">
							
							<div class="elementor-widget-container">
								<section class="rhea_ultra_City rhea_ultra_City-16bfe2f8" style="background-image: url('https://ultra-realhomes.b-cdn.net/wp-content/uploads/2022/11/Untitled-3-600x1080.jpg');">
									<a href="{{ route('jobs').'?category='.$category->id }}" class="rhea_ultra_city_thumb">
										<span>View All <i class="fas fa-caret-right"></i></span>
									</a>
									<div class="rhea_ultra_city_tag_wrapper">
										<div class="rhea_ultra_city_tag">
											<span class="rhea_ultra_city_name">{{ $category->name }} </span>
											<span class="rhea_ultra_city_properties">2 </span>
											<span class="rhea_ultra_city_properties_label">Properties</span>
										</div>
									</div>
								</section>
							</div>
						</div>
					</div>
				</div>	
				@endforeach
			@endif					
	</div>
</section>