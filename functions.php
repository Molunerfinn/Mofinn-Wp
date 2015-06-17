<?php
/**
 * mofinn functions and definitions
 *
 * @package mofinn
 */
define('mofinn_URL', get_template_directory_uri());
define('mofinn_DIR', get_template_directory());

/* =Theme Core
----------------------------------*/
require mofinn_DIR . '/inc/theme-setup.php';
require mofinn_DIR . '/inc/template-tags.php';
require mofinn_DIR . '/inc/jetpack.php';
require mofinn_DIR . '/inc/widgets/class-popular-widget.php';
require mofinn_DIR . '/inc/customizer.php';
require mofinn_DIR . '/inc/extras.php';

/* comment_mail_notify v1.0 by willin kan. Fixed by molunerfinn (所有回复都发邮件) */
function comment_mail_notify($comment_id) {
  $comment = get_comment($comment_id);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  $spam_confirmed = $comment->comment_approved;
  if (($parent_id != '') && ($spam_confirmed != 'spam')) {
    $wp_email = 'molunerfinn@' . preg_replace('#^www.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 发出点, no-reply 可改为可用的 e-mail.
    $to = trim(get_comment($parent_id)->comment_author_email);
    $subject = '您在 [' . get_option("blogname") . '] 的留言有了回复';
    $message = '
    <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px;">
      <p><strong>' . trim(get_comment($parent_id)->comment_author) . '</strong>, 您好!</p>
      <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'
       . trim(get_comment($parent_id)->comment_content) . '</p>
      <p><strong>' . trim($comment->comment_author) . ' </strong>给您的回复:<br />'
       . trim($comment->comment_content) . '<br /></p>
      <p>您可以点击 <a href="' . htmlspecialchars(get_comment_link($parent_id,array("type" => "all"))) . '">查看回复的完整內容</a></p>
      <p>欢迎再度光临 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
      <p>(此邮件由系统自动发送，请勿回复.)</p>
    </div>';
      $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
      $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
      wp_mail( $to, $subject, $message, $headers );
  }
}
add_action('comment_post', 'comment_mail_notify');
// -- END ---------------------------------------

?>
