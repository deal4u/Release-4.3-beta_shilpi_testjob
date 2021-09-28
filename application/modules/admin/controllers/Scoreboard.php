<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scoreboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('common/common_model');
		$this->load->model(admin_controller().'Scoreboard_model');
        
        if (!$this->session->userdata('admin_logged_in')) {
            redirect(admin_url() . 'login');
        }
        if (get_session('admin_type') == 2 && (get_session('admin_permissions')['scoreboard'] == 'N/A' || get_session('admin_permissions')['scoreboard']['view'] == 0)){
            redirect(admin_url());
        }
    }

    public function index(){
        if (get_session('admin_type') == 2 && (get_session('admin_permissions')['scoreboard'] == 'N/A' || get_session('admin_permissions')['scoreboard']['view'] == 0)) {
            show_admin404();
        }else{
			$data['activeoffer'] = $this->Scoreboard_model->get_active_offer(['activeoffer'=> '1']);
				
            $this->load->view('scoreboard/scoreboard',$data);
        }
    }

/* to check permission for appearing on scoreboard */
    public function get_salesperson_scoreboard($id){
       $salespersons = $this->Scoreboard_model->get_salesperson_scoreboard($id);
	   return $salespersons;
    }

	public function add_scoreboard_offer(){
		$data['offerlist'] = $this->Scoreboard_model->get_active_offer($array= array());
		
		$this->load->view('scoreboard/addscoreboard',$data);
	}
	public function add_scoreboardoffer(){
		if($_POST){
			$data = $_POST;
			$this->form_validation->set_rules('offer_text', 'offer_text', 'trim|required|xss_clean');
			$this->form_validation->set_rules('validity_days', 'Validity', 'trim|xss_clean');
			$this->form_validation->set_rules('offer_startdate', 'start_date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('offer_enddate', 'end_date', 'trim|required|xss_clean');
			if ($this->form_validation->run($this) == FALSE){
				$finalResult = array('msg' => 'error', 'response'=>validation_errors());
				echo json_encode($finalResult);
				exit;
			}else{
				$this->Scoreboard_model->update_offers($data);
				$data['status'] = '1';
				$salespersons = $this->Scoreboard_model->insert_offers($data);
				if($salespersons > 0){
					$finalResult = array('msg' => 'success', 'response'=>"Offer successfully added.");
					echo json_encode($finalResult);
					exit;
				}else{
					$finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
					echo json_encode($finalResult);
					exit;
				}
			}
		}			
	}
}
