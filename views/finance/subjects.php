<div class="table">
    <?php if(isset($subjects) and count($subjects)): ?>
    
    <table>
        <colgroup>
            <col class="colid" />
        </colgroup>
        <thead>
            <tr id="title-line">
                <th> ID </th>
                <th> Hotel name</th>
                <th> Name </th>
                <th> Country </th>
                <th> Account </th>
                <th> Bank Name </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subjects as $key => $subject): /* @var $subject Subject */ ?>
            <tr>
                <td> <?php echo $subject->id; ?> </td>
                <td>
                    <?php if ($subject->hotel_id): ?>                
                    <?php HTML::anchor($subject->hotel_name, 'hotels/hotel/'.$subject->hotel_id); ?>
                    <?php else: ?>
                    -
                    <?php endif; ?>
                    
                </td>
                <td> <?php echo $subject->subject_name; ?> </td>
                <td> <?php echo $subject->country_name; ?> </td>
                <td> <?php echo $subject->account; ?> </td>
                <td> <?php echo $subject->bank_name; ?> </td>
            </tr>   
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <?php endif; ?>
    
    <a href="<?php echo URL::abs('finance/add-subject'); ?>">
        Add Subject
    </a>
</div>


