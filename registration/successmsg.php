<?php
// Create an HTML alert message for error display
$htmlContent = '<div class="rvt-alert rvt-alert--success [ rvt-m-top-md ]" role="alert" aria-labelledby="success-alert-title" data-rvt-alert="success">'.
'<div class="rvt-alert__title" id="success-alert-title">Thank you!</div>'.
'<p class="rvt-alert__message">' . $message . '</p>'.
'<button class="rvt-alert__dismiss" data-rvt-alert-close>'.
  '<span class="rvt-sr-only">Dismiss this alert</span>'.
  '<svg fill="currentColor" width="16" height="16" viewBox="0 0 16 16"><path d="m3.5 2.086 4.5 4.5 4.5-4.5L13.914 3.5 9.414 8l4.5 4.5-1.414 1.414-4.5-4.5-4.5 4.5L2.086 12.5l4.5-4.5-4.5-4.5L3.5 2.086Z"></path></svg>'.'</button>'.'</div>';

// Display the HTML error message
echo $htmlContent;
?>