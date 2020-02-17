</div><br><br>
<hr>
<div class="col-md-12 text-center">&copy; Copyright 2019 Network accessories</div>


<script src="js/jquery/2.1.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    jQuery(window).scroll(function() {
        var vscroll = jQuery(this).scrollTop();
        //console.log(vscroll);

    });

    function detailsmodal(id) {
        var data = {
            "id": id
        };
        jQuery.ajax({
            url: 'includes/detailsmodal.php',
            method: "post",
            data: data,
            success: function(data) {
                jQuery('body').append(data);
                jQuery('#details-modal').modal('toggle');
            },
            error: function() {
                alert("Something Went Wrong!!");
            }

        });

    }
</script>
</body>

</html>