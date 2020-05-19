<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_base extends MX_Controller {
    private $prefix         = 'template_base';
    private $title          = 'Template';
    private $url            = 'template/template_base/';
    private $setting;

    function __construct() {
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

    public function index()
    {
        $data['setting']    = $this->setting;
        $data['url']        = $this->url;
        $data['breadcrumb'] = [$this->title => $this->setting['url']];
        $this->template->display($this->url.'/'.$this->prefix, $data);
    }
    

   


}
