<h2><?php echo __('MATERIAL_HEADER') ?></span></h2>
<br>
<?php if ($materials): ?>

    <?php foreach ($materials as $item): ?>	
        <div class="well">
            <div class="material-title">
                <?php
                echo $item->title;
                ?> 
            </div>                   
            <?php echo Html::img('assets/img/materials/' . $item->image, array('class' => 'material-image')); ?>
            <div class="material-description">
                <?php
                echo htmlspecialchars_decode($item->description);
                ?> 
            </div> 
            <div class="material-price">
                <?php
                
                echo __('MATERIAL_PRICE').': '.$item->price.'&euro;';
                ?> 
            </div>
        </td>
        <td> 

        </td>
        <td> 
            <div class="material-action">
                <?php
                if (Auth::has_access('material.manage')) {
                    echo Html::anchor('material/edit/' . $item->id, Asset::img('pencil.png'), array(
                        'class' => 'edit-btn',
                        'title' => __('MATERIAL_EDIT')));
                    echo Html::anchor('material/delete/' . $item->id, Asset::img('trash.png'), array(
                        'class' => 'delete-btn',
                        'onclick' => 'return confirm(\'Are you sure you want to delete this item?\');',
                        'title' => __('MATERIAL_DELETE')));
                }
                ?>
            </div> 
        </div>
    <?php endforeach; ?>	


<?php else: ?>
    <p>No Materials.</p>

<?php endif; ?><p>

    <?php
    if (Auth::has_access('material.manage')) {
        echo Html::anchor('material/create', __('MATERIAL_ADD_NEW'), array('class' => 'btn btn-success'));
    }
    ?>

</p>
