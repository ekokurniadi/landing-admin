<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Team extends MY_Controller {

  
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Team_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $team = $this->Team_model->get_all();

        $data = array(
            'team_data' => $team
        );
        $this->load->view('header');
        $this->load->view('team_list', $data);
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
                             OR job LIKE '%$search%'
                             OR twitter LIKE '%$search%'
                             OR facebook LIKE '%$search%'
                             OR instagram LIKE '%$search%'
                             OR linkedin LIKE '%$search%'
                            )";
          }
      }

    if (isset($orders)) {
        if ($orders != '') {
          $order = $orders;
          $order_column = ['job','twitter','facebook','instagram','linkedin'];
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
    $fetch = $this->db->query("SELECT * from team $where");
    $fetch2 = $this->db->query("SELECT * from team ");
    foreach($fetch->result() as $rows){
        $button1= "<a href=".base_url('team/read/'.$rows->id)." class='btn btn-icon icon-left btn-light'><i class='fa fa-eye'></i></a>";
        $button2= "<a href=".base_url('team/update/'.$rows->id)." class='btn btn-icon icon-left btn-warning'><i class='fa fa-pencil-square-o'></i></a>";
        $button3 = "<a href=".base_url('team/delete/'.$rows->id)." class='btn btn-icon icon-left btn-danger' onclick='javasciprt: return confirm(\"Are You Sure ?\")''><i class='fa fa-trash'></i></a>";
        $sub_array=array();
        $sub_array[]=$index;
        $sub_array[] = "<img src=" . base_url() . 'image/' . $rows->image . " class='img-fluid' width='80px'>";
        $sub_array[]=$rows->name;
        $sub_array[]=$rows->job;
        $sub_array[]=$rows->twitter;
        $sub_array[]=$rows->facebook;
        $sub_array[]=$rows->instagram;
        $sub_array[]=$rows->linkedin;
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
        $row = $this->Team_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'image' => $row->image,
		'name' => $row->name,
		'job' => $row->job,
		'twitter' => $row->twitter,
		'facebook' => $row->facebook,
		'instagram' => $row->instagram,
		'linkedin' => $row->linkedin,
	    );
            $this->load->view('header');
            $this->load->view('team_read', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('team'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('team/create_action'),
	    'id' => set_value('id'),
	    'image' => set_value('image'),
	    'name' => set_value('name'),
	    'job' => set_value('job'),
	    'twitter' => set_value('twitter'),
	    'facebook' => set_value('facebook'),
	    'instagram' => set_value('instagram'),
	    'linkedin' => set_value('linkedin'),
	);

        $this->load->view('header');
        $this->load->view('team_form', $data);
        $this->load->view('footer');
    }
    
    public function create_action() 
    {
      
            $data = array(
		'image' => upload_gambar_biasa('team', 'image/', 'png|jpg|PNG|JPG|JPEG|jpeg', 20000, 'image'),
		'name' => $this->input->post('name',TRUE),
		'job' => $this->input->post('job',TRUE),
		'twitter' => $this->input->post('twitter',TRUE),
		'facebook' => $this->input->post('facebook',TRUE),
		'instagram' => $this->input->post('instagram',TRUE),
		'linkedin' => $this->input->post('linkedin',TRUE),
	    );

            $this->Team_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('team'));
        
    }
    
    public function update($id) 
    {
        $row = $this->Team_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('team/update_action'),
		'id' => set_value('id', $row->id),
		'image' => set_value('image', $row->image),
		'name' => set_value('name', $row->name),
		'job' => set_value('job', $row->job),
		'twitter' => set_value('twitter', $row->twitter),
		'facebook' => set_value('facebook', $row->facebook),
		'instagram' => set_value('instagram', $row->instagram),
		'linkedin' => set_value('linkedin', $row->linkedin),
	    );
            $this->load->view('header');
            $this->load->view('team_form', $data);
            $this->load->view('footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('team'));
        }
    }
    
    public function update_action() 
    {
        $id = $this->input->post('id', TRUE);
        $row = $this->Team_model->get_by_id($id);
        $this->_rules();

            $data = array(
		'image' => $_FILES['image']['name']=="" ? $row->image: upload_gambar_biasa('team', 'image/', 'png|jpg|PNG|JPG|JPEG|jpeg', 20000, 'image'),
		'name' => $this->input->post('name',TRUE),
		'job' => $this->input->post('job',TRUE),
		'twitter' => $this->input->post('twitter',TRUE),
		'facebook' => $this->input->post('facebook',TRUE),
		'instagram' => $this->input->post('instagram',TRUE),
		'linkedin' => $this->input->post('linkedin',TRUE),
	    );

            $this->Team_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('team'));
        
    }
    
    public function delete($id) 
    {
        $row = $this->Team_model->get_by_id($id);

        if ($row) {
            $this->Team_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('team'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('team'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('image', 'image', 'trim');
	$this->form_validation->set_rules('name', 'name', 'trim|required');
	$this->form_validation->set_rules('job', 'job', 'trim|required');
	$this->form_validation->set_rules('twitter', 'twitter', 'trim|required');
	$this->form_validation->set_rules('facebook', 'facebook', 'trim|required');
	$this->form_validation->set_rules('instagram', 'instagram', 'trim|required');
	$this->form_validation->set_rules('linkedin', 'linkedin', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Team.php */
/* Location: ./application/controllers/Team.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-07-07 11:54:27 */
/* http://harviacode.com */