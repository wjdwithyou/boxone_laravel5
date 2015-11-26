<?php

/*
 *  국내배송 관련 컨트롤러
 */
$rootpath = "/var/www/laravel/app";
//$rootpath = "C:/app/app";
include $rootpath."/function/baseFunction.php";

    /*  	
     *	국내배송정보 등록 기능
     */
	public function create($product_name, $postal_num, $postal_agency, $memo, $member_idx, $icon, $status)
	{

		if(	!(	inputErrorCheck($product_name, 'product_name')
				&& inputErrorCheck($postal_num, 'postal_num')
				&& inputErrorCheck($postal_agency, 'postal_agency')
				&& inputErrorCheck($member_idx, 'member_idx')
				&& inputErrorCheck($memo, 'memo')
				&& inputErrorCheck($icon, 'icon')
				&& inputErrorCheck($status, 'status')
				))
			return ;		
				

		$result = DB::table('domestic_shipment')->insertGetId(
			array(
				'product_name'=> $product_name, 
				'postal_num'=> $postal_num, 
				'postal_agency'=> $postal_agency, 
				'member_idx'=> $member_idx, 
				'memo'=> $memo, 
				'status'=> $status, 
				'icon'=> $icon,
				'upload'=>DB::raw('now()')
				)
			);	

		return array('code' => 1, 'msg' =>'success' ,'data' => $result);
	}

    /*  	
     *	국내배송 리스트 가져오는 기능
     */
	public function getInfoList($member_idx)
	{

		$result = DB::select('select * from domestic_shipment where member_idx=? order by idx DESC', array($member_idx));

		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

 	/*  	
     *	국내배송 삭제 기능
     */
	public function delete($idx)
	{
		
		if(	!(	inputErrorCheck($idx, 'idx')))
			return ;		

 		$result = DB::delete('delete from domestic_shipment where idx=?', array($idx));

		if($result == true){
         	return array('code' => 1, 'msg' => 'success');
        }else{
         	return array('code' => 0, 'msg' => 'delete false: no matched data');
        }
	}


    /*  	
     *	국내배송 수정 기능
     */
	public function update($idx, $product_name, $postal_num, $postal_agency, $memo, $icon, $status)
	{

		if(	!(	inputErrorCheck($idx, 'idx')
				&& inputErrorCheck($product_name, 'product_name')
				&& inputErrorCheck($postal_num, 'postal_num')
				&& inputErrorCheck($postal_agency, 'postal_agency')
				&& inputErrorCheck($memo, 'memo')
				&& inputErrorCheck($icon, 'icon')
				&& inputErrorCheck($status, 'status')
				))
			return ;		
				
		$result = DB::update('update domestic_shipment set product_name=?, postal_num=?, postal_agency=?, memo=?, icon=?, status=?,	upload=now() where idx=?',
			array($product_name, $postal_num, $postal_agency, $memo, $icon, $status, $idx));
                    
 		if($result == true){
          	return array('code' => 1, 'msg' => 'success');
         }else{
          	return array('code' => 0, 'msg' => 'update false');
         } 
	}
