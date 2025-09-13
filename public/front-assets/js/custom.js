$(document).ready(function(){
    //Property progress tabs
    $(document).on("click", ".btn-next-tab", function (e) {
        e.preventDefault();

        // find current active pane and tab
        let $currentPane = $(".tab-pane.show.active");
        let $nextPane = $currentPane.next(".tab-pane");

        let $currentTab = $(".nav-pills .nav-link.active");
        let $nextTab = $currentTab.closest("li").next("li").find(".nav-link");

        if ($nextPane.length && $nextTab.length) {
            // switch tab panes
            $currentPane.removeClass("show active");
            $nextPane.addClass("show active");

            // switch nav links
            $currentTab.removeClass("active");
            $nextTab.addClass("active");
        }
    });




     $('input[name="optionRadio"]').change(function() {
        var selected = $(this).val();
        $('.tab-pane').removeClass('show active');
        $('#div' + selected).addClass('show active');
    });    

    $('#loginForm').submit(function(e) {
        e.preventDefault(); // prevent page refresh
        $('.invalid-feedback').text('').addClass('d-none');
        $('.form-control').removeClass('is-invalid');
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if(response.status) {
                    location.reload(); // or window.location.href = '/dashboard';
                }
            },
            error: function(xhr) {
                if(xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('#error_' + key).text(value[0]).removeClass('d-none');
                        $('#login_' + key).addClass('is-invalid'); // adds red border
                    });
                }
            }
        });
    });

	$('#forgotPasswordForm').submit(function(e) {
        e.preventDefault();

        // Remove previous errors
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').text('');

        let form = $(this);
        let url = form.attr('action');

        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                alert(response.message); // or display inside modal
                form[0].reset();
            },
            error: function(xhr) {
                if(xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('#forgot_' + key).addClass('is-invalid'); // add red border
                        $('#error_' + key).text(value[0]); // show error message
                    });
                }
            }
        });
    });

    // When any plan radio button changes
    $('input[name="plan_id"]').change(function() {
        // Remove .active class from all plan cards
        $('.plan-card').removeClass('active');

        // Add .active class to the parent label of the checked radio
        $(this).closest('.plan-card').addClass('active');
    });

    // Optional: add .active to the initially checked radio on page load
    $('input[name="plan_id"]:checked').closest('.plan-card').addClass('active');




    $(".logoFirst").hover(
        function() {
            $(this).find(".rollover-details").fadeIn(200);
        }, 
        function() {
            $(this).find(".rollover-details").fadeOut(200);
        }
    );

    $(".user").hover(
        function() {
            $(this).find(".rollover-user").fadeIn(200);
        }, 
        function() {
            $(this).find(".rollover-user").fadeOut(200);
        }
    );

    //Progress bar
    function isFilled(el) {
        let $el = $(el);
        let type = $el.attr("type");
        let tag = $el.prop("tagName").toLowerCase();

        if (tag === "textarea" || type === "text" || type === "email" || type === "number") {
            return $el.val().trim() !== "";
        }
        if (tag === "select") {
            return $el.val() !== "" && $el.val() !== null;
        }
        if (type === "radio" || type === "checkbox") {
            let name = $el.attr("name");
            return $("input[name='" + name + "']:checked").length > 0;
        }
        return false;
    }

    function updateProgress() {
        // let totalSteps = 24;
        // let completedSteps = 2;

        let totalSteps = $(".form-section").length;
        let completedSteps = 0;

        $(".form-section").each(function () {
            let step = $(this).data("step");
            let inputs = $(this).find(".required-field");
            let groups = $(this).find(".required-group");
            let filledCount = 0;

            // Count filled fields
            inputs.each(function () {
                if (isFilled(this)) filledCount++;
            });

            // Count groups with at least one checked
            groups.each(function () {
                if ($(this).find("input:checked").length > 0) filledCount++;
            });

            // Step-bar class update
            if (filledCount === 0) {
                $("#step-" + step).removeClass().addClass("pending");
                $("#step-" + step + " .status").text("Pending");
            } else if (filledCount < inputs.length + groups.length) {
                $("#step-" + step).removeClass().addClass("in-progress");
                $("#step-" + step + " .status").text("In Progress");
            } else {
                $("#step-" + step).removeClass().addClass("completed");
                $("#step-" + step + " .status").text("Completed");
            }

            // Increment completedSteps if section has at least one filled
            if (filledCount > 0) completedSteps++;
        });

        // Dropzone files count (if any)
        if (typeof dropzone !== "undefined" && dropzone[0].dropzone.files.length > 0) {
            completedSteps++;
        }

        // Percentage calculation
        let percent = (completedSteps / totalSteps) * 100;
        $(".progress-bar").css("width", percent + "%").text(Math.round(percent) + "%");
    }

    // Bind inputs to update progress dynamically
    $(document).on("input change", ".required-field, .required-group input", updateProgress);

    // Initial call on page load to account for pre-selected/default fields
    updateProgress();






    $('[data-bs-toggle="tooltip"]').tooltip();
    
    setTimeout(function() {
        $('.alert').fadeOut('fast');
    }, 1500);   

    $('.tagNav .nav-link').on('click', function(e) {
        e.preventDefault();

        var $nav = $(this).closest('.tagNav'); // current nav
        var target = $(this).data('target');
        var $targetDiv = $('#' + target);

        // Find the matching tag-container for this nav
        var $container = $targetDiv.closest('.tag-container');

        // Scroll container to the target div
        $container.animate({
            scrollLeft: $targetDiv.position().left + $container.scrollLeft()
        }, 400);

        // Navbar active state (only inside this nav)
        $nav.find('.nav-link').removeClass('active');
        $(this).addClass('active');

        // Div active state (only inside this container)
        $container.find('.tag').removeClass('div-active');
        $targetDiv.addClass('div-active');
    });




    // Initialize each module independently (works even if multiple exist on the page)
    $('.tag-module').each(function () {
    const $module   = $(this);
    const $nav      = $module.find('.tagNav').first();                       // scope to this module
    const $links    = $nav.find('> li > .nav-link[data-target]');            // only count intended nav items
    const total     = $links.length;

    // Set total
    $module.find('.counter-total').text(total);

    // Determine current from the active link (fallback to 1)
    let currentIdx = $links.index($links.filter('.active')) + 1;
    if (currentIdx < 1) currentIdx = 1;

    // Render initial state
    $module.find('.counter-current').text(currentIdx);
    $module.find('.slick-progress').css('width', (currentIdx / total * 100) + '%');

    // Click handler (scoped)
    $links.on('click', function (e) {
        e.preventDefault();

        // Active state on nav
        $links.removeClass('active');
        $(this).addClass('active');

        // Update counter + progress
        const index = $links.index(this) + 1;
        $module.find('.counter-current').text(index);
        $module.find('.slick-progress').css('width', (index / total * 100) + '%');
    });
});


    // Fix when modal opens
    $('#big-modal').on('shown.bs.modal', function () {
        $('.center').slick('setPosition');
    });
    
     // Prevent dropdown from closing on tab click
    $('.dropdown-menu').on('click', function (e) {
        e.stopPropagation();
    });

    // Also keep it open when switching tabs
    $('#more-filters-tab a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
    });






});


function toggleActiveClass(name, buttonId) {
    let anyChecked = $(`input[name="${name}[]"]:checked`).length > 0;
    $(`#${buttonId}`).toggleClass('activeFilter', anyChecked);
}



