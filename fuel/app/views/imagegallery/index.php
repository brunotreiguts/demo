
<div class="upload-block"><?php
    if (Auth::has_access('gallery.create')) {
        echo Html::anchor('imagegallery/create/', Asset::img('upload.png'), array(
            'class' => 'add-btn',
            'title' => __('GALLERY_UPLOAD_NEW_IMAGE')));
    }
    ?> </div> <?php
if ($imagegalleries):
    ?>
    <div class="popup-gallery">
        <?php
        foreach ($imagegalleries as $item):
            ?> <div class="image-container"> <?php
            echo Html::anchor(
                    'assets/img/gallery/' . $item->file, Html::img('assets/img/gallery/thumbs/' . $item->file, array(
                        'class' => 'gallery-img')), array(
                'title' => $item->description,
                'class' => 'gallery-link thumbnail'));
            ?>  <div class="manage-images">
                    <?php
                    if (Auth::has_access('gallery.manage')) {
//                    
//                    echo Html::anchor('imagegallery/edit/' . $item->id, 'Edit');
//                    
                        ?>  <?php
                        echo Html::anchor('imagegallery/edit/' . $item->id, Asset::img('pencil.png'), array(
                            'class' => 'edit-btn',
                            'title' => __('GALLERY_EDIT_DESCRIPTION')));

                        echo Html::anchor('imagegallery/delete/' . $item->id, Asset::img('trash.png'), array(
                            'class' => 'delete-btn',
                            'onclick' => 'return confirm(\'Are you sure you want to delete this item?\');',
                            'title' => __('GALLERY_DELETE_IMAGE')));
                    }
                    ?>
                </div>
            </div> <?php
        endforeach;
        ?> 
    </div>
<?php else: ?>
    <p><?php __('GALLERY_NO_IMAGES') ?></p>

<?php endif; ?>
