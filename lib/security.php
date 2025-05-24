<?php
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function decode_data_with_formatting($data)
{
  $allowed_tags = '<b><i><u><strong><em><p><br><ul><ol><li><a><blockquote><code><pre><h1><h2><h3><h4><h5><h6>';
  $data = nl2br(strip_tags(htmlspecialchars_decode($data), $allowed_tags));
  return $data;
}
?>