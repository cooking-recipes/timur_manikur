<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		$config_meta_title = $this->config->get('config_meta_title');
		$config_meta_description = $this->config->get('config_meta_description');
		$config_name = $this->config->get('config_name');

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}


				$data['alternate'] = '';
				$mlseo = $this->config->get('mlseo');
				if (isset($mlseo['hreflang'])) {	
					$this->load->model('localisation/language');
					$languages = $this->model_localisation_language->getLanguages();
					
					if (isset($this->request->get['route'])) {
						if ($this->request->get['route'] == 'product/product') {
							foreach($languages as $xlanguage) {
								if ($xlanguage['code'] != $this->session->data['language']) {								
								
								$squery = $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_language'");
								if (isset($xlanguage['code']) && ($xlanguage['code'] != $squery->row['value'])) {$url = $xlanguage['code'].'/';}
									else {$url = '';} 
									
								$query = $this->db->query("select * from " . DB_PREFIX . "url_alias where CONCAT('product_id=', CAST(".$this->request->get['product_id']." as CHAR)) = query and language_id = ".  $xlanguage['language_id']);
								if ($query->num_rows) {
									$url .= $query->row['keyword'];
								}
								
								$data['alternate'] .='<link rel="alternate" hreflang="'.$xlanguage['code'].'" href="'.HTTP_SERVER.$url.'" />';
								 
								}
							}
						}
						
						if ($this->request->get['route'] == 'product/category') {
							$xcats = explode('_', $this->request->get['path']); $xcat = end($xcats);
							foreach($languages as $xlanguage) {
								if ($xlanguage['code'] != $this->session->data['language']) {								
								
								$squery = $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_language'");
								if (isset($xlanguage['code']) && ($xlanguage['code'] != $squery->row['value'])) {$url = $xlanguage['code'].'/';}
									else {$url = '';} 
									
								$query = $this->db->query("select * from " . DB_PREFIX . "url_alias where CONCAT('category_id=', CAST(".$xcat." as CHAR)) = query and language_id = ".  $xlanguage['language_id']);
								if ($query->num_rows) {
									$url .= $query->row['keyword'];
								}
								
								$data['alternate'] .='<link rel="alternate" hreflang="'.$xlanguage['code'].'" href="'.HTTP_SERVER.$url.'" />';
								 
								}
							}
						}
						
						if ($this->request->get['route'] == 'product/manufacturer/info') {
							foreach($languages as $xlanguage) {
								if ($xlanguage['code'] != $this->session->data['language']) {								
								
								$squery = $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_language'");
								if (isset($xlanguage['code']) && ($xlanguage['code'] != $squery->row['value'])) {$url = $xlanguage['code'].'/';}
									else {$url = '';} 
									
								$query = $this->db->query("select * from " . DB_PREFIX . "url_alias where CONCAT('manufacturer_id=', CAST(".$this->request->get['manufacturer_id']." as CHAR)) = query and language_id = ".  $xlanguage['language_id']);
								if ($query->num_rows) {
									$url .= $query->row['keyword'];
								}
								
								$data['alternate'] .='<link rel="alternate" hreflang="'.$xlanguage['code'].'" href="'.HTTP_SERVER.$url.'" />';
								 
								}
							}
						}
						
						if ($this->request->get['route'] == 'information/information') {
							foreach($languages as $xlanguage) {
								if ($xlanguage['code'] != $this->session->data['language']) {								
								
								$squery = $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_language'");
								if (isset($xlanguage['code']) && ($xlanguage['code'] != $squery->row['value'])) {$url = $xlanguage['code'].'/';}
									else {$url = '';} 
									
								$query = $this->db->query("select * from " . DB_PREFIX . "url_alias where CONCAT('information_id=', CAST(".$this->request->get['information_id']." as CHAR)) = query and language_id = ".  $xlanguage['language_id']);
								if ($query->num_rows) {
									$url .= $query->row['keyword'];
								}
								
								$data['alternate'] .='<link rel="alternate" hreflang="'.$xlanguage['code'].'" href="'.HTTP_SERVER.$url.'" />';
								 
								}
							}
						}
						
						
					
					}
				}
				
				
		$data['base'] = $server;
		$data['title'] = $this->document->getTitle();
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();

				
				foreach ($data['links'] as $link) { 
					if ($link['rel']=='canonical') {$hasCanonical = true;} 
					} 
				$data['canonical_link'] = '';
				$canonicals = $this->config->get('canonicals'); 
				if (!isset($hasCanonical) && isset($this->request->get['route']) && (isset($canonicals['canonicals_extended']))) {
					$data['canonical_link'] = $this->url->link($this->request->get['route']);					
					}
				
				
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');
		$data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		$data['name'] = $this->config->get('config_name');
 
			$data['maintenance'] = $this->config->get('config_maintenance');
			
		$data['alter_lang'] = $this->getAlterLanguageLinks($this->document->getLinks());
		$data['config_comment'] = html_entity_decode($this->config->get('config_comment'));

		if($_SERVER['REQUEST_URI'] == '/')
		{
			$data['title'] = $config_meta_title;
			$data['description'] = $config_meta_description;
		}
		else
		{
			$data['title'] = $this->document->getTitle(). ' &mdash; '.$config_meta_title;
			$data['description'] = $this->document->getDescription() . '. '.$config_meta_title;
		}

		// ПРАВИЛЬНАЯ НАСТРОЙКА TITLE
		//var_dump(mb_strlen($data['title']));
		if(mb_strlen($data['title']) > 70) {
			$data['title'] = str_replace($config_meta_title, $config_name.' - всё для маникюра', $data['title']);
			if(mb_strlen($data['title']) > 70) {
				$data['title'] = str_replace($config_meta_title, $config_name, $data['title']);
				//var_dump(mb_strlen($data['title']));
				if (mb_strlen($data['title']) > 70) {
					$data['title'] = str_replace(' &mdash; ' . $config_name, '', $data['title']);
					//var_dump(mb_strlen($data['title']));
					if (mb_strlen($data['title']) > 70)
						$data['title'] = mb_substr($data['title'], 0, 70);
				}
			}
		}

		// ПРАВИЛЬНАЯ НАСТРОЙКА DESCRIPTION
		if(mb_strlen($data['description']) > 160) {
			$data['description'] = str_replace($config_meta_title, $config_name, $data['description']);
			if(mb_strlen($data['description']) > 160) {
				$data['description'] = str_replace('. '.$config_name, '', $data['description']);
				if(mb_strlen($data['description']) > 160)
					$data['description'] = mb_substr($data['description'], 0, 160);
			}
		}
 
			$data['maintenance'] = $this->config->get('config_maintenance');
			
		$data['alter_lang'] = $this->getAlterLanguageLinks($this->document->getLinks());

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		} else {
			$data['icon'] = '';
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

 
			if (($data['maintenance']==0)) {
			$data['informations'] = array();
			foreach ($this->model_catalog_information->getInformations() as $result) {
				if ($result['bottom']) {
					$data['informations'][] = array(
						'title' => $result['title'],
						'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
					);
				}
			}	
		}
			
 
			if (($data['maintenance']==0)) {
			$data['informations'] = array();
			foreach ($this->model_catalog_information->getInformations() as $result) {
				if ($result['bottom']) {
					$data['informations'][] = array(
						'title' => $result['title'],
						'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
					);
				}
			}	
		}
			
		$this->load->language('common/header');

		$data['text_home'] = $this->language->get('text_home');
		$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		$data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));

		$data['text_account'] = $this->language->get('text_account');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_category'] = $this->language->get('text_category');
 
			
			$data['text_shopcart'] = $this->language->get('text_shopcart');
			$data['text_information'] = $this->language->get('text_information');
			$data['text_service'] = $this->language->get('text_service');
			$data['text_extra'] = $this->language->get('text_extra');
			$data['text_account'] = $this->language->get('text_account');
			$data['text_contact'] = $this->language->get('text_contact');
			$data['text_return'] = $this->language->get('text_return');
			$data['text_sitemap'] = $this->language->get('text_sitemap');
			$data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$data['text_voucher'] = $this->language->get('text_voucher');
			$data['text_affiliate'] = $this->language->get('text_affiliate');
			$data['text_special'] = $this->language->get('text_special');
			$data['text_account'] = $this->language->get('text_account');
			$data['text_order'] = $this->language->get('text_order');
			$data['text_newsletter'] = $this->language->get('text_newsletter');
			$data['text_category'] = $this->language->get('text_category');
			
			
 
			
			$data['text_shopcart'] = $this->language->get('text_shopcart');
			$data['text_information'] = $this->language->get('text_information');
			$data['text_service'] = $this->language->get('text_service');
			$data['text_extra'] = $this->language->get('text_extra');
			$data['text_account'] = $this->language->get('text_account');
			$data['text_contact'] = $this->language->get('text_contact');
			$data['text_return'] = $this->language->get('text_return');
			$data['text_sitemap'] = $this->language->get('text_sitemap');
			$data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$data['text_voucher'] = $this->language->get('text_voucher');
			$data['text_affiliate'] = $this->language->get('text_affiliate');
			$data['text_special'] = $this->language->get('text_special');
			$data['text_account'] = $this->language->get('text_account');
			$data['text_order'] = $this->language->get('text_order');
			$data['text_newsletter'] = $this->language->get('text_newsletter');
			$data['text_category'] = $this->language->get('text_category');
			
			
		$data['text_all'] = $this->language->get('text_all');

		$data['home'] = $this->url->link('common/home');
		$data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$data['logged'] = $this->customer->isLogged();
		$data['account'] = $this->url->link('account/account', '', 'SSL');
		$data['register'] = $this->url->link('account/register', '', 'SSL');
		$data['login'] = $this->url->link('account/login', '', 'SSL');
		$data['order'] = $this->url->link('account/order', '', 'SSL');
		$data['transaction'] = $this->url->link('account/transaction', '', 'SSL');
		$data['download'] = $this->url->link('account/download', '', 'SSL');
		$data['logout'] = $this->url->link('account/logout', '', 'SSL');
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
		$data['contact'] = $this->url->link('information/contact');
		$data['telephone'] = $this->config->get('config_telephone');
 
			$data['sitemap'] = $this->url->link('information/sitemap');
			$data['special'] = $this->url->link('product/special');
			$data['contact'] = $this->url->link('information/contact');
			$data['contact'] = $this->url->link('information/contact');
			$data['return'] = $this->url->link('account/return/insert', '', 'SSL');
			$data['sitemap'] = $this->url->link('information/sitemap');
			$data['manufacturer'] = $this->url->link('product/manufacturer', '', 'SSL');
			$data['voucher'] = $this->url->link('account/voucher', '', 'SSL');
			$data['affiliate'] = $this->url->link('affiliate/account', '', 'SSL');
			$data['account'] = $this->url->link('account/account', '', 'SSL');
			$data['order'] = $this->url->link('account/order', '', 'SSL');
			$data['newsletter'] = $this->url->link('account/newsletter', '', 'SSL');		
			
 
			$data['sitemap'] = $this->url->link('information/sitemap');
			$data['special'] = $this->url->link('product/special');
			$data['contact'] = $this->url->link('information/contact');
			$data['contact'] = $this->url->link('information/contact');
			$data['return'] = $this->url->link('account/return/insert', '', 'SSL');
			$data['sitemap'] = $this->url->link('information/sitemap');
			$data['manufacturer'] = $this->url->link('product/manufacturer', '', 'SSL');
			$data['voucher'] = $this->url->link('account/voucher', '', 'SSL');
			$data['affiliate'] = $this->url->link('affiliate/account', '', 'SSL');
			$data['account'] = $this->url->link('account/account', '', 'SSL');
			$data['order'] = $this->url->link('account/order', '', 'SSL');
			$data['newsletter'] = $this->url->link('account/newsletter', '', 'SSL');		
			

		$status = true;

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", str_replace(array("\r\n", "\r"), "\n", trim($this->config->get('config_robots'))));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}

		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();

				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach ($children as $child) {
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);

					$children_data[] = array(
						'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
					);
				}

				// Level 1
				$data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}


			$this->load->model('design/topmenu');
			$data['categories'] = $this->model_design_topmenu->getMenu();
			

			$this->load->model('design/topmenu');
			$data['categories'] = $this->model_design_topmenu->getMenu();
			
		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		$data['cart'] = $this->load->controller('common/cart');

		// For page specific css
		if (isset($this->request->get['route'])) {
			if (isset($this->request->get['product_id'])) {
				$class = '-' . $this->request->get['product_id'];
			} elseif (isset($this->request->get['path'])) {
				$class = '-' . $this->request->get['path'];
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$class = '-' . $this->request->get['manufacturer_id'];
			} else {
				$class = '';
			}

			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
		} else {
			$data['class'] = 'common-home';
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/header.tpl', $data);
		} else {
			return $this->load->view('default/template/common/header.tpl', $data);
		}
	}
	
	protected function getAlterLanguageLinks($links) {
		$result = array();
		if ($this->config->get('config_seo_url')) {
			foreach($links as $link) {
				if($link['rel']=='canonical') {
					$url=$link['href'];
					$schema = parse_url($url,PHP_URL_SCHEME);
					$server = strtolower($schema)=='https' ? HTTPS_SERVER : HTTP_SERVER; 
					$cur_lang = substr($url, strlen($server),2);
					$query = substr($url, strlen($server)+2);
					$this->load->model('localisation/language');
					$languages = $this->model_localisation_language->getLanguages();
					$active_langs = array();
					foreach($languages as $lang) {
						if($lang['status']) {
							$active_langs[]=$lang['code'];
						} 
					}
					if(in_array($cur_lang, $active_langs)) {
						foreach($active_langs as $lang) {
							$result[$lang] = $server.$lang.($query ? $query : '');
						}
					}
				}
			}
		}
		return $result;
	}
	
	protected function getAlterLanguageLinks2($links) {
		$result = array();
		if ($this->config->get('config_seo_url')) {
			foreach($links as $link) {
				if($link['rel']=='canonical') {
					$url=$link['href'];
					$schema = parse_url($url,PHP_URL_SCHEME);
					$server = strtolower($schema)=='https' ? HTTPS_SERVER : HTTP_SERVER; 
					$cur_lang = substr($url, strlen($server),2);
					$query = substr($url, strlen($server)+2);
					$this->load->model('localisation/language');
					$languages = $this->model_localisation_language->getLanguages();
					$active_langs = array();
					foreach($languages as $lang) {
						if($lang['status']) {
							$active_langs[]=$lang['code'];
						} 
					}
					if(in_array($cur_lang, $active_langs)) {
						foreach($active_langs as $lang) {
							$result[$lang] = $server.$lang.($query ? $query : '');
						}
					}
				}
			}
		}
		return $result;
	}
}