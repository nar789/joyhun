<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
class MY_Form_validation extends CI_Form_validation {
 /* 폼검증에 기능 추가
  * 한글,영문,숫자,데쉬,언더바만 가능하게 한다. utf-8 기준.
  */
 public function korean_alpha_dash($str)
 {
  return ( preg_match('/[^\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}0-9a-zA-Z_-]/u',$str)) ? FALSE : TRUE;
 }
}
?>