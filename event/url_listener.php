<?php

namespace sr\pipebot\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class url_listener implements EventSubscriberInterface
{
    static public function getSubscribedEvents()
    {
        return array(
            'core.common'  => 'redirect_if_post_number',
        );
    }

    public function __construct(\phpbb\request\request $request,
                                \phpbb\config\config $config)
    {
        $this->request = $request;
        $this->config = $config;
    }

    public function redirect_if_post_number($event)
    {
        $script_path = $this->config['script_path'];
        $script_name = $this->request->server('SCRIPT_NAME');
        if ($script_name != $script_path.'/app.php')
        {
            return;
        }

        $base_len = strlen($script_path);
        $base_len += 1;

        $request_uri = $this->request->server('REQUEST_URI');
        if (strlen($request_uri) <= $base_len)
        {
            return;
        }

        $rest = substr($request_uri, $base_len);
        if (!is_numeric($rest))
        {
            return;
        }

        $post_id = intval($rest);

        redirect("viewtopic.php?p=${post_id}#p${post_id}");
    }
}
