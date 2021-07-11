<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message extends MY_Controller {

  
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Message_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $message = $this->Message_model->get_all();

        $data = array(
            'message_data' => $message
        );
        $this->load->view('header');
        $this->load->view('message_list', $data);
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
            $where .= " AND (name LIKE '%$search%'
                            OR email LIKE '%$search%'
                            OR subject LIKE '%$search'
                            OR message LIKE '%$search%'   
                            )";
          }
      }

    if (isset($orders)) {
        if ($orders != '') {
          $order = $orders;
          $order_column = ['name','email','subject','message'];
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
    $fetch = $this->db->query("SELECT * from message $where");
    $fetch2 = $this->db->query("SELECT * from message ");
    foreach($fetch->result() as $rows){
        $button1= "<a href=".base_url('message/read/'.$rows->id)." class='btn btn-icon icon-left btn-light'><i class='fa fa-eye'></i></a>";
        $button2= "<a href=".base_url('message/update/'.$rows->id)." class='btn btn-icon icon-left btn-warning'><i class='fa fa-pencil-square-o'></i></a>";
        $button3 = "<a href=".base_url('message/delete/'.$rows->id)." class='btn btn-icon icon-left btn-danger' onclick='javasciprt: return confirm(\"Are You Sure ?\")''><i class='fa fa-trash'></i></a>";
        $sub_array=array();
        $sub_array[]=$index;
        $sub_array[]=$rows->name;
        $sub_array[]=$rows->email;
        $sub_array[]=$rows->subject;
        $sub_array[]=$rows->message;
        $sub_array[]=$rows->is_read == 0 ? "Belum dibaca" : "Sudah dibaca";
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
        $row = $this->Message_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'name' => scriptToHtml($row->name),
		'email' => scriptToHtml($row->email),
		'subject' => scriptToHtml($row->subject),
		'message' => scriptToHtml($row->message),
	    );
            $this->load->view('header');
            $this->load->view('message_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('message'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('message/create_action'),
	    'id' => set_value('id'),
	    'name' => set_value('name'),
	    'email' => set_value('email'),
	    'subject' => set_value('subject'),
	    'message' => set_value('message'),
	);

        $this->load->view('header');
        $this->load->view('message_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'email' => $this->input->post('email',TRUE),
		'subject' => $this->input->post('subject',TRUE),
		'message' => $this->input->post('message',TRUE),
	    );

            $this->Message_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('message'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Message_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('message/update_action'),
		'id' => set_value('id', $row->id),
		'name' => set_value('name', scriptToHtml($row->name)),
		'email' => set_value('email', scriptToHtml($row->email)),
		'subject' => set_value('subject', scriptToHtml($row->subject)),
		'message' => set_value('message', scriptToHtml($row->message)),
	    );
            $this->load->view('header');
            $this->load->view('message_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('message'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'name' => $this->input->post('name',TRUE),
		'email' => $this->input->post('email',TRUE),
		'subject' => $this->input->post('subject',TRUE),
		'message' => $this->input->post('message',TRUE),
		'is_read' => 1,
	    );

            $this->Message_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('message'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Message_model->get_by_id($id);

        if ($row) {
            $this->Message_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('message'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('message'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('subject', 'subject', 'trim|required');
	$this->form_validation->set_rules('message', 'message', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Message.php */
/* Location: ./application/controllers/Message.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-07 11:54:27 */
/* http://harviacode.com */