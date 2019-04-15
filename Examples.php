<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examples extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

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

	public function doctors_management()
	{
		try{
			$crud = new grocery_CRUD();
			
			$crud->set_theme('datatables');
			$crud->set_table('Doctors');
			$crud->set_subject('Doctors');
			$crud->required_fields('doctor_id', 'doctor_name');
			$crud->columns('doctor_id', 'doctor_name');
			$crud->display_as('doctor_id','Doctor ID');
			$crud->display_as('doctor_name','Doctor Name');
			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
			}
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
				$crud->set_table('Medications');
				$crud->set_subject('Medications');
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
		try{
			$crud = new grocery_CRUD();
			
			$crud->set_theme('datatables');
			$crud->set_table('Visits');
			$crud->set_subject('Visits');
			$crud->required_fields('visit_id', 'doctor_id', 'patient_id', 'visit_date');
			$crud->columns('visit_id', 'doctor_id', 'patient_id', 'visit_date');
			$crud->display_as('visit_id','Visit ID');
			$crud->display_as('doctor_id','Doctor ID');
			$crud->display_as('patient_id','Patient ID');
			$crud->display_as('visit_date','Visit Date');
			
			
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
			$crud->display_as('fev_id','FEV ID');
			$crud->display_as('visit_id','Visit ID');
			$crud->display_as('fev_number','FEV Number');
			
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

}
