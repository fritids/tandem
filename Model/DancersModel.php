<?php
namespace Model;

class DancersModel
{

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

    public function getVotes($id)
    {
        $vote = count(get_users([
            'meta_key' => 'dancer_vote',
            'meta_value' => $id,
        ]));

        return $vote ? $vote : 0;
    }

    public function getById($id)
    {
        $post = [
            "post_name" => $this->getMeta($id, "post_name"),
            "subtitle" => $this->getMeta($id, "subtitle"),
            "post_punchline" => $this->getMeta($id, "post_punchline"),
            "post_color" => $this->getMeta($id, "post_color"),
            "post_image" => $this->getMeta($id, "post_image"),
            "post_profile" => $this->getMeta($id, "post_profile"),
            "id" => $id,
            "medias" => get_post_gallery_images($id),
            "votes" => $this->getVotes($id)
        ];
        return $post;

    }


    public function getByMeta($meta, $value)
    {
        $posts = [];
        $query = get_posts([
            'post_type' => "dancer",
            'meta_key' => $meta,
            'meta_value' => $value
        ]);

        foreach ($query as $post) : setup_postdata($post);

            $posts[] = $this->getById($post->ID);

        endforeach;

        return $posts ? $posts : null;
    }

    public function getAll()
    {
        $posts = [];
        $query = get_posts([
            'post_type' => "dancer",
        ]);

        foreach ($query as $post) : setup_postdata($post);

            $posts[] = $this->getById($post->ID);

        endforeach;

        return $posts ? $posts : null;
    }

}