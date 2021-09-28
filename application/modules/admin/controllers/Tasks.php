<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(admin_controller() . 'task_model');
        $this->load->model('common/common_model');
        if (!$this->session->userdata('admin_logged_in')) {
            redirect(admin_url() . 'login');
        }
    }

    public function index()
    {
        $data['tasks'] = $this->task_model->get_tasks();
        $this->load->view('tasks/tasks', $data);
    }

    public function add()
    {
        if($_POST){
            $data = $this->input->post();
            $claim_id = $this->task_model->insert_task($data);
            if($claim_id > 0){
                $claim = get_claim_data($data['claim']);
                $claim_num = $claim['claim_num'];
                if ($data['type']==1){
                    $msg = "Task successfully inserted.";
                }else{
                    $msg = "Note successfully inserted.";
                }
                $finalResult = array('msg' => 'success', 'response'=>$msg, 'claim' => $claim_num);
                echo json_encode($finalResult);
                exit;
            }else{
                $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                echo json_encode($finalResult);
                exit;
            }
        }else{
            show_admin404();
        }
    }

    public function add_notes()
    {
        if($_POST){
            $data = $this->input->post();
            $claim_id = $this->task_model->insert_notes($data);
            if($claim_id > 0){
                if ($data['type']==1){
                    $msg = "Task successfully inserted.";
                }else{
                    $msg = "Note successfully inserted.";
                }
                $finalResult = array('msg' => 'success', 'response'=>$msg);
                echo json_encode($finalResult);
                exit;
            }else{
                $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                echo json_encode($finalResult);
                exit;
            }
        }else{
            show_admin404();
        }
    }

    public function update()
    {
        if($_POST){
            $data = $this->input->post();
            $task_status = $this->task_model->update_task($data);
            if($task_status > 0){
                $finalResult = array('msg' => 'success', 'response'=>"Task successfully updated.");
                echo json_encode($finalResult);
                exit;
            }else{
                $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                echo json_encode($finalResult);
                exit;
            }
        }else{
            show_admin404();
        }
    }

    public function update_multiple()
    {
        if($_POST){
            $data = $this->input->post();
            $task_status = $this->task_model->update_multiple($data);
            if($task_status > 0){
                $finalResult = array('msg' => 'success', 'response'=>"Task successfully updated.");
                echo json_encode($finalResult);
                exit;
            }else{
                $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                echo json_encode($finalResult);
                exit;
            }
        }else{
            show_admin404();
        }
    }

    public function update_task(){
        if($_POST){
            $data = $this->input->post();
            $task_status = $this->task_model->update_status($data);
            if($task_status > 0){
                $task = get_single_notes_tasks($data['id']);
                if (!empty($task['claim'])){
                    $claim = get_claim_data($task['claim']);
                    $claim_num = $claim['claim_num'];
                }else{
                    $claim_num = '';
                }
                $finalResult = array('msg' => 'success', 'response'=>"Task successfully updated.", 'claim' => $claim_num);
                echo json_encode($finalResult);
                exit;
            }else{
                $finalResult = array('msg' => 'error', 'response'=>'Something went wrong!');
                echo json_encode($finalResult);
                exit;
            }
        }else{
            show_admin404();
        }
    }

    public function search_task()
    {
        $data['param'] = $this->input->get();
        if (!empty($data)){
            $data['tasks'] = $this->task_model->search_task($data['param']);
            $this->load->view('tasks/tasks', $data);
        }else{
            show_admin404();
        }
    }
}
