<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 13-08-17
 * Time: 17:03
 */

namespace CT\CoreBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use FOS\CommentBundle\Entity\Comment as BaseComment;

/**
 * @ORM\Entity
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class Comment extends BaseComment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Thread of this comment
     *
     * @var Thread
     * @ORM\ManyToOne(targetEntity="MyProject\MyBundle\Entity\Thread")
     */
    protected $thread;
}