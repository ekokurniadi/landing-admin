<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feature extends MY_Controller {

  
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Feature_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $feature = $this->Feature_model->get_all();

        $data = array(
            'feature_data' => $feature
        );
        $this->load->view('header');
        $this->load->view('feature_list', $data);
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
            $where .= " AND (icon LIKE '%$search%'
                            OR feature LIKE '%$search%'
                            )";
          }
      }

    if (isset($orders)) {
        if ($orders != '') {
          $order = $orders;
          $order_column = ['icon','feature'];
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
    $fetch = $this->db->query("SELECT * from feature $where");
    $fetch2 = $this->db->query("SELECT * from feature ");
    foreach($fetch->result() as $rows){
        $button1= "<a href=".base_url('feature/read/'.$rows->id)." class='btn btn-icon icon-left btn-light'><i class='fa fa-eye'></i></a>";
        $button2= "<a href=".base_url('feature/update/'.$rows->id)." class='btn btn-icon icon-left btn-warning'><i class='fa fa-pencil-square-o'></i></a>";
        $button3 = "<a href=".base_url('feature/delete/'.$rows->id)." class='btn btn-icon icon-left btn-danger' onclick='javasciprt: return confirm(\"Are You Sure ?\")''><i class='fa fa-trash'></i></a>";
        $sub_array=array();
        $sub_array[]=$index;
        $sub_array[]=$rows->icon;
        $sub_array[]=$rows->feature;
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
        $row = $this->Feature_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'icon' => $row->icon,
		'feature' => $row->feature,
	    );
            $this->load->view('header');
            $this->load->view('feature_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('feature'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('feature/create_action'),
	    'id' => set_value('id'),
	    'icon' => set_value('icon'),
	    'feature' => set_value('feature'),
	);

        $this->load->view('header');
        $this->load->view('feature_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'icon' => $this->input->post('icon',TRUE),
		'feature' => $this->input->post('feature',TRUE),
	    );

            $this->Feature_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('feature'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Feature_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('feature/update_action'),
		'id' => set_value('id', $row->id),
		'icon' => set_value('icon', $row->icon),
		'feature' => set_value('feature', $row->feature),
	    );
            $this->load->view('header');
            $this->load->view('feature_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('feature'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'icon' => $this->input->post('icon',TRUE),
		'feature' => $this->input->post('feature',TRUE),
	    );

            $this->Feature_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('feature'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Feature_model->get_by_id($id);

        if ($row) {
            $this->Feature_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('feature'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('feature'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('icon', 'icon', 'trim|required');
	$this->form_validation->set_rules('feature', 'feature', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Feature.php */
/* Location: ./application/controllers/Feature.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-07 11:54:26 */
/* http://harviacode.com */