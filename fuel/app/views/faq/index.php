<h2><?php echo __('FAQ_HEADING') ?></h2>
<br>

<?php

if ($faqs):
    ?>

    <div class="well">
    <?php foreach ($faqs as $item): ?>
            <div class="panel panel-default">
                <div class="panel-heading faq-question"><?php echo htmlspecialchars_decode($item->question); ?></div>
                <div class="panel-body faq-answer">
        <?php echo htmlspecialchars_decode($item->answer); ?>


                </div>
                <?php
                if (Auth::has_access('faq.manage')) {
                    echo Html::anchor('faq/edit/' . $item->id, __('FAQ_EDIT'), array(
                        'class' => 'btn btn-small'));
                    echo Html::anchor('faq/delete/' . $item->id, __('FAQ_DELETE'), array(
                        'class' => 'btn btn-small btn-danger',
                        'onclick' => "return confirm(__('GLOBAL_ARE_YOU_SURE_DELETE'))"));
                }
                ?>					</div>
    <?php endforeach; ?>		
    </div>

<?php else: ?>

    <p><?php __('NO_FAQ_ADDED') ?></p>

<?php
endif;
echo Html::anchor('ask/index', __('ASK_YOUR_QUESTION'), array('class' => 'btn btn-default'));

if (Auth::has_access('faq.create')) {
    echo Html::anchor('faq/create', __('FAQ_ADD_NEW'), array('class' => 'btn btn-success create'));
}
