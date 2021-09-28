<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* End of file connect_helper.php */
/* Location: ./system/helpers/array_helper.php */
if ( ! function_exists('admin_url'))
{
    function admin_url()
    {
        $CI = get_instance();
        return $CI->config->item('admin_url');
    }
}

if ( ! function_exists('admin_controller'))
{
    function admin_controller()
    {
        $CI = get_instance();
        return $CI->config->item('admin_controller');
    }

}

if ( ! function_exists('show_admin404'))
{
    function show_admin404()
    {
        $CI = get_instance();
        return $CI->load->view('common/admin_error_page');
    }
}

if ( ! function_exists('show_404'))
{
    function show_404()
    {
        $CI = get_instance();
        return $CI->load->view('common/error_page');
    }
}

if ( ! function_exists('get_session'))
{
    function get_session($session_name)
    {
        $CI = get_instance();
        return $CI->session->userdata($session_name);
    }

}
if ( ! function_exists('set_session'))
{
    function set_session($session_name, $value)
    {
        $CI = get_instance();
        return $CI->session->set_userdata($session_name, $value);
    }

}
if ( ! function_exists('unset_session'))
{
    function unset_session($session_name)
    {
        $CI = get_instance();
        return $CI->session->unset_userdata($session_name);
    }
}
if ( ! function_exists('admin_email'))
{
    function admin_email()
    {
        $CI = get_instance();
        return $CI->config->item('admin_email');
    }
}
if ( ! function_exists('no_reply_email'))
{
    function no_reply_email()
    {
        $CI = get_instance();
        return $CI->config->item('no_reply_email');
    }
}
if ( ! function_exists('login_email'))
{
    function login_email()
    {
        $CI = get_instance();
        return $CI->config->item('login_email');
    }
}

if ( ! function_exists('custom_substr'))
{
    function custom_substr($x, $length) {
        if (strlen($x) <= $length) {
            echo $x;
        } else {
            $y = substr($x, 0, $length) . '...';
            echo $y;
        }
    }
}

if ( ! function_exists('support_email'))
{
    function support_email()
    {
        $CI = get_instance();
        return $CI->config->item('support_email');
    }
}

if ( ! function_exists('show'))
{
    function show($data){
        echo "<pre>";
        print_r($data);
    }
}

if ( ! function_exists('formated_date'))
{
    function formated_date($datee){
        return date("d/m/Y" , strtotime($datee));
    }
}

if ( ! function_exists('db_date'))
{
    function db_date($datee){
        return date("Y-m-d" , strtotime($datee));
    }
}

if ( ! function_exists('js_date_formate'))
{
    function js_date_formate(){
        return "dd/mm/yyyy";
    }
}

if ( ! function_exists('singleRow'))
{
    function singleRow($table, $select_col, $where_arr = '') {
        $CI = & get_instance();

        $CI->db->select($select_col);
        $CI->db->from($table);
        if ($where_arr != '') {
            $CI->db->where($where_arr);
        }
        $query = $CI->db->get();
        return $query->row_array();
    }
}

if ( ! function_exists('singleCol'))
{
    function singleCol($table, $select_col, $where_arr = '') {
        $CI = & get_instance();

        $CI->db->select($select_col);
        $CI->db->from($table);
        if ($where_arr != '') {
            $CI->db->where($where_arr);
        }
        $query = $CI->db->get()->row_array();
        return $query[$select_col];
    }
}

if ( ! function_exists('get_setting'))
{
    function get_setting($meta_tag, $meta_key="", $all = 0, $meta_value="") {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('general_settings');
        $CI->db->where('meta_tag', $meta_tag);
        if ($meta_key!="") {
            $CI->db->where('meta_key', $meta_key);
        }

		if ($meta_value!="") {
            $CI->db->where('meta_value', $meta_value);
        }
        if($all == 1){
            $query = $CI->db->get()->result_array();
            return $query;
        }else{
            $query = $CI->db->get()->row_array();
            return $query['meta_value'];
        }
    }
}

if ( ! function_exists('coverage_type'))
{
    function coverage_type() {

        $coverage = array(
            1=>array("value"=>3,"name"=>"Pool/Spa"),
            2=>array("value"=>4,"name"=>"Central Vacuum"),
            3=>array("value"=>5,"name"=>"Septic System"),
            4=>array("value"=>6,"name"=>"Stand Alone Freezer"),
            5=>array("value"=>7,"name"=>"Free Standing Ice Maker"),
            6=>array("value"=>8,"name"=>"Add'l Water Heater"),
            7=>array("value"=>9,"name"=>"Additional Spa"),
            8=>array("value"=>3,"name"=>"Sump Pump"),
            9=>array("value"=>4,"name"=>"Septic Pumping"),
            10=>array("value"=>5,"name"=>"Water Softener"),
            11=>array("value"=>6,"name"=>"Add'l A/C System"),
            12=>array("value"=>7,"name"=>"Add'l Garage Door Opener"),
            13=>array("value"=>8,"name"=>"Limited Roof Leak"),
            14=>array("value"=>9,"name"=>"Well Pump"),
            15=>array("value"=>3,"name"=>"Second Refrigerator"),
            16=>array("value"=>4,"name"=>"Refrigerator Ice Maker"),
            17=>array("value"=>5,"name"=>"Add'l Heating System"),
            18=>array("value"=>6,"name"=>"Add'l Oven/Range/Stove")
        );
        return $coverage;
    }
}

if ( ! function_exists('claim_status'))
{
    function claim_status($value='') {

        $status = array(
            1=>'New',
            2=>'Assigned',
            3=>'Open Callback',
            4=>'Suspended',
            5=>'Reassign',
            6=>'NTIA',
            7=>'Review',
            8=>'Supervisor Callback',
            9=>'Vendor Callback',
            10=>'Closed Approved',
            11=>'Closed Denied',
            12=>'Closed Buyout',
            13=>'Closed Goodwill',
            14=>'Closed Cap',
            15=>'Closed',
        );
        if (empty($value)){
            return $status;
        }else{
            foreach ($status as $index=>$stat){
                if ($value==$index){
                    return $stat;
                }
            }
        }
    }
}

if ( ! function_exists('policy_status'))
{
    function policy_status($value='') {

        $status = array(
            1=>'New',
            2=>'Active',
            3=>'InActive',
            4=>'Past Due',
            5=>'Cancelled',
            6=>'Expired',
        );
        if (empty($value)){
            return $status;
        }else{
            foreach ($status as $index=>$stat){
                if ($value==$index){
                    return $stat;
                }
            }
        }
    }
}
if ( ! function_exists('vendor_services'))
{
    function vendor_services($value='') {

        $services = array(
            1=>'HVAC',
            2=>'Appliances',
            3=>'Plumbing',
            4=>'Electrical',
            5=>'Garage Door Openers',
            6=>'Pool & Spa',
            7=>'Roofing',
            8=>'Central Vacuum Systems',
            9=>'Well Pumps',
            10=>'Septic System & Pumping',
            11=>'Sprinkler System',
            12=>'Drywall',
            13=>'Garbage Disposal'
        );
        if (empty($value)){
            return $services;
        }else{
            foreach ($services as $index=>$service){
                if ($value==$index){
                    return $service;
                }
            }
        }
    }
}


if ( ! function_exists('get_sales_representative'))
{
    function get_sales_representative($id='') {
        $CI = & get_instance();
        $CI->db->select('id,FirstName,LastName');
        $CI->db->from('admins');
        $CI->db->where('type',2);
        if ($id!=''){
            $CI->db->where('id',$id);
            $query = $CI->db->get()->row_array();
        }else{
            $query = $CI->db->get()->result_array();
        }
        return $query;
    }
}

if ( ! function_exists('get_salesperson'))
{
    function get_salesperson($id='') {
        $CI = & get_instance();
        $CI->db->select('id,FirstName,LastName');
        $CI->db->from('admins');
        $CI->db->where('type',2);
        if ($id!=''){
            $CI->db->where('id',$id);
            $query = $CI->db->get()->row_array();
        }else{
            $query = $CI->db->get()->result_array();
        }
        return $query;
    }
}

if ( ! function_exists('get_agent'))
{
    function get_agent($id='') {
        $CI = & get_instance();
        $CI->db->select('id,FirstName,LastName');
        $CI->db->from('admins');
        if ($id!=''){
            $CI->db->where('id',$id);
            $query = $CI->db->get()->row_array();
        }else{
            $query = $CI->db->get()->result_array();
        }
        return $query;
    }
}

if ( ! function_exists('get_leadsource'))
{
    function get_leadsource($id='') {
        $CI = & get_instance();
        $CI->db->select('id,name,cost');
        $CI->db->from('lead_source');
        $CI->db->where('status',1);
        if ($id!=''){
            $CI->db->where('id',$id);
            $query = $CI->db->get()->row_array();
        }else{
            $query = $CI->db->get()->result_array();
        }
        return $query;
    }
}

if ( ! function_exists('get_coverage'))
{
    function get_coverage($id, $renewal_id) {
        $CI = & get_instance();
        $CI->db->select('coverage,comments');
        $CI->db->from('extra_coverage');
        $CI->db->where('customer',$id);
        $CI->db->where('renewal_id',$renewal_id);
        $query = $CI->db->get()->result_array();
        return $query;
    }
}

if ( ! function_exists('get_coverage_ids'))
{
    function get_coverage_ids($id, $renewal_id) {
        $CI = & get_instance();
        $CI->db->select('coverage');
        $CI->db->from('extra_coverage');
        $CI->db->where('customer',$id);
        $CI->db->where('renewal_id',$renewal_id);
        $coverages = $CI->db->get()->result_array();

        $coverage_ids = array();
        $coverage_ids[] = 0;
        foreach ($coverages as $covg) {
            $coverage_ids[] = $covg['coverage'];
        }

        return $coverage_ids;
    }
}

if ( ! function_exists('total_accounts'))
{
    function total_accounts($email) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('customers');
        $CI->db->where('email',$email);
        $query = $CI->db->get()->result_array();
        return $query;
    }
}

if ( ! function_exists('get_customers'))
{
    function get_customers($id='') {
        $CI = & get_instance();
        $CI->db->select('id,first_name,last_name,city,state,zip_code,email,home_phone,salesperson');
        $CI->db->from('customers');
        if ($id==''){
            $query = $CI->db->get()->result_array();
        }else{
            $CI->db->where('id',$id);
            $query = $CI->db->get()->row_array();
        }
        return $query;
    }
}

if ( ! function_exists('get_vendors'))
{
    function get_vendors($id='') {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('vendors');
        if ($id==''){
            $query = $CI->db->get()->result_array();
        }else{
            $CI->db->where('id',$id);
            $query = $CI->db->get()->row_array();
        }
        return $query;
    }
}

if ( ! function_exists('get_claims'))
{
    function get_claims($status, $type) {
        $CI = & get_instance();
        if ($type==1){
            $CI->db->select('id,claim_num,customer,created_at,updated_at');
        }elseif ($type==2){
            $CI->db->select('*');
        }
        $CI->db->from('claims');
        $CI->db->where('status',$status);
        $CI->db->order_by('created_at', 'DESC');
        if ($type==1){
            return $CI->db->get()->result_array();
        }elseif ($type==2){
            return $CI->db->get()->num_rows();
        }
    }
}

if ( ! function_exists('claims_detail'))
{
    function claims_detail() {
        $CI = & get_instance();
        $CI->db->select('id,claim_num,customer,status,created_at,updated_at');
        $CI->db->from('claims');
        return $CI->db->get()->result_array();
    }
}

if ( ! function_exists('claims_count'))
{
    function claims_count($id="") {
        $CI = & get_instance();
        $CI->db->select('COUNT(*) AS total,status');
        $CI->db->from('claims');
        if ($id=="") {
            $CI->db->group_by('status');
        }else{
            $CI->db->where('customer',$id);
        }
        return $CI->db->get()->result_array();
    }
}

if ( ! function_exists('search_claim_status'))
{
    function search_claim_status($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['status'] == $id) {
                return $array[$key]['total'];
            }
        }
        return 0;
    }
}

if ( ! function_exists('search_claim_details'))
{
    function search_claim_details($id, $array) {
        $claims = array();
        foreach ($array as $key => $val) {
            if ($val['status'] == $id) {
                $claims[]=$val;
            }
        }
        return $claims;
    }
}

if ( ! function_exists('get_notes'))
{
    function get_notes($customer) {
        $CI = & get_instance();
        $CI->db->select('n.*');
        $CI->db->from('tasks_notes as n');
        $CI->db->where('n.type',2);
        $CI->db->where('n.customer',$customer);
        $CI->db->where('n.claim', NULL);
        $CI->db->order_by('created_at', 'DESC');
        return $CI->db->get()->result_array();
    }
}

if ( ! function_exists('get_notes_tasks'))
{
    function get_notes_tasks($customer) {
        $CI = & get_instance();
        $CI->db->select('n.*');
        $CI->db->from('tasks_notes as n');
        $CI->db->where('n.customer',$customer);
        $CI->db->where('n.type!=','3');
        $CI->db->where('n.claim', NULL);
        $CI->db->order_by('created_at', 'DESC');
        return $CI->db->get()->result_array();
    }
}

if ( ! function_exists('get_single_notes_tasks'))
{
    function get_single_notes_tasks($id) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('tasks_notes');
        $CI->db->where('id', $id);
        return $CI->db->get()->row_array();
    }
}

if ( ! function_exists('get_claim_notes'))
{
    function get_claim_notes($customer, $claim) {
        $CI = & get_instance();
        $CI->db->select('n.*');
        $CI->db->from('tasks_notes as n');
        $CI->db->where('n.type',2);
        $CI->db->where('n.customer',$customer);
        $CI->db->where('n.claim', $claim);
        $CI->db->order_by('created_at', 'DESC');
        return $CI->db->get()->result_array();
    }
}

if ( ! function_exists('get_claim_notes_tasks'))
{
    function get_claim_notes_tasks($customer, $claim) {
        $CI = & get_instance();
        $CI->db->select('n.*');
        $CI->db->from('tasks_notes as n');
        $CI->db->where('n.customer',$customer);
        $CI->db->where('n.claim', $claim);
        $CI->db->order_by('created_at', 'DESC');
        return $CI->db->get()->result_array();
    }
}

if ( ! function_exists('get_notes_type'))
{
    function get_notes_type($customer,$vendor) {
        $CI = & get_instance();
        $CI->db->select('n.*');
        $CI->db->from('tasks_notes as n');
        $CI->db->where('n.type',3);
		if(isset($customer) && $customer!=""){
			$CI->db->where('n.customer',$customer);
		}
		if(isset($vendor) && $vendor!=""){
			$CI->db->where('n.vendor',$vendor);
		}
        
        $CI->db->where('n.claim', NULL);
        $CI->db->order_by('created_at', 'DESC');
        return $CI->db->get()->result_array();
    }
}
if ( ! function_exists('get_staff_name'))
{
    function get_staff_name($id) {
        $CI = & get_instance();
        $CI->db->select('FirstName, LastName');
        $CI->db->from('admins');
        $CI->db->where('id',$id);
        return $CI->db->get()->row_array();
    }
}

if ( ! function_exists('get_timeago'))
{
    function get_timeago( $ptime )
    {
        $estimate_time =  time() - $ptime;


        if( $estimate_time < 1 )
        {
            return 'less than 1 second ago';
        }

        $condition = array(
            12*30*24*60*60  =>  'year',
            30*24*60*60     =>  'month',
            24*60*60            =>  'day',
            60 * 60                 =>  'hour',
            60                      =>  'minute',
            1                       =>  'second'
        );

        foreach( $condition as $secs => $str )
        {
            $d = $estimate_time / $secs;

            if( $d >= 1 )
            {
                $r = round( $d );
                return ''. $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
            }
        }
    }
}

if ( ! function_exists('get_data'))
{
    function get_data($id, $table, $where = "", $select = '', $limit = '', $order_by = "", $order = "", $joins = '', $group_by = "") {
        $CI = & get_instance();
        if ($group_by != "") {
            $CI->db->group_by($group_by);
        }
        if ($limit != "") {
            $CI->db->limit($limit[0], $limit[1]);
        }
        if (!is_array($order_by)) {
            if ($order_by != "") {
                if ($order != "") {
                    $CI->db->order_by($order_by, $order);
                } else {
                    $CI->db->order_by($order_by, "desc");
                }
            }
        } else {
            foreach ($order_by as $key => $orders) {
                $CI->db->order_by($orders[0], $orders[1]);
            }
        }
        if ($joins != "") {
            foreach ($joins as $join) {
                $CI->db->join($join[0], $join[1], $join[2]);
            }
        }
        if ($where != "") {
            $CI->db->where($where);
        }
        if ($id != "") {
            $CI->db->where('id', $id);
        }
        if (is_array($select)) {
            foreach ($select as $key => $value) {
                $CI->db->select($value);
            }
        } else {
            $CI->db->select($select);
        }
        $result = $CI->db->get($table)->result_array();
        return $result;
    }
}

if ( ! function_exists('task_count'))
{
    function task_count() {
        $CI = & get_instance();
        $CI->db->select('COUNT(*) as total');
        $CI->db->from('tasks_notes');
        $CI->db->where('type',1);
        $CI->db->where('status',1);
        if (get_session('admin_type') != 1){
            $CI->db->where('assign_to',get_session('admin_id'));
        }
        $query = $CI->db->get()->row_array();
        return $query['total'];
    }
}

if ( ! function_exists('get_authorization'))
{
    function get_authorization($id) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('claim_auth');
        $CI->db->where('claim',$id);
        $CI->db->where('status','1');
        $CI->db->order_by('created_at', 'DESC');
        $query = $CI->db->get()->result_array();
        return $query;
    }
}

if (! function_exists('count_all_score')){
    function count_all_score($salesperson)  {
        $CI = & get_instance();
        $CI->db->select("*");
        $CI->db->from("customers");
        $CI->db->where('salesperson', $salesperson);
        $query1  = $CI->db->get();
        $result = $query1->result_array();
        $years  = '0';
        // return count($query->result_array());
        if( count($result) > 0 ) {
            foreach ($result as $value) {
                $CI->db->select("*");
                $CI->db->from("policy");
                $CI->db->where('customer', $value['id']);
                $query2  = $CI->db->get();
                $policys = $query2->result_array();
                if( count($policys) > 0 ) {
                    foreach ($policys as $policy) {
                        $CI->db->select("*");
                        $CI->db->from("policy_renewal");
                        $CI->db->where('policy_num', $policy['policy_num']);
                        $CI->db->limit(1);
                        $CI->db->order_by('id',"DESC");
                        $query           = $CI->db->get();
                        $policy_renewal  = $query->result_array();
                        // if( $policy_renewal[0]['payment_as'] != '1' ) {
                            $years       = $years + $policy_renewal[0]['plan_year'];
                        // } else {
                            // $years       = $years + 1;
                        // }
                    }
                }
            }
        } 
        return $years;

    }
}
if (! function_exists('count_weekly_score')){
    function count_weekly_score($salesperson) {
    
    $day = date('l');
        if ($day == "Sunday"){
            $last_sunday = date('Y-m-d');
        }else{
            $last_sunday = date('Y-m-d',strtotime('last sunday'));
        }
        $current_date = date('Y-m-d');

        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('customers');
        $CI->db->where('salesperson', $salesperson);
        // $CI->db->where('DATE(created_at)', date('Y-m-d'));
        $CI->db->where('created_at <= ', $current_date);
        $CI->db->where('created_at >= ', $last_sunday);
        $query1 = $CI->db->get();
        // return $query->num_rows();
        $result = $query1->result_array();
        $years  = '0';
        // return count($query->result_array());
        if( count($result) > 0 ) {
            foreach ($result as $value) {
                $CI->db->select("*");
                $CI->db->from("policy");
                $CI->db->where('customer', $value['id']);
                $query2  = $CI->db->get();
                $policys = $query2->result_array();
                if( count($policys) > 0 ) {
                    foreach ($policys as $policy) {
                        $CI->db->select("*");
                        $CI->db->from("policy_renewal");
                        $CI->db->where('policy_num', $policy['policy_num']);
                        $CI->db->limit(1);
                        $CI->db->order_by('id',"DESC");
                        $query           = $CI->db->get();
                        $policy_renewal  = $query->result_array();
                        // if( $policy_renewal[0]['payment_as'] != '1' ) {
                            $years       = $years + $policy_renewal[0]['plan_year'];
                        // } else {
                            // $years       = $years + 1;
                        // }
                    }
                }
            }
        } 
        return $years;
    }
}
if (! function_exists('count_today_score')){
    function count_today_score($salesperson) {

        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('customers');
        $CI->db->where('salesperson', $salesperson);
        $CI->db->where('DATE(created_at)', date('Y-m-d'));
        $query1 = $CI->db->get();
        // return $query->num_rows();
        $result = $query1->result_array();
        $years  = '0';
        // return count($query->result_array());
        if( count($result) > 0 ) {
            foreach ($result as $value) {
                $CI->db->select("*");
                $CI->db->from("policy");
                $CI->db->where('customer', $value['id']);
                $query2  = $CI->db->get();
                $policys = $query2->result_array();
                if( count($policys) > 0 ) {
                    foreach ($policys as $policy) {
                        $CI->db->select("*");
                        $CI->db->from("policy_renewal");
                        $CI->db->where('policy_num', $policy['policy_num']);
                        $CI->db->limit(1);
                        $CI->db->order_by('id',"DESC");
                        $query           = $CI->db->get();
                        $policy_renewal  = $query->result_array();
                        // if( $policy_renewal[0]['payment_as'] != '1' ) {
                            $years       = $years + $policy_renewal[0]['plan_year'];
                        // } else {
                            // $years       = $years + 1;
                        // }
                    }
                }
            }
        } 
        return $years;
    }
}
if (! function_exists('get_customer_by_salesperson')){
    function get_customer_by_salesperson($salesperson) {

        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('customers');
        $CI->db->where('salesperson', $salesperson);
        $query = $CI->db->get();
        return $query->result_array();
    }
}

if (! function_exists('get_customer_by_leadsource')){
    function get_customer_by_leadsource($leadsource) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('customers');
        $CI->db->where('leadsource', $leadsource);
        $query = $CI->db->get();
        return $query->result_array();
    }
}

if (! function_exists('get_invoice_data')) {
    function get_invoice_data($auth_group) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('claim_auth');
        $CI->db->where('auth_for', $auth_group);
        $query = $CI->db->get();
        return $query->result_array();
    }
}
if (! function_exists('get_claim_data')){
    function get_claim_data($claim_id) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('claims');
        $CI->db->where('id', $claim_id);
        $query = $CI->db->get();
        return $query->row_array();
    }
}
if (! function_exists('get_invoice_type')){
    function get_invoice_type($type_id) {
        switch ($type_id) {
            case 1:
                $type = "Claim";
                break;
            case 2:
                $type = "Goodwill";
                break;
            case 3:
                $type = "Buyout";
                break;
            case 4:
                $type = "Reimbersment";
                break;
        }
        return 	ucfirst($type) ;
    }
}
if (! function_exists('get_status')){
    function get_status($status_id) {
        switch ($status_id) {
            case 1:
                $status = "Active";
                break;
            case 2:
                $type = "Inactive";
                break;
        }
        return 	ucfirst($status) ;
    }
}

if (! function_exists('get_policy_logs')){
    function get_policy_logs($customer_id) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('policy_logs');
        $CI->db->where('customer', $customer_id);
        $CI->db->order_by('created_at', 'DESC');
        $query = $CI->db->get();
        return $query->result_array();
    }
}

if (! function_exists('total_claim_amount')){
    function total_claim_amount($claim_id) {
        $CI = & get_instance();
        $CI->db->select_sum('amount');
        $CI->db->from('claim_auth');
        $CI->db->where('claim', $claim_id);
        $CI->db->where('status!=' , '2');
        $query = $CI->db->get();
        return $query->row_array();
    }
}

if (! function_exists('total_customer_amount')){
    function total_customer_amount($customer) {
        $amount = 0;
        $claims = get_data('','claims',array('customer'=>$customer),'id');
        foreach ($claims as $claim){
            $claim_amount = total_claim_amount($claim['id']);
            $amount = $amount + $claim_amount['amount'];
        }
        return $amount;
    }
}

if (! function_exists('insert_log')) {
    function insert_log($customer_id,$user_id) {
        $CI = & get_instance();
        $CI->db->set('customer',$customer_id);
        $CI->db->set('user', $user_id);
        return  $CI->db->insert('policy_logs');
    }
}

if ( ! function_exists('get_claim_num'))
{
    function get_claim_num($num) {

        $claim_num = check_claim_num($num);
        if(!empty($claim_num)){
            $new_num = str_pad(mt_rand(1,99999),5,'0',STR_PAD_LEFT);
            return get_claim_num($new_num);
        }else{
            return $num;
        }
    }
}

if ( ! function_exists('check_claim_num'))
{
    function check_claim_num($num) {
        $CI = & get_instance();
        $CI->db->select('claim_num');
        $CI->db->from('claims');
        $CI->db->where('claim_num', $num);
        $query = $CI->db->get()->row_array();
        return $query['claim_num'];

    }
}


if ( ! function_exists('get_plan_policy_data'))
{
    function get_plan_policy_data($id, $table, $where = "", $select = '', $limit = '', $order_by = "", $order = "", $joins = '', $group_by = "") {
        $CI = & get_instance();
        if ($group_by != "") {
            $CI->db->group_by($group_by);
        }
        if ($limit != "") {
            $CI->db->limit($limit[0], $limit[1]);
        }
        if (!is_array($order_by)) {
            if ($order_by != "") {
                if ($order != "") {
                    $CI->db->order_by($order_by, $order);
                } else {
                    $CI->db->order_by($order_by, "desc");
                }
            }
        } else {
            foreach ($order_by as $key => $orders) {
                $CI->db->order_by($orders[0], $orders[1]);
            }
        }
        if ($joins != "") {
            foreach ($joins as $join) {
                $CI->db->join($join[0], $join[1], $join[2]);
            }
        }
        if ($where != "") {
            $CI->db->where($where);
        }
        if ($id != "") {
            $CI->db->where('customer', $id);
        }
        if (is_array($select)) {
            foreach ($select as $key => $value) {
                $CI->db->select($value);
            }
        } else {
            $CI->db->select($select);
        }
        $result = $CI->db->get($table)->result_array();
        return $result;
    }
}

if ( ! function_exists('get_last_claim_num'))
{
    function get_last_claim_num() {
        $CI = & get_instance();
        $CI->db->select("claim_num");
        $CI->db->from("claims");
        $CI->db->limit(1);
        $CI->db->order_by('id',"DESC");
        $query = $CI->db->get()->row_array();
        if(!$query) {
            return false;
        }
        else {
            return $query['claim_num'];
        }
    }
}
if ( ! function_exists('get_last_policy_num'))
{
    function get_last_policy_num() {
        $CI = & get_instance();
        $CI->db->select_max("policy_num");
        $CI->db->from("policy_renewal");
        $CI->db->limit(1);
        $CI->db->order_by('id',"DESC");
        $query = $CI->db->get()->row_array();
        if(!$query) {
            return false;
        }
        else {
            return $query['policy_num'];
        }
    }
}
if ( ! function_exists('get_customer_policies'))
{
    function get_customer_policies($policy_num) {
		$CI = & get_instance();
        $CI->db->select("*");
        $CI->db->from("policy_renewal");
		$CI->db->where('policy_num',$policy_num);
        
        $CI->db->order_by('id',"DESC");
        $query = $CI->db->get()->result_array();
        return $query;
    }
}

if ( ! function_exists('get_customer_policy'))
{
    function get_customer_policy($policy_num) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('policy_renewal');
        $CI->db->where('policy_num',$policy_num);
        $CI->db->limit(1);
        $CI->db->order_by('id',"DESC");
        $CI->db->order_by('created_at',"DESC");
        // $CI->db->get()->row_array();
        // echo $CI->db->last_query();
        return $CI->db->get()->row_array();
    }
}

if ( ! function_exists('get_policy_by_pdf'))
{
    function get_policy_by_pdf($random_num) {
        $CI = & get_instance();
        $CI->db->select('c.customer');
        $CI->db->from('policy_renewal as p');
        $CI->db->join('policy as c', 'p.policy_num = c.policy_num');
        $CI->db->where('pdf_randomid',$random_num);
        return $CI->db->get()->row_array();
    }
}

if ( ! function_exists('get_plan_name'))
{
    function get_plan_name($meta_tag, $meta_key) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('general_settings');
        $CI->db->where('meta_tag', $meta_tag);
        $CI->db->where('meta_key', $meta_key);
        return $CI->db->get()->row_array();
    }
}

if ( ! function_exists('check_expired_policy'))
{
    function check_expired_policy($policy_num) {
        $CI = & get_instance();
        $plan_end = date('Y-m-d');
        $CI->db->select('*');
        $CI->db->from('policy_renewal');
        $CI->db->where("policy_num" ,$policy_num);
        $CI->db->order_by('id',"DESC");
        $policy_data = $CI->db->get()->row_array();

        if ($policy_data['id'] > 0) {
            $CI->db->select('*');
            $CI->db->from('policy_renewal');
            $CI->db->where("id", $policy_data['id']);
            $CI->db->where("(status = '6' OR Date(plan_end) <= '".$plan_end."')");
            return $CI->db->get()->row_array();
        }
    }
}


if ( ! function_exists('get_plan_data'))
{
    function get_plan_data($meta_value) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('general_settings');
        $CI->db->where('meta_value', $meta_value);
        return $CI->db->get()->result_array();
    }
}

if ( ! function_exists('get_plan_coverages'))
{
    function get_plan_coverages($meta_tag, $meta_key) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('general_settings');
        $CI->db->where('meta_tag', $meta_tag);
        $CI->db->where_in('meta_key', $meta_key);
        return $CI->db->get()->result_array();
    }
}

if ( ! function_exists('get_plan_names'))
{
    function get_plan_names($meta_tag, $meta_key) {
        $CI = & get_instance();
        $CI->db->select('meta_content');
        $CI->db->from('general_settings');
        $CI->db->where('meta_tag', $meta_tag);
        $CI->db->where('meta_value', $meta_key);
        $query = $CI->db->get()->result_array();
        return $query;
    }
}

if ( ! function_exists('get_claim_value'))
{
    function get_claim_value($meta_tag, $meta_key) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('general_settings');

        $CI->db->where('meta_tag', $meta_tag);
        $CI->db->where('meta_key', $meta_key);
        return $CI->db->get()->row_array();
    }
}

if ( ! function_exists('get_zip_codes'))
{
    function get_zip_codes($vendor_id) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('general_settings');

        $CI->db->where('meta_tag', 'vendor_zip_codes');
        $CI->db->where('meta_key', $vendor_id);
        return $CI->db->get()->result_array();
    }
}


if ( ! function_exists('get_serviced_vendors'))
{
    function get_serviced_vendors($vendor_id) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('vendors');
        $CI->db->where('status', 1);
        $CI->db->where('id', $vendor_id);
        return $CI->db->get()->result_array();
    }
}

if ( ! function_exists('get_admin_permissions'))
{
    function get_admin_permissions($admin_id, $module) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('admin_permissions');
        $CI->db->where('module', $module);
        $CI->db->where('admin_id', $admin_id);
        return $CI->db->get()->row_array();
    }
}

if ( ! function_exists('get_policy_timestamp'))
{
    function get_policy_timestamp($policy) {
        $CI = & get_instance();
        $CI->db->select('mail_ip,mail_timestamp');
        $CI->db->from('policy_renewal');
        $CI->db->where('id', $policy);
        return $CI->db->get()->row_array();
    }
}

if ( ! function_exists('get_client_ip'))
{
    function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}

if ( ! function_exists('get_customer_card'))
{
    function get_customer_card($customer, $where="", $status='') {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('customer_cards');
        $CI->db->where('customer_id', $customer);
        if (!empty($where)){
            $CI->db->where($where);
        }
        if (!empty($status)){
            $CI->db->where('status', $status);
        }
        return $CI->db->get()->row_array();
    }
}

if ( ! function_exists('get_all_cards'))
{
    function get_all_cards($customer,$status) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('customer_cards');
        $CI->db->where('customer_id', $customer);
        $CI->db->where('status', $status);
        $CI->db->order_by('id','desc');
        return $CI->db->get()->result_array();
    }
}

if ( ! function_exists('get_customer_payments'))
{
    function get_customer_payments($customer) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('payments');
        $CI->db->where('customer_id', $customer);
        $CI->db->order_by('created_at', 'DESC');
        return $CI->db->get()->result_array();
    }
}

if ( ! function_exists('get_customer_sale'))
{
    function get_customer_sale($customer) {
        $CI = & get_instance();
        $payments = $CI->db->query("SELECT SUM(amount_approved) AS total FROM
 `payments` WHERE `customer_id` = ".$customer." AND (`type` = 1 OR `type` = 3) AND id NOT IN
 (SELECT parent_id FROM `payments` WHERE `customer_id` = ".$customer." AND `type` = 3 AND `status` = 1) AND `status` = 1")->row_array();
        $refunds = get_customer_refunds($customer);
        $result = $payments['total'] - $refunds;
        return $result;
    }
}

if ( ! function_exists('get_customer_refunds'))
{
    function get_customer_refunds($customer) {
        $CI = & get_instance();
        $result = $CI->db->query("SELECT SUM(amount_approved) AS total FROM `payments` WHERE `customer_id` = ".$customer." AND `type` = 2 AND `status` = 1")->row_array();
        return $result['total'];
    }
}

if ( ! function_exists('get_notes_tasks_vendors'))
{
    function get_notes_tasks_vendors($vendor) {
        $CI = & get_instance();
        $CI->db->select('n.*');
        $CI->db->from('tasks_notes as n');
        $CI->db->where('n.vendor',$vendor);
        $CI->db->where('n.type !=','3');
        $CI->db->where('n.claim', NULL);
        $CI->db->order_by('created_at', 'DESC');
        return $CI->db->get()->result_array();
    }
}

if ( ! function_exists('get_single_notes_tasks'))
{
    function get_single_notes_tasks($id) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('tasks_notes');
        $CI->db->where('id', $id);
        return $CI->db->get()->row_array();
    }
}

if (! function_exists('get_zipcodes_in_radius')){
    function get_zipcodes_in_radius($latitude,$longitude,$radius=50) {
        $CI = & get_instance();
        $zipcodes = $CI->db->query("SELECT * FROM (
            SELECT id, zipcode,( 3959 * ACOS( COS( RADIANS($latitude) ) * COS( RADIANS( latitude ) ) * COS( RADIANS( longitude )
            - RADIANS($longitude) ) + SIN( RADIANS($latitude) ) * SIN( RADIANS( latitude ) ) ) ) AS distance
            FROM zipcodes HAVING distance <  $radius
            ORDER BY distance ASC
        ) AS r
        JOIN `general_settings` g ON g.`meta_value` = r.zipcode
        WHERE g.`meta_tag` = 'vendor_zip_codes' 
        ");
        // ->row_array();
        
        // echo $CI->db->last_query();
        return $zipcodes->result_array();
    }
}

if (! function_exists('get_vendors_in_zipcodes')){
    function get_vendors_in_zipcodes($zipcodes) {
        $CI = & get_instance();
        
        $CI->db->select('*');
        $CI->db->from('vendors v');
        $CI->db->where('status', 1);
        $CI->db->where_in('v.zip_code ', $zipcodes);
        $query = $CI->db->get();

        // echo $CI->db->last_query();
        return $query->result_array();
    }
}
if (! function_exists('getARBProfile')){
    function getARBProfile($customer_id) {
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('customer_payment_profiles');
        $CI->db->where('customer_payment_profiles.customer_id ', $customer_id);
        $query = $CI->db->get();
        // echo $CI->db->last_query();
        return $query->result_array();
    }
}

if (! function_exists('get_vendors_by_ids')){
    function get_vendors_by_ids($ids) {
        $CI = & get_instance();
        
        $CI->db->select('*');
        $CI->db->from('vendors v');
        $CI->db->where('status', 1);
        $CI->db->where_in('v.id ', $ids);
        $query = $CI->db->get();

        // echo $CI->db->last_query();
        return $query->result_array();
    }
}

if (! function_exists('is_reimbursement_claimed')){
    function is_reimbursement_claimed($claim_num){
        $CI = & get_instance();
        $CI->db->select('*');
        $CI->db->from('claims');
        $CI->db->where('claim_num', $claim_num);
        $details =  $CI->db->get()->row_array();

        if(empty($details['vendor']) && $details['status'] == '2'){
           /* $CI = & get_instance();
            
            $CI->load->model('Task_model','task_model');
            $CI->task_model->insert_task([
                'customer' => $details['customer'],
                'text' => '<p><strong>Reimbursement Claimed</strong></p>',
                'type' => 2,
                'assign_to' => 0,
                'claim' => $details['id']
            ]);*/
            return true;
        }   
        return false;
    }
}

if (! function_exists('removeBOM')){
    function removeBOM($data) {
        if (0 === strpos(bin2hex($data), 'efbbbf')) {
        return substr($data, 3);
        }
    }
}

if (! function_exists('save_general_note')){
    function save_general_note($customer, $msg) {
        $CI = & get_instance();
        $CI->load->model(admin_controller() . 'task_model');
        $CI->task_model->insert_notes([
            'customer' => $customer,
            'text' => '<p>'.$msg.'</p>',
            'type' => '2',
            'assign_to' => 0

        ]);
    }
}
if (! function_exists('save_log_note')){
    function save_log_note($customer, $msg) {
        $CI = & get_instance();
        $CI->load->model(admin_controller() . 'task_model');
        $CI->task_model->insert_notes([
            'customer' => $customer,
            'text' => '<p>'.$msg.'</p>',
            'type' => '3',
            'assign_to' => 0

        ]);
    }
}

if (! function_exists('save_log_note_for_claim')){
    function save_log_note_for_claim($customer,$claimid, $msg) {
        $CI = & get_instance();
        $CI->load->model(admin_controller() . 'task_model');
        $CI->task_model->insert_notes([
            'customer' => $customer,
            'claim' => $claimid,
            'text' => '<p>'.$msg.'</p>',
            'type' => '2',
            'assign_to' => 0,
            'show_portal' => 0

        ]);
    }
}

if (! function_exists('iframe')){
    function iframe($data){
	
			$iconImg = '';
			if( isset($data['ext']) && ($data['ext'] == 'jpg' || $data['ext'] == 'jpeg' || $data['ext'] == 'png' || $data['ext'] == 'txt'||  $data['ext'] == 'pdf')){
				$iconImg .= '<iframe class="ass_imgs" src="'.$data['path'].'" frameborder="no" width="100%" height="1000px"></iframe>';
			}else if( isset($data['ext']) && ($data['ext'] == 'docx' || $data['ext'] == 'doc'  || $data['ext'] == 'xlsx' )){
				$iconImg .= '<iframe class="ass_imgs" src="https://docs.google.com/gview?url='.$data['path'].'&embedded=true" frameborder="no" width="100%" height="1000px"></iframe>';
			}else{
				$iconImg .= '<iframe class="ass_imgs" src="https://docs.google.com/viewer?url='.$data['path'].'&embedded=true" frameborder="no" width="100%" height="1000px"></iframe>';
			}
		return $iconImg;
	}
}

if (! function_exists('maskCard')){
    function maskCard($card){
		if(get_session('admin_type') == 1){
			$cardmasked = $card;
		}else{
			if($card !="" && strlen($card) > 2){
				$cardmasked = substr_replace($card, str_repeat('X',  strlen($card) - 4), 0,  strlen($card) - 4);
			}else{
				$cardmasked = $card;
			}
		}
		
		return $cardmasked;
	}
}

if (! function_exists('AmountInWords')){
	// Create a function for converting the amount in words
	function AmountInWords(float $amount){
        $total_alphabets = 100;
        $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
        // Check if there is any number after decimal
        $amt_hundred = null;
        $count_length = strlen($num);
        $x = 0;
        $string = array();
        $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
          3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
          7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
          10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
          13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
          16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
          19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
          40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
          70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
         $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
         while( $x < $count_length ) {
           $get_divider = ($x == 2) ? 10 : 100;
           $amount = floor($num % $get_divider);
           $num = floor($num / $get_divider);
           $x += $get_divider == 10 ? 1 : 2;
           if ($amount) {
            $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
            $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
            $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
            '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
            '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
             }
         else $string[] = null;
        }
        $implode_to_dollars = implode('', array_reverse($string));
        $get_cents = ($amount_after_decimal > 0) ? "and " . $amount_after_decimal.'/100': '';
        
        $final_amount = ($implode_to_dollars ? $implode_to_dollars  : '') . $get_cents;
        $remaining_alphabets = $total_alphabets - mb_strlen($final_amount);
        $stars = '';
        $i = 1;
        while($i<$remaining_alphabets){
            $stars .='*';
            $i++;
        }
        
        return  $final_amount = $final_amount.$stars;
	}
}
