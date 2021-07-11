<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service_rate extends MY_Controller {

  
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Service_rate_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $service_rate = $this->Service_rate_model->get_all();

        $data = array(
            'service_rate_data' => $service_rate
        );
        $this->load->view('header');
        $this->load->view('service_rate_list', $data);
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
            $where .= " AND (title LIKE '%$search%'
                           OR value LIKE '%$search%'
                            )";
          }
      }

    if (isset($orders)) {
        if ($orders != '') {
          $order = $orders;
          $order_column = ['title','value'];
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
    $fetch = $this->db->query("SELECT * from service_rate $where");
    $fetch2 = $this->db->query("SELECT * from service_rate ");
    foreach($fetch->result() as $rows){
        $button1= "<a href=".base_url('service_rate/read/'.$rows->id)." class='btn btn-icon icon-left btn-light'><i class='fa fa-eye'></i></a>";
        $button2= "<a href=".base_url('service_rate/update/'.$rows->id)." class='btn btn-icon icon-left btn-warning'><i class='fa fa-pencil-square-o'></i></a>";
        $button3 = "<a href=".base_url('service_rate/delete/'.$rows->id)." class='btn btn-icon icon-left btn-danger' onclick='javasciprt: return confirm(\"Are You Sure ?\")''><i class='fa fa-trash'></i></a>";
        $sub_array=array();
        $sub_array[]=$index;
        $sub_array[]=$rows->icon;
        $sub_array[]=$rows->title;
        $sub_array[]=$rows->value;
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
        $row = $this->Service_rate_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'icon' => $row->icon,
		'title' => $row->title,
		'value' => $row->value,
	    );
            $this->load->view('header');
            $this->load->view('service_rate_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('service_rate'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('service_rate/create_action'),
	    'id' => set_value('id'),
	    'icon' => set_value('icon'),
	    'title' => set_value('title'),
	    'value' => set_value('value'),
	);

        $this->load->view('header');
        $this->load->view('service_rate_form', $data);
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
		'title' => $this->input->post('title',TRUE),
		'value' => $this->input->post('value',TRUE),
	    );

            $this->Service_rate_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('service_rate'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Service_rate_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('service_rate/update_action'),
		'id' => set_value('id', $row->id),
		'icon' => set_value('icon', $row->icon),
		'title' => set_value('title', $row->title),
		'value' => set_value('value', $row->value),
	    );
            $this->load->view('header');
            $this->load->view('service_rate_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('service_rate'));
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
		'title' => $this->input->post('title',TRUE),
		'value' => $this->input->post('value',TRUE),
	    );

            $this->Service_rate_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('service_rate'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Service_rate_model->get_by_id($id);

        if ($row) {
            $this->Service_rate_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('service_rate'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('service_rate'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('icon', 'icon', 'trim|required');
	$this->form_validation->set_rules('title', 'title', 'trim|required');
	$this->form_validation->set_rules('value', 'value', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Service_rate.php */
/* Location: ./application/controllers/Service_rate.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-07 11:54:27 */
/* http://harviacode.com */