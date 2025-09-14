@extends('front.layouts.app')
@section('hideHeader') @endsection
@section('main')

@include('front.home.results.filters')

<div class="body-details">
    <div class="row">
        <div class="col-md-8 col-12">
            @include('front.home.results.breadcrumb')
            @include('front.home.results.cards')                                                                                     
            </div>
            <div class="col-md-4 col-12">Right</div>
        </div>
    </div>
@endsection

@section('customJs')

<script type="text/javascript">
    // function applyProperty(id){
    //     $.ajax({
    //         url: '{{ route("applyProperty") }}',
    //         type: 'post',
    //         data: {id:id},
    //         dataType: 'json',
    //         success: function(response){
    //             window.location.href = "{{ url()->current() }}";
    //         }
    //     });
    // }

function updateDropdownLabel(dropdownId, inputSelector, defaultText) {
    var checked = $(inputSelector + ':checked');
    var button = $(dropdownId);

    if (checked.length === 0) {
        button.text(defaultText);
    } else {
        var names = checked.map(function () {
            return $(this).data('label');
        }).get();
        button.text(names.join(', '));
    }
}

$('.custom-checkbox-label input').on('change', function () {
    if ($(this).is(':checked')) {
        $(this).closest('.custom-checkbox-label').addClass('active');
    } else {
        $(this).closest('.custom-checkbox-label').removeClass('active');
    }

    updateDropdownLabel('#propertyTypeDropdown', 'input[name="property_type[]"]', 'Property Type');
    updateDropdownLabel('#roomDropdown', 'input[name="room[]"]', 'BHK Type');
    updateDropdownLabel('#bathroomDropdown', 'input[name="bathroom[]"]', 'Bathrooms');
    updateDropdownLabel('#listedTypeDropdown', 'input[name="listed_type[]"]', 'Listed By');    
    updateDropdownLabel('#facingDropdown', 'input[name="facing[]"]', 'Facings');
    updateDropdownLabel('#areasDropdown', 'input[name="areas[]"]', 'Areas');
});

// Initialize all dropdown labels on page load
updateDropdownLabel('#propertyTypeDropdown', 'input[name="property_type[]"]', 'Property Type');
updateDropdownLabel('#roomDropdown', 'input[name="room[]"]', 'BHK Type');
updateDropdownLabel('#bathroomDropdown', 'input[name="bathroom[]"]', 'Bathrooms');
updateDropdownLabel('#listedTypeDropdown', 'input[name="listed_type[]"]', 'Listed By');
updateDropdownLabel('#facingDropdown', 'input[name="facing[]"]', 'Facings');
updateDropdownLabel('#areasDropdown', 'input[name="areas[]"]', 'Areas');
updateDropdownLabel('#saletypeDropdown', 'input[name="saletype"]', 'Sale Type');
updateDropdownLabel('#constructionDropdown', 'input[name="construction_type"]', 'Construction Type');

function updateDropdownLabel(dropdownId, checkboxSelector, defaultLabel) {
    let selectedLabels = [];
    $(checkboxSelector + ':checked').each(function () {
        selectedLabels.push($(this).data('label'));
    });

    if (selectedLabels.length > 0) {
        $(dropdownId).text(selectedLabels.join(', '));
    } else {
        $(dropdownId).text(defaultLabel);
    }
}



    $('.custom-radio-label input[name="saletype"]').on('change', function () {
        var name = $(this).attr('name');

        // Remove active from all radios in the group
        $('input[name="' + name + '"]').closest('.custom-radio-label').removeClass('active');

        // Add active to the selected one
        if ($(this).is(':checked')) {
            $(this).closest('.custom-radio-label').addClass('active');
        }

        // Update only the Sale Type dropdown label
        updateDropdownLabel('#saletypeDropdown', 'input[name="saletype"]', 'Sale Type');
    });


    function visitedProperty(id) {
        $.post('{{ route("visitedProperty") }}', {
            id: id,
            _token: '{{ csrf_token() }}'
        });    
    }

    function saveProperty(propertyId) {
        $.ajax({
            url: '/save-property', // your route
            type: 'POST',
            data: {
                property_id: propertyId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 'saved') {
                    showNotification('Saved', 'success');
                } else if (response.status === 'removed') {
                   
                }
                setTimeout(() => {
                    location.reload();
                }, 500);
            },
            error: function(xhr) {
                alert('Something went wrong!');
            }
        });
    }   
    
    function showNotification(message, type = 'success') {
        let notification = $('#notification');
        notification.removeClass('success info error').addClass(type).text(message).fadeIn();

        setTimeout(() => {
            notification.fadeOut();
        }, 1000); 
    }

</script>
@endsection