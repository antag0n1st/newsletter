<?php if (isset($_POST['error'])): ?>

    <div id="post-error" class="post-error">    
        <?php echo $_POST['error']; ?>
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