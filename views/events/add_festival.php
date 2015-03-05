<form id="add-event" name="form" method="post" action="<?php echo URL::abs('events/add-festival'); ?>">
    <br />
    Title: <input type="text" name="festival_name" <?php HTML::post_value('festival_name'); ?> /> <br /><br />
    
    country: <select name="country_id">

            <?php foreach ($countries as $key => $country): /* @var $country Country */ ?>

                <option <?php HTML::post_selected($key, 'country_id', $country->id); ?> >
                    <?php echo $country->country_name; ?>
                </option>

            <?php endforeach; ?>

        </select>
    <br /><br />
    <input type="submit" value="save" />

</form>
