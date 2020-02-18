<div class="blog">
	<div class="slider-blog d-flex align-items-center">
		<div class="text-wrapper flex-fill text-center">
			<div class="container">
				<div class="row justify-content-md-center">
					<div class="col-md-8">
						<h1 class="text-white text-shadow">BLOG</h1>
						<h3 class="text-white text-shadow font-size-16px mb-4">Vietnam Visa and Travel Tips</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="cluster cluster-news">
		<div class="container">
			<? require_once(APPPATH."views/module/breadcrumb.php"); ?>
			<div class="cluster-body">
				<div class="row">
					<div class="col-lg-9 col-sm-8 col-xs-12">
						<div class="row">
							<div class="col-sm-8">
								<div class="post-content">
									<div class="blog-infinite">
										<? foreach ($items as $value) { 
											$blog_categories = $this->m_blog_category->load($value->catid);
										?>
										<div class="post">
											<div class="post-content-wrapper">
												<? if (!empty($value->thumbnail)) { ?>
												<figure class="image-container">
													<a href="<?=site_url("blog/{$blog_categories->alias}/{$value->alias}")?>" class="hover-effect"><img class="img-fluid" src="<?=BASE_URL.$value->thumbnail?>" alt="<?=$value->title?>"></a>
												</figure>
												<? } ?>
												<div class="details">
													<h3 class="entry-title">
														<a title="<?=$value->title?>" href="<?=site_url("blog/{$blog_categories->alias}/{$value->alias}")?>"><?=$value->title?></a>
													</h3>
													<div class="excerpt-container">
														<?=$value->summary?>
													</div>
													<div class="post-meta">
														<? if (!empty($value->thumbnail)) { ?>
														<div class="entry-date"><?=date("d M Y",strtotime($value->created_date))?></div>
														<? } ?>
														<div class="entry-author fn">
															<b>Posted By:</b> <a href="#" class="author"><?=SITE_NAME?></a>
														</div>
														<div class="entry-action">
															<a href="<?=site_url("blog/{$blog_categories->alias}/{$value->alias}")?>" class="button entry-comment btn-small"><i class="fa fa-comment"></i> <span>Comment</span></a>
														</div>
													</div>
												</div>
											</div>
										</div>
										<? } ?>
									</div>
								</div>
								<div><?=$pagination?></div>
							</div>
							<div class="col-sm-4">
								<? require_once(APPPATH."views/module/latest_items.php"); ?>
								<? require_once(APPPATH."views/module/search.php"); ?>
								<? require_once(APPPATH."views/module/categories.php"); ?>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-4 d-none d-sm-none d-md-block">
						<? require_once(APPPATH."views/module/support.php"); ?>
						<? require_once(APPPATH."views/module/confidence.php"); ?>
						<? require_once(APPPATH."views/module/services.php"); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>