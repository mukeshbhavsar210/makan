@extends('front.layouts.app')

@section('main')

<section class="content-header">
    <div class="container">           
        <div class="row">
            <div class="col-md-3 col-12">
                <div class="progress-left">
                    <div class="card-body">
                        <a href="{{ route('properties.index') }}" class="link">< Go Back</a> 
                        @include('front.property.progress')
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-12">
                <div class="progress-right">
                    <form action="" method="post" id="createPropertyForm" name="createPropertyForm" >
                        @csrf
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="tab_01" role="tabpanel" aria-labelledby="pills-tab_01">
                                    <div class="tab-content" id="pills-tabContent_2">
                                        <div class="tab-pane fade show active" id="pills-basic" role="tabpanel" aria-labelledby="pills-tab_01">
                                            @include('front.property.create.tab_01')
                                        </div>

                                        <div class="tab-pane fade" id="pills-properties" role="tabpanel" aria-labelledby="pills-tab_02">
                                            @include('front.property.create.tab_02')
                                        </div>

                                        <div class="tab-pane fade" id="pills-price" role="tabpanel" aria-labelledby="pills-tab_03">
                                            @include('front.property.create.tab_03')
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
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $(document).ready(function(){
        $("form").on("submit", function(){
            let btn = $("#createBtn");
            btn.prop("disabled", true);              // disable button
            btn.text("Updating Data...");            // change label
        });

        //By default Ahmedabad area selected
        function loadAreas(cityId) {
            if (!cityId) return;

            $.ajax({
                url: "/get-areas/" + cityId,
                type: "GET",
                success: function (res) {
                    let areaSelect = $("#area");
                    areaSelect.empty().append('<option value="">Select Area</option>');
                    $.each(res, function (key, value) {
                        areaSelect.append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        }
        

        // When city changes
        $("#city").on("change", function () {
            loadAreas($(this).val());
        });

        // 🚀 On page load: auto-load areas of default (Ahmedabad)
        let defaultCityId = $("#city").val();
        if (defaultCityId) {
            loadAreas(defaultCityId);
        }



        $("#goToSecondTab").on("click", function(){
            $("#pills-tab_02").tab("show"); // Open Properties tab
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
        handleMultiSelect(".furnishings", "#furnishings-label", "#furnishingsCounts", "#furnishings", "Select Furnishings");
        handleMultiSelect(".facings", "#facings-label", "#facingsCounts", "#facings", "Select Facings");
        handleMultiSelect(".similar", "#similar-label", "#similarCounts", "#similar", "Similar Properties");


        //Room json data
        function updateRoomsJson() {
            var data = [];
            var idCounter = 1;

            $('.room-option:checked').each(function() {
                var title = $(this).val();
                var price = $('.showCheck[data-title="' + title + '"]').val() || '';

                data.push({
                    id: idCounter,
                    title: title,
                    price: price
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
        bindJsonUpdater("furnishing", "furnishing_json");
        bindJsonUpdater("facings", "facings_json");
        bindJsonUpdater("related_properties", "related_properties_json");
    });
   

    $("#city").change(function(){
        var city_id = $(this).val();
        $.ajax({
            url: '{{ route("areaSub.index") }}',            
            type: 'get',
            data: {city_id:city_id},
            dataType: 'json',
            success: function(response) {
                $("#area").find("option").not(":first").remove();
                $.each(response["subAreas"],function(key,item){
                    $("#area").append(`<option value='${item.id}' >${item.name}</option>`)
                })
            },
            error: function(){
                console.log("Something went wrong")
            }
        });
    })

   
    //Slug automatically add
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


    // Highlight selected plan card
    $('input[name="plan_id"]').change(function(){
        $('.plan-card').removeClass('active');
        $(this).closest('.plan-card').addClass('active');
    });

     // AJAX form submission
    $("#createPropertyForm").submit(function(event){
        event.preventDefault();
        var formArray = $(this).serializeArray();

        $.ajax({
            url: '{{ route("properties.store") }}',
            type: 'post',
            data: formArray,
            dataType: 'json',
            success: function(response){
                if(response.status == true){
                    if(response.paid_plan){
                        // Open Razorpay
                        var options = {
                            "key": "{{ env('RAZORPAY_KEY') }}",
                            "amount": response.amount * 100,
                            "currency": "INR",
                            "name": "{{ config('app.name') }}",
                            "description": "Plan Payment",
                            "order_id": response.razorpay_order_id,
                            "handler": function(res){
                                $.post("{{ route('payment.success') }}", {
                                    _token: '{{ csrf_token() }}',
                                    razorpay_payment_id: res.razorpay_payment_id,
                                    razorpay_order_id: res.razorpay_order_id,
                                    razorpay_signature: res.razorpay_signature
                                }, function(data){
                                    window.location.href = data.redirect;
                                });
                            },
                            "theme": { "color": "#528FF0" }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                    } else {
                        // Free plan → redirect
                        window.location.href = "{{ route('properties.index') }}";
                    }
                } else {
                    var errors = response.errors;
                    $.each(errors, function(key,value){
                        $(`#${key}`).addClass('is-invalid')
                            .siblings('p').addClass('invalid-feedback').html(value);
                    });
                }
            },
            error: function(){
                console.log("Something went wrong");
            }
        });
    });


    //File image uplaod
    Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            url: "{{ route('temp-images.create') }}",
            maxFiles: 10,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                $("#image_id").val(response.image_id);
                console.log(response);

                // Build HTML with label dropdown
                var html = `
                    <div class="col-md-3 mt-3" id="image-row-${response.image_id}">
                        <div class="media">
                            <input type="hidden" name="image_array[${response.image_id}][id]" value="${response.image_id}">
                            
                            <img src="${response.ImagePath}" class="img-fluid" />

                            <!-- Label selection -->
                            <select name="image_array[${response.image_id}][label]" class="form-select mt-2 image-label">
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

                            <!-- Delete button -->
                            <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" 
                            class="deleteCardImg">X</a>
                        </div>
                    </div>`;

                $("#product-gallery").append(html);

                // Attach event after adding select
                $(".image-label").off("change").on("change", function() {
                    enforceUniqueLabels();
                });

                updateProgress(); // ✅ Update progress after adding an image
            },
            removedfile: function(file) {
                updateProgress(); // ✅ Update progress after removing an image
                file.previewElement.remove();
            },
            complete: function(file) {
                this.removeFile(file); // Optional: remove preview after upload
            }
        });

        // Function to enforce unique labels
        function enforceUniqueLabels() {
            let selectedLabels = [];

            // Collect all selected labels
            $(".image-label").each(function() {
                let val = $(this).val();
                if (val) selectedLabels.push(val);
            });

            // Reset all options first
            $(".image-label option").prop("disabled", false);

            // Disable already selected labels in other dropdowns
            $(".image-label").each(function() {
                let currentVal = $(this).val();
                selectedLabels.forEach(label => {
                    if (label !== currentVal) {
                        $(this).find("option[value='" + label + "']").prop("disabled", true);
                    }
                });
            });
        }

        // Delete image
        function deleteImage(id){
            $("#image-row-"+id).remove();
            updateProgress(); // ✅ Update progress after deleting an image
        }

        // ✅ Updated updateProgress function to include Dropzone
        function updateProgress() {
            let totalSteps = $(".form-section").length;
            let completedSteps = 0;

            $(".form-section").each(function () {
                let sectionValid = true;

                $(this).find(".required-field").each(function () {
                    if (!$(this).val()) sectionValid = false;
                });

                $(this).find(".required-group").each(function () {
                    if ($(this).find("input:checked").length === 0) sectionValid = false;
                });

                if (sectionValid) completedSteps++;
            });

            // ✅ Include Dropzone as one "section"
            if ($("#product-gallery .col-md-3").length > 0) completedSteps++;

            let percent = (completedSteps / (totalSteps + 1)) * 100; // +1 for Dropzone
            $(".progress-bar").css("width", percent + "%").text(Math.round(percent) + "%");

            $(".step-bar li").each(function (index) {
                if (index < completedSteps) $(this).removeClass("pending in-progress").addClass("completed");
                else if (index === completedSteps) $(this).removeClass("pending completed").addClass("in-progress");
                else $(this).removeClass("completed in-progress").addClass("pending");
            });
        }

        // Initial call
        updateProgress();

</script>

@endsection