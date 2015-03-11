<div class="container1">
    <div id="top-menu">
        <div id="menu-wraper">
            <?php global $_active_page_;
            global $_active_page_submenu_; ?>
            <div> 
                <a style="margin-left: 60px;" href="<?php echo URL::abs('groups'); ?>" 
                   class="menu-list <?php echo $_active_page_ == 'groups' ? 'active' : ''; ?>"> 
                    Groups 
                </a> 
            </div>
            <div> 
                <a href="<?php echo URL::abs('applications'); ?>" 
                   class="menu-list <?php echo $_active_page_ == 'applications' ? 'active' : ''; ?>"> 
                    Applications 
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
            <div> 
                <a href="<?php echo URL::abs('newsletter'); ?>" 
                   class="menu-list <?php echo $_active_page_ == 'newsletter' ? 'active' : ''; ?>"> 
                    Newsletter 
                </a> 
            </div>
        </div>
    </div>
</div>


<?php if ($_active_page_ == 'groups'): ?>
    <div class="submenu"> 
        <div> 
            <a href="<?php echo URL::abs('groups'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'details' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                Details 
            </a> 
        </div>
        <div> 
            <a href="<?php echo URL::abs('groups/lista'); ?>" 
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
               class="<?php echo $_active_page_submenu_ == 'list_events' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                List Events
            </a> 
        </div>
        <div> 
            <a href="<?php echo URL::abs('events/add-event'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'add_event' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                Add Event
            </a> 
        </div>        
        <div> 
            <a href="<?php echo URL::abs('events/list-festivals'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'list_festivals' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                List Festivals
            </a> 
        </div>
        <div> 
            <a href="<?php echo URL::abs('events/add-festival'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'add_festival' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                Add Festival
            </a> 
        </div>
    </div>
<?php endif; ?>

<?php if ($_active_page_ == 'newsletter'): ?>
    <div class="submenu"> 
        <div> 
            <a href="<?php echo URL::abs('newsletter'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'overview' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                Overview 
            </a> 
        </div>
        <div> 
            <a href="<?php echo URL::abs('newsletter/templates'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'templates' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                Templates 
            </a> 
        </div>
        <div> 
            <a href="<?php echo URL::abs('newsletter/add-template'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'add_template' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                Add 
            </a> 
        </div>
    </div>
<?php endif; ?>

<?php if ($_active_page_ == 'applications'): ?>
    <div class="submenu"> 
        <div> 
            <a href="<?php echo URL::abs('applications'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'list' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                List 
            </a> 
        </div>
        
        <div> 
            <a href="<?php echo URL::abs('applications/list-by-filter/application-is-not-sent'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'application-is-not-sent' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                App Not Sent
            </a> 
        </div>
        
        <div> 
            <a href="<?php echo URL::abs('applications/list-by-filter/application-is-sent'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'application-is-sent' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                App Sent
            </a> 
        </div>
        
        <div> 
            <a href="<?php echo URL::abs('applications/list-by-filter/application-is-answered'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'application-is-answered' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                App Answered
            </a> 
        </div>
        
        <div> 
            <a href="<?php echo URL::abs('applications/list-by-filter/invitation-is-sent'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'invitation-is-sent' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                Invitation Sent
            </a> 
        </div>
        
        <div> 
            <a href="<?php echo URL::abs('applications/list-by-filter/invoice-is-paid'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'invoice-is-paid' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                Paid
            </a> 
        </div>
        
        <div> 
            <a href="<?php echo URL::abs('applications/add'); ?>" 
               class="<?php echo $_active_page_submenu_ == 'add' ? 'submenu-active' : 'submenu-list submenu_hover'; ?>">
                Add 
            </a> 
        </div>
        
        
        
    </div>
<?php endif; ?>