<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_global {

    var $ci;

    function __construct() {
       $this->ci = & get_instance();
       $this->ci->db->query("SET time_zone='+08:00'");
    }

    public function count( $table, $join = NULL, $where = NULL, $where_e = NULL, $group = NULL )
    {
        $this->ci->db->select("count(*) as jumlah")->from($table);

        if ( ! is_null( $join ) )
        {
            foreach ($join as $key => $value) {
                $tipe = ( @$value[2] != '' ) ? $value[2] : 'INNER';
                $this->ci->db->join( $value[0], $value[1], $tipe );
            }
        }

        ( ! is_null($where)
            ? $this->ci->db->where($where)
            : ''
        );

        ( ! is_null($where_e)
            ? $this->ci->db->where($where_e, NULL, FALSE)
            : ''
        );

        ( ! is_null($group)
            ? $this->ci->db->group_by($group, NULL, FALSE)
            : ''
        );

        $query  = $this->ci->db->get();
        if(!$query) pre($this->ci->db->error(), 1);

        $result = $query->row();
        if(empty($result)){
            return '0';
        }else{
            return $result->jumlah;
        }
    }

    /**
     * Mengambil data dari $tabel
     *
    **/

    public function get( $table, $type, $join = NULL, $where = NULL, $select = '*', $where_e = NULL, $order = NULL, $start = 0, $tampil = NULL, $group = NULL, $array = null )
    {
        if ( is_array($select))
        {
            $this->ci->db->select( $select[0], $select[1] )->from($table);
        }
            else
        {
            $this->ci->db->select($select)->from($table);
        }

        if ( ! is_null( $join ) )
        {
            foreach ($join as $key => $value) {
                $tipe = ( @$value[2] != '' ) ? $value[2] : 'INNER';
                $this->ci->db->join( $value[0], $value[1], $tipe );
            }
        }

        if( ! is_null( $order )){
            if(is_array($order[0])){
                foreach ($order as $key => $value) {
                    $this->ci->db->order_by( $value[0], $value[1]);
                }
            }else{
                $this->ci->db->order_by( $order[0], $order[1]);
            }

        }
        ( ! is_null( $tampil )
            ? $this->ci->db->limit( $tampil, $start)
            : ''
        );
        ( ! is_null( $where )
            ? $this->ci->db->where( $where)
            : ''
        );
        ( ! is_null( $where_e )
            ? $this->ci->db->where( $where_e, NULL, FALSE)
            : ''
        );
        ( ! is_null( $group )
            ? $this->ci->db->group_by( $group, NULL, FALSE)
            : ''
        );

        if($type == 'select') {

            $query  = $this->ci->db->get();

            $err = $this->ci->db->error();
            if ( $err['code'] != 0 ) {
                pre('lastdb');
                pre($err, 1);
            }

            ( ! is_null( $array )
                ? $result = $query->result_array()
                : $result = $query->result()
            );
        } else if($type == 'query') {
            $result = $this->ci->db->get_compiled_select();
        }

        return $result;

    }




    public function getOne( $table, $join = NULL, $where = NULL, $select = '*')
    {
        if ( is_array($select))
        {
            $this->ci->db->select( $select[0], $select[1] )->from($table);
        }
            else
        {
            $this->ci->db->select($select)->from($table);
        }

        if ( ! is_null( $join ) )
        {
            foreach ($join as $key => $value) {
                $tipe = ( @$value[2] != '' ) ? $value[2] : 'INNER';
                $this->ci->db->join( $value[0], $value[1], $tipe );
            }
        }



        ( ! is_null( $where )
            ? $this->ci->db->where( $where)
            : ''
        );




            $result = $this->ci->db->get()->row();


        return $result;

    }




    public function insert( $table, $data = NULL )
    {

        $result    = $this->ci->db->insert( $table, $data );

        if ( $result == TRUE )
        {
            $result             = [];
            $result['status']   = TRUE;
            $result['id']       = $this->ci->db->insert_id();
        }
            else
        {
            $result             = [];
            $result['status']   = FALSE;
        }

        return $result;
    }

    public function update( $table, $data = NULL, $where = NULL, $where_e = NULL )
    {
        ( ! is_null($where_e)
            ? $this->ci->db->where($where_e, NULL, FALSE)
            : ''
        );

        $result    = $this->ci->db->update( $table, $data, $where );

        return $result;
    }

    public function delete( $table, $where = NULL, $where_e = NULL )
    {
        ( ! is_null($where_e)
            ? $this->ci->db->where($where_e, NULL, FALSE)
            : ''
        );

        $result    = $this->ci->db->delete( $table, $where );

        return $result;
    }

    public function validation( $table, $where, $where_e = NULL )
    {
        $this->ci->db->select('*')->from( $table );

        ( ! is_null($where)
            ? $this->ci->db->where($where)
            : ''
        );
        ( ! is_null($where_e)
            ? $this->ci->db->where($where_e, NULL, FALSE)
            : ''
        );

        $query  = $this->ci->db->get();
        $result = $query->num_rows();

        if( $result > 0 )
        {
            $result = FALSE;
        }
            else
        {
            $result = TRUE;
        }

        return $result;
    }

    public function get_num_rows( $table, $join = NULL, $where = NULL, $where_e = NULL, $group = NULL )
    {
        $this->ci->db->select("count(*) as jumlah")->from($table);

        if ( ! is_null( $join ) )
        {
            foreach ( $join as $rows)
            {
                $tipe = ( @$rows['tipe'] != '' ) ? $rows['tipe'] : 'INNER';
                $this->ci->db->join( $rows['table'], $rows['on'], $tipe );
            }
        }

        ( ! is_null($where)
            ? $this->ci->db->where($where)
            : ''
        );
        ( ! is_null($where_e)
            ? $this->ci->db->where($where_e, NULL, FALSE)
            : ''
        );
        ( ! is_null($group)
            ? $this->ci->db->group_by($group, NULL, FALSE)
            : ''
        );

        $query  = $this->ci->db->get();
        $result = $query->num_rows();

        return $result;
    }

    public function insert_update_batch( $table, $data )
    {
        $count      = 0;
        $jumlah     = 0;

        foreach ($data as $param) {
            $result     = $this->_insert_update($table, $param);
            if ($result == TRUE){
                $count++;
            }
            $jumlah++;
        }

        if ( $count == $jumlah )
        {
            $result             = [];
            $result['status']   = TRUE;
        }
            else
        {
            $result             = [];
            $result['status']   = FALSE;
            $result['message']  = ($jumlah - $count) . ' data gagal diproses';
        }

        return $result;
    }

    public function insert_update( $table, $data )
    {
        $result     = $this->_insert_update($table, $data);

        if ( $result == TRUE )
        {
            $result             = [];
            $result['status']   = TRUE;
        }
            else
        {
            $result             = [];
            $result['status']   = FALSE;
        }

        return $result;
    }

    public function _insert_update($table, $data)
    {
        $key    = [];
        $value  = [];

        //generate duplicate
        $strDuplicate   = [];
        foreach ($data as $kolom => $nilai) {
            $key[]              = $kolom;
            $value[]            = $nilai;

            $nilai              = $this->ci->db->escape($nilai);
            $strDuplicate[]     = "{$kolom} = {$nilai}";
        }
        $strDuplicate   = implode(",", $strDuplicate);

        // generate tanda tanya
        $tanya  = [];
        foreach ($value as $val)
        {
            $tanya[] = '?';
        }
        $tanya  = implode(", ", $tanya);

        $sKey   = implode(",", $key);

        $sql    = " INSERT INTO {$table}({$sKey}) VALUES ({$tanya})
                    ON DUPLICATE KEY UPDATE
                    {$strDuplicate}
                  ;";
        $query  = $this->ci->db->query($sql, $value);

        return $query;
    }

    public function getPayoutUser($id){
      $this->ci->db->where(['payout_users_id'=>$id]);
      return $this->ci->db->get('payout')->result();
    }


    public function machineSummary(){
      $dates = [
        date('Y-m-d'),
        date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d')))),
        date('Y-m-d', strtotime('-2 day', strtotime(date('Y-m-d')))),
        date('Y-m-d', strtotime('-3 day', strtotime(date('Y-m-d')))),
        date('Y-m-d', strtotime('-4 day', strtotime(date('Y-m-d')))),
        date('Y-m-d', strtotime('-5 day', strtotime(date('Y-m-d')))),
        date('Y-m-d', strtotime('-6 day', strtotime(date('Y-m-d'))))
      ];
      $this->ci->db->like('logminingdaily_date',$dates[0]);
      $this->ci->db->or_like('logminingdaily_date',$dates[1]);
      $this->ci->db->or_like('logminingdaily_date',$dates[2]);
      $this->ci->db->or_like('logminingdaily_date',$dates[3]);
      $this->ci->db->or_like('logminingdaily_date',$dates[4]);
      $this->ci->db->or_like('logminingdaily_date',$dates[5]);
      $this->ci->db->or_like('logminingdaily_date',$dates[6]);
      $datum = $this->ci->db->get('logminingdaily')->result();
      $return = [];
      $no = 0;
      foreach($datum as $d){
        if($d->machine_summary != ''){
          $return[$no] = explode(',',$d->machine_summary);
          $return[$no][3] = $return[$no][0] + $return[$no][1] + $return[$no][2];
        }else{
          $return[$no] = ['-','-','-'];
          $return[$no][3] = '-';
        }

        $no++;
      }

      return $return;
    }


    public function createMachineSummary(){
      $assigned = $this->ci->db->get_where('machine',['machine_status'=>'1'])->result();
      $available = $this->ci->db->get_where('machine',['machine_status'=>'0'])->result();
      $retired = $this->ci->db->get_where('machine',['machine_status'=>'99'])->result();

      $return = count($assigned).','.count($available).','.count($retired);
      return $return;
    }



}
