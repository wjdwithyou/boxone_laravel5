<?php

namespace App\Http\models;
use DB;
use Hash;
/*
 *  회원 관련 컨트롤러
 */
include_once dirname(__FILE__)."/../function/baseFunction.php";


class MemberModel{

    /*    
     *  회원 등록 기능
     */
    function create($type, $email, $nickname, $id, $pw, $img)
    {

        if( !(  inputErrorCheck($type, 'type')
            && inputErrorCheck($email, 'email')
            && inputErrorCheck($nickname, 'nickname')
            && inputErrorCheck($id, 'id')
            && inputErrorCheck($pw, 'pw')))
          return ;
        

        $hashedPassword = Hash::make($pw);

        if(Hash::check($pw, $hashedPassword)){
          //비밀번호 일치
        }
        else{
          //비밀번호 불일치
          if(Hash::needsRehash($hashedPassword))
            $hashedPassword = Hash::make($pw);
        }


        $member_idx = DB::table('member')->insertGetId(
          array(
            'type'=> $type, 
            'email'=> $email, 
            'nickname'=> $nickname, 
            'id'=> $id, 
            'pw'=> $hashedPassword,
            'upload'=>DB::raw('now()')
            )
          );  
        
        // 이미지 처리
        if ($type == 5)
        {
        	$ext = $img->getClientOriginalExtension();
        	$fileName = $img->getRealPath();
        	
        	insertImg('2', $member_idx, $fileName, $ext, '0');
        }
        else
        {
        	if (strpos($img, '?'))
        		$ext = substr($img, strpos($img, '?')-3, 3);
        	else
        		$ext = substr($img, strrpos($img, ".") + 1);
        	
        	$fileName = $img;
        	insertImg('3', $member_idx, $fileName, $ext, '0');
        }
        
        $dbImg = $member_idx."_image.".$ext;
        $result = DB::update('update member set image=? where idx=?', array($dbImg, $member_idx));
        

      if($member_idx > 0)
        return array('code' => 1, 'data' => $member_idx);
      else
        return array('code' => 0, 'data' => 'internel server error');
    }


    /*
     *  인덱스와 비밀번호 받아서 회원 존재 여부 알려주는 기능
     */
    function login($type, $id, $pw){

      $target_member = DB::select('select * from member where id=? AND type=?', array($id, $type));

      if(count($target_member)>0 && Hash::check($pw, $target_member[0]->pw)){
          //로그인 성공
          return array('code' => 1, 'data' => $target_member);
      } 
      else{
          //로그인 실패
          return array('code' => 0, 'data'=> "login failure" );
      }
    }

    /*    
     *  이메일 중복 체크
     */
    function checkEmail($email)
    {

      $check = DB::select('select * from member where email=?', array($email));

      if( $check == NULL)
        return array('code' => 1, 'msg' => 'success');
      else
        return array('code' => 0, 'msg' => $check[0]->type, 'idx' => $check[0]->idx);
    }
    /*    
     *  닉네임 중복 체크
     */
    function checkNickname($nickname)
    {

      $check = DB::select('select * from member where nickname=?', array($nickname));

      if( $check == NULL)
        return array('code' => 1, 'msg' => 'success');
      else
        return array('code' => 0, 'msg' => 'exist user');
    }


    /*    
     *  닉네임으로 회원 검색 기능
     */
    function getInfoByNickname($nickname)
    {

      if( !(  inputErrorCheck($nickname, 'nickname')))
        return ;

      $result = DB::select('select idx, nickname, type, email, image, id, point, upload from member where nickname=?', array($nickname)); 

      return  array('code' => 1, 'data' => $result);
    }

      /*    
       *  단일 멤버 정보 반환
       */
    function getInfoSingle($member_idx)
    {
      if( !(  inputErrorCheck($member_idx, 'member_idx')))
        return ;

      $result = DB::select('select idx, nickname, type, email, image, id, point, upload from member where idx=?', array($member_idx));

      return array('code' => 1, 'msg' => 'success', 'data' => $result);
    }

    /*    
     *  모든 회원 정보 수정 기능
     */
    function update($idx, $nickname, $type, $email, $id)
     {
    
      if( !(  inputErrorCheck($idx, 'idx')
          && inputErrorCheck($nickname, 'nickname')
          && inputErrorCheck($type, 'type')
          && inputErrorCheck($email, 'email')
          && inputErrorCheck($id, 'id')))
        return ;

      $result = DB::update('update member set nickname=?, email=?, type=?, id=?, upload=now() where idx=?', 
        array($nickname, $email, $type, $id, $idx));


      if($result == 1){
              return array('code' => 1, 'msg' => 'success');
           }else{
              return array('code' => 0, 'msg' => 'update failure');
           }
      }
      

      /*
       *   비밀번호 찾기 에서 사용
       */
      function updatePw($member_email, $pw)
      {
      	if( !(inputErrorCheck($member_email, 'member_email') 
            && inputErrorCheck($pw, 'pw')))
        	return ;
      
        $hashedPassword = Hash::make($pw);

        if(Hash::check($pw, $hashedPassword)){
          //비밀번호 일치
        }
        else{
          //비밀번호 불일치
          if(Hash::needsRehash($hashedPassword))
            $hashedPassword = Hash::make($pw);
        }

      	$result = DB::update('update member set pw=? where email=?', 
      		array($hashedPassword, $member_email));
      	
      	if ($result == 1)
      		return array('code' => 1, 'msg' => 'success');
      	else
      		return array('code' => 0, 'msg' => 'update failure');
      }


    /*
     *  추천인 닉네임을 파라미터로 받아 포인트 증가시킴
     */
    function recommand($nickname)
    {

      if( !( inputErrorCheck($nickname, 'nickname')))
        return ;

      $target = DB::select('select idx, point from member where nickname=?', array($nickname));

      if($target == NULL){
      }
      else{
        $result = DB::update('update member set point=point+500 where idx=?', array($target[0]->idx));
      }
      return array('code' => 1, 'msg' => 'update success');
     }

    /*    
     *  게시물 삭제 기능
     */
    function delete($member_idx)
    {
        
      if( !(  inputErrorCheck($member_idx, 'member_idx')))
        return ;    
  
      $result = DB::delete('delete from member where idx=?', array($member_idx));
  
      if($result == true){
            return array('code' => 1, 'msg' => 'success');
          }else{
            return array('code' => 0, 'msg' => 'delete failure: no matched data');
          }
    }
    

    /*
     *  세션 생성
     */
    function createSession($member_email, $session)
    {
        if( !(  inputErrorCheck($member_email, 'member_email')
            && inputErrorCheck($session, 'session')))
          return ;
        
        $hashedSession = Hash::make($session);

        if(Hash::check($session, $hashedSession)){
          //비밀번호 일치
        }
        else{
          //비밀번호 불일치
          if(Hash::needsRehash($hashedSession))
            $hashedSession = Hash::make($session);
        }

        $result = DB::update('update member set session=?, upload=now() where email=?', array($hashedSession, $member_email));

      if($result > 0)
        return array('code' => 1, 'data' => $result);
      else
        return array('code' => 0, 'data' => 'internel server error');      
    }

    /*
     *  세션 체크
     */
    function checkSession($member_email, $session)
    {
      $target_member = DB::select('select session from member where email=?', array($member_email));

      if(Hash::check($session, $target_member[0]->session)){
          //로그인 성공
          return array('code' => 1, 'data' => $target_member);
      } 
      else{
          //로그인 실패
          return array('code' => 0, 'data'=> "session failure" );
      }
    }

    /*
     *  세션 삭제
     */
    function deleteSession($member_email)
    {
      $target_member = DB::update('update member set session=NULL, upload=now() where email=?', array($member_email));


      if($result == true){
            return array('code' => 1, 'msg' => 'success');
      }else{
            return array('code' => 0, 'msg' => 'update false');
    	}
    }

}