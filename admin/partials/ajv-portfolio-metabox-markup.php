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
				<label for="_ajv_portfolio_description"><?php echo esc_html__( 'Short Description', 'ajv-portfolio' ); ?></label>
			</th>
			<td>
				<p>
					<textarea class="widefat" rows="4" cols="78" name="_ajv_portfolio_description" id="_ajv_portfolio_description"><?php echo isset( $portfolio_stored_meta['_ajv_portfolio_description'] ) ? esc_attr( $portfolio_stored_meta['_ajv_portfolio_description'][0] ) : ''; ?></textarea>
				</p>
				<p>
					<span class="description"><em><?php echo esc_html__( 'Enter a short description for the project.', 'ajv-portfolio' ); ?></em></span>
				</p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="_ajv_portfolio_client"><?php echo esc_html__( 'Client Name', 'ajv-portfolio' ); ?></label>
			</th>
			<td>
				<p>
					<input class="widefat" type="text" name="_ajv_portfolio_client" id="_ajv_portfolio_client" value="<?php echo isset( $portfolio_stored_meta['_ajv_portfolio_client'] ) ? esc_attr( $portfolio_stored_meta['_ajv_portfolio_client'][0] ) : ''; ?>">
				</p>
				<p>
					<span class="description"><em><?php echo esc_html__( 'Enter the client\'s name.', 'ajv-portfolio' ); ?></em></span>
				</p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="_ajv_portfolio_company"><?php echo esc_html__( 'Client Company', 'ajv-portfolio' ); ?></label>
			</th>
			<td>
				<p>
					<input class="widefat" type="text" name="_ajv_portfolio_company" id="_ajv_portfolio_company" value="<?php echo isset( $portfolio_stored_meta['_ajv_portfolio_company'] ) ? esc_attr( $portfolio_stored_meta['_ajv_portfolio_company'][0] ) : ''; ?>">
				</p>
				<p>
					<span class="description"><em><?php echo esc_html__( 'Enter the name of the client\'s company, business, or organization.', 'ajv-portfolio' ); ?></em></span>
				</p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="_ajv_portfolio_url"><?php echo esc_html__( 'Link URL', 'ajv-portfolio' ); ?></label>
			</th>
			<td>
				<p>
					<input class="widefat" type="text" name="_ajv_portfolio_url" id="_ajv_portfolio_url" value="<?php echo isset( $portfolio_stored_meta['_ajv_portfolio_url'] ) ? esc_url( $portfolio_stored_meta['_ajv_portfolio_url'][0] ) : ''; ?>" placeholder="http://...">
				</p>
				<p>
					<span class="description"><em><?php echo esc_html__( 'Enter the link to the client\'s site, or the web page where the work is displayed.', 'ajv-portfolio' ); ?></em></span>
				</p>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="_ajv_portfolio_url_text"><?php echo esc_html__( 'Link Text', 'ajv-portfolio' ); ?></label>
			</th>
			<td>
				<p>
					<input class="widefat" type="text" name="_ajv_portfolio_url_text" id="_ajv_portfolio_url_text" value="<?php echo isset( $portfolio_stored_meta['_ajv_portfolio_url_text'] ) ? esc_attr( $portfolio_stored_meta['_ajv_portfolio_url_text'][0] ) : ''; ?>">
				</p>
				<p>
					<span class="description"><em><?php echo esc_html__( 'Enter the link\'s anchor text.', 'ajv-portfolio' ); ?></em></span>
				</p>
			</td>
		</tr>
	</tbody>
</table>
