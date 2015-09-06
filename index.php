<?php

require('workflows.php');

$query = "{query}";

preg_match('#^(\d+)([kmgp]?b)?$#i', $query, $match);

if (!isset($match[1])) {
    return;
}

if (!isset($match[2])) {
    $match[2] = 'bit';
}

$match[1] = (int)$match[1];
$match[2] = strtolower($match[2]);

$wf = new Workflows();
function output($bits)
{
    global $wf;
    $output = sprintf("% dBits % .2fByte % .2fKB % .2fMB % .2fGB % .2fTB % .2fPB", $bits, $bits / 8, $bits / 1024 / 8, $bits / 1024 / 1024 / 8, $bits / 1024 / 1024 / 1024 / 8, $bits / 1024 / 1024 / 1024 / 1024 / 8, $bits / 1024 / 1024 / 1024 / 1024 / 1024 / 8);

    $outputArr = explode(" ", $output);
    foreach ($outputArr as $key => $val) {

        $wf->result($key, $val, $val, '', 'icon.png');
    }
    echo $wf->toxml();
}

switch ($match[2]) {
    case "bit" :
        output($match[1]);
        break;
    case "b" :
        output($match[1] * 8);
        break;

    case "kb":
        output($match[1] * 1024 * 8);
        break;

    case "mb":
        output($match[1] * 1024 * 1024 * 8);
        break;

    case "gb":
        output($match[1] * 1024 * 1024 * 1024 * 8);
        break;

    case "tb":
        output($match[1] * 1024 * 1024 * 1024 * 1024 * 8);
        break;

    case "pb":
        output($match[1] * 1024 * 1024 * 1024 * 1024 * 1024 * 8);
        break;
}

