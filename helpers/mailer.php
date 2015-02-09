<?php
/**
 * Mail wrapper 
 */
class Mailer{
    /**
     * Send email 
     * @param type $from
     * @param type $to
     * @param type $subject
     * @param string $message
     * @return boolean 
     */
    public static function send($from,$to, $subject, $message,$is_html = true) {

        $headers = "From: ".$from."\r\n";
        $headers .= "Reply-To: ".$from."\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: ".($is_html ? 'text/html' : 'text/plain' )." ; charset=UTF-8\r\n";

        $message = $is_html ? "<html><head><title>".$subject."</title></head><body>".$message."</body></html>" : $message;
        
        if (mail($to, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }
}
?>