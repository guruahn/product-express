<?php
/**
 * Request Rusult View Template
 *
 * Template Name: Rusult View
 *
 * @package    Product Express
 * @copyright  2015 userstorylab
 * @version    1.0
 */
?>
<?php get_header(); ?>



<div class="container pure-g" data-sticky_parent>
    <div class="pure-u-1     pure-u-md-14-24  pure-u-lg-16-24   content pure-u-1">
    <!-- 본문 영역 시작 -->
    <div class="pure-g" >


    </div>
    </div><!--//.content-->
    <?php
    get_template_part( 'sidebar' );
    ?>
</div>




<?php
global $wpdb;
$formmaker_submits = $wpdb->query( "SELECT * FROM ".$wpdb->prefix."formmaker_submits WHERE 1=1");
$formmaker_submits = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."formmaker_submits WHERE date  >= NOW() - INTERVAL 10 HOUR", OBJECT);

$group_id = '';
$mail_html = '';
foreach($formmaker_submits as $result){
    if($group_id == '' || $group_id != $result->group_id){
        $group_id = $result->group_id;
        $mail_html .= "<br /><br />";
    }
    if($result->element_label == 2){
        $mail_html .= "제품(서비스) 이름 : ".$result->element_value."<br />";
    }elseif($result->element_label == 3){
        $mail_html .= "이메일 : ".$result->element_value."<br />";
    }elseif($result->element_label == 13){
        $mail_html .= "URL : ".$result->element_value."<br />";
    }elseif($result->element_label == 11){
        $mail_html .= "Message : ".$result->element_value."<br />";
    }
}

//echo $mail_html;

//printr($formmaker_submits);

if($mail_html != ''){
    $mail_html .= '<br /><br /><a href="http://pe.userstorylab.com/wp-admin/admin.php?page=submissions_fm">의뢰 리스트 바로가기</a>';
    require 'PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    $mail->setLanguage('ko', 'PHPMailer/language');
    $mail->CharSet = "utf-8";
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'email-smtp.us-east-1.amazonaws.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'AKIAJWHL276QUTJTXZ3A';                 // SMTP username
    $mail->Password = 'AuXbYIVVB1RWM5JD/VO0ssp2iBkL3ljGKDUWl5Cb7LUz';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->From = 'product@userstorylab.com';
    $mail->FromName = 'Product Express';
    // Add a recipient
    $mail->addAddress('product@userstorylab.com', 'Product Express');
    $mail->addReplyTo('product@userstorylab.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = '새로운 의뢰가 도착했습니다.';
    $mail->Body    = $mail_html;
    $mail->AltBody = wp_strip_all_tags($mail_html);
    if(!$mail->send()) {
        //echo 'Message could not be sent.';
        //echo 'Mailer Error: ' . $mail->ErrorInfo;
        wp_redirect( home_url().'#request_fail' ); exit;
    } else {
        //echo 'Message has been sent';
        wp_redirect( home_url().'#request_ok' ); exit;
    }
}


?>



<?php get_footer(); ?>