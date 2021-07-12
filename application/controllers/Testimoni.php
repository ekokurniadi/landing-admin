<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testimoni extends MY_Controller {

  
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Testimoni_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $testimoni = $this->Testimoni_model->get_all();

        $data = array(
            'testimoni_data' => $testimoni
        );
        $this->load->view('header');
        $this->load->view('testimoni_list', $data);
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
                            OR job Like '%$search%'
                            OR testimoni LIKE '%$search%'
                            )";
          }
      }

    if (isset($orders)) {
        if ($orders != '') {
          $order = $orders;
          $order_column = ['name','job','testimoni'];
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
    $fetch = $this->db->query("SELECT * from testimoni $where");
    $fetch2 = $this->db->query("SELECT * from testimoni ");
    foreach($fetch->result() as $rows){
        $button1= "<a href=".base_url('testimoni/read/'.$rows->id)." class='btn btn-icon icon-left btn-light'><i class='fa fa-eye'></i></a>";
        $button2= "<a href=".base_url('testimoni/update/'.$rows->id)." class='btn btn-icon icon-left btn-warning'><i class='fa fa-pencil-square-o'></i></a>";
        $button3 = "<a href=".base_url('testimoni/delete/'.$rows->id)." class='btn btn-icon icon-left btn-danger' onclick='javasciprt: return confirm(\"Are You Sure ?\")''><i class='fa fa-trash'></i></a>";
        $sub_array=array();
        $sub_array[]=$index;
        $sub_array[] = "<img src=" . base_url() . 'image/' . $rows->user_profile . " class='img-fluid' width='80px'>";
        $sub_array[]=$rows->name;
        $sub_array[]=$rows->job;
        $sub_array[]=$rows->testimoni;
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
        $row = $this->Testimoni_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'user_profile' => $row->user_profile,
		'name' => $row->name,
		'job' => $row->job,
		'testimoni' => $row->testimoni,
	    );
            $this->load->view('header');
            $this->load->view('testimoni_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('testimoni'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('testimoni/create_action'),
	    'id' => set_value('id'),
	    'user_profile' => set_value('user_profile'),
	    'name' => set_value('name'),
	    'job' => set_value('job'),
	    'testimoni' => set_value('testimoni'),
	);

        $this->load->view('header');
        $this->load->view('testimoni_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'user_profile' => upload_gambar_biasa('testi', 'image/', 'png|jpg|PNG|JPG|JPEG|jpeg', 20000, 'user_profile'),
		'name' => $this->input->post('name',TRUE),
		'job' => $this->input->post('job',TRUE),
		'testimoni' => $this->input->post('testimoni',TRUE),
	    );

            $this->Testimoni_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('testimoni'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Testimoni_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('testimoni/update_action'),
		'id' => set_value('id', $row->id),
		'user_profile' => set_value('user_profile', $row->user_profile),
		'name' => set_value('name', $row->name),
		'job' => set_value('job', $row->job),
		'testimoni' => set_value('testimoni', $row->testimoni),
	    );
            $this->load->view('header');
            $this->load->view('testimoni_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('testimoni'));
        }
    }
    
    public function update_action() 
    {
        $id = $this->input->post('id', TRUE);
        $row = $this->Testimoni_model->get_by_id($id);
       
            $data = array(
		'user_profile' => $ $_FILES['user_profile']['name'] == "" ? $row->user_profile : upload_gambar_biasa('testi', 'image/', 'png|jpg|PNG|JPG|JPEG|jpeg', 20000, 'user_profile'),
		'name' => $this->input->post('name',TRUE),
		'job' => $this->input->post('job',TRUE),
		'testimoni' => $this->input->post('testimoni',TRUE),
	    );

            $this->Testimoni_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('testimoni'));
        
    }
    
    public function delete($id) 
    {
        $row = $this->Testimoni_model->get_by_id($id);

        if ($row) {
            $this->Testimoni_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('testimoni'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('testimoni'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('user_profile', 'user profile', 'trim');
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('job', 'job', 'trim|required');
	$this->form_validation->set_rules('testimoni', 'testimoni', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Testimoni.php */
/* Location: ./application/controllers/Testimoni.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-07 11:54:27 */
/* http://harviacode.com */