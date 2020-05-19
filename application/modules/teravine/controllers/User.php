<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller {
    private $prefix         = 'user';
    private $table_db       = 'tbl_user';
    private $title          = 'User';
    private $logTable       = '';
    private $url            = 'teravine/user/';
    private $setting;

    function __construct() {


        //aktive session
        $data_session = array(
            'USER_ID'       => 'admin',
            'USER_USERNAME' => 'admin',
           
        );
        $this->session->set_userdata('USER',$data_session);
        $this->session->set_userdata('IS_LOGIN', TRUE);


        parent::__construct();
        $this->middleware('guest', 'forbidden');
        $this->setting  = [
            'instance'  => $this->prefix,
            'url'       => $this->url,
            'method'    => $this->router->method,
            'title'     => $this->title,
            'pagetitle' => $this->title
        ];
    }

    public function index(){
      
        $cek_count = $this->db->query("SELECT count(*) as jml FROM tbl_user")->row()->jml;
        $data['cek_count']  = $cek_count;
        $data['setting']    = $this->setting;
        $data['url']        = $this->url;
        $data['breadcrumb'] = ['Master' => TRUE, $this->title => $this->url];
        $js['custom']       = ['table-ajax'];
        $this->template->display($this->prefix, $data, $js);
    }

    public function get_table(){
        //select data
        $aCari = [
            'id'      => 'id',
            'nama'    => 'nama',
            'no_hp' => 'no_hp',
            'email'    => 'email',
            'alamat'    => 'alamat',
        ];

        $tmpSelect = [
           'id','nama','no_hp','email','alamat'
        ];


        //pencarian
        $where  = [];
        $whereE = " 0=0 ";
        foreach ($aCari as $key => $value) {
            if(isset($_REQUEST[$key]))
            {
                if($_REQUEST[$key] != '' && $_REQUEST[$key] != '-')
                {
                    $where[$value.' LIKE '] = '%'.$_REQUEST[$key].'%';
                } 
                if($_REQUEST[$key] == '-')
                {
                    $whereE .= " AND ".$value." = '' ";
                }
            } 
            
        }


        //orderby
        $join   = NULL;
        $keys = array_keys($aCari);
        if (isset($_REQUEST['order'])) {
            @$order = [$aCari[$keys[($_REQUEST['order'][0]['column'])]], $_REQUEST['order'][0]['dir']];
        }else{
            $order = ['id','desc'];
        }

        //default setting
        $iTotalRecords  = $this->m_global->countDataAll($this->table_db, $join, $where, $whereE);
        $iDisplayLength = intval($_REQUEST['length']);
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart  = intval($_REQUEST['start']);
        $sEcho = intval($_REQUEST['draw']);
        $records = [];
        $records["data"] = [];
        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;
        $select = implode(',', array_merge($tmpSelect, $aCari));
        $result = $this->m_global->getDataAll($this->table_db, $join, $where, $select, $whereE, $order, $iDisplayStart, $iDisplayLength);
        // echo $this->db->last_query();exit;
        $i = 1 + $iDisplayStart;

        //tampilkan datanya disini
        $param = [];
        foreach ($result as $rows) {
            $id = $rows->id;
            $param[] = [
                            $i,
                            $rows->nama,
                            $rows->no_hp,
                            $rows->email,
                            $rows->alamat,
                            "",
                        ];
            $i++;
        }
        $records["data"]            = $param;
        $records["draw"]            = $sEcho;
        $records["recordsTotal"]    = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;
        echo json_encode($records);
    }


    public function show_add(){
        csrf_init();

        $data['setting']    = $this->setting;
        $data['breadcrumb'] = ['Master' => TRUE, $this->title => $this->url, 'Tambah' => $this->url.$this->setting['method']];
        $js['custom']       = ['form-validation'];
        $this->template->display($this->prefix.'_add', $data, $js);
    }

    public function add(){

        $input['ex_csrf_token'] = @$this->input->post('ex_csrf_token');
        $res    = [];
        if (csrf_get_token() != $input['ex_csrf_token']){
            $res['status']  = 2;
            $res['message'] = $this->csrf_message;
            echo json_encode($res);
        }else{
            $arr_almt = $this->input->post('almt');

            if($arr_almt){
                $this->form_validation->set_rules('almt[]','Nama','required|trim|xss_clean');
            }

            $this->form_validation->set_rules('nama','Nama','required|trim|xss_clean');
            $this->form_validation->set_rules('no_hp','Nama','required|trim|xss_clean');
            $this->form_validation->set_rules('email','Nama','required|trim|xss_clean');
            $this->form_validation->set_rules('alamat','Nama','required|trim|xss_clean');
           
            if ($this->form_validation->run($this))
            {

                $data = [
                    'nama'      => $this->input->post('nama'),
                    'no_hp'     => $this->input->post('no_hp'),
                    'email'     => $this->input->post('email'),
                    'alamat'    => $this->input->post('alamat'),
                ];

                $result = $this->m_global->insert($this->table_db, $data);
               
                $us_id = $this->db->insert_id();
                if($arr_almt){
                    foreach($arr_almt as $ls){  
                        $data_alamat = [
                            'us_id'     => $us_id,
                            'alamat'    => $ls,
                        ];
                        $this->m_global->insert('tbl_alamat', $data_alamat);
                    }
                   
                }
                // echo '<pre>';print_r($result);exit;

                if ($result['status'])
                {
                    $res['status'] = 1;
                    $res['message'] = 'successfully add data';
                    echo json_encode($res);
                }
                else
                {
                    $res['status'] = 0;
                    $res['message'] = 'Failed Add Data !';
                    echo json_encode($res);
                }

            }else{
                $res['status'] = 3;
                $str                = ['<p>', '</p>'];
                $str_replace        = ['<li>', '</li>'];
                $res['message']    = str_replace($str, $str_replace, validation_errors());
                echo json_encode($res);
            }
        }
    }



}
