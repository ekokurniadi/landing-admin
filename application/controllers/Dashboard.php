<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dashboard extends MY_Controller {

    // protected $access=array('Admin');
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('form_validation');
    }
    
	public function index()
	{	
        $data=array(
            'user'=>$this->db->get('user'),  
        );
       
        $this->load->view('header');
        $this->load->view('index',$data);
        $this->load->view('footer');
    }
    
    public function getNotif(){
	
			
			$result=array();
			$res = $this->db->query("SELECT * from message where is_read='0'");
			
			$response = array();
			if($res->num_rows() <= 0){
				$result=array(
					"status"=>"0",
					"pesan"=>"Tidak ada notifikasi"
				);
				echo json_encode($result);
			}else{
				foreach($res->result() as $rows){
					$sub_array=array();
					$sub_array[]="Hallo ".ucwords($_SESSION['nama']);
                    $sub_array[]=$rows->name;
                    $sub_array[]= base_url()."message/update/".$rows->id;
                    $sub_array[]="Anda mendapatkan pesan dari ".$rows->name.", silahkan baca pesan nya.";
					$response[]=$sub_array;
				}
				
				echo json_encode(array(
                    "total_notif"=>	$res->num_rows(),
                    "pesan"=>"Kamu memiliki ".$res->num_rows()." pemberitahuan",
                    "data"=>$response,
                ));
			}
		
	}
    

    
}
?>