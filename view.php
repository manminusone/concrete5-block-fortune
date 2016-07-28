<?php
	defined('C5_EXECUTE') or die("Access Denied.");
	$c = Page::getCurrentPage();
	if (!$content && is_object($c) && $c->isEditMode()) { ?>
		<div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Content Block.')?></div> 
	<?php } else if (is_object($c) && $c->isEditMode()) { ?>
		<div class="ccm-edit-more-disabled-item"><?php echo t('Fortune disabled in edit mode.')?></div>
	<?php } else { ?>
	    <?php 
		$tmpArray = array_filter(explode("\n", $content), function($value) { return $value !== ''; });
		if (count($tmpArray) > 0) {
		    $tmpChoice = $tmpArray[ rand(0, count($tmpArray)) ];
		    echo '<div class="text-fortune">' . t($tmpChoice) . '</div>';
		}
	} ?>
