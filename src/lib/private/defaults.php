<?php

if (file_exists(OC::$SERVERROOT . '/themes/' . OC_Util::getTheme() . '/defaults.php')) {
	require_once 'themes/' . OC_Util::getTheme() . '/defaults.php';
}

/**
 * Default strings and values which differ between the enterprise and the
 * community edition. Use the get methods to always get the right strings.
 */
class OC_Defaults {

	private $theme;
	private $l;

	private $defaultEntity;
	private $defaultName;
	private $defaultTitle;
	private $defaultBaseUrl;
	private $defaultSyncClientUrl;
	private $defaultDocBaseUrl;
	private $defaultSlogan;
	private $defaultLogoClaim;

	function __construct() {
		$this->l = OC_L10N::get('core');

		$this->defaultEntity = "ownCloud"; /* e.g. company name, used for footers and copyright notices */
		$this->defaultName = "ownCloud"; /* short name, used when referring to the software */
		$this->defaultTitle = "ownCloud"; /* can be a longer name, for titles */
		$this->defaultBaseUrl = "http://owncloud.org";
		$this->defaultSyncClientUrl = " http://owncloud.org/sync-clients/";
		$this->defaultDocBaseUrl = "http://doc.owncloud.org";
		$this->defaultSlogan = $this->l->t("web services under your control");
		$this->defaultLogoClaim = "";

		if (class_exists("OC_Theme")) {
			$this->theme = new OC_Theme();
		}
	}

	private function themeExist($method) {
		if (OC_Util::getTheme() !== '' && method_exists('OC_Theme', $method)) {
			return true;
		}
		return false;
	}

	/**
	 * Returns the base URL
	 * @return string URL
	 */
	public function getBaseUrl() {
		if ($this->themeExist('getBaseUrl')) {
			return $this->theme->getBaseUrl();
		} else {
			return $this->defaultBaseUrl;
		}
	}

	/**
	 * Returns the URL where the sync clients are listed
	 * @return string URL
	 */
	public function getSyncClientUrl() {
		if ($this->themeExist('getSyncClientUrl')) {
			return $this->theme->getSyncClientUrl();
		} else {
			return $this->defaultSyncClientUrl;
		}
	}

	/**
	 * Returns the documentation URL
	 * @return string URL
	 */
	public function getDocBaseUrl() {
		if ($this->themeExist('getDocBaseUrl')) {
			return $this->theme->getDocBaseUrl();
		} else {
			return $this->defaultDocBaseUrl;
		}
	}

	/**
	 * Returns the title
	 * @return string title
	 */
	public function getTitle() {
		if ($this->themeExist('getTitle')) {
			return $this->theme->getTitle();
		} else {
			return $this->defaultTitle;
		}
	}

	/**
	 * Returns the short name of the software
	 * @return string title
	 */
	public function getName() {
		if ($this->themeExist('getName')) {
			return $this->theme->getName();
		} else {
			return $this->defaultName;
		}
	}

	/**
	 * Returns entity (e.g. company name) - used for footer, copyright
	 * @return string entity name
	 */
	public function getEntity() {
		if ($this->themeExist('getEntity')) {
			return $this->theme->getEntity();
		} else {
			return $this->defaultEntity;
		}
	}

	/**
	 * Returns slogan
	 * @return string slogan
	 */
	public function getSlogan() {
		if ($this->themeExist('getSlogan')) {
			return $this->theme->getSlogan();
		} else {
			return $this->defaultSlogan;
		}
	}

	/**
	 * Returns logo claim
	 * @return string logo claim
	 */
	public function getLogoClaim() {
		if ($this->themeExist('getLogoClaim')) {
			return $this->theme->getLogoClaim();
		} else {
			return $this->defaultLogoClaim;
		}
	}

	/**
	 * Returns short version of the footer
	 * @return string short footer
	 */
	public function getShortFooter() {
		if ($this->themeExist('getShortFooter')) {
			$footer = $this->theme->getShortFooter();
		} else {
			$footer = "<a href=\"". $this->getBaseUrl() . "\" target=\"_blank\">" .$this->getEntity() . "</a>".
				' – ' . $this->getSlogan();
		}

		return $footer;
	}

	/**
	 * Returns long version of the footer
	 * @return string long footer
	 */
	public function getLongFooter() {
		if ($this->themeExist('getLongFooter')) {
			$footer = $this->theme->getLongFooter();
		} else {
			$footer = $this->getShortFooter();
		}

		return $footer;
	}

	public function buildDocLinkToKey($key) {
		if ($this->themeExist('buildDocLinkToKey')) {
			return $this->theme->buildDocLinkToKey($key);
		}
		return $this->getDocBaseUrl() . '/server/6.0/go.php?to=' . $key;
	}

}
