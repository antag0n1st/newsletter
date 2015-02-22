<div class="container1">
    <div id="top-menu">
        <div id="menu-wraper">
            <?php global $_active_page_;
            global $_active_page_submenu_; ?>
            <div> 
                <a style="margin-left: 180px;" href="<?php echo URL::abs('groups'); ?>" 
                   class="menu-list <?php echo $_active_page_ == 'groups' ? 'active' : ''; ?>"> 
                    Groups 
                </a> 
            </div>
            <div> 
                <a href="<?php echo URL::abs('events'); ?>" 
                   class="menu-list <?php echo $_active_page_ == 'events' ? 'active' : ''; ?>"> 
                    Events 
                </a> 
            </div>
            <div> 
                <a href="<?php echo URL::abs('countries'); ?>" 
                   class="menu-list <?php echo $_active_page_ == 'countries' ? 'active' : ''; ?>"> 
                    Countries 
                </a> 
            </div>
            <div> 
                <a href="<?php echo URL::abs('categories'); ?>" 
                   class="menu-list <?php echo $_active_page_ == 'categories' ? 'active' : ''; ?>"> 
                    Categories 
                </a> 
            </div>
            <div> 
                <a href="<?php echo URL::abs('hotels'); ?>" 
                   class="menu-list <?php echo $_active_page_ == 'hotels' ? 'active' : ''; ?>"> 
                    Hotels 
                </a> 
            </div>
        </div>
    </div>
</div>


<?php if ($_active_page_ == 'groups'): ?>
    <div class="submenu"> 
        <div> 
            <a href="<?php echo URL::abs('groups'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'list' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                List 
            </a> 
        </div>
        <div> 
            <a href="<?php echo URL::abs('groups/add'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'add' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                Add 
            </a> 
        </div>
    </div>
<?php endif; ?>

<?php if ($_active_page_ == 'countries'): ?>
    <div class="submenu"> 
        <div> 
            <a href="<?php echo URL::abs('countries'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'list' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                List 
            </a> 
        </div>
        <div> 
            <a href="<?php echo URL::abs('countries/add'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'add' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                Add 
            </a> 
        </div>
    </div>
<?php endif; ?>

<?php if ($_active_page_ == 'categories'): ?>
    <div class="submenu"> 
        <div> 
            <a href="<?php echo URL::abs('categories'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'list' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                List 
            </a> 
        </div>
        <div> 
            <a href="<?php echo URL::abs('categories/add'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'add' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                Add 
            </a> 
        </div>
    </div>
<?php endif; ?>

<?php if ($_active_page_ == 'hotels'): ?>
    <div class="submenu"> 
        <div> 
            <a href="<?php echo URL::abs('hotels'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'list' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                List 
            </a> 
        </div>
        <div> 
            <a href="<?php echo URL::abs('hotels/add'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'add' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                Add 
            </a> 
        </div>
    </div>
<?php endif; ?>

<?php if ($_active_page_ == 'events'): ?>
    <div class="submenu"> 
        <div> 
            <a href="<?php echo URL::abs('events'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'list' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                List 
            </a> 
        </div>
        <div> 
            <a href="<?php echo URL::abs('events/add'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'add' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                Add 
            </a> 
        </div>
    </div>
<?php endif; ?>