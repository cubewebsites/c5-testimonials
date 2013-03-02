c5-testimonials
===============

Cube Websites Concrete5 Testimonials Package

## Concrete 5.4.0.5 Users
I have now created a branch for Concrete 5.4.0.5.
Please visit https://github.com/cubewebsites/c5-testimonials/tree/concrete5.4 to get it

## Description

This package allows you to easily create, manage and display testimonials on your Concrete5 powered websites.

The following fields are available to you:

* Title
* Author
* Department
* Quote
* URL
* Display Order
* Testimonial date

When adding a block you can choose specific testimonials to display, or display all.  Additionally, you can sort by display order, or in a random order.

## Requirements

    Concrete >= 5.5.0

## Installation

1. From the dashboard, go to "Extend Concrete5"
2. Install Cube Testimonials

You should now have a new section available in the Dashboard called "Cube Testimonials".  When editing a page you'll have the option to add a block called "Testimonials"

## Display Customisation

You can copy the blocks/testimonials/view.php file into a local blocks/testimonials/view.php to customise it to your hearts' content.  

The new `Testimonial` date field is not displayed in the default view, but you can load it into your view file by calling the method `$t->getDate()`

For example add the following in the `view.php` file

    <?php echo date('j M Y',strtotime($t->getDate())) ?>

The above example makes use of the [PHP date](http://php.net/manual/en/function.date.php) method for the date formatting.

### Markup and Themes

The package itself does not contain any styling, this is entirely upto you.  However, the markup used is compatible with Twitter Bootstrap so if you have that then you'll get some nice styling to get you started.

## Changelog

*2013-03-02*

1.  Fixed bug which was causing websites to load very slowly

*2013-02-27*

1.  Caching now disabled so that "Random" display works correctly  
1.  Added `Testimonial Date` field  
1.  Can _Save and Add Another_ testimonial  

2012-08-27 - Initial Release

## Author

[Cube Websites](http://cubewebsites.com)