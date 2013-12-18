<?php

/**
 * Description of CakeRss
 *
 * Extends SimplePie to test certain features I need before I push to SimplePie Repo
 *
 * @author Angel S. Moreno <angelxmoreno@gmail.com>
 */
class CakeRss extends SimplePie {

	/**
	 * Get the lastBuildDate for the item
	 *
	 * Uses `<lastBuildDate>`
	 *
	 * @since 1.0 (previously called `get_feed_description()` since 0.8)
	 * @return string|null
	 */
	public function get_lastBuildDate($date_format = 'j F Y, g:i a') {
		if ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ATOM_10, 'lastBuildDate')) {
			$date = $this->sanitize($return[0]['data'], $this->registry->call('Misc', 'atom_10_construct_type', array($return[0]['attribs'])), $this->get_base($return[0]));
		} elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ATOM_03, 'lastBuildDate')) {
			$date = $this->sanitize($return[0]['data'], $this->registry->call('Misc', 'atom_03_construct_type', array($return[0]['attribs'])), $this->get_base($return[0]));
		} elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_RSS_10, 'lastBuildDate')) {
			$date = $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_MAYBE_HTML, $this->get_base($return[0]));
		} elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_RSS_090, 'lastBuildDate')) {
			$date = $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_MAYBE_HTML, $this->get_base($return[0]));
		} elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_RSS_20, 'lastBuildDate')) {
			//works
			$date = $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_HTML, $this->get_base($return[0]));
		} elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_DC_11, 'lastBuildDate')) {
			$date = $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		} elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_DC_10, 'lastBuildDate')) {
			$date = $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_TEXT);
		} elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ITUNES, 'lastBuildDate')) {
			$date = $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_HTML, $this->get_base($return[0]));
		} elseif ($return = $this->get_channel_tags(SIMPLEPIE_NAMESPACE_ITUNES, 'lastBuildDate')) {
			$date = $this->sanitize($return[0]['data'], SIMPLEPIE_CONSTRUCT_HTML, $this->get_base($return[0]));
		} else {
			$date = null;
		}
		if($date){
			$date = date($date_format,  strtotime($date));
		}

		return $date;
	}

}
