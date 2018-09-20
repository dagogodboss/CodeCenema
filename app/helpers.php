<?php

function auto_p($text) {
  return '<p>' . preg_replace(['/(\r?\n){2,}/', '/\r?\n/'], ['</p><p>', '<br />'], $text) . '</p>';
}