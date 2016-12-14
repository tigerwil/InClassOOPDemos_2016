<?php

echo substr(sha1(mt_rand()), 0, 22);
echo '<hr>';
echo md5(uniqid(rand(), true));