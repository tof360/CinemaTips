<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 02-08-17
 * Time: 00:03
 */

namespace CT\CoreBundle\Twig;


class CoreExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('minutes_to_iso8601_duration', array($this, 'minutes_to_iso8601_durationFilter')),
        );
    }

    public function minutes_to_iso8601_durationFilter($minutes)
    {
            $time = strtotime($minutes . "minutes", 0);
            $units = array(
                "Y" => 365*24*3600,
                "D" =>     24*3600,
                "H" =>        3600,
                "M" =>          60,
                "S" =>           1,
            );
            $str = "";
            $istime = false;
            foreach ($units as $unitName => &$unit) {
                $quot  = intval($time / $unit);
                $time -= $quot * $unit;
                $unit  = $quot;
                if ($unit > 0) {
                    if (!$istime && in_array($unitName, array("H", "M", "S"))) {
                        $istime = true;
                    }
                    $str .= strval($unit) . $unitName;
                }
            }
            return $str;

    }
}