<?php
/**
 * @version		$Id: default_items.php 20209 2011-01-09 17:23:07Z chdemko $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');
$params = &$this->params;
?>

<div class="archive-items">
<?php foreach ($this->items as $i => $item) : ?>
	<div class="row<?php echo $i % 2; ?>">

		<h2>
		<?php if ($params->get('link_titles')): ?>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug,$item->catslug)); ?>">
				<?php echo $this->escape($item->title); ?></a>
		<?php else: ?>
				<?php echo $this->escape($item->title); ?>
		<?php endif; ?>
		</h2>

		<?php $ShowArticleInfo = (($params->get('show_author')) OR ($params->get('show_category')) OR ($params->get('show_parent_category'))
		OR ($params->get('show_create_date')) OR ($params->get('show_modify_date')) OR ($params->get('show_publish_date')) OR ($params->get('show_hits'))); ?>
		<?php if ($ShowArticleInfo) : ?>
		<div class="article-info-box">

			<?php if ($params->get('show_create_date') OR $params->get('show_modify_date')) : ?>
			<ul class="article-info">
				<?php if ($params->get('show_create_date')) : ?>
				<li class="create"> <?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHTML::_('date',$this->item->created, JText::_('DATE_FORMAT_LC2'))); ?> </li>
				<?php endif; ?>
				<?php if ($params->get('show_modify_date')) : ?>
				<li class="modified"> <?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHTML::_('date',$this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?> </li>
				<?php endif; ?>
			</ul>
			<?php endif; ?>
			
			<?php $useRowTwo = (($params->get('show_publish_date')) OR ($params->get('show_author')) OR ($params->get('show_hits'))); ?>
			<?php if ($useRowTwo) : ?>
			<ul class="article-info">
				<?php if ($params->get('show_publish_date')) : ?>
				<li class="published"> <?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE', JHTML::_('date',$this->item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?> </li>
				<?php endif; ?>
				<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
				<li class="createdby">
					<?php $author =  $this->item->author; ?>
					<?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>
					<?php if (!empty($this->item->contactid ) &&  $params->get('link_author') == true):?>
					<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHTML::_('link',JRoute::_('index.php?option=com_contact&view=contact&id='.$this->item->contactid),$author)); ?>
					<?php else :?>
					<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
					<?php endif; ?>
				</li>
				<?php endif; ?>
				<?php if ($params->get('show_hits')) : ?>
				<li class="hits"> <?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?> </li>
				<?php endif; ?>
			</ul>
			<?php endif; ?>
			
			<?php $useRowThree = (($params->get('show_parent_category')) OR ($params->get('show_category'))); ?>
			<?php if ($useRowThree) : ?>
			<ul class="article-info">
				<?php endif; ?>
				<?php if ($params->get('show_parent_category') && $this->item->parent_slug != '1:root') : ?>
				<li class="parent-category-name">
					<?php	$title = $this->escape($this->item->parent_title);
						$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)).'">'.$title.'</a>';?>
					<?php if ($params->get('link_parent_category') AND $this->item->parent_slug) : ?>
					<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
					<?php else : ?>
					<?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
					<?php endif; ?>
				</li>
				<?php endif; ?>
				<?php if ($params->get('show_category')) : ?>
				<li class="category-name">
					<?php 	$title = $this->escape($this->item->category_title);
						$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';?>
					<?php if ($params->get('link_category') AND $this->item->catslug) : ?>
					<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
					<?php else : ?>
					<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
					<?php endif; ?>
				</li>
				<?php endif; ?>
				<?php if ($useRowThree) : ?>
			</ul>
			<?php endif; ?>
		</div>
		<?php endif; ?>

<?php if ($params->get('show_intro')) :?>
	<div class="intro">
		<?php echo JHTML::_('string.truncate', $item->introtext, $params->get('introtext_limit')); ?>
	</div>		
<?php endif; ?>
	</div>
<?php endforeach; ?>
</div>

<div class="pagination">
	<p class="counter">
		<?php echo $this->pagination->getPagesCounter(); ?>
	</p>
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>