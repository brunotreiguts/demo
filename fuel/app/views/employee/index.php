<?php
if (Auth::has_access('employee.create')) {
    echo Html::anchor('employee/create/', Asset::img('add_user.png'), array(
        'class' => 'add-btn',
        'title' => __('EMPLOYEE_ADD_NEW')));
}
?> 
<h2><?php echo __('EMPLOYEE_HEADER') ?></h2>
<?php
if ($employees):
    ?>
    <table class="employee-display-block">
        <tbody>
            <?php foreach ($employees as $item): ?> 
                <tr>
                    <td>
                        <?php echo Html::img('assets/img/employee/' . $item->avatar, array('class' => 'employee-avatar')); ?>
                        <div class="employee-name"> 
                            <?php
                            echo $item->name;
                            echo " " . $item->surname;
                            ?> 
                        </div>
                        <div class="employee-phone">
                            <?php
                            echo Html::img('assets/img/mobile_phone.png', array('class' => 'contact-icon')) . "+371 " . $item->phonenumber;
                            ?> 
                        </div>
                        <div class="employee-email">
                            <?php
                            echo Html::img('assets/img/mail.png', array('class' => 'contact-icon')) . " " . $item->email;
                            ?> 
                        </div>
                    </td>
                    <td> 
                        <div class="employee-description">
                            <?php
                            echo htmlspecialchars_decode($item->description);
                            ?> 
                        </div> 
                    </td>
                    <td> 
                        <div class="employee-actions">
                            <?php
                            if (Auth::has_access('employee.manage')) {
                                echo Html::anchor('employee/edit/' . $item->id, Asset::img('pencil.png'), array(
                                    'class' => 'edit-btn',
                                    'title' => __('EMPLOYEE_EDIT')));
                                echo Html::anchor('employee/delete/' . $item->id, Asset::img('delete_user.png'), array(
                                    'class' => 'delete-btn',
                                    'onclick' => 'return confirm(\'Are you sure you want to delete this item?\');',
                                    'title' => __('EMPLOYEE_DELETE')));
                            }
                            ?>
                        </div> 
                    </td>
                </tr>
            <?php endforeach; ?>  </tbody>
    </table>
    <?php
else:
    echo __('NO_EMPLOYEES_ADDED');
endif;
?>