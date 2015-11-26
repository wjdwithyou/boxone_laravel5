<?php

/*
 *  배대지 관련 컨트롤러
 */
$rootpath = "/var/www/laravel/app";
//$rootpath = "C:/app/app";
include $rootpath."/function/baseFunction.php";

    /*  	
     *	배대지정보 등록 기능
     */
	public function create($fare, $ranking, $country, $name)
	{

		if(	!(	inputErrorCheck($fare, 'fare')
				&& inputErrorCheck($ranking, 'ranking')
				&& inputErrorCheck($country, 'country')
				&& inputErrorCheck($name, 'name')))
			return ;		
				

		$result = DB::table('shipping_agency')->insertGetId(
			array(
				'fare'=> $fare, 
				'ranking'=> $ranking, 
				'country'=> $country, 
				'name'=> $name, 
				'upload'=>DB::raw('now()')
				)
			);	

		return array('code' => 1,'msg' =>'success' ,'data' => $result);
	}

    /*  	
     *	배대지 리스트로 종류별로 가져오는 기능
     */
	public function getInfoList($status)
	{
		$result = DB::select('select * from shipping_agency where status=? order by ranking asc', array($status));

		return array('code' => 1, 'msg' => 'success', 'data' => $result);
	}


 	/*  	
     *	배대지 삭제 기능
     */
	public function delete($idx)
	{

		if(	!(	inputErrorCheck($idx, 'idx')))
			return ;		

 		$result = DB::delete('delete from Shippingagency where idx=?', array($idx));

		if($result == true){
         	return array('code' => 1, 'msg' => 'success');
        }else{
         	return array('code' => , 'msg' => 'update failure: no matched data');
        }
	}


    /*  	
     *	배대지 수정 기능
     */
	public function update($idx, $title, $contents)
	{
	  	   
		if(	!(	inputErrorCheck($idx, 'idx')
				&& inputErrorCheck($title, 'title')
				&& inputErrorCheck($contents, 'contents')))
			return ;		
				
		$result = DB::update('update Shippingagency set title=?, contents=?, upload=now() where idx = ?' ,
			array($title, $contents, $idx));
                    
 		if($result == true){
          	return array('code' => 1, 'msg' => 'success');
         }else{
          	return array('code' => 0, 'msg' => 'update failure: no matched data');
         } 
	}
