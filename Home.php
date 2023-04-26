<?php

namespace App\Controllers;

class Home extends BaseController
{
	
	function __construct()
	{
		$this->db = \Config\Database::connect(); 
		$this->uri = service('uri');
		$this->forge = \Config\Database::forge();
	}
	
	
    public function index()
    {
		if($this->request->getPost()){
			$url_data = $this->request->getPost();
			
			$url = $url_data['product_url'];
			$handle = curl_init($url);
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
			$html = curl_exec($handle);
			libxml_use_internal_errors(true); // Prevent HTML errors from displaying
			$doc = new \DOMDocument();
			$doc->loadHTML($html);
			
			$insert_data['product_name'] = trim($doc->getElementById('productTitle')->textContent);
			$priceget = $this->getElementsByClassName($doc, 'a-price-whole', 'span');
			$insert_data['product_price'] = $priceget[0]->textContent;
			$imgget = $this->getElementsByImgName($doc, 'a-dynamic-image a-stretch-vertical', 'img');
			$insert_data['product_img'] = $imgget[0];
			
			$response = $this->General_model->insert_update_qry("product",$insert_data);
			
			return redirect()->to('/');
		}
		
		$builder = $this->db->table('product');
		$this->outputData['getproduct'] = $builder->get()->getResult();
		
        return view('home', $this->outputData);
    }
	
	public function getElementsByClassName($dom, $ClassName, $tagName=null) {
		if($tagName){
			$Elements = $dom->getElementsByTagName($tagName);
		}else {
			$Elements = $dom->getElementsByTagName("*");
		}
		$Matched = array();
		for($i=0;$i<$Elements->length;$i++) {
			if($Elements->item($i)->attributes->getNamedItem('class')){
				if($Elements->item($i)->attributes->getNamedItem('class')->nodeValue == $ClassName) {
					$Matched[]=$Elements->item($i);
				}
			}
		}
		return $Matched;
	}
	
	public function getElementsByImgName($dom, $ClassName, $tagName=null) {
		if($tagName){
			$Elements = $dom->getElementsByTagName($tagName);
		}else {
			$Elements = $dom->getElementsByTagName("*");
		}
		$Matched = array();
		for($i=0;$i<$Elements->length;$i++) {
			if($Elements->item($i)->attributes->getNamedItem('class')){
				if($Elements->item($i)->attributes->getNamedItem('class')->nodeValue == $ClassName) {
					$Matched[]=$Elements->item($i)->getAttribute('src');
				}
			}
		}
		return $Matched;
	}
}
