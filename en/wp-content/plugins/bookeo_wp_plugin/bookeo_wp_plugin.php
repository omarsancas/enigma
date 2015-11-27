<?php
/*
Plugin Name: Bookeo
Description: Online appointment scheduling, tour and class bookings
Plugin URI: http://www.bookeo.com
Version: 1.4
Author: Bookeo
Autor URI: http://www.bookeo.com
*/

add_action('admin_menu', 'myplugin_menu_giovannaroncaliplugin');

function myplugin_menu_giovannaroncaliplugin()
{
    add_menu_page("", "Bookeo", 'manage_options', __FILE__);
    add_submenu_page(__FILE__, "", "", 'manage_options', __FILE__, "fun_read_data");
}

function fun_read_data()
{
    include('bookeo widget.php');
}

function spinText($text)
{
    $test = preg_match_all("#\{(.*?)\}#", $text, $out);

    if (!$test) {
        return $text;
    }

    $toFind = array();
    $toReplace = array();

    foreach ($out[0] as $id => $match) {

        $choices     = explode(":", $out[1][$id]);
        $toFind[]    = $match;
        $toReplace[] = trim($choices[1]);

        if ($choices[0] == "bookeo") {

            if ($choices[1]) {

                $replace = str_replace("&amp;", "&", $choices[1]);
                $replace = str_replace("&#038;", "&", $replace);

                $toReplace[] = '<script type="text/javascript" src="https://bookeo.com/widget.js?a='
                    . get_option("hwe_txtwidgetcode")
                    . '&'
                    . $replace
                    . '"></script>';
            } else {
                $toReplace[] = '<script type="text/javascript" src="https://bookeo.com/widget.js?a='
                    . get_option("hwe_txtwidgetcode")
                    . '"></script>';
            }

        }

        return $text=str_replace($toFind, $toReplace[1], $text);
    }
}

add_action('the_content', 'fun_form_cont');
function fun_form_cont($content)
{
    $rec = spinText($content);

    return $rec;
}
