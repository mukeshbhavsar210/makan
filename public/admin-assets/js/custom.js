<script>
    $(document).ready(function(){
        $("form").on("submit", function(){
            let btn = $("#updateBtn");
            btn.prop("disabled", true);              // disable button
            btn.text("Updating Data...");            // change label
        });
    });
</script>
