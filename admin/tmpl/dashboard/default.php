<?php
/**
* @title		Minitek Slider
* @copyright	Copyright (C) 2011-2020 Minitek, All rights reserved.
* @license		GNU General Public License version 3 or later.
* @author url	https://www.minitek.gr/
* @developers	Minitek.gr
*/

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\URI\URI;
use Joomla\CMS\Session\Session;
use Joomla\Component\MinitekSlider\Administrator\Helper\MinitekSliderHelper;

$local_version = MinitekSliderHelper::localVersion();
$moduleIsInstalled = MinitekSliderHelper::checkModuleIsInstalled();
?>

<div class="minitek-dashboard mt-3">
	<?php if (!$moduleIsInstalled) { ?>
		<div class="alert alert-danger text-center mt-0">
			<div class="update-info">
				<div>
					<span><?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_MODULE_NOT_INSTALLED'); ?></span>
				</div>
				<div class="mt-2">
					<a class="button-success btn btn-sm btn-success" href="https://www.minitek.gr/downloads/minitek-slider-module" target="_blank">
						<span class="icon-download" aria-hidden="true"></span>
						<?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_DOWNLOAD'); ?>
					</a>
				</div>
			</div>
		</div>
	<?php } ?>

	<div class="row">

		<div class="col-sm-12 col-md-8">
			<div class="media mt-0">
				<div class="pull-left">
					<img class="media-object" src="<?php echo URI::root(true).'/administrator/components/com_minitekslider/assets/images/logo.png'; ?>">
				</div>
				<div class="media-body">
			    <h2 class="media-heading"><?php echo Text::_('COM_MINITEKSLIDER'); ?> <span class="badge badge-success">Free</span></h2>
			    <?php echo Text::_('COM_MINITEKSLIDER_DESC'); ?>
			  </div>
			</div>

			<div class="dashboard-thumbnails">
				<div class="thumbnail card">
					<a href="<?php echo Route::_('index.php?option=com_minitekslider&task=widget.add'); ?>">
						<i class="icon icon-new" style="color: #74b974;"></i>
						<span class="thumbnail-title">
							<?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_NEW_WIDGET'); ?>
						</span>
					</a>
				</div>

				<div class="thumbnail card">
					<a href="<?php echo Route::_('index.php?option=com_minitekslider&view=widgets'); ?>">
						<i class="icon icon-grid"></i>
						<span class="thumbnail-title">
							<?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_WIDGETS'); ?>
						</span>
					</a>
				</div>

				<div class="thumbnail card">
					<a href="#" class="disabled" onclick="return: false;">
						<i class="icon icon-folder"></i>
						<span class="thumbnail-title">
							<?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_GROUPS'); ?>
							<span class="badge badge-danger">Pro</span>
						</span>
					</a>
				</div>

				<div class="thumbnail card">
					<a href="#" class="disabled" onclick="return: false;">
						<i class="icon icon-pencil"></i>
						<span class="thumbnail-title">
							<?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_CUSTOM_ITEMS'); ?>
							<span class="badge badge-danger">Pro</span>
						</span>
					</a>
				</div>

				<div class="thumbnail card">
					<a href="<?php echo Route::_('index.php?option=com_config&view=component&component=com_minitekslider&path=&return='.base64_encode(URI::getInstance()->toString())); ?>">
						<i class="icon icon-cog"></i>
						<span class="thumbnail-title">
							<?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_CONFIGURATION'); ?>
						</span>
					</a>
				</div>

				<div class="thumbnail card">
					<a href="<?php echo Route::_('index.php?option=com_minitekslider&task=widgets.deleteCroppedImages&'.Session::getFormToken().'=1'); ?>">
						<i class="icon icon-trash" style="color: #ea7a7a;"></i>
						<span class="thumbnail-title">
							<?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_DELETE_CROPPED_IMAGES'); ?>
						</span>
					</a>
				</div>

				<div class="thumbnail card">
					<a href="https://extensions.joomla.org/extension/photos-a-images/slideshow/minitek-slider/" target="_blank">
						<i class="icon icon-star" style="color: #ffcb52;"></i>
						<span class="thumbnail-title">
							<?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_LIKE_THIS_EXTENSION'); ?><br>
							<span class="small">
								<?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_LEAVE_A_REVIEW_ON_JED'); ?>
							</span>
						</span>
					</a>
				</div>
			</div>
		</div>

		<div class="col-sm-12 col-md-4">

			<div class="dashboard-module">
				<div class="card mb-3">
					<div class="card-header">
						<h4 class="m-0"><?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_SIDEBAR_ABOUT'); ?></h4>
					</div>
					<div class="card-body p-0">
						<ul class="list-group list-group-flush">
							<li class="list-group-item">
								<div><?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_SIDEBAR_EXTENSION'); ?></div>
								<div><a href="https://www.minitek.gr/joomla/extensions/minitek-slider" target="_blank"><?php echo Text::_('COM_MINITEKSLIDER'); ?></a></div>
							</li>
							<li class="list-group-item">
								<div><?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_SIDEBAR_VERSION'); ?></div>
								<div>
									<span class="badge badge-success"><?php echo $local_version; ?></span> <span class="badge badge-success">Free</span>
									<a id="check-version" href="#" class="btn btn-info btn-sm float-right">
										<i class="fas fa-sync"></i>&nbsp;&nbsp;<?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_SIDEBAR_CHECK_VERSION'); ?>
									</a>
								</div>
							</li>
							<li class="list-group-item">
								<div><?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_SIDEBAR_DEVELOPER'); ?></div>
								<div><a href="https://www.minitek.gr/" target="_blank">Minitek</a></div>
							</li>
							<li class="list-group-item">
								<div><?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_SIDEBAR_LICENSE'); ?></div>
								<div><a href="https://www.minitek.gr/terms-of-service" target="_blank">GNU GPLv3 Commercial</a></div>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="dashboard-module">
				<div class="card mb-3">
					<div class="card-header">
						<h4 class="m-0"><?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_SIDEBAR_QUICK_LINKS'); ?></h4>
					</div>
					<div class="card-body p-0">
						<ul class="list-group list-group-flush">
							<li class="list-group-item">
								<span class="icon-book" aria-hidden="true"></span>&nbsp;
								<span>
									<a href="https://www.minitek.gr/support/documentation/joomla/minitek-slider-j4" target="_blank"><?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_SIDEBAR_DOCUMENTATION'); ?></a>
								</span>
							</li>
							<li class="list-group-item">
								<span class="icon-list" aria-hidden="true"></span>&nbsp;
								<span>
									<a href="https://www.minitek.gr/support/changelogs/joomla/minitek-slider" target="_blank"><?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_SIDEBAR_CHANGELOG'); ?></a>
								</span>
							</li>
							<li class="list-group-item">
								<span class="icon-support" aria-hidden="true"></span>&nbsp;
								<span>
									<a href="https://www.minitek.gr/support/forum/joomla/minitek-slider" target="_blank"><?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_SIDEBAR_TECHNICAL_SUPPORT'); ?></a>
								</span>
							</li>
							<li class="list-group-item">
								<span class="icon-help" aria-hidden="true"></span>&nbsp;
								<span>
									<a href="https://www.minitek.gr/support/documentation/joomla/minitek-slider-j4/faq" target="_blank"><?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_SIDEBAR_FAQ'); ?></a>
								</span>
							</li>
							<li class="list-group-item">
								<span class="icon-question" aria-hidden="true"></span>&nbsp;
								<span>
									<a href="https://www.minitek.gr/support/documentation/joomla/minitek-slider-j4/free-vs-pro" target="_blank"><?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_SIDEBAR_FREE_VS_PRO'); ?></a>
								</span>
							</li>
							<li class="list-group-item">
								<span class="icon-lock" aria-hidden="true"></span>&nbsp;
								<span>
									<a href="https://www.minitek.gr/joomla/extensions/minitek-slider#subscriptionPlans" target="_blank"><?php echo Text::_('COM_MINITEKSLIDER_DASHBOARD_UPGRADE_TO_PRO'); ?></a>
								</span>
							</li>
						</ul>
					</div>
				</div>
			</div>

		</div>

	</div>
</div>
