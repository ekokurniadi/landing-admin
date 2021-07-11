<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frequently_asked_questions extends MY_Controller {

  
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Frequently_asked_questions_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $frequently_asked_questions = $this->Frequently_asked_questions_model->get_all();

        $data = array(
            'frequently_asked_questions_data' => $frequently_asked_questions
        );
        $this->load->view('header');
        $this->load->view('frequently_asked_questions_list', $data);
        $this->load->view('footer');
    }

    public function fetch_data(){
    $starts       = $this->input->post("start");
    $length       = $this->input->post("length");
    $LIMIT        = "LIMIT $starts, $length ";
    $draw         = $this->input->post("draw");
    $search       = $this->input->post("search")["value"];
    $orders       = isset($_POST["order"]) ? $_POST["order"] : ''; 
    
    $where ="WHERE 1=1";
    $searchingColumn="";
    $result=array();
    if (isset($search)) {
      if ($search != '') {
         $searchingColumn = $search;
            $where .= " AND (judul LIKE '%$search%'
                            OR question LIKE '%$search%'
                            )";
          }
      }

    if (isset($orders)) {
        if ($orders != '') {
          $order = $orders;
          $order_column = ['judul','question'];
          $order_clm  = $order_column[$order[0]['column']];
          $order_by   = $order[0]['dir'];
          $where .= " ORDER BY $order_clm $order_by ";
        } else {
          $where .= " ORDER BY id ASC ";
        }
      } else {
        $where .= " ORDER BY id ASC ";
      }
      if (isset($LIMIT)) {
        if ($LIMIT != '') {
          $where .= ' ' . $LIMIT;
        }
      }
    $index=1;
    $button="";
    $fetch = $this->db->query("SELECT * from frequently_asked_questions $where");
    $fetch2 = $this->db->query("SELECT * from frequently_asked_questions ");
    foreach($fetch->result() as $rows){
        $button1= "<a href=".base_url('frequently_asked_questions/read/'.$rows->id)." class='btn btn-icon icon-left btn-light'><i class='fa fa-eye'></i></a>";
        $button2= "<a href=".base_url('frequently_asked_questions/update/'.$rows->id)." class='btn btn-icon icon-left btn-warning'><i class='fa fa-pencil-square-o'></i></a>";
        $button3 = "<a href=".base_url('frequently_asked_questions/delete/'.$rows->id)." class='btn btn-icon icon-left btn-danger' onclick='javasciprt: return confirm(\"Are You Sure ?\")''><i class='fa fa-trash'></i></a>";
        $sub_array=array();
        $sub_array[]=$index;
        $sub_array[]=$rows->judul;
        $sub_array[]=$rows->question;
        $sub_array[]=$button1." ".$button2." ".$button3;
        $result[]      = $sub_array;
        $index++;
    }
    $output = array(
      "draw"            =>     intval($this->input->post("draw")),
      "recordsFiltered" =>     $fetch2->num_rows(),
      "data"            =>     $result,
     
    );
    echo json_encode($output);

}

    public function read($id) 
    {
        $row = $this->Frequently_asked_questions_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'judul' => $row->judul,
		'question' => $row->question,
	    );
            $this->load->view('header');
            $this->load->view('frequently_asked_questions_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('frequently_asked_questions'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('frequently_asked_questions/create_action'),
	    'id' => set_value('id'),
	    'judul' => set_value('judul'),
	    'question' => set_value('question'),
	);

        $this->load->view('header');
        $this->load->view('frequently_asked_questions_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'judul' => $this->input->post('judul',TRUE),
		'question' => $this->input->post('question',TRUE),
	    );

            $this->Frequently_asked_questions_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('frequently_asked_questions'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Frequently_asked_questions_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('frequently_asked_questions/update_action'),
		'id' => set_value('id', $row->id),
		'judul' => set_value('judul', $row->judul),
		'question' => set_value('question', $row->question),
	    );
            $this->load->view('header');
            $this->load->view('frequently_asked_questions_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('frequently_asked_questions'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'judul' => $this->input->post('judul',TRUE),
		'question' => $this->input->post('question',TRUE),
	    );

            $this->Frequently_asked_questions_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('frequently_asked_questions'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Frequently_asked_questions_model->get_by_id($id);

        if ($row) {
            $this->Frequently_asked_questions_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('frequently_asked_questions'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('frequently_asked_questions'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('judul', 'judul', 'trim|required');
	$this->form_validation->set_rules('question', 'question', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Frequently_asked_questions.php */
/* Location: ./application/controllers/Frequently_asked_questions.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-07 11:54:26 */
/* http://harviacode.com */