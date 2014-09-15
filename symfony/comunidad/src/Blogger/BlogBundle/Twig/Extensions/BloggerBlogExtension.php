<?php

namespace Blogger\BlogBundle\Twig\Extensions;

class BloggerBlogExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'created_ago' => new \Twig_Filter_Method($this, 'createdAgo'),
        );
    }

    public function createdAgo(\DateTime $dateTime)
    {
        
        $server = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $locale = substr($server, 0,5);

        
        $delta = time() - $dateTime->getTimestamp();
        if ($delta < 0)
            throw new \Exception("createdAgo is unable to handle dates in the future");

        $duration = "";
        if ($delta < 60)
        {
            // Seconds
            $time = $delta;
            $duration = ($locale =="es-ES") ? " hace " .$time. " segundo" . (($time === 0 || $time > 1) ? "s" : "") : $time . " second" . (($time === 0 || $time > 1) ? "s" : "") . " ago";
        }
        else if ($delta < 3600)
        {
            // Mins
            $time = floor($delta / 60);
            $duration = ($locale =="es-ES") ? " hace " .$time. " minuto" . (($time > 1) ? "s" : "") : $time . " minute" . (($time > 1) ? "s" : "") . " ago";
            
        }
        else if ($delta < 86400)
        {
            // Hours
            $time = floor($delta / 3600);
            $duration = ($locale =="es-ES") ? " hace " .$time. " hora" . (($time > 1) ? "s" : "") : $time . " hour" . (($time > 1) ? "s" : "") . " ago";
        }
        else
        {
            // Days
            $time = floor($delta / 86400);
            $duration = ($locale =="es-ES") ? " hace " .$time. " día" . (($time > 1) ? "s" : "") : $time . " day" . (($time > 1) ? "s" : "") . " ago";
        }

        return $duration;
    }

    public function getName()
    {
        return 'blogger_blog_extension';
    }
}