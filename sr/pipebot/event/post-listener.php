<?php

namespace sr\pipebot\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PostListener implements EventSubscriberInterface
{
    static public function getSubscribedEvents()
    {
        return array(
            'core.submit_post_modify_sql_data'  => 'submit_post_modify_sql_data',
        );
    }

    public function submit_post_modify_sql_data($event)
    {
        $info = print_r($event, true);
        file_put_contents("/tmp/out", $info);
    }
}
