<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examples extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
		$this->load->model('login_model');

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
		if(!$this->login_model->isLogged()){
                                 //you are not permitted to see this page, so go to the login page
                           $this->login_model->logout();
                           return; //just in case...
                      }

		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('Patients');
			$crud->set_subject('Patients');
			$crud->required_fields('patient_id', 'first_name', 'last_name', 'patient_gender', 'patient_birthday', 'patient_genetics', 'patient_diabetes', 'patient_other');
			$crud->columns('patient_id', 'first_name', 'last_name', 'patient_gender', 'patient_birthday', 'patient_genetics', 'patient_diabetes', 'patient_other');
			$crud->display_as('patient_id','Patient ID');
			$crud->display_as('patient_birthday', 'Patient Birthday');
			$crud->display_as('patient_other','Other information');
			
			$crud->callback_column('age', array($this, 'calc_age'));

			$output = $crud->render();
			$output -> title = "Patients";
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	public function prescriptions_management()
	{
		if(!$this->login_model->isLogged()){
                                 //you are not permitted to see this page, so go to the login page
                           $this->login_model->logout();
                           return; //just in case...
                      }

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
		if(!$this->login_model->isLogged()){
                                 //you are not permitted to see this page, so go to the login page
                           $this->login_model->logout();
                           return; //just in case...
                      }

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
	
	public function visits_management()
	{
		if(!$this->login_model->isLogged()){
                                 //you are not permitted to see this page, so go to the login page
                           $this->login_model->logout();
                           return; //just in case...
                      }

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
		if(!$this->login_model->isLogged()){
                                 //you are not permitted to see this page, so go to the login page
                           $this->login_model->logout();
                           return; //just in case...
                      }

		try{
			$crud = new grocery_CRUD();
			
			$crud->set_theme('datatables');
			$crud->set_table('FEV');
			$crud->set_subject('FEV');
			$crud->required_fields('fev_id', 'visit_id', 'fev_num');
			$crud->columns('fev_id', 'visit_id', 'fev_num');
			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
	}
	
	public function doctors_management()
	{
		if(!$this->login_model->isLogged()){
                                 //you are not permitted to see this page, so go to the login page
                           $this->login_model->logout();
                           return; //just in case...
                      }

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
	
	public function users()
	{
		$crud = new grocery_CRUD();
		$crud-> set_table('crud_users');
		$crud -> set_subject('Users');
		$crud -> required_fields('username', 'password');
		$crud -> columns('username', 'password', 'permissions');
		$crud -> change_field_type('password', 'password');
		$crud -> unset_read()->unset_export()->unset_print();
		$crud -> callback_before_insert(array($this, 'encrypt_pw'));
		$crud -> callback_before_update(array($this, 'encrypt_pw'));
		$output = $crud ->render();
		$this->_example_output($output);
	}
	
	function encrypt_pw($post_array)
	{
		if(!empty($post_array['password']))
		{
			$post_array['password'] = MD5($_POST['password']);
			
		}
		return $post_array;
	}

}
	public function calc_age($value, $row) {
		return date_diff(date_create($row->patient_birthday), date_create('now'))->y;
	}
