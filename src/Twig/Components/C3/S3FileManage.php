<?php

namespace ChapterThree\C3Bundle\Twig\Components\C3;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent(template: '@C3/components/S3FileManage.html.twig')]
class S3FileManage
{
    public $fileUploadFlag = false;
    public string $getDataUrl;

    #[PreMount]
    public function preMount(array $data): array
    {
        // validate data
        $resolver = new OptionsResolver();
        $resolver->setIgnoreUndefined(true);

        $resolver->setRequired('getDataUrl');
        $resolver->setAllowedTypes('getDataUrl', 'string');

        try {
            $result = $resolver->resolve($data) + $data;
        }catch (MissingOptionsException $exception){
            throw new MissingOptionsException('<twig:C3:S3FileManage> は getDataUrl="url" が必要です。 '.
                "['name' => string,'div' => 'dir'|'file','children' => [],'url'=>string]\n".
                "if (!\$this->isCsrfTokenValid('filemanage-get-items\', \$request->getPayload()->get(\'token\'))) {".
                "  throw new AccessDeniedHttpException(\'CSRF token invalid. \');".
                '} に対応してください'
            );
        }

        return $result;
    }
}