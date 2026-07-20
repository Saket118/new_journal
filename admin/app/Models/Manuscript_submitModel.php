<?php

namespace App\Models;
use App\Libraries\Template;
use CodeIgniter\Model;

class Manuscript_submitModel extends Model
{
    public $tl;
	function __construct()
    {

        // $this->load->helper('url');
        parent::__construct();
        $this->db = \Config\Database::connect();
        $this->tl = new Template();
      
       
    }



   public function phase_c()
    {  

        $data = array();
        $data['SUBMITTED'] = 0;
        $data["IN REVISION"] = 0;
        $data["IN REVIEW"] = 0;
        $data["ACCEPTED"] = 0;
        $data["REJECTED"] = 0;
        $data["PUBLISHED"] = 0;
        $data["WITHDRAWN"] = 0;
        $data["REVISED"] =0;
        $data["RE REVISED"]=0;
        $data['Decision']=0;
                
      $builder = $this->db->table('manuscript_submit');
      $builder->select('count(current_phase) as total,current_phase');
      $builder->where('is_complete', 1);
      $builder->where('org_id', $_SESSION['org_id']);
      $builder->where('visible_sts', 0);
      $builder->where('user_id', $_SESSION['id']);
      $builder->groupBy('current_phase');
      $query1 = $builder->get();
 
      foreach ($query1->getResult() as $row) 
      {       
                 if($row->current_phase==1)
                {
                    $data['SUBMITTED'] = $data['SUBMITTED']+$row->total;
                }

                elseif($row->current_phase==5 || $row->current_phase==6)
                {
                    $data["IN REVISION"] = $data["IN REVISION"]+$row->total;
                }

                elseif($row->current_phase==14)
                {
                    $data["REVISED"] = $data["REVISED"]+$row->total;
                }

                elseif($row->current_phase==15)
                {
                    $data["RE REVISED"] = $data["RE REVISED"]+$row->total;
                }

                elseif($row->current_phase==9)
                {
                  $data["ACCEPTED"] = $data["ACCEPTED"]+$row->total;
                }
                elseif($row->current_phase==2 || $row->current_phase==3 || $row->current_phase==7 ||$row->current_phase==8 || $row->current_phase==4)
                {
                  $data["IN REVIEW"] = $data["IN REVIEW"]+$row->total;
                }                               
                elseif($row->current_phase==10)
                {
                    $data["REJECTED"] = $data["REJECTED"]+$row->total;
                }
                elseif($row->current_phase==11)
                {
                    $data["PUBLISHED"] = $data["PUBLISHED"]+$row->total;
                }
                elseif($row->current_phase==12)
                {
                    $data["WITHDRAWN"] = $data["WITHDRAWN"]+$row->total;
                }
                
        }
     
      return $data;
        
  }


 public function manu_data($id)
   {   

    $cond="";
    if($id==1)
      { $cond="current_phase in (1)";}
    elseif($id==5)
      { $cond="current_phase in (5,6)";}
    elseif($id==3)
      { $cond="current_phase in (2,3,7,8,4)";}
    elseif($id==9)
      { $cond="current_phase in (9)";}
    elseif($id==10)
      { $cond="current_phase in (10)";}
    elseif($id==11)
      { $cond="current_phase in (11)"; }
    elseif($id==12)
      { $cond="current_phase in (12)";}
    elseif($id==2)
      { $cond="current_phase in (14)";}
    elseif($id==4)
      { $cond="current_phase in (15)";}
    
   
       $ids=$_SESSION['id'];
        $org_id=$_SESSION['org_id']; 
        $credRes = array();
        $qu = $this->db->table("Organisation");
        $qu->select("Razor_id,Paymongo_id,Paypal_id,PayUMoney_id");
        $qu->where("org_id",$org_id);
         $result = $qu->get();
         print_r($this->db->getLastQuery());
         exit();
        //  $result = $qu->get()->getRowArray();
    

        if($result) 
        {
          $credRes['razor'] = !empty($result['Razor_id']) ? $result['Razor_id'] : 0;
          $credRes['paypal'] = !empty($result['Paypal_id']) ? $result['Paypal_id'] : 0;
          $credRes['payumoney'] = !empty($result['PayUMoney_id']) ? $result['PayUMoney_id'] : 0;
          $credRes['paymongo'] = !empty($result['Paymongo_id']) ? $result['Paymongo_id'] : 0;
        }

      $builder = $this->db->table('manuscript_submit');
      $builder->select('*');
      $builder->where('user_id', $ids);
      $builder->where('org_id', $org_id);
      $builder->where('visible_sts',0);
      $builder->where($cond);
      $query = $builder->get();
      //print_r($this->db->getLastQuery());exit;
      $res=array();
      foreach ($query->getResult() as $row) 
      { 
                                            
            $data['manuscript_no']=$row->manuscript_no;
            $data['category_name']=$this->tl->articletype($row->articletype)['category_name']; //using library
            $data['title']=html_entity_decode($row->title);  
            $data['submit_date']=$row->submit_date;
            $data['phase_name']= $this->tl->phase($row->current_phase)['phase_name'];

            $manuscript=encrypt($row->manuscript_no);

            $M_id=encrypt($row->id);


          // $view='<a href="'.base_url().'/view_auth/?M_NO='.$manuscript.'"><div class="view btn" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="fas fa-eye"></i></div></a>';


          $view='<a href="'.base_url().'/view/?M_NO='.encrypt($row->id).'"><div class="view btn" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="fas fa-eye"></i></div></a>';




          $withdraw='<div data-manuscript_no="'.$manuscript.'" class="withdraw btn" data-bs-toggle="tooltip" data-bs-placement="top" title="withdraw manuscript"><i class="fas fa-won-sign"></i></div>';

          // $Edit='<a href="'.base_url().'/Edit_revision_manuscript/Revision_manuscript/?M_NO='.$row->id.'"><div data-id="'.$row->id.'"data-manuscript_no="'.$row->manuscript_no.'" class="update btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit manuscript"><i class="fas fa-edit"></i></div></a>';

          $Edit='<a href="'.base_url().'/Edit_rev/?id='.$M_id.'"><div class="update btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit manuscript"><i class="fas fa-edit"></i></div></a>';

          if($credRes['razor'] || $credRes['paypal'] || $credRes['payumoney']|| $credRes['paymongo']) 
          {
            if($row->payment_status == 'SUCCESS') 
            {
              $credit = "<div class='credit btn'><i data-bs-toggle='tooltip' title='Paid' data-bs-placement='top' class='fas fa-solid fa-check'></i></div>";
              $withdraw= '';
            } 
            else 
            {
              $credit = "<div class='credit btn'><i data-id='{$row->id}' data-razor='{$credRes['razor']}' data-paypal='{$credRes['paypal']}' data-paymongo='{$credRes['paymongo']}' data-payumoney='{$credRes['payumoney']}' class='fas fa-credit-card credIcon' data-bs-toggle='modal' data-bs-target='#exampleModal'></i></div>";
            }
          } else {
            $credit = "";
          }


         if($id==1 || $id==3 || $id==9 || $id==10 || $id==2 || $id==4)
         {
            $data['action']= '<div class="d-flex justify-content-center">'.$view.$withdraw.'
                    </div>'; 
         }

         else if($id==5)
         {
            
            $data['action']= '<div class="d-flex justify-content-center">'.$view.$Edit.$withdraw.' </div>';

         }

         else if($id==11)
         {
            $data['action']= '<div class="d-flex justify-content-center">'.$view.$withdraw.$credit.'</div>'; 
         }


         else if($id==12)
         {
            $data['action']= '<div class="d-flex justify-content-center">'.$view.'</div>'; 
         }
   
        $res[]= $data;    
      }
      return $res; 
    }




    function update_phase($manuscript_no)
    {  
      $id=$_SESSION['id'];
      $org_id=$_SESSION['org_id'];
      $q1 = $this->tl->manuscript_no($manuscript_no)['id'];

        timezone();
        $d=date('Y-m-d');
        $date = date("Y-m-d H:i:s");

      
      $query=$this->db->query("UPDATE `manuscript_submit` SET `current_phase`=12 WHERE `manuscript_no` ='".$manuscript_no."'");
       $affectedRows1=$this->db->affectedRows();

    if($affectedRows1==1)
    {

      $query1=$this->db->query("INSERT INTO `manuscript_history`(`user_id`, `manuscript_id`, `date_of_history`, `description`, `org_id`, `manuscript_phase`) VALUES ('".$id."','".$q1."','".$date."','manuscript withdraw','".$org_id."','12')"); 

      $query2=$this->db->query("INSERT INTO `manuscript_phase`(`manuscript_id`, `phase_id`, `change_by`, `assigned_to`, `phase_sts`, `org_id`, `invite_date`, `invitation_sts`, `assigned_usertype`, `complete_date`) VALUES ('".$q1."','12','".$id."','".$id."','1','".$org_id."','".$d."','1','1','".$date."')");
      $affectedRows2=$this->db->affectedRows();
 
      //*************Mail functionality to Admin*********
   
      $query5= $this->db->query("SELECT login_id,`Email`,`First_Name` FROM user_login WHERE user_account_type=1 and org_id= ".$org_id." order by created_date desc limit 1")->getRowArray();
      $manu_no=manu_no($q1)['manuscript_no'];
       $email = \Config\Services::email();
       $name='';
       $message=$this->tl->email_template($name,$manu_no, $q1,"MANUSCRIPT_WITHDRAW", $_SESSION['id'], $query5['login_id'], $org_id);//getting email body
        //$from=from_mail()['email'];

          $subject = $message['subject'];
          $message = $message['message'];

          $mail_result=Sending_mails($query5['Email'],$subject,$message);

          // $email->setTo($query5['Email']);
          // $email->setFrom($from);
          // $email->setSubject($subject);
          // $email->setMessage($message);

          if ($mail_result==true) 
            { 
              $res['sts']=true;
              $res['msg']='Manuscript Withdraw Successfully';
            } 
            else 
            {
              // $res = $email->printDebugger(['headers']);
                $res['sts']=false;
               $res['msg']='Mail Error';
            }  
   }

      //************End of Mail**************************

    // if($affectedRows2==1 && $affectedRows1==1)
    // {
    //   $res['msg']='Manuscript Withdraw Successfully';
    // }
    // else
    // {
    //   $res['msg']='Manuscript not Withdraw';
    // }

        $res['csrfName']=csrf_token();
        $res['csrfHash']=csrf_hash();
    return $res;
  } 


}

?>
