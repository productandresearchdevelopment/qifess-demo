<?php
function isMobile(){
    $agent = new Jenssegers\Agent\Agent();
    return $agent->isMobile();
}
