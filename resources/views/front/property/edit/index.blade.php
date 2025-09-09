@extends('front.layouts.app')

@section('main')
    
<section class="content-header">
    <div class="container">       
        <div class="row">
            <div class="col-md-3 col-12">
                @include('front.property.edit.left')
            </div>
            <div class="col-md-9 col-12">
                <div class="progress-right">            
                    <form action="" method="post" id="updateJobForm" name="updateJobForm"> 
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="tab_01" role="tabpanel" aria-labelledby="pills-tab_01">
                                <div class="tab-content" id="pills-tabContent_2">
                                    <div class="tab-pane fade show active" id="pills-basic" role="tabpanel" aria-labelledby="pills-tab_01">
                                        @include('front.property.edit.tab_01')                                        
                                    </div>

                                    <div class="tab-pane fade" id="pills-properties" role="tabpanel" aria-labelledby="pills-tab_02">
                                        @include('front.property.edit.tab_02')
                                    </div>

                                    <div class="tab-pane fade" id="pills-price" role="tabpanel" aria-labelledby="pills-tab_03">
                                        @include('front.property.edit.tab_03')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>           
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>
    $(document).ready(function(){
        $("form").on("submit", function(){
            let btn = $("#updateBtn");
            btn.prop("disabled", true); 
            btn.text("Updating Data..."); 
        });

        function isFilled(el) {
            let $el = $(el);
            let type = $el.attr("type");

            if ($el.is("textarea") || type === "text" || type === "email" || type === "number") {
                return $el.val().trim() !== "";
            }
            if (type === "radio") {
                let name = $el.attr("name");
                return $("input[name='" + name + "']:checked").length > 0;
            }
            if (type === "checkbox") {
                let name = $el.attr("name");
                return $("input[name='" + name + "']:checked").length > 0;
            }
            return false;
        }

        function updateProgress() {
            let fields = $(".required-field");
            let total = fields.length;
            let filled = 0;

            fields.each(function () {
                if (isFilled(this)) {
                    filled++;
                }
            });

            let percent = Math.round((filled / total) * 100);

            // update progress bar
            $("#progress-bar").css("width", percent + "%").text(percent + "%");

            // update step status
            $(".form-section").each(function () {
                let step = $(this).data("step");
                let inputs = $(this).find(".required-field");
                let sectionFilled = 0;

                inputs.each(function () {
                    if (isFilled(this)) {
                        sectionFilled++;
                    }
                });

                if (sectionFilled === 0) {
                    $("#step-" + step).removeClass().addClass("pending");
                } else if (sectionFilled < inputs.length) {
                    $("#step-" + step).removeClass().addClass("in-progress");
                } else {
                    $("#step-" + step).removeClass().addClass("completed");
                }
            });
        }

        // update on change/input
        $(document).on("input change", ".required-field", updateProgress);

        // initial load
        updateProgress();


        //BHK on
        $(document).on("change", ".room-option", function () {
            let target = $($(this).data("target"));
            if ($(this).is(":checked")) {
                target.addClass("active");
                
                //$(".child-wrapper").addClass("d-none");                
            } else {
                target.removeClass("active");
            }
        });

        $(document).on("input", ".price, .size", function () {
            let key = $(this).data("title"); // e.g. 1_bhk
            let parentGroup = $("#heading_" + key); // parent checkbox group
            let priceVal = $(".price[data-title='" + key + "']").val().trim();
            let sizeVal  = $(".size[data-title='" + key + "']").val().trim();

            if (priceVal !== "" || sizeVal !== "") {
                parentGroup.addClass("active");
                $("#room_" + key).prop("checked", true); // ✅ also check the box automatically
            } else {
                parentGroup.removeClass("active");
                $("#room_" + key).prop("checked", false); // ✅ uncheck if both empty
            }
        });

         $("input[name='residence_types']").on("change", function (e) {
            e.preventDefault();   // stop form submission
            e.stopPropagation();  // stop bubbling if any parent is listening

            if ($(this).val() === "residential") {
                $(".residenceProperty").removeClass("d-none");
                $(".commercialProperty").addClass("d-none");
            } else {
                $(".residenceProperty").addClass("d-none");
                $(".commercialProperty").removeClass("d-none");
            }
        });
    
        //Multiselect Checkbox
        function handleMultiSelect(optionsClass, dropdownId, labelId, hiddenInputId, defaultText) {
            $(optionsClass).on("change", function() {
                let selectedLabels = [];
                let selectedIds = [];

                $(optionsClass + ":checked").each(function() {
                    selectedLabels.push($(this).parent().text().trim());
                    selectedIds.push($(this).val());
                });

                // Update dropdown button text (first 2 labels + '...' if more)
                let displayText = "";
                if (selectedLabels.length > 2) {
                    displayText = selectedLabels.slice(0, 2).join(", ") + ", ...";
                } else if (selectedLabels.length > 0) {
                    displayText = selectedLabels.join(", ");
                } else {
                    displayText = defaultText;
                }
                $(dropdownId).text(displayText);

                // Update label with count
                $(labelId).text(selectedLabels.length ? defaultText.split(' ')[0] + " (" + selectedLabels.length + ")" : defaultText.split(' ')[0]);

                // Store selected IDs in hidden input
                $(hiddenInputId).val(selectedIds.join(","));
            });
        }

        // Apply to your selects
        handleMultiSelect(".room", "#room-label", "#roomCounts", "#room", "Select BHK");
        handleMultiSelect(".bathroom", "#bathroom-label", "#bathroomCounts", "#bathroom", "Select Bathroom");
        handleMultiSelect(".property-types", "#propertyTypes-label", "#propertyTypesCounts", "#property_types", "Select Property Types");
        handleMultiSelect(".amenities", "#amenities-label", "#amenitiesCounts", "#amenities", "Select Amenities");
        handleMultiSelect(".facings", "#facings-label", "#facingsCounts", "#facings", "Select Facings");
        handleMultiSelect(".similar", "#similar-label", "#similarCounts", "#similar", "Similar Properties");


        //Room json data
        function updateRoomsJson() {
            var data = [];
            var idCounter = 1;

            $('.room-option:checked').each(function() {
                var title = $(this).val();

                var price = $('.showCheck[data-title="' + title + '"][data-field="price"]').val() || '';
                var size  = $('.showCheck[data-title="' + title + '"][data-field="size"]').val() || '';

                data.push({
                    id: idCounter,
                    title: title,
                    price: price,
                    size: size
                });
                idCounter++;
            });

            $('#rooms_json').val(JSON.stringify(data));
        }


        $('.room-option').change(function() {
            var title = $(this).val();
            var input = $('.showCheck[data-title="' + title + '"]');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide().val('');
            }
            updateRoomsJson();
        });
        $('.showCheck').on('input', updateRoomsJson);
        // Initialize
        $('.room-option').each(function() {
            var input = $('.showCheck[data-title="' + $(this).val() + '"]');
            $(this).is(':checked') ? input.show() : input.hide();
        });
        updateRoomsJson();


        function bindJsonUpdater(checkboxClass, hiddenInputId) {
            function updateJson() {
                const data = $(`.${checkboxClass}:checked`).map(function () {
                    return $(this).val();
                }).get();
                $(`#${hiddenInputId}`).val(JSON.stringify(data));
            }

            $(document).on("change", `.${checkboxClass}`, updateJson);
            updateJson(); // initialize on page load
        }

        // Bind all
        bindJsonUpdater("bathroom-option", "bathrooms_json");
        bindJsonUpdater("property-types", "property_types_json");
        bindJsonUpdater("amenities", "amenities_json");
        bindJsonUpdater("facings", "facings_json");
        bindJsonUpdater("related_properties", "related_properties_json");
    });

    $('#title').change(function(){
        element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("getSlug") }}',
            type: 'get',
            data: {title: element.val()},
            dataType: 'json',
            success: function(response){
                $("button[type=submit]").prop('disabled', false);
                if(response["status"] == true){
                    $("#slug").val(response["slug"]);
                }
            }
        });
    })

    //Product form add details in database
    $("#updateJobForm").submit(function(event){
        event.preventDefault();

        var formArray = $(this).serializeArray();
        $("button[type='submit']").prop('disabled',true);

        $.ajax({
            url: '{{ route("properties.update",$property->id) }}',
            type: 'put',
            data: formArray,
            dataType: 'json',
            success: function(response){

                $("button[type='submit']").prop('disabled',false);

                if (response['status'] == true) {
                    $(".error").removeClass('invalid-feedback').html('');
                    $("input[type='text'], select, input[type='number']").removeClass('is-invalid');
                    window.location.href="{{ route('properties.index') }}";
                } else {
                    var errors = response['errors'];
                    $(".error").removeClass('invalid-feedback').html('');
                    $("input[type='text'], select, input[type='number']").removeClass('is-invalid');

                    $.each(errors, function(key,value){
                        $(`#${key}`).addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(value);
                    });
                }
            },

            error: function(){
                console.log("Something went wrong")
            }
        });
    });


    //File image uplaod
    Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            url:  "{{ route('property-images.update') }}",
            maxFiles: 10,
            paramName: 'image',
            params: {'property_id' : '{{ $property->id }}'},
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif,image/avif",

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, success: function(file, response){
                $("#image_id").val(response.image_id);
                console.log(response)

               var html = `<div class="media" id="image-row-${response.image_id}">
                                <input type="hidden" name="image_array[]" value="${response.image_id}" >
                                <img src="${response.ImagePath}" class="thumb" />

                                <div class="overlay">
                                    <div class="field">
                                        <select name="image_array[${response.image_id}][label]" class="form-control mt-2 image-label">
                                            <option value="">Select Label</option>
                                            <option value="Main">Main</option>
                                            <option value="Video">Video</option>
                                            <option value="Elevation">Elevation</option>
                                            <option value="Bedroom">Bedroom</option>
                                            <option value="Living">Living</option>
                                            <option value="Balcony">Balcony</option>
                                            <option value="Amenities">Amenities</option>
                                            <option value="Floor">Floor</option>
                                            <option value="Location">Location</option>
                                            <option value="Cluster">Cluster</option>                        
                                        </select>
                                        <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" class="deleteCardImg">X</a>
                                    </div>
                                </div>
                            </div>`;

                $("#product-gallery").append(html);
            },
            complete: function(file){
                this.removeFile(file);
            }
        });


        //Delete Images
        function deleteImage(id){
            $("#image-row-"+id).remove();

            if (confirm("Are you sure you want to delete image?")) {
                $.ajax({
                    url: '{{ route("property-images.destroy") }}',
                    type: 'delete',
                    data: {id:id},
                        success: function(response) {
                            if(response.status == true){
                                //alert(response.message);
                            } else {
                                alert(response.message);
                            }
                        }
                })
            }
        }
</script>
@endsection