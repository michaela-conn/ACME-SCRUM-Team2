<?php
error_reporting(E_ERROR | E_PARSE);

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Main extends CI_Controller {
 
function __construct()
{
        parent::__construct();
 
/* Standard Libraries of codeigniter are required */
$this->load->database();
$this->load->helper('url');
/* ------------------ */ 
 
$this->load->library('grocery_CRUD');
 
}
function encrypt_pw($post_array) {
			    if(!empty($post_array['password'])) {
					    $post_array['password'] = SHA1($_POST['password']);
			    }
			    return $post_array;
	    }

 
public function index()
{
echo "<h1>Welcome to the world of Codeigniter</h1>";//Just an example to ensure that we get into the function
die();
}
 
public function employees()
{
$crud = new grocery_CRUD();
$crud->set_table('employees');
$crud->set_subject('Employee');
$crud->columns('lastName','firstName','email','jobTitle'); 
$crud->fields('lastName','firstName','extension','email','jobTitle');
$crud->display_as('lastName','Last Name');
$crud->display_as('firstName','First Name');
$crud->display_as('jobTitle','Job Title');
$crud->required_fields('lastName','firstName','jobTitle');
$crud->set_rules('lastName','Last Name','htmlspecialchars|required|min_length[2]|max_length[30]',array('required' => 'You must provide a %s.'));
$crud->set_rules('firstName','First Name','htmlspecialchars|required|min_length[2]|max_length[30]',array('required' => 'You must provide a %s.'));// user friendly message 
 $crud->field_type('jobTitle','dropdown',
array('1' => 'Analysis', '2' => 'Manager','3' => 'President' , '4' => 'Vice President'));
//$crud->where('jobTitle','Sales Rep');	  shows only people whos postion is Sales Rep  
$crud->unset_delete();
$crud->unset_clone();


$output = $crud->render();
$output->title = "Employees";
 
$this->_example_output($output);        
}

public function customers_main()
{
$crud = new grocery_CRUD();
$crud->set_table('customers_main');
$crud->set_subject('Customer'); 
$crud->columns('first_name', 'email'); 
//$crud->fields('custName','custEmail','State','zip','phoneNumber');
$crud->display_as('first_name','Customer Name');
$crud->display_as('email','Customer Email');
$crud->required_fields('first_name','email');
$crud->set_rules('first_Name','First Name','htmlspecialchars|required|min_length[2]|max_length[30]');
$crud->set_rules('email','Customer Email','htmlspecialchars|required|valid_email|is_unique[customers_main.email]');
$crud->callback_before_insert(array($this,'encrypt_pw'));
$crud->unset_delete();
$crud->unset_clone();


$output = $crud->render();
$output->title = "Customers"; 
 
$this->_example_output($output);        
}
 
function _example_output($output = null)
 
{
$this->load->view('our_template.php',$output);    
}
}
 
/* End of file Main.php */
/* Location: ./application/controllers/Main.php */
