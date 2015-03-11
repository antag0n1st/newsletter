<?php if (isset($_POST['_error'])): ?>

    <div id="post-error" class="post-error">    
        <?php echo $_POST['_error']; ?>
    </div>

    <script type="text/javascript">

        $(function () {
            $("#post-error").slideDown(600, function () {
                setTimeout(function () {
                    $("#post-error").slideUp();
                }, 1000 * 5);
            });
        });

    </script>

<?php endif; ?>


<?php if (isset($_POST['_confirmation'])): ?>

    <div id="_confirmation" class="post-confirmation">    
        <?php echo $_POST['_confirmation']; ?>
    </div>

    <script type="text/javascript">

        $(function () {
            $("#_confirmation").slideDown(600, function () {
                setTimeout(function () {
                    $("#_confirmation").slideUp();
                }, 1000 * 5);
            });
        });

    </script>

<?php endif; ?>