<?php
/**
* @title		Minitek Slider
* @copyright	Copyright (C) 2011-2021 Minitek, All rights reserved.
* @license		GNU General Public License version 3 or later.
* @author url	https://www.minitek.gr/
* @developers	Minitek.gr
*/

defined('_JEXEC') or die('Restricted access');

if (!empty($this->slider) ||  $this->slider!== 0)
{
	foreach ($this->slider as $key=>$item)
	{
		?><div class="mslider-item <?php 
			if (!$this->slider_images) 
			{
				echo 'no_images ';
			} 
			else if (!isset($item->itemImage) || !$item->itemImage) 
			{
				echo 'no_image ';
			}
			echo $this->hoverEffectClass; 
			?>" style="padding-right:<?php echo $this->gutter; ?>px; padding-left:<?php echo $this->gutter; ?>px;"><?php 

			?><div class="mslider-item-outer-cont" style="<?php echo $this->animated_flip; ?>">
				<div class="mslider-item-inner-cont" style="<?php 
					if ($this->border_radius) 
					{
						?>border-radius: <?php echo $this->border_radius; ?>px; <?php 
					}
					if ($this->border) 
					{
						?>border: <?php echo $this->border; ?>px solid <?php echo $this->border_color; ?>;<?php 
					} 
					?>"><?php 
					
					if ($this->detailBox || !isset($item->itemImage) || !$item->itemImage) 
					{
						?><div class="mslider-detail-box <?php 
							echo $this->detailBoxTextColor; 
							if (!isset($item->itemImage) || !$item->itemImage || !$this->slider_images) 
							{
								echo ' no_image';
							} 
							?>" style="background-color: rgba(<?php echo $this->detailBoxBackground; ?>,<?php echo $this->detailBoxBackgroundOpacity; ?>);"><?php 

							if ($this->detailBoxDate && isset($item->itemDate)) 
							{
								?><div class="mslider-date"><?php 
									echo $item->itemDate; 
								?></div><?php 
							}

							if ($this->detailBoxTitle) 
							{
								?><h3 class="mslider-title"><?php 
									if (isset($item->itemLink) && $this->detailBoxTitleLink) 
									{
										?><a href="<?php echo $item->itemLink; ?>"><?php 
											echo $item->itemTitle; 
										?></a><?php 
									} 
									else 
									{
										?><span><?php echo $item->itemTitle; ?></span><?php 
									}
								?></h3><?php 
							}

							if (($this->detailBoxCategory && ((isset($item->itemCategoryRaw) && $item->itemCategoryRaw) || (isset($item->itemCategoriesRaw) && $item->itemCategoriesRaw))) || ($this->detailBoxAuthor && ((isset($item->itemAuthorRaw) && $item->itemAuthorRaw) || (isset($item->itemAuthorsRaw) && $item->itemAuthorsRaw))) || $this->detailBoxType) 
							{
								?><div class="mslider-item-info"><?php 
									if ($this->detailBoxCategory && ((isset($item->itemCategoryRaw) && $item->itemCategoryRaw) || (isset($item->itemCategoriesRaw) && $item->itemCategoriesRaw))) 
									{
										?><p class="mslider-item-category">
											<span><?php echo JText::_('COM_MINITEKSLIDER_IN'); ?> </span><?php 
											echo $item->itemCategory; 
										?></p><?php 
									}

									if ($this->detailBoxType) 
									{
										?><p class="mslider-item-type"><?php 
											echo $item->itemType; 
										?></p><?php 
									}

									if ($this->detailBoxAuthor && ((isset($item->itemAuthorRaw) && $item->itemAuthorRaw) || (isset($item->itemAuthorsRaw) && $item->itemAuthorsRaw))) 
									{
										?><p class="mslider-item-author">
											<span><?php echo JText::_('COM_MINITEKSLIDER_BY'); ?> </span><?php 
											echo $item->itemAuthor; 
										?></p><?php 
									}
								?></div><?php 
							} 

							if ($this->detailBoxIntrotext && isset($item->itemIntrotext) && $item->itemIntrotext) 
							{
								?><div class="mslider-desc"><?php 
									echo $item->itemIntrotext; 
								?></div><?php 
							} 

							if ($this->detailBoxHits && isset($item->itemHits)) 
							{
								?><div class="mslider-hits">
									<p><?php echo $item->itemHits; ?>&nbsp;<?php echo JText::_('COM_MINITEKSLIDER_HITS'); ?></p>
								</div><?php 
							}

							if ($this->detailBoxCount && isset($item->itemCount)) 
							{ 
								?><div class="mslider-count">
									<p><?php echo $item->itemCount; ?></p>
								</div><?php 
							}

							if ($this->detailBoxReadmore) 
							{
								if (isset($item->itemLink)) 
								{
									?><div class="mslider-readmore">
										<a href="<?php echo $item->itemLink; ?>"><?php echo JText::_('COM_MINITEKSLIDER_READ_MORE'); ?></a>
									</div><?php 
								}
							}
						?></div><?php 
					}

					if (isset($item->itemImage) && $item->itemImage && $this->slider_images) 
					{
						?><div class="mslider-cover <?php echo $this->hoverEffectClass; ?>">
							<div class="mslider-img-div" style="<?php echo $this->animated_flip; ?>">
								<div class="mslider-item-img"><?php
									if (isset($item->itemLink) && $this->slider_image_link) 
									{
										?><a href="<?php echo $item->itemLink; ?>" class="mslider-photo-link">
											<img src="<?php echo $item->itemImage; ?>" alt="<?php echo htmlspecialchars($item->itemTitleRaw); ?>" />
										</a><?php 
									} 
									else 
									{
										?><div class="mslider-photo-link">
											<img src="<?php echo $item->itemImage; ?>" alt="<?php echo htmlspecialchars($item->itemTitleRaw); ?>" />
										</div><?php 
									}
								?></div><?php 
								
								if ($this->hoverBox && ($this->hoverBoxEffect !== '2' && $this->hoverBoxEffect !== '3')) 
								{
									?><div class="mslider-hover-box" style="<?php 
										echo $this->animated; 
										?> background-color: rgba(<?php echo $this->hb_bg_class; ?>,<?php echo $this->hb_bg_opacity_class; ?>);"><?php 

										?><div class="mslider-hover-box-content <?php echo $this->hoverTextColor; ?>"><?php 
											if ($this->hoverBoxDate && isset($item->itemDate)) 
											{
												?><div class="mslider-date"><?php 
													echo $item->itemDate; 
												?></div><?php 
											}

											if ($this->hoverBoxTitle) 
											{
												?><h3 class="mslider-title"><?php 
													if (isset($item->itemLink) && $this->detailBoxTitleLink) 
													{
														?><a href="<?php echo $item->itemLink; ?>"><?php 
															echo $item->hover_itemTitle; 
														?></a><?php 
													} 
													else 
													{
														?><span><?php echo $item->hover_itemTitle; ?></span><?php 
													}
												?></h3><?php 
											}

											if ($this->hoverBoxCategory || $this->hoverBoxType || $this->hoverBoxAuthor) 
											{
												?><div class="mslider-item-info"><?php 
													if (((isset($item->itemCategoryRaw) && $item->itemCategoryRaw) || (isset($item->itemCategoriesRaw) && $item->itemCategoriesRaw)) && $this->hoverBoxCategory) 
													{
														?><p class="mslider-item-category">
															<span><?php echo JText::_('COM_MINITEKSLIDER_IN'); ?> </span><?php 
															echo $item->itemCategory; 
														?></p><?php 
													}

													if ($this->hoverBoxType) 
													{
														?><p class="mslider-item-category"><?php 
															echo $item->itemType; 
														?></p><?php 
													}

													if (((isset($item->itemAuthorRaw) && $item->itemAuthorRaw) || (isset($item->itemAuthorsRaw) && $item->itemAuthorsRaw)) && $this->hoverBoxAuthor) 
													{
														?><p class="mslider-item-author">
															<span><?php echo JText::_('COM_MINITEKSLIDER_BY'); ?> </span><?php 
															echo $item->itemAuthor; 
														?></p><?php 
													}
												?></div><?php 
											}

											if ($this->hoverBoxIntrotext) 
											{ 
												if (isset($item->hover_itemIntrotext) && $item->hover_itemIntrotext) 
												{
													?><div class="mslider-desc"><?php 
														echo $item->hover_itemIntrotext; 
													?></div><?php 
												}
											}

											if ($this->hoverBoxHits && isset($item->itemHits)) 
											{
												?><div class="mslider-hits">
													<p><?php echo $item->itemHits; ?>&nbsp;<?php echo JText::_('COM_MINITEKSLIDER_HITS'); ?></p>
												</div><?php 
											}

											if ($this->hoverBoxLinkButton || $this->hoverBoxZoomButton) 
											{
												?><div class="mslider-item-icons"><?php 
													if ($this->hoverBoxLinkButton) 
													{
														if (isset($item->itemLink)) 
														{
															?><a href="<?php echo $item->itemLink; ?>" class="mslider-item-link-icon">
																<i class="fa fa-link"></i>
															</a><?php 
														}
													}

													if ($this->hoverBoxZoomButton && (isset($item->itemImage) && $item->itemImage && $this->slider_images)) 
													{
														?><a data-bs-toggle="modal" data-bs-target="#zoomSlider_<?php echo $this->widgetID; ?>" class="mslider-zoom mslider-item-zoom-icon" data-src="<?php echo $item->itemImage; ?>" data-title="<?php echo htmlspecialchars($item->itemTitleRaw); ?>">
															<i class="fa fa-search"></i>
														</a><?php 
													}
												?></div><?php 
											}
										?></div>
									</div><?php 
								}
							?></div>
						</div><?php 
					}
				?></div><?php 
				
				if ($this->hoverBox && ((! $this->slider_images || !isset($item->itemImage) || !$item->itemImage) || ($this->hoverBoxEffect == '2' || $this->hoverBoxEffect == '3'))) 
				{
					?><div class="mslider-hover-box" style="<?php 
						echo $this->animated; 
						?> background-color: rgba(<?php echo $this->hb_bg_class; ?>,<?php echo $this->hb_bg_opacity_class; ?>);<?php 
						if ($this->border_radius) 
						{
							?> border-radius: <?php echo $this->border_radius; ?>px;<?php 
						} 
						?>"><?php 

						?><div class="mslider-hover-box-content <?php echo $this->hoverTextColor; ?>"><?php 
							if ($this->hoverBoxDate && isset($item->itemDate)) 
							{
								?><div class="mslider-date"><?php 
									echo $item->itemDate; 
								?></div><?php 
							}

							if ($this->hoverBoxTitle) 
							{
								?><h3 class="mslider-title"><?php 
									if (isset($item->itemLink) && $this->detailBoxTitleLink) 
									{
										?><a href="<?php echo $item->itemLink; ?>"><?php 
											echo $item->hover_itemTitle; 
										?></a><?php 
									} 
									else 
									{
										?><span><?php echo $item->hover_itemTitle; ?></span><?php 
									} 
								?></h3><?php 
							}

							if ($this->hoverBoxCategory || $this->hoverBoxType || $this->hoverBoxAuthor) 
							{
								?><div class="mslider-item-info"><?php 
									if (((isset($item->itemCategoryRaw) && $item->itemCategoryRaw) || (isset($item->itemCategoriesRaw) && $item->itemCategoriesRaw)) && $this->hoverBoxCategory) 
									{
										?><p class="mslider-item-category">
											<span><?php echo JText::_('COM_MINITEKSLIDER_IN'); ?> </span><?php 
											echo $item->itemCategory; 
										?></p><?php 
									}

									if ($this->hoverBoxType) 
									{
										?><p class="mslider-item-category"><?php 
											echo $item->itemType; 
										?></p><?php 
									}

									if (((isset($item->itemAuthorRaw) && $item->itemAuthorRaw) || (isset($item->itemAuthorsRaw) && $item->itemAuthorsRaw)) && $this->hoverBoxAuthor) 
									{
										?><p class="mslider-item-author">
											<span><?php echo JText::_('COM_MINITEKSLIDER_BY'); ?> </span><?php 
											echo $item->itemAuthor; 
										?></p><?php 
									}
								?></div><?php 
							}

							if ($this->hoverBoxIntrotext) 
							{
								if (isset($item->hover_itemIntrotext) && $item->hover_itemIntrotext) 
								{
									?><div class="mslider-desc"><?php 
										echo $item->hover_itemIntrotext; 
									?></div><?php 
								}
							}

							if ($this->hoverBoxHits && isset($item->itemHits)) 
							{
								?><div class="mslider-hits">
									<p><?php echo $item->itemHits; ?>&nbsp;<?php echo JText::_('COM_MINITEKSLIDER_HITS'); ?></p>
								</div><?php 
							}

							if ($this->hoverBoxLinkButton || $this->hoverBoxZoomButton) 
							{
								?><div class="mslider-item-icons"><?php 
									if ($this->hoverBoxLinkButton) 
									{
										if (isset($item->itemLink)) 
										{
											?><a href="<?php echo $item->itemLink; ?>" class="mslider-item-link-icon">
												<i class="fa fa-link"></i>
											</a><?php 
										}
									}

									if ($this->hoverBoxZoomButton && (isset($item->itemImage) && $item->itemImage && $this->slider_images)) 
									{
										?><a data-bs-toggle="modal" data-bs-target="#zoomSlider_<?php echo $this->widgetID; ?>" class="mslider-zoom mslider-item-zoom-icon" data-src="<?php echo $item->itemImage; ?>" data-title="<?php echo htmlspecialchars($item->itemTitleRaw); ?>">
											<i class="fa fa-search"></i>
										</a><?php 
									}
								?></div><?php 
							}
						?></div>
					</div><?php 
				}
			?></div>
		</div><?php 
	}
} 
else 
{
	echo '-'; // =0 // for javascript purposes - Do not remove
}
