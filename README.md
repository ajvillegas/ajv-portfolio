# AJV Portfolio

This plugin adds a portfolio section to your website.

**Contributors**: [ajvillegas](http://profiles.wordpress.org/ajvillegas)  
**Tags**: [portfolio](http://wordpress.org/plugins/tags/portfolio), [admin](http://wordpress.org/plugins/tags/admin), [custom post type](http://wordpress.org/plugins/tags/custom-post-type)  
**Requires at least**: 4.5  
**Tested up to**: 4.8  
**Stable tag**: 1.0.0  
**License**: [GPLv2 or later](http://www.gnu.org/licenses/gpl-2.0.html)

# Description

This plugin adds a portfolio section to your website by registering a new 'Portfolio' custom post type and custom taxonomy for categorizing portfolio items.

**Custom Post Type Parameters**

You can alter any of the custom post type and custom taxonomy parameters using the `ajv_portfolio_post_type_filter` and the `ajv_portfolio_taxonomy_filter` respectively. For a look at the plugin's default parameters, please refer to the `AJV_Portfolio_CPT` class under `ajv-portfolio/admin/class-ajv-portfolio-cpt.php`.

**Note:** If you update the rewrite parameter with these filters, make sure to also update your permalinks by visiting the permalinks settings page.

**Custom Post Meta Box**

The plugin adds a custom post meta box to the portfolio editor screen that allows you to enter metadata relevant to each portfolio item.

To retrieve the meta box options use `get_post_meta`. The following example shows how you can implement this on your theme's template file.

```php
<?php

// Get post meta
$description = get_post_meta( get_the_ID(), '_ajv_portfolio_description', true );
$client = get_post_meta( get_the_ID(), '_ajv_portfolio_client', true );
$company = get_post_meta( get_the_ID(), '_ajv_portfolio_company', true );
$url = get_post_meta( get_the_ID(), '_ajv_portfolio_url', true );

?>
<div class="portfolio-post-meta">
    <h4><?php echo __( 'Description:', 'my-text-domain' ); ?></h4>
    <p><?php echo $description; ?></p>
	
    <h4><?php echo __( 'Client:', 'my-text-domain' ); ?></h4>
    <p>
        <span class="client"><?php echo $client; ?></span>
        <span class="company"><?php echo ', ' . $company; ?></span>
    </p>
	
    <a class="button" href="<?php echo $url; ?>" target="_blank"><?php echo __( 'View Project', 'my-text-domain' ); ?></a>
</div>
<?php
```

For more information, please refer to this page: [get_post_meta()](https://developer.wordpress.org/reference/functions/get_post_meta/).

# Installation

**Using The WordPress Dashboard**

1. Navigate to the 'Add New' Plugin Dashboard
2. Click on 'Upload Plugin' and select `ajv-portfolio.zip` from your computer
3. Click on 'Install Now'
4. Activate the plugin on the WordPress Plugins Dashboard

**Using FTP**

1. Extract `ajv-portfolio.zip` to your computer
2. Upload the `ajv-portfolio` directory to your `wp-content/plugins` directory
3. Activate the plugin on the WordPress Plugins Dashboard

# Screenshots

*Admin table view*

![Admin table view](wp-assets/screenshot-1.png?raw=true)

*Custom post meta box*

![Custom post meta box](wp-assets/screenshot-2.png?raw=true)

# Changelog

**1.0.0**
* Initial release.
