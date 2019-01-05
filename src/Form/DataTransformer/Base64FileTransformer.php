<?php

/*
 * This file is part of the Ivory Base64 File package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Base64FileTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($value)
    {
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value)
    {
        if (empty($value)) {
            return;
        }

        try {
            $tmpFilePath = tempnam(sys_get_temp_dir(), 'allegato_');
            $tmp = fopen($tmpFilePath, 'wb+');
            $size = fwrite($tmp, base64_decode($value));

            fclose($tmp);

            return new UploadedFile($tmpFilePath, 'originalName', $size, null, 0, true);
        } catch (\Exception $e) {
            throw new TransformationFailedException($e->getMessage(), 0, $e);
        }
    }
}
