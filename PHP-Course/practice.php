
<?php
  echo '<h2>' . 'MY SKILLS' . '</h2>';
  $langs = array("HTML",
                "CSS",
                "JS",
                "PHP",
                "JQUERY",
                array("GIT", "GITHUB", "WIREFRAMING", "COMMAND LINE"),
                "BOOTSTRAP",
                "SASS",
                "PUG",
                "GULP",
                "AJAX",
                "JSON");

  $langs[] = "WORDPRESS";

  echo "<pre>";

  print_r($langs);

  echo "</pre>";

/* Set cookies(name, value, expire, path, domain, secure, httponly)
** name:     The name of the cookie
** value:    Content of the cookie
** expire:   Expiration date
** path:     
** domain:
** secure:
** httponly:
*/

setcookie("elmester", "test", time() + 86400, "/");

if (count($_COOKIE) > 0){

  echo "Awesome, You have some cookies.";
  echo "<pre>";
  print_r($_COOKIE);
  echo "</pre>";

} else{

  echo "Ooops, did you have at least 1 cookie!";

}
