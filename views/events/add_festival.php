<form class="details1" id="add-event" name="form" method="post" action="<?php echo URL::abs('events/add-festival'); ?>">
    
    <div class="collum1 text">
        
    Title:
    <br/>
    Country:
    </div>
    
    <div class="collum2">    
    <input class="input-text" type="text" name="festival_name" <?php HTML::post_value('festival_name'); ?> />
    <select class="input-text" name="country_id">

            <?php foreach ($countries as $key => $country): /* @var $country Country */ ?>

                <option <?php HTML::post_selected($key, 'country_id', $country->id); ?> >
                    <?php echo $country->country_name; ?>
                </option>

            <?php endforeach; ?>

        </select>
    
    <input class="save" type="submit" value="save" />

</form>
