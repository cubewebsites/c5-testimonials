<?php
defined('C5_EXECUTE') or die("Access Denied.");

class CubeTestimonialsPackage extends Package {
	protected $pkgHandle            =   'cube_testimonials';
	protected $appVersionRequired   =   '5.5.2.1';
	protected $pkgVersion           =   '0.0.2';


	public function getPackageDescription() {
		return t('Allows creation, management and listing of testimonials');
	}

	public function getPackageName() {
		return t('Cube Testimonials');
	}

	public function install() {
		$pkg    =   parent::install();

		// Setup the block
		BlockType::installBlockTypeFromPackage('testimonials',$pkg);

		// Install the single pages for admin
		Loader::model('single_page');
		$sp =   SinglePage::add('dashboard/cube_testimonials',$pkg);
		$sp->update(array('cName'=>t('Cube Testimonials'),'cDescription'=>t('Manage Testimonials')));

		// Install the single pages for admin
		Loader::model('single_page');
		$sp =   SinglePage::add('dashboard/cube_testimonials/manage',$pkg);
		$sp->update(array('cName'=>t('Manage Testimonials'),'cDescription'=>t('Manage Testimonials'),'cDisplayOrder'=>1));

		$sp =   SinglePage::add('dashboard/cube_testimonials/add',$pkg);
		$sp->update(array('cName'=>t('Add Testimonial'),'cDescription'=>t('Add / Edit Testimonial'),'cDisplayOrder'=>2));


	}

}