<?php

/*
 *  해외통관 관련 컨트롤러
 */
$rootpath = "/var/www/laravel/app";
//$rootpath = "C:/app/app";
include $rootpath."/function/baseFunction.php";

    /*  	
     *	해외통관 정보 등록 기능
     */
	public function create($product_name, $year, $icon, $memo, $member_idx, $status)
	{

		if(	!(	inputErrorCheck($product_name, 'product_name')
				&& inputErrorCheck($year, 'year')
				&& inputErrorCheck($icon, 'icon')
				&& inputErrorCheck($member_idx, 'member_idx')
				&& inputErrorCheck($memo, 'memo')
				&& inputErrorCheck($status, 'status')
				))
			return ;		
				

		$result = DB::table('foreign_shipment')->insertGetId(
			array(
				'product_name'=> $product_name, 
				'year'=> $year, 
				'icon'=> $icon, 
				'member_idx'=> $member_idx, 
				'memo'=> $memo, 
				'status'=> $status, 
				'upload'=>DB::raw('now()')
				)
			);	

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}

    /*  	
     *	해외통관 리스트 가져오는 기능
     */
	public function getInfoList($member_idx)
	{
		$result = DB::select('select * from foreign_shipment where member_idx=? order by idx DESC', array($membeR_idx));

		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}

 	/*  	
     *	해외통관 삭제 기능
     */
	public function delete($idx)
	{
		if(	!(	inputErrorCheck($idx, 'idx')))
			return ;		

 		$result = DB::delete('delete from foreign_shipment where idx=?', array($idx));

		if($result == true){
         	return array('code' => 1, 'msg' => 'success');
        }else{
         	return array('code' => 0, 'msg' => 'delete false: no matched data');
        }
	}


    /*  	
     *	해외통관 수정 기능
     */
	public function update($idx, product_name, $year, $icon, $memo, $status)
	{


		if(	!(	inputErrorCheck($idx, 'idx')
				&& inputErrorCheck($product_name, 'product_name')
				&& inputErrorCheck($year, 'year')
				&& inputErrorCheck($icon, 'icon')
				&& inputErrorCheck($memo, 'memo')
				&& inputErrorCheck($status, 'status')
				))
			return ;		
				
				
		$result = DB::update('update foreign_shipment set product_name=?, year=?, icon=?, memo=?, status=?,	upload=now() where idx=?',
			array($product_name, $year, $icon, $memo, $status, $idx));
                    
 		if($result == true){
          	return array('code' => 1, 'msg' => 'success');
         }else{
          	return array('code' => 0, 'msg' => 'update false');
         } 
	}