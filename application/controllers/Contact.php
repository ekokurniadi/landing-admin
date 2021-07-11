<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends MY_Controller {

  
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Contact_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $contact = $this->Contact_model->get_all();

        $data = array(
            'contact_data' => $contact
        );
        $this->load->view('header');
        $this->load->view('contact_list', $data);
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
    // $searchingColumn;
    $result=array();
    if (isset($search)) {
      if ($search != '') {
         $searchingColumn = $search;
            $where .= " AND (location LIKE '%$search%'
                           OR email LIKE '%$search%'
                           OR phone LIKE '%$search%'

                            )";
          }
      }

    if (isset($orders)) {
        if ($orders != '') {
          $order = $orders;
          $order_column = ['location','email','phone'];
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
    $fetch = $this->db->query("SELECT * from contact $where");
    $fetch2 = $this->db->query("SELECT * from contact ");
    foreach($fetch->result() as $rows){
        $button1= "<a href=".base_url('contact/read/'.$rows->id)." class='btn btn-icon icon-left btn-light'><i class='fa fa-eye'></i></a>";
        $button2= "<a href=".base_url('contact/update/'.$rows->id)." class='btn btn-icon icon-left btn-warning'><i class='fa fa-pencil-square-o'></i></a>";
        $button3 = "<a href=".base_url('contact/delete/'.$rows->id)." class='btn btn-icon icon-left btn-danger' onclick='javasciprt: return confirm(\"Are You Sure ?\")''><i class='fa fa-trash'></i></a>";
        $sub_array=array();
        $sub_array[]=$index;
        $sub_array[]=$rows->location;
        $sub_array[]=$rows->email;
        $sub_array[]=$rows->phone;
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
        $row = $this->Contact_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'location' => $row->location,
		'email' => $row->email,
		'phone' => $row->phone,
	    );
            $this->load->view('header');
            $this->load->view('contact_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contact'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('contact/create_action'),
	    'id' => set_value('id'),
	    'location' => set_value('location'),
	    'email' => set_value('email'),
	    'phone' => set_value('phone'),
	);

        $this->load->view('header');
        $this->load->view('contact_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'location' => $this->input->post('location',TRUE),
		'email' => $this->input->post('email',TRUE),
		'phone' => $this->input->post('phone',TRUE),
	    );

            $this->Contact_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('contact'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Contact_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('contact/update_action'),
		'id' => set_value('id', $row->id),
		'location' => set_value('location', $row->location),
		'email' => set_value('email', $row->email),
		'phone' => set_value('phone', $row->phone),
	    );
            $this->load->view('header');
            $this->load->view('contact_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contact'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'location' => $this->input->post('location',TRUE),
		'email' => $this->input->post('email',TRUE),
		'phone' => $this->input->post('phone',TRUE),
	    );

            $this->Contact_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('contact'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Contact_model->get_by_id($id);

        if ($row) {
            $this->Contact_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('contact'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('contact'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('location', 'location', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('phone', 'phone', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Contact.php */
/* Location: ./application/controllers/Contact.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-10 05:42:52 */
/* http://harviacode.com */