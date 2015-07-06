<?php
namespace Model;

class Battle {

    public function setMeta($id, $name, $value)
    {

        if (!update_post_meta($id, $name, $value)) {
            add_post_meta($id, $name, $value);
        };
    }

    public function getMeta($id, $name, $default = null)
    {

        $meta = get_post_meta($id, $name, True);
        return $meta ? $meta : $default;

    }

    public function getById($id)
    {
        $post = [
            "id" => $id,
        ];
        return $post;

    }

}