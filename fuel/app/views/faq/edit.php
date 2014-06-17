<h2>Editing <span class='muted'>Faq</span></h2>
<br>

<?php echo render('faq/_form'); ?>
<p>
	<?php echo Html::anchor('faq/view/'.$faq->id, 'View'); ?> |
	<?php echo Html::anchor('faq', 'Back'); ?></p>
