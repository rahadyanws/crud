<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backgrid247 {
  private $ci;
  private $client;
  private $super_key;
  private $base_url;
  private $chart_url;
  private $sql_url;
  private $mapreduce_url;
  private $config;

  function __construct() {
  $this->ci =& get_instance();
  $this->config = $this->ci->config->item('backgrid');
  $this->base_url = $this->config['base_url'];
  $this->sql_url = $this->config['sql_url'];
  $this->chart_url = $this->config['chart_url'];
  $this->mapreduce_url = $this->config['mapreduce_url'];
  $this->super_key = $this->config['super_key'];
  }

  function getSuperKey() {
    return $this->super_key;
  }

  /**
   * _headers
   *
   * Fungsi untuk merubah array ke format header untuk fungsi HTTP
   *
   * @param   array   $headers  Array daftar header yang akan diolah
   *
   * @return  string            Nilai olahan balik
   */
  public function _headers($headers) {
      $output = array();
      if (!$headers) return $output;
      foreach($headers as $key => $value) {
        array_push($output, "$key: $value");
      }
      return $output;
  }

    /**
   * HTTP POST
   *
   * Fungsi untuk melakukan request via HTTP method post
   *
   * @param   string  $url      URL sumber data
   * @param   array   $content  parameter dan data input
   * @param   array   $login    informasi login bila dibutuhkan. default: false
   * @param   array   $headers  Informasi yang akan ditambahkan dalam headers. default: array kosong
   *
   * @return  string            Nilai balik dari URL
   */
  public function post($url, $content, $headers = array()) {
    $self = $this;

    $url = $this->base_url . $url . $this->super_key;
    //$url = 'http://192.168.1.228:1414/563a235ce765dd8171a8ca2d';

    $content = json_encode($content);

    $handle = curl_init();
    // $url = (is_array($content)) ? "$url?".http_build_query($content) : $url . '/' . $content;

    $headers['Content-Type'] = 'application/json';
    $headers['Content-length'] = strlen($content);
    curl_setopt_array($handle, array(
        CURLOPT_POST       => true,
        CURLOPT_VERBOSE    => false,
        CURLOPT_URL        => $url,
        CURLOPT_POSTFIELDS => $content,
        CURLOPT_HTTPHEADER => $self->_headers($headers),
        CURLOPT_HEADER     => true,
        CURLOPT_RETURNTRANSFER => true
    ));
    $raw = curl_exec($handle);

    // get header
    $header_len = curl_getinfo($handle, CURLINFO_HEADER_SIZE);
    $this->curlerr['header'] = substr($raw, 0, $header_len);

    $this->curlerr['info'] = curl_getinfo($handle);
    $this->curlerr['errno'] = curl_errno($handle);
    curl_close($handle);

    return substr($raw, $header_len);
  }

  public function posta1($url, $content, $headers = array()) {
    $self = $this;

    $url = $this->sql_url . $url . $this->super_key; ;
    error_log(__FILE__ . ' : ' . __LINE__ . json_encode($url));

    $content = json_encode($content);

    $handle = curl_init();
    // $url = (is_array($content)) ? "$url?".http_build_query($content) : $url . '/' . $content;

    $headers['Content-Type'] = 'application/json';
    $headers['Content-length'] = strlen($content);
    curl_setopt_array($handle, array(
        CURLOPT_POST       => true,
        CURLOPT_VERBOSE    => false,
        CURLOPT_URL        => $url,
        CURLOPT_POSTFIELDS => $content,
        CURLOPT_HTTPHEADER => $self->_headers($headers),
        CURLOPT_HEADER     => true,
        CURLOPT_RETURNTRANSFER => true
    ));
    $raw = curl_exec($handle);

    // get header
    $header_len = curl_getinfo($handle, CURLINFO_HEADER_SIZE);
    $this->curlerr['header'] = substr($raw, 0, $header_len);

    $this->curlerr['info'] = curl_getinfo($handle);
    $this->curlerr['errno'] = curl_errno($handle);
    curl_close($handle);

    return substr($raw, $header_len);
  }



  /**
   * HTTP GET
   *
   * Fungsi untuk melakukan request via HTTP method get
   *
   * @param   string  $url      URL sumber data
   * @param   array   $content  parameter dan data input
   * @param   array   $login    informasi login bila dibutuhkan. default: false
   * @param   array   $headers  Informasi yang akan ditambahkan dalam headers. default: array kosong
   *
   * @return  string            Nilai balik dari URL
   */
  public function get($url, $content = array(), $login = false, $headers = array()) {
    $self = $this;

    $url = $this->base_url . $url . $this->super_key;

    $handle = curl_init();

    $url = (is_array($content)) ? "$url?".http_build_query($content) : $url . '/' . $content;

    // $url = (count($content)) ? "$url?".http_build_query($content) : $url;
    // echo $url;

    curl_setopt_array($handle, array(
        CURLOPT_VERBOSE    => false,
        CURLOPT_URL        => $url,
        CURLOPT_HTTPHEADER => $self->_headers($headers),
        CURLOPT_HEADER     => true,
        CURLOPT_RETURNTRANSFER => true
    ));

    $raw = curl_exec($handle);
    // get header
    $header_len = curl_getinfo($handle, CURLINFO_HEADER_SIZE);
    $this->curlerr['header'] = substr($raw, 0, $header_len);

    $this->curlerr['info'] = curl_getinfo($handle);
    $this->curlerr['errno'] = curl_errno($handle);
    curl_close($handle);
    return substr($raw, $header_len);
  }

  public function get2($url, $apikey, $content= array(), $login = false, $headers = array()) {
    $self = $this;

    $url = $this->base_url . $url . $apikey;

    $handle = curl_init();

    $url = (is_array($content)) ? "$url?".http_build_query($content) : $url . '/' . $content;

    curl_setopt_array($handle, array(
        CURLOPT_VERBOSE    => false,
        CURLOPT_URL        => $url,
        CURLOPT_HTTPHEADER => $self->_headers($headers),
        CURLOPT_HEADER     => true,
        CURLOPT_RETURNTRANSFER => true
    ));

    $raw = curl_exec($handle);
    // get header
    $header_len = curl_getinfo($handle, CURLINFO_HEADER_SIZE);
    $this->curlerr['header'] = substr($raw, 0, $header_len);

    $this->curlerr['info'] = curl_getinfo($handle);
    $this->curlerr['errno'] = curl_errno($handle);
    curl_close($handle);
    return substr($raw, $header_len);
  }

  public function get3($url, $url2, $content = array(), $login = false, $headers = array()) {
    error_log("masuk get3");
    $self = $this;

    $url = $this->base_url . $url . $this->super_key . $url2;
    error_log($url);
    $handle = curl_init();
    $url = (is_array($content)) ? "$url?".http_build_query($content) : $url . '/' . $content;

    // $url = (count($content)) ? "$url?".http_build_query($content) : $url;
    // echo $url;

    curl_setopt_array($handle, array(
        CURLOPT_VERBOSE    => false,
        CURLOPT_URL        => $url,
        CURLOPT_HTTPHEADER => $self->_headers($headers),
        CURLOPT_HEADER     => true,
        CURLOPT_RETURNTRANSFER => true
    ));

    $raw = curl_exec($handle);
    // get header
    $header_len = curl_getinfo($handle, CURLINFO_HEADER_SIZE);
    $this->curlerr['header'] = substr($raw, 0, $header_len);

    $this->curlerr['info'] = curl_getinfo($handle);
    $this->curlerr['errno'] = curl_errno($handle);
    curl_close($handle);
    return substr($raw, $header_len);
  }

  public function get4($url, $content = array(), $login = false, $headers = array()) {
    $self = $this;

    $url = $this->sql_url . $url . $this->super_key;
//    error_log(__FILE__ . ' : ' . __LINE__ . json_encode($url));

    $handle = curl_init();

    $url = (is_array($content)) ? "$url?".http_build_query($content) : $url . '/' . $content;

    curl_setopt_array($handle, array(
        CURLOPT_VERBOSE    => false,
        CURLOPT_URL        => $url,
        CURLOPT_HTTPHEADER => $self->_headers($headers),
        CURLOPT_HEADER     => true,
        CURLOPT_RETURNTRANSFER => true
    ));

    $raw = curl_exec($handle);
    // get header
    $header_len = curl_getinfo($handle, CURLINFO_HEADER_SIZE);
    $this->curlerr['header'] = substr($raw, 0, $header_len);

    $this->curlerr['info'] = curl_getinfo($handle);
    $this->curlerr['errno'] = curl_errno($handle);
    curl_close($handle);
    return substr($raw, $header_len);
  }

  public function get5($content = array(), $login = false, $headers = array()) {
    $self = $this;

    $url = $this->chart_url;
//    error_log(__FILE__ . ' : ' . __LINE__ . json_encode($url));

    $handle = curl_init();

    $url = (is_array($content)) ? "$url?".http_build_query($content) : $url . '/' . $content;

    curl_setopt_array($handle, array(
        CURLOPT_VERBOSE    => false,
        CURLOPT_URL        => $url,
        CURLOPT_HTTPHEADER => $self->_headers($headers),
        CURLOPT_HEADER     => true,
        CURLOPT_RETURNTRANSFER => true
    ));

    $raw = curl_exec($handle);
    // get header
    $header_len = curl_getinfo($handle, CURLINFO_HEADER_SIZE);
    $this->curlerr['header'] = substr($raw, 0, $header_len);

    $this->curlerr['info'] = curl_getinfo($handle);
    $this->curlerr['errno'] = curl_errno($handle);
    curl_close($handle);
    return substr($raw, $header_len);
  }

  public function getMapReduce($url, $content = array(), $login = false, $headers = array()) {
    $self = $this;

    $url = $this->mapreduce_url . $url ;

    $handle = curl_init();

    $url = (is_array($content)) ? "$url?".http_build_query($content) : $url . '/' . $content;

    // $url = (count($content)) ? "$url?".http_build_query($content) : $url;
    // echo $url;

    curl_setopt_array($handle, array(
        CURLOPT_VERBOSE    => false,
        CURLOPT_URL        => $url,
        CURLOPT_HTTPHEADER => $self->_headers($headers),
        CURLOPT_HEADER     => true,
        CURLOPT_RETURNTRANSFER => true
    ));

    $raw = curl_exec($handle);
    // get header
    $header_len = curl_getinfo($handle, CURLINFO_HEADER_SIZE);
    $this->curlerr['header'] = substr($raw, 0, $header_len);

    $this->curlerr['info'] = curl_getinfo($handle);
    $this->curlerr['errno'] = curl_errno($handle);
    curl_close($handle);
    return substr($raw, $header_len);
  }


  /**
   * HTTP DELETE
   *
   * Fungsi untuk melakukan request via HTTP method delete
   *
   * @param   string  $url      URL sumber data
   * @param   array   $content  parameter dan data input
   * @param   array   $login    informasi login bila dibutuhkan. default: false
   * @param   array   $headers  Informasi yang akan ditambahkan dalam headers. default: array kosong
   *
   * @return  string            Nilai balik dari URL
   */
  public function delete($url, $content = array(), $login = false, $headers = array()) {
    $self = $this;

    $url = $this->base_url . $url . $this->super_key;

    $handle = curl_init();

    $url = (is_array($content)) ? $url : $url . '/' . $content;

    $content = json_encode($content);

    $headers['Content-Type'] = 'application/json';
    $headers['Content-length'] = strlen($content);


    curl_setopt_array($handle, array(
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_VERBOSE    => false,
        CURLOPT_URL        => $url,
        CURLOPT_POSTFIELDS => $content,
        CURLOPT_HEADER     => false,
        CURLOPT_HTTPHEADER => $self->_headers($headers),
        CURLOPT_RETURNTRANSFER => true
    ));

    $raw = curl_exec($handle);
    // get header
    $header_len = curl_getinfo($handle, CURLINFO_HEADER_SIZE);
    $this->curlerr['header'] = substr($raw, 0, $header_len);

    $this->curlerr['info'] = curl_getinfo($handle);
    $this->curlerr['errno'] = curl_errno($handle);
    curl_close($handle);
    error_log(json_encode($raw));
    // return substr($raw, $header_len);
    return $raw;
  }

    /**
   * HTTP PUT
   *
   * Fungsi untuk melakukan request via HTTP method put
   *
   * @param   string  $url      URL sumber data
   * @param   array   $content  parameter dan data input
   * @param   array   $login    informasi login bila dibutuhkan. default: false
   * @param   array   $headers  Informasi yang akan ditambahkan dalam headers. default: array kosong
   *
   * @return  string            Nilai balik dari URL
   */

  public function delete2($url, $apikey, $content = array(), $login = false, $headers = array()) {
    $self = $this;

    $url = $this->base_url . $url . $apikey;

    $handle = curl_init();

    $url = (is_array($content)) ? $url : $url . '/' . $content;

    $content = json_encode($content);

    $headers['Content-Type'] = 'application/json';
    $headers['Content-length'] = strlen($content);


    curl_setopt_array($handle, array(
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_VERBOSE    => false,
        CURLOPT_URL        => $url,
        CURLOPT_POSTFIELDS => $content,
        CURLOPT_HEADER     => false,
        CURLOPT_HTTPHEADER => $self->_headers($headers),
        CURLOPT_RETURNTRANSFER => true
    ));

    $raw = curl_exec($handle);
    // get header
    $header_len = curl_getinfo($handle, CURLINFO_HEADER_SIZE);
    $this->curlerr['header'] = substr($raw, 0, $header_len);

    $this->curlerr['info'] = curl_getinfo($handle);
    $this->curlerr['errno'] = curl_errno($handle);
    curl_close($handle);
    error_log(json_encode($raw));
    // return substr($raw, $header_len);
    return $raw;
  }

  public function delete3($url, $content, $login = false, $headers = array()) {
    $self = $this;

    $url = $this->sql_url . $url . $this->super_key;
    error_log(__FILE__ . ' : ' . __LINE__ . json_encode($url));

    $handle = curl_init();

    $url = (is_array($content)) ? $url : $url . '/' . $content;

    $content = json_encode($content);

    $headers['Content-Type'] = 'application/json';
    $headers['Content-length'] = strlen($content);


    curl_setopt_array($handle, array(
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_VERBOSE    => false,
        CURLOPT_URL        => $url,
        CURLOPT_POSTFIELDS => $content,
        CURLOPT_HEADER     => false,
        CURLOPT_HTTPHEADER => $self->_headers($headers),
        CURLOPT_RETURNTRANSFER => true
    ));

    $raw = curl_exec($handle);
    // get header
    $header_len = curl_getinfo($handle, CURLINFO_HEADER_SIZE);
    $this->curlerr['header'] = substr($raw, 0, $header_len);

    $this->curlerr['info'] = curl_getinfo($handle);
    $this->curlerr['errno'] = curl_errno($handle);
    curl_close($handle);
    error_log(json_encode($raw));
    // return substr($raw, $header_len);
    return $raw;
  }

    /**
   * HTTP PUT
   *
   * Fungsi untuk melakukan request via HTTP method put
   *
   * @param   string  $url      URL sumber data
   * @param   array   $content  parameter dan data input
   * @param   array   $login    informasi login bila dibutuhkan. default: false
   * @param   array   $headers  Informasi yang akan ditambahkan dalam headers. default: array kosong
   *
   * @return  string            Nilai balik dari URL
   */
  public function put($url, $content, $id, $login = false, $headers = array()) {
    $self = $this;

    $url = $this->base_url . $url . $this->super_key;

    $handle = curl_init();

  $url = $url . '/' . $id;

  $url = (is_array($content)) ? "$url?".http_build_query($content) : $url . '/' . $content;

    $content = json_encode($content);

    $headers['Content-Type'] = 'application/json';
    $headers['Content-length'] = strlen($content);
    curl_setopt_array($handle, array(
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_VERBOSE    => false,
        CURLOPT_URL        => $url,
        CURLOPT_POSTFIELDS => $content,
        CURLOPT_HTTPHEADER => $self->_headers($headers),
        CURLOPT_HEADER     => false,
        CURLOPT_RETURNTRANSFER => true
    ));
    $raw = curl_exec($handle);

    // get header
    $header_len = curl_getinfo($handle, CURLINFO_HEADER_SIZE);
    $this->curlerr['header'] = substr($raw, 0, $header_len);

    $this->curlerr['info'] = curl_getinfo($handle);
    $this->curlerr['errno'] = curl_errno($handle);
    curl_close($handle);

    return $raw;
  }

  public function put2($url, $content, $login = false, $headers = array()) {
    $self = $this;

    $url = $this->base_url . $url . $this->super_key;

    $handle = curl_init();

  $url = (is_array($content)) ? "$url?".http_build_query($content) : $url . '/' . $content;

    $content = json_encode($content);

    $headers['Content-Type'] = 'application/json';
    $headers['Content-length'] = strlen($content);
    curl_setopt_array($handle, array(
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_VERBOSE    => false,
        CURLOPT_URL        => $url,
        CURLOPT_POSTFIELDS => $content,
        CURLOPT_HTTPHEADER => $self->_headers($headers),
        CURLOPT_HEADER     => false,
        CURLOPT_RETURNTRANSFER => true
    ));
    $raw = curl_exec($handle);

    // get header
    $header_len = curl_getinfo($handle, CURLINFO_HEADER_SIZE);
    $this->curlerr['header'] = substr($raw, 0, $header_len);

    $this->curlerr['info'] = curl_getinfo($handle);
    $this->curlerr['errno'] = curl_errno($handle);
    curl_close($handle);

    return $raw;
  }

  // user
  public function user_read($query = null){
    if (is_null($query)) {
      return json_decode($this->get('/user/read/'));
    } else {
      return json_decode($this->post('/user/read/', $query));
    }
  }

  public function role_read($query = null){
    if (is_null($query)) {
      return json_decode($this->get('/role/read/'));
    }else{
      return json_decode($this->get('/role/read/', $query));
    }
  }

  public function role_listpermission(){
      return json_decode($this->get('/role/listpermission/'));
  }

  public function user_create($query = null) {
    if (is_null($query)) {
      return null;
    } else {
      return json_decode($this->post('/user/create/', $query));
    }
  }

  public function role_create($query = null) {
    if (is_null($query)) {
      return null;
    } else {
      return json_decode($this->post('/role/create/', $query));
    }
  }

  public function role_update($query = null) {
    if (is_null($query)) {
      return null;
    } else {
      $rid = $query['rid'];
      unset($query['rid']);
      return json_decode($this->put('/role/update/', $query, $rid));
    }
  }

  public function user_update($uid, $query = null) {
    if (is_null($query)) {
      return null;
    } else {
      return json_decode($this->put('/user/update/', $query, $uid));
    }
  }

  public function user_readID($uid) {
    if (is_null($uid)) {
      return null;
    } else {
      return json_decode($this->get('/user/read/', $uid));
    }
  }

  public function user_readInv($uid) {
    if (is_null($uid)) {
      return null;
    } else {
      $user = json_decode($this->get('/user/read/', $uid));
      if($user->code == 1) {
        $user = $user->message[0];
        foreach ($user->apikey as $k => $v){
          if (isset($user->inventoryDir)) {
            foreach ($user->inventoryDir as $ki => $vi){
              if($ki == $v->apikey){
                $inv["message"][$k] = $this->get2('/inventory/read/', $ki);
                $inv["code"] = 1;
                $inv["status"]= "success";
              }
            }
          }
        }
        if(!isset($inv)){
          $inv["code"] = 0;
        }
        return json_decode(json_encode($inv), false);
      }else{
//        var_dump($user);die();
        return $user;
      }
    }
  }

  public function user_delete($uid) {
    if (is_null($uid)) {
      return null;
    } else {
      return json_decode($this->delete('/user/remove/', $uid));
    }
  }

  public function role_delete($uid) {
    if (is_null($uid)) {
      return null;
    } else {
      return json_decode($this->delete('/role/remove/', $uid));
    }
  }

  // history
  public function user_history($params = array()) {
  return json_decode($this->get('/user/history/', $params));
  }

    // generate apikey
  public function create_apikey($query = null) {
    // print_r($query);die();
    if (is_null($query)) {
      return null;
    } else {
      return json_decode($this->post('/apikey/create/', $query));
    }
  }

  public function checkin_apikey($query) {
    if (is_null($query)) {
      return null;
    } else {
      return json_decode($this->get('/apikey/checkin/', $query));
    }
  }

  public function checkout_apikey($query) {
    if (is_null($query)) {
      return null;
    } else {
      return json_decode($this->get('/apikey/checkout/', $query));
    }
  }

  public function delete_apikey($query = null) {
    if (is_null($query)) {
      return null;
    } else {
      return json_decode($this->delete('/apikey/remove/', $query));
    }
  }

  public function delete_inventory($data = null) {
    if (is_null($data)) {
      return null;
    } else {
      return json_decode($this->delete2('/inventory/remove/', $data["apikeyid"], $data["iid"]));
    }
  }

  public function inventory_read($apikey = null) {
    if (is_null($apikey)) {
      return null;
    } else {
      return json_decode($this->get2('/inventory/read/', $apikey));
    }
  }

  public function job_readall($url2=null) {
    $url2 = "/jobs/";
      error_log("masuk job_read");
    if (is_null($url2)) {
      return null;
    } else {
      return json_decode($this->get3('/historyserver/', $url2));
    }
  }

  public function jobtasks_readall($data=array()) {
      error_log("masuk jobtasks_readall");
      $url2 = $data['jobs'].$data['jobid'].$data['tasks'];
     error_log($url2);
    if (is_null($data)) {
      return null;
    } else {
      return json_decode($this->get3('/historyserver/', $url2));
    }
  }

  public function cluster_read() {
    return json_decode($this->get('/config/'));
  }

  public function eventtype_read() {
      $data = json_decode($this->get5());
      error_log(__FILE__ . ' : ' . __LINE__ . json_encode($data));
      return $data;
  }

  public function sql_submit($query) {
//    error_log(__FILE__ . ' : ' . __LINE__ . json_encode($query));
    if (is_null($query)) {
      return null;
    } else {
      $data = json_decode($this->posta1('/sqlquery/', $query));
//        error_log(__FILE__ . ' : ' . __LINE__ . json_encode($data));
      return $data;
    }
  }

  public function sql_delete($query) {
//    error_log(__FILE__ . ' : ' . __LINE__ . json_encode($query));
    if (is_null($query)) {
      return null;
    } else {
      return json_decode($this->posta1('/drop/', $query));
    }
  }
	
  public function sql_tableread(){
      $data = json_decode($this->get4('/phoenix/'));
//      error_log(__FILE__ . ' : ' . __LINE__ . json_encode($data));
      return $data;
  }

  public function sql_detail($table_name) {
//    error_log(__FILE__ . ' : ' . __LINE__ . json_encode($query));
    if (is_null($table_name)) {
      return null;
    } else {
      $data = json_decode($this->posta1('/sqlquery/', $table_name));
//        error_log(__FILE__ . ' : ' . __LINE__ . json_encode($data));
      return $data;
    }
  }

  public function ambari_host() {
    return json_decode($this->get('/ambari/hosts/'));
  }

  public function ambari_service() {
    return json_decode($this->get('/ambari/services/'));
  }

  public function oozie_listjob() {
    return json_decode($this->get('/testoozie/listjob/'));
  }

  public function oozie_jobid($jobid = null) {
    if (is_null($jobid)) {
      return null;
    } else {
      return json_decode($this->getMapReduce('/oozie/v1/job/', $jobid));
    }
  }

  public function oozie_infoid($jobid = null) {
    if (is_null($jobid)) {
      return null;
    } else {
      $url2 = '/jobs/'.$jobid;
      return json_decode($this->get3('/historyserver/', $url2, $content = array(), $login = false, $headers = array()));
    }
  }

}
