<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Product;
use Application\Form\ProductForm;
use Application\Model\Category;
use Application\Model\CategoryTable;
use Zend\Authentication\AuthenticationService;
use Zend\Validator\File\Size;
use Zend\Http\PhpEnvironment\Request;
use Zend\Filter\File\Rename;

use Zend\Db\Sql\Select;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\Iterator as paginatorIterator;

class ProductController extends AbstractActionController
{
	protected $productTable;
	protected $categoryTable;
	
	//remove
	private function _predump($value){
		echo "<pre>";
		var_dump($value);
		echo "</pre>";
		die;
	}

	//Function to create thumbnail
	private function img_resize($ini_path, $dest_path, $params = array()) {
	    $width = !empty($params['width']) ? $params['width'] : null;
	    $height = !empty($params['height']) ? $params['height'] : null;
	    $constraint = !empty($params['constraint']) ? $params['constraint'] : false;
	    $rgb = !empty($params['rgb']) ?  $params['rgb'] : 0xFFFFFF;
	    $quality = !empty($params['quality']) ?  $params['quality'] : 100;
	    $aspect_ratio = isset($params['aspect_ratio']) ?  $params['aspect_ratio'] : true;
	    $crop = isset($params['crop']) ?  $params['crop'] : true;

	    if (!file_exists($ini_path)) return false;
	 
	 
	    if (!is_dir($dir=dirname($dest_path))) mkdir($dir);
	 
	    $img_info = getimagesize($ini_path);
	    if ($img_info === false) return false;
	 
	    $ini_p = $img_info[0]/$img_info[1];
	    if ( $constraint ) {
	        $con_p = $constraint['width']/$constraint['height'];
	        $calc_p = $constraint['width']/$img_info[0];
	 
	        if ( $ini_p < $con_p ) {
	            $height = $constraint['height'];
	            $width = $height*$ini_p;
	        } else {
	            $width = $constraint['width'];
	            $height = $img_info[1]*$calc_p;
	        }
	    } else {
	        if ( !$width && $height ) {
	            $width = ($height*$img_info[0])/$img_info[1];
	        } else if ( !$height && $width ) {
	            $height = ($width*$img_info[1])/$img_info[0];
	        } else if ( !$height && !$width ) {
	            $width = $img_info[0];
	            $height = $img_info[1];
	        }
	    }
	 
	    preg_match('/\.([^\.]+)$/i',basename($dest_path), $match);
	    $ext = $match[1];
	    $output_format = ($ext == 'jpg') ? 'jpeg' : $ext;
	 
	    $format = strtolower(substr($img_info['mime'], strpos($img_info['mime'], '/')+1));
	    $icfunc = "imagecreatefrom" . $format;
	 
	    $iresfunc = "image" . $output_format;
	 
	    if (!function_exists($icfunc)) return false;
	 
	    $dst_x = $dst_y = 0;
	    $src_x = $src_y = 0;
	    $res_p = $width/$height;
	    if ( $crop && !$constraint ) {
	        $dst_w  = $width;
	        $dst_h = $height;
	        if ( $ini_p > $res_p ) {
	            $src_h = $img_info[1];
	            $src_w = $img_info[1]*$res_p;
	            $src_x = ($img_info[0] >= $src_w) ? floor(($img_info[0] - $src_w) / 2) : $src_w;
	        } else {
	            $src_w = $img_info[0];
	            $src_h = $img_info[0]/$res_p;
	            $src_y    = ($img_info[1] >= $src_h) ? floor(($img_info[1] - $src_h) / 2) : $src_h;
	        }
	    } else {
	        if ( $ini_p > $res_p ) {
	            $dst_w = $width;
	            $dst_h = $aspect_ratio ? floor($dst_w/$img_info[0]*$img_info[1]) : $height;
	            $dst_y = $aspect_ratio ? floor(($height-$dst_h)/2) : 0;
	        } else {
	            $dst_h = $height;
	            $dst_w = $aspect_ratio ? floor($dst_h/$img_info[1]*$img_info[0]) : $width;
	            $dst_x = $aspect_ratio ? floor(($width-$dst_w)/2) : 0;
	        }
	        $src_w = $img_info[0];
	        $src_h = $img_info[1];
	    }
	 
	    $isrc = $icfunc($ini_path);
	    $idest = imagecreatetruecolor($width, $height);
	    if ( ($format == 'png' || $format == 'gif') && $output_format == $format ) {
	        imagealphablending($idest, false);
	        imagesavealpha($idest,true);
	        imagefill($idest, 0, 0, IMG_COLOR_TRANSPARENT);
	        imagealphablending($isrc, true);
	        $quality = 0;
	    } else {
	        imagefill($idest, 0, 0, $rgb);
	    }
	    imagecopyresampled($idest, $isrc, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
	    $res = $iresfunc($idest, $dest_path, $quality);
	 
	    imagedestroy($isrc);
	    imagedestroy($idest);
	 
	    return $res;
	}
	
	//Getting Product Table
	public function getProductTable(){
        if(!$this->productTable){
            $sm = $this->getServiceLocator();
            $this->productTable = $sm->get('Application\Model\ProductTable');
        }
        return $this->productTable;
    }

    //Getting Category Table
    public function getCategoryTable(){

    	if(!$this->categoryTable){
            $sm = $this->getServiceLocator();
            $this->categoryTable = $sm->get('Application\Model\CategoryTable');
        }
        return $this->categoryTable;


    }
    
    public function indexAction(){
        $auth = new AuthenticationService();
		$identity = $auth->getIdentity();
		
		if (!$auth->hasIdentity()) {
			return $this->redirect()->toRoute('auth', array('controller' => 'auth', 'action' => 'login'));	
		}
		
        $select = new Select();

        $order_by = $this->params()->fromRoute('order_by') ?
                $this->params()->fromRoute('order_by') : 'id';

        $order = $this->params()->fromRoute('order') ?
                $this->params()->fromRoute('order') : Select::ORDER_ASCENDING;

        $page = $this->params()->fromRoute('page') ? (int) $this->params()->fromRoute('page') : 1;
        $page = $this->params()->fromRoute('page') ? (int) $this->params()->fromRoute('page') : 1;

        $products = $this->getProductTable()->fetchAll($select->order($order_by . ' ' . $order));

        //!important
        $itemsPerPage = 10;

        $products->current();

        $paginator = new Paginator(new paginatorIterator($products));
        $paginator->setCurrentPageNumber($page)
                ->setItemCountPerPage($itemsPerPage)
                ->setPageRange(7);

        return new ViewModel(array(
            'order_by' => $order_by,
            'order' => $order,
            'page' => $page,
            'paginator' => $paginator,
        ));
    }

    public function searchResultAction(){

    	$request = $this->getRequest();
    	if($request->isPost()){
    		$data = $request->getPost()->toArray();
    		

    		$search_result = $this->getProductTable()->searchProduct($data['search-filter']);
    		
    		return new ViewModel(array(
    			'products' => $search_result,
    		));


    	}else{
    		$this->getResponse()->setStatusCode(404);
			return;
    	}

    	
    }
	
	public function addAction(){
		
		$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$form = new ProductForm($dbAdapter);
		
        $request = $this->getRequest();
        if($request->isPost()){
        	
			//Getting data
        	$image_file = $request->getFiles()->toArray();
			$form_data = $request->getPost()->toArray();
			
            $product = new Product();
            $form->setInputFilter($product->getInputFilter());
			
            $form->setData($form_data);
			
            if($form->isValid() && $image_file['baseimage']['error'] != 4){
				
				$file_adapter = new \Zend\File\Transfer\Adapter\Http(); 
				$extension = new \Zend\Validator\File\Extension(array('extension' => array('png')));
				
				$file_adapter->setValidators(array($extension), $image_file['baseimage']['name']);
				
				if($file_adapter->isValid()) {
					$file_adapter->setDestination('./data/catalog_uploads/');
					$file_adapter->addFilter(
						'Rename', array(
							"target"    => "./data/catalog_uploads/".$image_file['baseimage']['name'],
				   			"randomize" => true
						)
					);
					
					$file_adapter->receive();

					//$this->_predump($file_adapter->isValid());
					$file_name = $file_adapter->getFileName();
					
					//Creating thumbnail
					$params = array(
					    'width' => 100,
					    'height' => 100,
					    'aspect_ratio' => true,
					    'rgb' => '0x000000',
					    'crop' => false
					);

					$new_thumbnail = substr($file_name, 0, -4).'_thumbnail.png';
					$this->img_resize($file_name, $new_thumbnail, $params);
					
					//End creating thumbnail
					
					$baseimage_file = array('baseimage' => substr($file_name, 1),'thumbnail' => substr($new_thumbnail, 1));
					
					$post_data = array_merge_recursive(
						$form_data,
						$baseimage_file
					);
					
					$product->exchangeArray($post_data);
	                $this->getProductTable()->saveProduct($product);

				}else{
					$dataError = $file_adapter->getMessages();
			        $error = array();
			        foreach($dataError as $key=>$row)
			        {
			            $error[] = $row;
			        } //set formElementErrors

			        $form->setMessages(array('baseimage'=>$error ));
			        return array('form' => $form);
				}

                
                //Redirect to list of albums
                return $this->redirect()->toRoute('products');
            }
			//END SAVE PROCESS
			$form->setMessages(array('baseimage'=>array('Este campo es requerido.')));
	        return array('form' => $form);
		}
        
        return array(
        	'form'=>$form
        );
	}
	
	public function editAction(){
        $id = (int) $this->params()->fromRoute('id', 0);

        if(!$id){
            return $this->redirect()->toRoute('products', array(
                'action' => 'add'
            ));
        }

        try {
             $product = $this->getProductTable()->getProduct($id);
        }
        catch (\Exception $ex) {
             return $this->redirect()->toRoute('products', array(
                 'action' => 'index'
             ));
        }
		
		$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$form = new ProductForm($dbAdapter);

        $form->bind($product);

        $request = $this->getRequest();
        if($request->isPost()){

         	//Getting data
         	$image_file = $request->getFiles()->toArray();
			$form_data = $request->getPost()->toArray();

			//Validate data
         	$form->setInputFilter($product->getInputFilter());
            $form->setData($request->getPost());
            
            //Making the action
            if($form->isValid()){

            	//if we have an image: to save it

            	if($image_file['baseimage']['error'] != 4){

            		$file_adapter = new \Zend\File\Transfer\Adapter\Http(); 

					//validating uploaded file extension
					$extension = new \Zend\Validator\File\Extension(array('extension' => array('png')));
					$file_adapter->setValidators(array($extension), $image_file['baseimage']['name']);

					if($file_adapter->isValid()) {

						$file_adapter->setDestination('./data/catalog_uploads/');
						$file_adapter->addFilter(
							'Rename', array(
								"target"    => "./data/catalog_uploads/".$image_file['baseimage']['name'],
					   			"randomize" => true
							)
						);
						
						$file_adapter->receive();

						//$this->_predump($file_adapter->isValid());
						$file_name = $file_adapter->getFileName();
						
						//Creating thumbnail
						$params = array(
						    'width' => 100,
						    'height' => 100,
						    'aspect_ratio' => true,
						    'rgb' => '0x000000',
						    'crop' => false
						);

						$new_thumbnail = substr($file_name, 0, -4).'_thumbnail.png';
						$this->img_resize($file_name, $new_thumbnail, $params);
						//End creating thumbnail

						$product->baseimage = substr($file_name, 1);
						$product->thumbnail = substr($new_thumbnail, 1);

					}else{
						try {
				             $product = $this->getProductTable()->getProduct($id);
				        }
				        catch (\Exception $ex) {
				             return $this->redirect()->toRoute('products', array(
				                 'action' => 'index'
				             ));
				        }
				        
						$dataError = $file_adapter->getMessages();
				        $error = array();
				        foreach($dataError as $key=>$row)
				        {
				            $error[] = $row;
				        } //set formElementErrors

				        $form->setMessages(array('baseimage'=>$error ));
				        return array('id' => $id,'form' => $form,'baseimage' => $product->baseimage);
					}


            	}

                $this->getProductTable()->saveProduct($product);
                
                return $this->redirect()->toRoute('products');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
            'baseimage' => $product->baseimage
        );

    }

    public function deleteAction(){
    	$id =  (int) $this->params()->fromRoute('id', 0);
    	if(!$id){
            return $this->redirect()->toRoute('products');
        }

        $request = $this->getRequest();

        if($request->isPost()){
            $del = $request->getPost('del', 'no');

            if($del == 'yes'){
                $id = (int) $request->getPost('id');
                $this->getProductTable()->deleteProduct($id);
            }
            
            return $this->redirect()->toRoute('products');
        }
        return array(
            'id' => $id,
            'product' => $this->getProductTable()->getProduct($id),
        );

    }

    public function svgAction(){
    	$id 	  = (int) $this->params()->fromRoute('id', 0);
		$stage_id = (int) $this->params()->fromRoute('stage', 0);
		$stage 	  = array();
		
		if(!$id || !$stage_id){
            return $this->redirect()->toRoute('products', array(
                'action' => 'add'
            ));
        }
		
		try {
             $product = $this->getProductTable()->getProduct($id);
			 switch ($stage_id) {
				 case 1:
					 $stage['id'] = 1;
					 $stage['stage'] = 'Clásico';
					 break;
				 case 2:
					 $stage['id'] = 2;
					 $stage['stage'] = 'Contemporáneo';
					 break;
				 case 3:
					 $stage['id'] = 3;
					 $stage['stage'] = 'Vanguardista';
					 break;
				 default:
					 
					 break;
			 }
        }
        catch (\Exception $ex) {
             return $this->redirect()->toRoute('products', array(
                 'action' => 'index'
             ));
        }
		
		$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
        $form = new ProductForm($dbAdapter);
        $form->bind($product);
        $request = $this->getRequest();
		
		if($request->isPost()){
			//Getting data
         	$image_file = $request->getFiles()->toArray();
			$form_data  = $request->getPost()->toArray();
			$stage_edit = $form_data['stage'];
			
			$file_adapter = new \Zend\File\Transfer\Adapter\Http();
			//validating uploaded file extension
			$extension = new \Zend\Validator\File\Extension(array('extension' => array('png')));
			$file_adapter->setValidators(array($extension), $image_file['imagepng1']['name']);
			
			if($file_adapter->isValid()) {
				$file_adapter->setDestination('./data/svg_images/');
				$file_adapter->addFilter(
					'Rename', array(
						"target"    => "./data/svg_images/".$image_file['imagepng1']['name'],
			   			"randomize" => true
					)
				);
				$file_adapter->receive();
				$file_name = $file_adapter->getFileName();
			}
			
			switch ($stage_edit) {
				 case 1:
					 $product->svgcode1 = $form_data['svgcode1'];
					 $product->image1   = substr($file_name, 1);
					 break;
				 case 2:
					 $product->svgcode2 = $form_data['svgcode2'];
					 $product->image2   = substr($file_name, 1);
					 break;
				 case 3:
					 $product->svgcode3 = $form_data['svgcode3'];
					 $product->image3   = substr($file_name, 1);
					 break;
				 default:
					 return $this->redirect()->toRoute('products');
					 break;
			 }
			
			$this->getProductTable()->saveSVG($product);
			return $this->redirect()->toRoute('products');
			
		}
		
		return array(
            'id' 	  => $id,
            'stage'   => $stage,
            'form' 	  => $form,
            'product' => $this->getProductTable()->getProduct($id),
        );
		
    }
	
	
}
