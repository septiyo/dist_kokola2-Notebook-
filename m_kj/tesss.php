<?php
echo ini_get("memory_limit")."\n";
echo ini_get("max_input_vars")."\n";
 echo "Using ", memory_get_peak_usage(1), " bytes of ram.";
?>
