<?php 
//��֤����
class ValidateCode {
 private $charset = '0123456789';//�������
 private $code;//��֤��
 private $codelen = 40;//��֤�볤��
 private $width = 70;//���
 private $height = 30;//�߶�
 private $img;//ͼ����Դ���
 private $font;//ָ��������
 private $fontsize = 16;//ָ�������С
 private $fontcolor;//ָ��������ɫ
 //���췽����ʼ��
 public function __construct() {
  $this->font = dirname(__FILE__).'/ttf/simhei.ttf';//ע������·��Ҫд�ԣ�������ʾ����ͼƬ
 }
 //���������
 private function createCode() {
  $_len = strlen($this->charset)-1;
  for ($i=0;$i<$this->codelen;$i++) {
   $this->code .= $this->charset[mt_rand(0,$_len)];
  }
 }
 //���ɱ���
 private function createBg() {
  $bj=mt_rand(231,255);
  $this->img = imagecreatetruecolor($this->width, $this->height);
  $color = imagecolorallocate($this->img, $bj, $bj, $bj);
  imagefilledrectangle($this->img,0,$this->height,$this->width,0,$color);
 }
 //��������
 private function createFont() {
  $_x = $this->width / $this->codelen;
  for ($i=0;$i<$this->codelen;$i++) {
   $this->fontcolor = imagecolorallocate($this->img,mt_rand(0,60),mt_rand(0,10),mt_rand(0,100));
   imagettftext($this->img,$this->fontsize,mt_rand(0,10),$_x*$i+mt_rand(1,2),$this->height / 1.4,$this->fontcolor,$this->font,$this->code[$i]);
  }
 }
 //����������ѩ��
 private function createLine() {
  //����
  for ($i=0;$i<3;$i++) {
   $color = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
   imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$color);
  }
  //ѩ��
  for ($i=0;$i<10;$i++) {
   $color = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
   imagestring($this->img,mt_rand(1,5),mt_rand(0,$this->width),mt_rand(0,$this->height),'*',$color);
  }
  //�߿�
  imagerectangle($this->img, 0, 0, $this->width-1, $this->height-1, imagecolorallocate($this->img, 0, 0, 0));  
 }
 
 //���
 private function outPut() {
  header('Content-type:image/png');
  imagepng($this->img);
  imagedestroy($this->img);
 }
 //��������
 public function doimg() {
  $this->createBg();
  $this->createCode();
  $this->createLine();
  $this->createFont();
  $this->outPut();
 }
 //��ȡ��֤��
 public function getCode() {
  return strtolower($this->code);
 }
}
session_start();
$_vc = new ValidateCode();  //ʵ����һ������
$_vc->doimg();  
$_SESSION['randcode'] = $_vc->getCode();//��֤�뱣�浽SESSION��
?>