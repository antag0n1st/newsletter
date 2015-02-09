<?php /* @var $paginator Paginator */ if(!$paginator->has_next_page() and !$paginator->has_previous_page()) : else : ?>

<div>
    
    <span class="button round"> <a href="<?php echo URL::abs($paginator->paging_url.$paginator->get_prev_page()); ?>">Претходно</a></span>

         <?php  for($i = 1; $i <= $paginator->number_of_pages(); $i++): ?>
              <?php if(($paginator->current_page - 3) < $i and $i < ($paginator->current_page +3)): ?>
              <?php if ($paginator->current_page == $i):   ?>

                        <span class="button round current-page"><?php echo $i; ?></span> 
                        
              <?php else: ?>  
                        
                        <a class="button round" href="<?php echo URL::abs($paginator->paging_url.$i); ?>"><?php echo $i; ?></a> 
                        
              <?php endif; ?>
              <?php endif; ?>               
         <?php endfor; ?>
                        

                        <span class="button round"><a href="<?php echo URL::abs($paginator->paging_url.$paginator->get_next_page()); ?>">Следно</a></span>
</div>

<?php endif; ?>