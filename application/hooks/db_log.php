<?php 

class Db_log{
 
    function __construct() {
       // Anything except exit() :P
    }
 
    // Name of function same as mentioned in Hooks Config
    function logQueries() {
 
        $CI = & get_instance();
 
        // $filepath = APPPATH . 'logs/queries.php'; // Creating Query Log file with today's date in application/logs folder
        // $handle = fopen($filepath, "a+");                 // Opening file with pointer at the end of the file
 
        // $times = $CI->db->query_times;                   // Get execution time of all the queries executed by controller
        // foreach ($CI->db->queries as $key => $query) {
        //     // $sql = $query . " \n Execution Time:" . $times[$key]; // Generating SQL file alongwith execution time
 
        //     $data = array(
        //         'DESCRIPTION' => $query,
        //         'USER_ID' => $CI->session->userdata('userid'),
        //         'USER_TYPE' => $CI->session->userdata('usertype'),
        //         'IP_ADDRESS' => $CI->input->ip_address(),
        //         'EXECUTION_TIME' => $times[$key]
        //     );

        //     $CI->db->insert('u_audit_trail', $data);
        // }

        // fclose($handle);      // Close the file
    }
 
}

?>