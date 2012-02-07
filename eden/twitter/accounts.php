<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2011-2012 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

/**
 * Twitter Account 
 *
 * @package    Eden
 * @category   twitter
 * @author     Christian Symon M. Buenavista sbuenavista@openovate.com
 */
class Eden_Twitter_Accounts extends Eden_Twitter_Base {
	/* Constants
	-------------------------------*/
	const URL_LIMIT_STATUS			= 'https://api.twitter.com/1/account/rate_limit_status.json';
	const URL_VERIFY_CREDENTIALS	= 'https://api.twitter.com/1/account/verify_credentials.json';
	const URL_END_SESSION			= 'https://api.twitter.com/1/account/end_session.json';
	const URL_UPDATE_PROFILE		= 'https://api.twitter.com/1/account/update_profile.json';
	const URL_UPDATE_BACKGROUND		= 'https://api.twitter.com/1/account/update_profile_background_image.json';
	const URL_UPDATE_PROFILE_COLOR	= 'https://api.twitter.com/1/account/update_profile_colors.json';
	
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_entities	= false;
	protected $_status		= false;
	protected $_use			= false;
	protected $_name		= NULL;
	protected $_url			= NULL;
	protected $_location	= NULL;
	protected $_description	= NULL;
	protected $_image		= NULL;
	protected $_tile		= NULL;
	protected $_background	= NULL;
	protected $_link		= NULL;
	protected $_border		= NULL;
	protected $_fill		= NULL;
	protected $_text		= NULL;
	
	/* Private Properties
	-------------------------------*/
	/* Magic
	-------------------------------*/
	public static function i() {
		return self::_getMultiple(__CLASS__);
	}
	
	/* Public Methods
	-------------------------------*/
	/**
	 * Set profile background color
	 *
	 * @param string
	 * @return this
	 */
	public function setBackgroundColor($background) {
		//Argument 3 must be a string
		Eden_Twitter_Error::i()->argument(1, 'string');
		
		$this->_background = $background;
		return $this;
	}
	
	/**
	 * Set profile link color
	 *
	 * @param string
	 * @return this
	 */
	public function setLinkColor($link) {
		//Argument 3 must be a string
		Eden_Twitter_Error::i()->argument(1, 'string');
		
		$this->_link = $link;
		return $this;
	}
	
	/**
	 * Set profile sibebar border color
	 *
	 * @param string
	 * @return this
	 */
	public function setBorderColor($border) {
		//Argument 3 must be a string
		Eden_Twitter_Error::i()->argument(1, 'string');
		
		$this->_border = $border;
		return $this;
	}
	
	/**
	 * Set profile sibebar fill color
	 *
	 * @param string
	 * @return this
	 */
	public function setFillColor($fill) {
		//Argument 3 must be a string
		Eden_Twitter_Error::i()->argument(1, 'string');
		
		$this->_fill = $fill;
		return $this;
	}
	
	/**
	 * Set profile text color
	 *
	 * @param string
	 * @return this
	 */
	public function setTextColor($text) {
		//Argument 3 must be a string
		Eden_Twitter_Error::i()->argument(1, 'string');
		
		$this->_text = $text;
		return $this;
	}
	
	/**
	 * Set image
	 *
	 * @param string
	 * @return this
	 */
	public function setImage($image) {
		//Argument 1 must be a string or null
		Eden_Twitter_Error::i()->argument(1, 'string');
		
		$this->_image = $image;
		return $this;
	}
	
	/**
	 * Set tile
	 *
	 * @param string
	 * @return this
	 */
	public function setTile($tile) {
		//Argument 1 must be a string or null
		Eden_Twitter_Error::i()->argument(1, 'string');
		
		$this->_tile = $tile;
		return $this;
	}
	
	/**
	 * Set name
	 *
	 * @param string
	 * @return this
	 */
	public function setName($name) {
		//Argument 1 must be a string or null
		Eden_Twitter_Error::i()->argument(1, 'string');
		
		$this->_name = $name;
		return $this;
	
	}
	
	/**
	 * Set url
	 *
	 * @param string
	 * @return this
	 */
	public function setUrl($url) {
		//Argument 1 must be a string or null
		Eden_Twitter_Error::i()->argument(1, 'string');
		
		$this->_url = $url;
		return $this;
	
	}
	
	/**
	 * Set location
	 *
	 * @param string
	 * @return this
	 */
	public function setLocation($location) {
		//Argument 1 must be a string or null
		Eden_Twitter_Error::i()->argument(1, 'string');
		
		$this->_location = $location;
		return $this;
	
	}
	
	/**
	 * Set description
	 *
	 * @param string
	 * @return this
	 */
	public function setDescriptione($description) {
		//Argument 1 must be a string or null
		Eden_Twitter_Error::i()->argument(1, 'string');
		
		$this->_description = $description;
		return $this;
	
	}
	
	/**
	 * Set use
	 *
	 * @return this
	 */
	public function setUse() {
		$this->_use = true;
		return $this;
	}
	
	/**
	 * Set include entities
	 *
	 * @return this
	 */
	public function setEntities() {
		$this->_entities = true;
		return $this;
	}
	
	/**
	 * Set skip status
	 *
	 * @return this
	 */
	public function setStatus() {
		$this->_status = true;
		return $this;
	}
	
	/**
	 * Returns the remaining number of API 
	 * requests available to the requesting 
	 * user before the API limit is reached 
	 * for the current hour.
	 *
	 * @return array
	 */
	public function getLimit() {
		return $this->_getResponse(self::URL_LIMIT_STATUS);
	} 
	 
	/**
	 * Returns an HTTP 200 OK response code and
	 * a representation of the requesting user 
	 * if authentication was successful 
	 *
	 * @return array
	 */
	public function getCredentials() {
		//populate fields
		$query = array(
			'include_entities'	=> $this->_entities,
			'skip_status'		=> $this->_status);
			
		return $this->_getResponse(self::URL_VERIFY_CREDENTIALS, $query);
	}
	 
	/**
	 * Ends the session of the authenticating user, returning a null cookie. 
	 * Use this method to sign users out of client-facing applications like widgets.
	 *
	 * @return string
	 */
	public function logOut() {
		return $this->_post(self::URL_END_SESSION);
	}
	 
	/**
	 * Sets values that users are able to set 
	 * under the "Account" tab of their settings 
	 * page. Only the parameters specified 
	 * will be updated.
	 *
	 * @return array
	 */
	public function updateProfile() {
		//populate fields
		$query = array(
			'include_entities'	=> $this->_entities,
			'skip_status'		=> $this->_status,
			'name'				=> $this->_name,
			'url'				=> $this->_url,
			'location'			=> $this->_location,
			'description'		=> $this->_description);
		
		return $this->_post(self::URL_UPDATE_PROFILE, $query);
	}
	 
	/**
	 * Updates the authenticating user's profile background image. 
	 * This method can also be used to enable or disable the profile 
	 * background image
	 *
	 * @return array
	 */
	public function updateBackground() {
		//populate fields
		$query = array(
			'include_entities'	=> $this->_entities,
			'skip_status'		=> $this->_status,
			'use'				=> $this->_use,
			'image'				=> $this->_image,
			'tile'				=> $this->_tile);
		
		return $this->_post(self::URL_UPDATE_BACKGROUND, $query);
	}
	 
	/**
	 * Sets values that users are able to 
	 * set under the Account tab of their
	 * settings page. Only the parameters 
	 * specified will be updated.
	 *
	 * @return array
	 */
	public function updateColor() {
		//populate fields
		$query = array(
			'include_entities'				=> $this->_entities,
			'skip_status'					=> $this->_status,
			'profile_background_color'		=> $this->_background,
			'profile_link_color'			=> $this->_link,
			'profile_sidebar_border_color'	=> $this->_border,
			'profile_sidebar_fill_color'	=> $this->_fill,
			'profile_text_color'			=> $this->_text);
		
		return $this->_post(self::URL_UPDATE_PROFILE_COLOR, $query);
		
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/ 
}