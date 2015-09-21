<?php

namespace sr\pipebot\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

require_once(dirname(dirname(__FILE__)).'/pipebot/pipebot.php');

class post_listener implements EventSubscriberInterface
{
    static public function getSubscribedEvents()
    {
        return array(
            'core.submit_post_modify_sql_data'  => 'submit_post_modify_sql_data',
        );
    }

    public function submit_post_modify_sql_data($event)
    {
        $post_mode = $event['post_mode'];
        if ($post_mode != 'post' && $post_mode != 'reply')
        {
            return;
        }

        $post_info = $event['data'];
        $forum_name = html_entity_decode($post_info['forum_name']);
        $topic_title = html_entity_decode($post_info['topic_title']);

        $url = $this->build_url($post_info);

        $message = null;
        if ($post_mode == 'post')
        {
            $message = "'\x02${forum_name}\x02' forum: New thread '\x02${topic_title}\x02': ${url}";
        }

        if ($post_mode == 'reply')
        {
            $message = "'\x02${forum_name}\x02' forum: New post in '\x02${topic_title}\x02' thread: ${url}";
        }

        //var_dump($message);
        //file_put_contents('/tmp/out', print_r($message, true));
        if ($message !== null)
        {
            \Pipebot::say($message);
        }
    }

    private function build_url($post_info)
    {
        $post_id = $post_info['post_id'];
        return "http://srobo.org/forum/${post_id}";
    }
}
