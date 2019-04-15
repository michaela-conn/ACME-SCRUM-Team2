<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//application/controllers
class Examples extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this ->load->model('login_model');
		$this->load->library('grocery_CRUD');
	}
	public function _example_output($output = null)
	{
		$this->load->view('example.php',(array)$output);
	}
	public function offices()
	{
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}
	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}
	public function patients_management()
	{
		try{
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('Patients');
			$crud->set_subject('Patients');
			$crud->required_fields('patient_id', 'first_name', 'last_name', 'patient_gender', 'patient_birthday', 'patient_genetics', 'patient_diabetes', 'patient_other');
			$crud->columns('patient_id', 'first_name', 'last_name', 'patient_gender', 'patient_birthday', 'patient_genetics', 'patient_diabetes', 'patient_other');
			$crud->display_as('patient_id','Patient ID');
			$crud->display_as('patient_other','Other information');
			$output = $crud->render();
			$output -> title = "Patients";
			$this->_example_output($output);
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function prescriptions_management()
	{
		try{
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('Prescriptions');
			$crud->set_subject('Prescriptions');
			$crud->required_fields('pres_id', 'doctor_id', 'patient_id', 'med_id', 'dosage');
			$crud->columns('pres_id', 'doctor_id', 'patient_id', 'med_id', 'dosage');
			$crud->display_as('pres_id','Prescription ID');
			$crud->display_as('doctor_id','Doctor ID');
			$crud->display_as('patient_id','Patient ID');
			$crud->display_as('med_id','Medication ID');
			$output = $crud->render();
			$output -> title = "Prescriptions";
			$this->_example_output($output);
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function medications_management()
	{
		try{
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('Prescriptions');
			$crud->set_subject('Prescriptions');
			$crud->required_fields('med_id', 'med_name');
			$crud->columns('med_id', 'med_name');
			$crud->display_as('med_id','Medication ID');
			$crud->display_as('med_name','Medication Name');
			$output = $crud->render();
			$output -> title = "Medications";
			$this->_example_output($output);
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	public function prescriptions_management()
	{
		try{
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('Patients');
			$crud->set_subject('Patients');
			$crud->required_fields('patient_id', 'first_name', 'last_name', 'patient_gender', 'patient_birthday', 'patient_genetics', 'patient_diabetes', 'patient_other');
			$crud->columns('patient_id', 'first_name', 'last_name', 'patient_gender', 'patient_birthday', 'patient_genetics', 'patient_diabetes', 'patient_other');
			
			$output = $crud->render();
			
			$this->_example_output($output);
			
			}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
	}
	public function visits_management()
	{
		try{
			$crud = new grocery_CRUD();
			
			$crud->set_theme('datatables');
			$crud->set_table('Visits');
			$crud->set_subject('Visits');
			$crud->required_fields('visit_id', 'doctor_id', 'patient_id', 'visit_date');
			$crud->columns('visit_id', 'doctor_id', 'patient_id', 'visit_date');
			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
	}
	
		public function fev_management()
	{
		try{
			$crud = new grocery_CRUD();
			
			$crud->set_theme('datatables');
			$crud->set_table('FEV');
			$crud->set_subject('FEV');
			$crud->required_fields('fev_id', 'visit_id', 'fev_number');
			$crud->columns('fev_id', 'visit_id', 'fev_number');
			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
	}
	public function doctors_management()
	{
		try{
			$crud = new grocery_CRUD();
			
			$crud->set_theme('datatables');
			$crud->set_table('Doctors');
			$crud->set_subject('Doctors');
			$crud->required_fields('doctor_id', 'doctor_name');
			$crud->columns('doctor_id', 'doctor_name');
			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
	}
	public function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}
	public function film_management()
	{
		       if(!$this->login_model->isLogged()){
                                 //you are not permitted to see this page, so go to the login page
                           $this->login_model->logout();
                           return; //just in case...
                      }
		$crud = new grocery_CRUD();
		$crud->set_table('film');
		$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
		$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
		$crud->unset_columns('special_features','description','actors');
		$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');
		$output = $crud->render();
		$this->_example_output($output);
	}
	public function film_management_twitter_bootstrap()
	{
		try{
			$crud = new grocery_CRUD();
			$crud->set_theme('twitter-bootstrap');
			$crud->set_table('film');
			$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
			$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
			$crud->unset_columns('special_features','description','actors');
			$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');
			$output = $crud->render();
			$this->_example_output($output);
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	function multigrids()
	{
		$this->config->load('grocery_crud');
		$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);
		$output1 = $this->offices_management2();
		$output2 = $this->employees_management2();
		$output3 = $this->customers_management2();
		$js_files = $output1->js_files + $output2->js_files + $output3->js_files;
		$css_files = $output1->css_files + $output2->css_files + $output3->css_files;
		$output = "<h1>List 1</h1>".$output1->output."<h1>List 2</h1>".$output2->output."<h1>List 3</h1>".$output3->output;
		$this->_example_output((object)array(
				'js_files' => $js_files,
				'css_files' => $css_files,
				'output'	=> $output
		));
	}
	public function offices_management2()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('offices');
		$crud->set_subject('Office');
		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));
		$output = $crud->render();
		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}
	public function employees_management2()
	{
		$crud = new grocery_CRUD();
		$crud->set_theme('datatables');
		$crud->set_table('employees');
		$crud->set_relation('officeCode','offices','city');
		$crud->display_as('officeCode','Office City');
		$crud->set_subject('Employee');
		$crud->required_fields('lastName');
		$crud->set_field_upload('file_url','assets/uploads/files');
		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));
		$output = $crud->render();
		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}
	public function customers_management2()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('customers');
		$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
		$crud->display_as('salesRepEmployeeNumber','from Employeer')
			 ->display_as('customerName','Name')
			 ->display_as('contactLastName','Last Name');
		$crud->set_subject('Customer');
		$crud->set_relation('salesRepEmployeeNumber','employees','lastName');
		$crud->set_crud_url_path(site_url(strtolower(__CLASS__."/".__FUNCTION__)),site_url(strtolower(__CLASS__."/multigrids")));
		$output = $crud->render();
		if($crud->getState() != 'list') {
			$this->_example_output($output);
		} else {
			return $output;
		}
	}
}
/*public function users();
	{
$crud = new grocery_CRUD();
$crud->set_table('crud_users');
$crud->set_subject('Users');
$crud->required_fields('username','password');
$crud->columns('username','password','permission');
}
}
*/
