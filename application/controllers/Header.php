<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Header extends MY_Controller {

  
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Header_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $header = $this->Header_model->get_all();

        $data = array(
            'header_data' => $header
        );
        $this->load->view('header');
        $this->load->view('header_list', $data);
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
                            OR  favicon LIKE '%$search%'
                            OR logo LIKE '%$search%'
                            )";
          }
      }

    if (isset($orders)) {
        if ($orders != '') {
          $order = $orders;
          $order_column = ['title','favicon','logo'];
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
    $fetch = $this->db->query("SELECT * from header $where");
    $fetch2 = $this->db->query("SELECT * from header ");
    foreach($fetch->result() as $rows){
        $button1= "<a href=".base_url('header/read/'.$rows->id)." class='btn btn-icon icon-left btn-light'><i class='fa fa-eye'></i></a>";
        $button2= "<a href=".base_url('header/update/'.$rows->id)." class='btn btn-icon icon-left btn-warning'><i class='fa fa-pencil-square-o'></i></a>";
        $button3 = "<a href=".base_url('header/delete/'.$rows->id)." class='btn btn-icon icon-left btn-danger' onclick='javasciprt: return confirm(\"Are You Sure ?\")''><i class='fa fa-trash'></i></a>";
        $sub_array=array();
        $sub_array[]=$index;
        $sub_array[]=$rows->title;
        $sub_array[]="<img src=".base_url().'image/'.$rows->favicon." class='img-fluid' width='80px'>";
        $sub_array[]="<img src=".base_url().'image/'.$rows->logo." class='img-fluid' width='80px'>";
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
        $row = $this->Header_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'title' => $row->title,
		'favicon' => $row->favicon,
		'logo' => $row->logo,
	    );
            $this->load->view('header');
            $this->load->view('header_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('header'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('header/create_action'),
	    'id' => set_value('id'),
	    'title' => set_value('title'),
	    'favicon' => set_value('favicon'),
	    'logo' => set_value('logo'),
	);

        $this->load->view('header');
        $this->load->view('header_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
        
        $data = array(
		'title' => $this->input->post('title',TRUE),
		'favicon' => upload_gambar_biasa('fav', 'image/', 'jpeg|png|jpg|gif', 10000, 'favicon'),
		'logo' => upload_gambar_biasa2('logo', 'image/', 'jpeg|png|jpg|gif', 10000, 'logo'),
	    );

            $this->Header_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('header'));
        
    }

    
    public function update($id) 
    {   
       
        $row = $this->Header_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('header/update_action'),
		'id' => set_value('id', $row->id),
		'title' => set_value('title', $row->title),
		'favicon' => set_value('favicon', $row->favicon),
		'logo' => set_value('logo', $row->logo),
	    );
            $this->load->view('header');
            $this->load->view('header_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('header'));
        }
    }
    
    public function update_action() 
    {
        $id = $this->input->post('id',TRUE);
        $row = $this->Header_model->get_by_id($id);

            $data = array(
		'title' => $this->input->post('title',TRUE),
		'favicon' => $_FILES['favicon']['name'] == "" ? $row->favicon : upload_gambar_biasa('fav', 'image/', 'jpeg|png|jpg|gif', 10000, 'favicon'),
		'logo' => $_FILES['logo']['name'] == "" ? $row->logo : upload_gambar_biasa2('logo', 'image/', 'jpeg|png|jpg|gif', 10000, 'logo'),
	    );

            $this->Header_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('header'));
       
    }
    
    public function delete($id) 
    {
        $row = $this->Header_model->get_by_id($id);

        if ($row) {
            $this->Header_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('header'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('header'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('title', 'title', 'trim|required');
	$this->form_validation->set_rules('favicon', 'favicon', 'trim|');
	$this->form_validation->set_rules('logo', 'logo', 'trim|');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Header.php */
/* Location: ./application/controllers/Header.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-07 11:54:27 */
/* http://harviacode.com */