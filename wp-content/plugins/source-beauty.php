<?php
/**
Plugin Name: Source Beauty
Plugin URI:  http://wordpress.org/#
Description: Beautifier for &lt;source&gt; tags
Author:      jahson
Version:     1.2.0
*/

// TODO: read carefully next links
// http://codex.wordpress.org/Writing_a_Plugin
// http://planetozh.com/blog/2009/09/top-10-most-common-coding-mistakes-in-wordpress-plugins/

function beautify_source( $source )
{
	// normalize newlines
	$source = str_replace( "\r", "\n", $source );
	$source = preg_replace( "/\n\n/", "\n", $source );

	$lines = explode( "\n", $source );
	foreach ( $lines as $key => $line ) {
		$line = rtrim( $line );
		if ( !empty( $line ) ) {
			// Replace tabs with spaces, encode and wrap in <code>
			// TODO: possible option for indent width
			$line = str_replace( "\t", '    ', $line );
			$line = htmlspecialchars( $line, ENT_QUOTES, 'UTF-8' );
			$line = "<code>{$line}</code>";
		}

		$lines[$key] = $line;
	}

	$source = implode( "\n", $lines );

	return "<pre>\n{$source}\n</pre>";
}

function beautify_sources_in_text( $text )
{
	$opening_tag = '<source>';
	$len_opening = strlen( $opening_tag );

	$closing_tag = '</source>';
	$len_closing = strlen( $closing_tag );

	$result = '';
	while ( '' !== $text ) {
		$inner_text = '';

		$opening_position = strpos( $text, $opening_tag );
		$closing_position = strpos( $text, $closing_tag );

		$start = $opening_position + $len_opening;

		// No more source tags in text
		if ( false === $opening_position && false === $closing_position ) {
			$result .= $text;
			break;
		}

		$result .= substr( $text, 0, $opening_position );

		// Count number of other opening tags between first opening and first
		// closing tags
		$number_of_opening = substr_count(
			$text,
			$opening_tag,
			$start,
			$closing_position - $start
		);

		// Move to proper closing tag position
		// We are moving forward to next closing tag while number of opening
		// tags is constant.
		$new_number_of_opening = $number_of_opening;
		while ( $new_number_of_opening === $number_of_opening ) {
			$new_closing_position = strpos(
				$text,
				$closing_tag,
				$closing_position + $len_closing
			);

			if ( false === $new_closing_position ) {
				// No more closing tags
				break;
			} else {
				$new_number_of_opening = substr_count(
					$text,
					$opening_tag,
					$start,
					// NOTE: $new_closing_position is used here instead of
					// $closing_position
					$new_closing_position - $start
				);

				if ( $new_number_of_opening === $number_of_opening ) {
					$closing_position = $new_closing_position;
				} else {
					// Exit because we about to move into next tag
					break;
				}
			}
		}

		$inner_text = substr( $text, $start, $closing_position - $start );
		$text = substr( $text, $closing_position + $len_closing );

		$result .= beautify_source( $inner_text );
	}

	return $result;
}

add_filter( 'pre_comment_content', 'beautify_sources_in_text', 0 );
add_filter( 'content_save_pre', 'beautify_sources_in_text', 0 );

/* vim: set ts=4 sw=4 noexpandtab: */
