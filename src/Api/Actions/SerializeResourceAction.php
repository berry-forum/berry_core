<?php 
/*
 * This file is part of Flarum.
 *
 * (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Flarum\Api\Actions;

use Tobscure\JsonApi\SerializerInterface;

abstract class SerializeResourceAction extends SerializeAction
{
    /**
     * Serialize the data as appropriate.
     *
     * @param SerializerInterface $serializer
     * @param array $data
     * @return \Tobscure\JsonApi\Elements\Resource
     */
    protected function serialize(SerializerInterface $serializer, $data)
    {
        return $serializer->resource($data);
    }
}
