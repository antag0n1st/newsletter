<form id="add-hotel" name="form" method="post" action="<?php echo URL::abs('hotels/add'); ?>">

    name: <input name="name" type="text" /> <br /><br />
    address: <input name="address" type="text" /> <br /><br />
    website: <input name="website" type="text" /> <br /><br />
    phone: <input name="phone" type="text" /> <br /><br />

    <select name="country_id">


        <?php foreach ($countries as $key => $country): /* @var $country Country */ ?>

        <option <?php if($key == 0) { echo "selected='selected'";} ?> value="<?php echo $country->id; ?>">
                <?php echo $country->country_name; ?>
            </option>


        <?php endforeach; ?>
    </select>


    <input type="submit" />

</form>