<?php

namespace IIT\Content\App\Services;

use Bitrix\Main\Application;

/**
 * Class ContentService
 * Using for base actions in getting pages and their content
 *
 * @package IIT\Content\App\Services
 */
class ContentService
{
    private $typeCode = 'content';

    /**
     * Getting content for page in the form of string
     *
     * @param string $path
     * @return string
     */
    public function getContent(string $path)
    {
        $path .= '/';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->getBaseUrl() . $path . '?curl=Y',
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_BINARYTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_USERPWD => 'admin:2sCArxi8',
            CURLOPT_HTTPHEADER =>  [
                'Authorization: Basic '.base64_encode('admin:2sCArxi8')
            ]
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    /**
     * Getting list of pages
     *
     * @param $path
     * @return array|false
     */
    public function getPages($path)
    {
        $path .= '/';
        if ($iblockID = $this->getIBlockId(basename($path))) {
            return $this->getIblockSections($iblockID);
        } else {
            $basePath = $this->getBasePath();
            $curPath = ($path == '/content' ? $basePath : $basePath . $path);
            $arDir = scandir($curPath);

            foreach ($arDir as $item) {
                if ($item == '.' || $item == '..') continue;
                if (is_dir($curPath . $item)) {
                    $result[] = $item;
                }
            }

            return $result ?: false;
        }
    }

    /**
     * Getting base url for curl action
     *
     * @return string
     */
    private function getBaseUrl()
    {
        $request = Application::getInstance()->getContext()->getRequest();
        $protocol = $request->isHttps() ? 'https://' : 'http://';
        $host = $_SERVER['SERVER_NAME'];
        $contentDir = '/content';

        return $protocol . $host . $contentDir;
    }

    /**
     * @return string
     */
    private function getBasePath()
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/content';
    }

    /**
     * Getting iblock id by their code
     *
     * @param string $code
     * @return false|mixed
     */
    private function getIBlockId(string $code)
    {
        $iblock = \CIBlock::GetList(
            [],
            ['CODE' => $code, 'TYPE' => $this->typeCode]
        )->Fetch();

        return $iblock ? $iblock['ID'] : false;
    }

    /**
     * Getting iblock sections
     *
     * @param int $iblockID
     * @return array
     */
    private function getIblockSections(int $iblockID)
    {
        $arSections = [];
        $rsSections = \CIBlockSection::GetList(
            [],
            ['IBLOCK_ID' => $iblockID, 'DEPTH_LEVEL' => 1],
            false,
            ['SECTION_PAGE_URL', 'NAME']
        );

        while ($section = $rsSections->GetNext()) {
            $arSections[] = $section['NAME'];
        }

        return $arSections;
    }
}