<form class="details1" id="add-hotel" name="form" method="post" action="<?php echo URL::abs('hotels/add'); ?>">
    <div class="collum1 text">
    name:
    <br/>
    address:
    <br/>
    website:
    <br/>
    phone:
    </div>
    <div class="collum2">
    <input class="input-text" name="name" type="text" />
    <input class="input-text" name="address" type="text" />
    <input class="input-text" name="website" type="text" />
    <input class="input-text" name="phone" type="text" /> 

    <select class="input-text" name="country_id">


        <?php foreach ($countries as $key => $country): /* @var $country Country */ ?>

        <option <?php if($key == 0) { echo "selected='selected'";} ?> value="<?php echo $country->id; ?>">
                <?php echo $country->country_name; ?>
            </option>


        <?php endforeach; ?>
    </select>
    <br/><br/>


    <input class="save" type="submit" value="Save"/>
    </div>

</form>