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
    function create($type, $email, $nickname, $id, $pw)
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


        $result = DB::table('member')->insertGetId(
          array(
            'type'=> $type, 
            'email'=> $email, 
            'nickname'=> $nickname, 
            'id'=> $id, 
            'pw'=> $hashedPassword,
            'upload'=>DB::raw('now()')
            )
          );  

      if($result > 0)
        return array('code' => 1, 'data' => $result);
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
      function updatePw($member_idx, $pw)
      {
      	if( !(inputErrorCheck($member_idx, 'member_idx') 
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

      	$result = DB::update('update member set pw=? where idx=?', 
      		array($hashedPassword, $member_idx));
      	
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
}