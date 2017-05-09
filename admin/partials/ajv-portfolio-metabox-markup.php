<?php

/**
 * Provide an admin area view for the meta boxes.
 *
 * This file is used to markup the portfolio meta box.
 *
 * @link       http://www.alexisvillegas.com
 * @since      1.0.0
 *
 * @package    AJV_Portfolio
 * @subpackage AJV_Portfolio/admin/partials
 */

?>

<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row">
				<label for="_ajv_portfolio_description"><?php _e( 'Short Description', 'ajv-portfolio' ); ?></label>
			</th>
			<td>
				<p>
					<textarea class="widefat" rows="4" cols="78" name="_ajv_portfolio_description" id="_ajv_portfolio_description"><?php if ( isset ( $portfolio_stored_meta['_ajv_portfolio_description'] ) ) echo esc_attr( $portfolio_stored_meta['_ajv_portfolio_description'][0] ); ?></textarea>
				</p>
				<p>
					<span class="description"><em><?php _e( 'Enter a short description for the project.', 'ajv-portfolio' ) ?></em></span>
				</p>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">
				<label for="_ajv_portfolio_client"><?php _e( 'Client Name', 'ajv-portfolio' ); ?></label>
			</th>
			<td>
				<p>
					<input class="widefat" type="text" name="_ajv_portfolio_client" id="_ajv_portfolio_client" value="<?php if ( isset ( $portfolio_stored_meta['_ajv_portfolio_client'] ) ) echo esc_attr( $portfolio_stored_meta['_ajv_portfolio_client'][0] ); ?>">
				</p>
				<p>
					<span class="description"><em><?php _e( 'Enter the client\'s name.', 'ajv-portfolio' ) ?></em></span>
				</p>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">
				<label for="_ajv_portfolio_company"><?php _e( 'Client Company', 'ajv-portfolio' ); ?></label>
			</th>
			<td>
				<p>
					<input class="widefat" type="text" name="_ajv_portfolio_company" id="_ajv_portfolio_company" value="<?php if ( isset ( $portfolio_stored_meta['_ajv_portfolio_company'] ) ) echo esc_attr( $portfolio_stored_meta['_ajv_portfolio_company'][0] ); ?>">
				</p>
				<p>
					<span class="description"><em><?php _e( 'Enter the name of the client\'s company, business, or organization.', 'ajv-portfolio' ) ?></em></span>
				</p>
			</td>
		</tr>
		
		<tr valign="top">
			<th scope="row">
				<label for="_ajv_portfolio_url"><?php _e( 'Link URL', 'ajv-portfolio' ); ?></label>
			</th>
			<td>
				<p>
					<input class="widefat" type="text" name="_ajv_portfolio_url" id="_ajv_portfolio_url" value="<?php if ( isset ( $portfolio_stored_meta['_ajv_portfolio_url'] ) ) echo esc_url( $portfolio_stored_meta['_ajv_portfolio_url'][0] ); ?>" placeholder="http://...">
				</p>
				<p>
					<span class="description"><em><?php _e( 'Enter the link to the client\'s site, or the web page where the work is displayed.', 'ajv-portfolio' ) ?></em></span>
				</p>
			</td>
		</tr>
	</tbody>
</table>
