<?php
    public function kmeans_2(){

        ///ambil data covid
        $dataArea = $this->db->query('SELECT
                                            * 
                                        FROM
                                            tbl_covid_province
                                            INNER JOIN tbl_province ON tbl_province.province_id = tbl_covid_province.id_province')->result();

        ///persiapan variable array
        $dataMinning = ['data_kumpul'=>[],'cluster'=>array()];

        //proses satu persatu data covid, jadikan bentuk data yang berisikan informasi provinsi, jml kasus, akumulasi meninggal, akumulasi sembuh, jumlah rawat isolasi, dan akumulasi kasus.
        foreach ($dataArea as $key => $value) {
            $dataMinning['data_kumpul'][$key] = array(
                'data_province' => array(
                    'id_province'           => $value->id_province,
                    'province_name'         => $value->province_name,
                ),
                    'kasus'                 => $value->kasus,
                    'akumulasi_meninggal'   => $value->akumulasi_meninggal,
                    'akumulasi_sembuh'      => $value->akumulasi_sembuh,
                    'rawat_isolasi'         => $value->rawat_isolasi,
                    'akumulasi_kasus'       => $value->akumulasi_kasus,
                
            );
        }

        //buat variable hitung dimulai dari angka 1.
        $no = 1;

        /// menghitung total data covid 
        $jumlah_total = count($dataMinning['data_kumpul']);

        // menghitung nilai tengah dengan cara total data covid dibagi 2
        $nilai_tengah = round($jumlah_total/2);

        ///preperation variable array. 
        $searchCluster = array();

        /// sorting data kasus dari data yang terbesar
        usort($dataMinning['data_kumpul'], function($a, $b) {
            return $a['kasus'] < $b['kasus'];
        });


        //proses data covid kedalam variable array yang berisikan jumlah kasus dan key dari setiap data kasus.
        foreach ($dataMinning['data_kumpul'] as $key => $value) {
            $searchCluster[] = array(
                'value' => $value['kasus'],
                'key'   =>  $key);
            $no++;
        }

        
        /// sorting data kasus dari data yang terbesar
        usort($searchCluster, function($a, $b) {
            return $a['value'] < $b['value'];
        });

        ///mengembalikan data array dalam urutan terbalik.
        $searchCluster = array_reverse($searchCluster);



        ///ambil data kasus random, dalam kasus ini diambil 3 data yaitu data paling terakhir, data tengah, data awal.
        /// masukan data covid untuk cluster 1 ambil data covid yang memiliki key paling terakhir
        $dataMinning['cluster']['1']['c1'] = array(
            'kasus'                 => $dataMinning['data_kumpul'][$searchCluster[$jumlah_total-1]['key']]['kasus'],
            'akumulasi_meninggal'   => $dataMinning['data_kumpul'][$searchCluster[$jumlah_total-1]['key']]['akumulasi_meninggal'],
            'akumulasi_sembuh'      => $dataMinning['data_kumpul'][$searchCluster[$jumlah_total-1]['key']]['akumulasi_sembuh'],
            'rawat_isolasi'         => $dataMinning['data_kumpul'][$searchCluster[$jumlah_total-1]['key']]['rawat_isolasi'],
            'akumulasi_kasus'       =>  $dataMinning['data_kumpul'][$searchCluster[$jumlah_total-1]['key']]['akumulasi_kasus'],
        );

        /// masukan data covid untuk cluster 2 ambil data covid yang memiliki key dari akumulasi nilai tengah
        $dataMinning['cluster']['1']['c2'] = array(
            'kasus'                 => $dataMinning['data_kumpul'][$searchCluster[$nilai_tengah]['key']]['kasus'],
            'akumulasi_meninggal'   => $dataMinning['data_kumpul'][$searchCluster[$nilai_tengah]['key']]['akumulasi_meninggal'],
            'akumulasi_sembuh'      => $dataMinning['data_kumpul'][$searchCluster[$nilai_tengah]['key']]['akumulasi_sembuh'],
            'rawat_isolasi'         => $dataMinning['data_kumpul'][$searchCluster[$nilai_tengah]['key']]['rawat_isolasi'],
            'akumulasi_kasus'       => $dataMinning['data_kumpul'][$searchCluster[$nilai_tengah]['key']]['akumulasi_kasus'],
        );

        /// masukan data covid untuk cluster 2 ambil data covid yang memiliki key 0
        $dataMinning['cluster']['1']['c3'] = array(
            'kasus'                 => $dataMinning['data_kumpul'][$searchCluster[0]['key']]['kasus'],
            'akumulasi_meninggal'   => $dataMinning['data_kumpul'][$searchCluster[0]['key']]['akumulasi_meninggal'],
            'akumulasi_sembuh'      => $dataMinning['data_kumpul'][$searchCluster[0]['key']]['akumulasi_sembuh'],
            'rawat_isolasi'         => $dataMinning['data_kumpul'][$searchCluster[0]['key']]['rawat_isolasi'],
            'akumulasi_kasus'       => $dataMinning['data_kumpul'][$searchCluster[0]['key']]['akumulasi_kasus'],
        );

        ///variable preperation yang dimulai dari angka 0
        $i = 0;


        /// dimulai perhitungan setiap iterasi

        /// variable yang berisikan pencatatan nilai kmeans pada setiap iterasi
        $sama = array('count_barang' => count($dataMinning['data_kumpul']), 'sama'=>0);
        while(true)
        {
            ///variable preperation yang bisikan nilai sama 0 terlebih dahulu
            $sama['sama'] = 0;

            if ($i != 0) {

                /// prepare data dummy
                $dataDummy = array(
                    'kasus'                 => 0,
                    'akumulasi_meninggal'   => 0,
                    'akumulasi_sembuh'      => 0,
                    'rawat_isolasi'         => 0,
                    'akumulasi_kasus'       => 0,
                );

                /// ambil data covid lalu  lalu kalkulasi kan data cluster 1 kasus, akumulasi meninggal akumulasi sembuh, rawat, kasus 
                foreach ($dataMinning['cluster']['dataCluster'][$i]['c1'] as $key => $value) {
                    $dataDummy['kasus']                 += $value['kasus'];
                    $dataDummy['akumulasi_meninggal']   += $value['akumulasi_meninggal'];
                    $dataDummy['akumulasi_sembuh']      += $value['akumulasi_sembuh'];
                    $dataDummy['rawat_isolasi']         += $value['rawat_isolasi'];
                    $dataDummy['akumulasi_kasus']       += $value['akumulasi_kasus'];
                }

                /// mulai menghitung untuk iteasi selanjutnya setelah iterasi 1 pada cluster 1
                $dataMinning['cluster'][$i+1]['c1'] = array(
                    //perhitungan kasus rounding(data kasus / jml data cluster 1)
                    'kasus'                 => round($dataDummy['kasus']/count($dataMinning['cluster']['dataCluster'][$i]['c1'])),

                    //perhitungan kasus rounding(data akumulasi_meninggal / jml data cluster 1)
                    'akumulasi_meninggal'   =>round($dataDummy['akumulasi_meninggal']/count($dataMinning['cluster']['dataCluster'][$i]['c1'])),

                    //perhitungan kasus rounding(data akumulasi_sembuh / jml data cluster 1)
                    'akumulasi_sembuh'      =>round($dataDummy['akumulasi_sembuh']/count($dataMinning['cluster']['dataCluster'][$i]['c1'])),

                    //perhitungan kasus rounding(data rawat_isolasi / jml data cluster 1)
                    'rawat_isolasi'         =>round($dataDummy['rawat_isolasi']/count($dataMinning['cluster']['dataCluster'][$i]['c1'])),

                    //perhitungan kasus rounding(data akumulasi_kasus / jml data cluster 1)
                    'akumulasi_kasus'       =>round($dataDummy['akumulasi_kasus']/count($dataMinning['cluster']['dataCluster'][$i]['c1'])),
                );

                ///ikuti step diatas untuk cluster 2

                $dataDummy = array(
                    'kasus'                 => 0,
                    'akumulasi_meninggal'   => 0,
                    'akumulasi_sembuh'      => 0,
                    'rawat_isolasi'         => 0,
                    'akumulasi_kasus'       => 0,
                );
                foreach ($dataMinning['cluster']['dataCluster'][$i]['c2'] as $key => $value) {
                    $dataDummy['kasus']                 += $value['kasus'];
                    $dataDummy['akumulasi_meninggal']   += $value['akumulasi_meninggal'];
                    $dataDummy['akumulasi_sembuh']      += $value['akumulasi_sembuh'];
                    $dataDummy['rawat_isolasi']         += $value['rawat_isolasi'];
                    $dataDummy['akumulasi_kasus']       += $value['akumulasi_kasus'];
                }
                $dataMinning['cluster'][$i+1]['c2'] = array(
                    'kasus'                 => round($dataDummy['kasus']/count($dataMinning['cluster']['dataCluster'][$i]['c2'])),
                    'akumulasi_meninggal'   => round($dataDummy['akumulasi_meninggal']/count($dataMinning['cluster']['dataCluster'][$i]['c2'])),
                    'akumulasi_sembuh'      => round($dataDummy['akumulasi_sembuh']/count($dataMinning['cluster']['dataCluster'][$i]['c2'])),
                    'rawat_isolasi'         => round($dataDummy['rawat_isolasi']/count($dataMinning['cluster']['dataCluster'][$i]['c2'])),
                    'akumulasi_kasus'       => round($dataDummy['akumulasi_kasus']/count($dataMinning['cluster']['dataCluster'][$i]['c2'])),
                );

                ///ikuti step diatas untuk cluster 3
                $dataDummy = array(
                    'kasus'                 => 0,
                    'akumulasi_meninggal'   => 0,
                    'akumulasi_sembuh'      => 0,
                    'rawat_isolasi'         => 0,
                    'akumulasi_kasus'       => 0,
                );
                foreach ($dataMinning['cluster']['dataCluster'][$i]['c3'] as $key => $value) {
                    $dataDummy['kasus']                 += $value['kasus'];
                    $dataDummy['akumulasi_meninggal']   += $value['akumulasi_meninggal'];
                    $dataDummy['akumulasi_sembuh']      += $value['akumulasi_sembuh'];
                    $dataDummy['rawat_isolasi']         += $value['rawat_isolasi'];
                    $dataDummy['akumulasi_kasus']       += $value['akumulasi_kasus'];
                }
                $dataMinning['cluster'][$i+1]['c3'] = array(
                    'kasus'                 => round($dataDummy['kasus']/count($dataMinning['cluster']['dataCluster'][$i]['c3'])),
                    'akumulasi_meninggal'   => round($dataDummy['akumulasi_meninggal']/count($dataMinning['cluster']['dataCluster'][$i]['c3'])),
                    'akumulasi_sembuh'      => round($dataDummy['akumulasi_sembuh']/count($dataMinning['cluster']['dataCluster'][$i]['c3'])),
                    'rawat_isolasi'         => round($dataDummy['rawat_isolasi']/count($dataMinning['cluster']['dataCluster'][$i]['c3'])),
                    'akumulasi_kasus'       => round($dataDummy['akumulasi_kasus']/count($dataMinning['cluster']['dataCluster'][$i]['c3'])),
                );

            }


            /// olah kembali satu persatu data covid
            foreach ($dataMinning['data_kumpul'] as $key => $value) {
                //jika data kosong maka berisikan array kosong
                if (empty($dataMinning['data_kumpul'][$key]['nilaiCluster'][$i+1])) {
                    $dataMinning['data_kumpul'][$key]['nilaiCluster'][$i+1] = array();
                }



                // pencarian nilai iterasi
                ///hitung akar kuadrat dari data kasus dikurangi jumlah data kasus pada cluster 1 dipangkat 2 ditambah data akumulasi_meninggal dikurangi jumlah data akumulasi_meninggal pada cluster 1 dipangkat 2 dst 
                $dataMinning['data_kumpul'][$key]['nilaiCluster'][$i+1]['c1'] = sqrt(
                        pow($value['kasus']-$dataMinning['cluster'][$i+1]['c1']['kasus'],2)+
                        pow($value['akumulasi_meninggal']-$dataMinning['cluster'][$i+1]['c1']['akumulasi_meninggal'],2)+
                        pow($value['akumulasi_sembuh']-$dataMinning['cluster'][$i+1]['c1']['akumulasi_sembuh'],2)+
                        pow($value['rawat_isolasi']-$dataMinning['cluster'][$i+1]['c1']['rawat_isolasi'],2)+
                        pow($value['akumulasi_kasus']-$dataMinning['cluster'][$i+1]['c1']['akumulasi_kasus'],2)
                    );

                ///hitung akar kuadrat dari data kasus dikurangi jumlah data kasus pada cluster 1 dipangkat 2 ditambah data akumulasi_meninggal dikurangi jumlah data akumulasi_meninggal pada cluster 2 dipangkat 2 dst
                $dataMinning['data_kumpul'][$key]['nilaiCluster'][$i+1]['c2'] = sqrt(
                    pow($value['kasus']-$dataMinning['cluster'][$i+1]['c2']['kasus'],2)+
                    pow($value['akumulasi_meninggal']-$dataMinning['cluster'][$i+1]['c2']['akumulasi_meninggal'],2)+
                    pow($value['akumulasi_sembuh']-$dataMinning['cluster'][$i+1]['c2']['akumulasi_sembuh'],2)+
                    pow($value['rawat_isolasi']-$dataMinning['cluster'][$i+1]['c2']['rawat_isolasi'],2)+
                    pow($value['akumulasi_kasus']-$dataMinning['cluster'][$i+1]['c2']['akumulasi_kasus'],2)
                );

                ///hitung akar kuadrat dari data kasus dikurangi jumlah data kasus pada cluster 1 dipangkat 2 ditambah data akumulasi_meninggal dikurangi jumlah data akumulasi_meninggal pada cluster 3 dipangkat 2 dst
                $dataMinning['data_kumpul'][$key]['nilaiCluster'][$i+1]['c3'] = sqrt(
                    pow($value['kasus']-$dataMinning['cluster'][$i+1]['c3']['kasus'],2)+
                    pow($value['akumulasi_meninggal']-$dataMinning['cluster'][$i+1]['c3']['akumulasi_meninggal'],2)+
                    pow($value['akumulasi_sembuh']-$dataMinning['cluster'][$i+1]['c3']['akumulasi_sembuh'],2)+
                    pow($value['rawat_isolasi']-$dataMinning['cluster'][$i+1]['c3']['rawat_isolasi'],2)+
                    pow($value['akumulasi_kasus']-$dataMinning['cluster'][$i+1]['c3']['akumulasi_kasus'],2)
                );

                /// ambil key dari nilai cluster minimum data yang sudah diproses diatas, diambil yang minimum nya antara nilai kasus, akumulasi meninggal, akumulasi sembuh, rawat isolasi, atau akumulasi kasus.
                $minCluster = array_keys($dataMinning['data_kumpul'][$key]['nilaiCluster'][$i+1], min($dataMinning['data_kumpul'][$key]['nilaiCluster'][$i+1]));

                //key minimum cluster disimpan pada variable ini
                $dataMinning['data_kumpul'][$key]['minCluster'][$i+1] = $minCluster[0];


                // apabila sudah mencapai nilai minimum cluster sebelumnya dan iterasi selanjutnya itu sama maka dimasukan ke variable sama
                if ($i != 0) {
                    if ($dataMinning['data_kumpul'][$key]['minCluster'][$i+1] == $dataMinning['data_kumpul'][$key]['minCluster'][$i]) {
                        $sama['sama']++;
                    }
                }
            }

            // maskan nilai ke variable cluster 1 kah cluster 2 kah cluster 3 kah
            foreach ($dataMinning['data_kumpul'] as $keys => $values) {
                if (empty($dataMinning['cluster']['dataCluster'][$i+1])) {
                    $dataMinning['cluster']['dataCluster'][$i+1] = array('c1'=>[],'c2'=>[],'c3'=>[]);
                }
                $dataMinning['cluster']['dataCluster'][$i+1][$values['minCluster'][$i+1]][] = $values;
            }

            // apabila nilai sama itu sudah sama dengan jumlah data maka iterasi diberhentikan
            if ($sama['sama'] == $sama['count_barang']) {
                // echo 'akhir cluster';
                break;
            }
            $i++;
        }
        // echo json_encode($dataMinning);
        // die;
        return $dataMinning;
    }
    
?>