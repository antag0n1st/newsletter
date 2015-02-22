
<div style="padding-left: 30px;">
    <form id="add-group" name="form" method="post" action="<?php echo URL::abs('groups/add'); ?>">
        <br />
        name:  <input name="group_name" type="text" <?php HTML::post_value('group_name'); ?> /> <br /> <br />
        contact name: <input name="contact_name" type="text" <?php HTML::post_value('contact_name'); ?> /> <br /> <br />

        email: <input name="email" type="text" <?php HTML::post_value('email'); ?> /> <br /> <br />

        <!-- RENDER OTHER EMAIL -->

        phone <input name="phone" type="text" <?php HTML::post_value('phone'); ?> /> <br /> <br />
        
        country: <select name="country_id">

            <?php foreach ($countries as $key => $country): /* @var $country Country */ ?>

            <option <?php if($key == 0) { echo "selected='selected'";} ?> value="<?php echo $country->id; ?>">
                    <?php echo $country->country_name; ?>
            </option>

            <?php endforeach; ?>
        
        </select>
        <br /> <br />
        city: <input name="city" type="text" <?php HTML::post_value('city'); ?> /> <br /> <br />
        address: <input name="address" type="text" <?php HTML::post_value('address'); ?> /> <br /> <br />
        website: <input name="website" type="text" <?php HTML::post_value('website'); ?> /> <br /> <br />
        
        categories: <select name="category_id">

            <?php foreach ($categories as $key => $category): /* @var $category Category */ ?>

            <option <?php if($key == 0) { echo "selected='selected'";} ?> value="<?php echo $category->id; ?>">
                    <?php echo $category->category_name; ?>
            </option>

            <?php endforeach; ?>
        
        </select>
        <br /> <br />
        <input type="submit" value="Save" />
    </form>

</div>

