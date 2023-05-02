<?php namespace App\Models;

use CodeIgniter\Model;

class AdModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct();
        $this->builder = $this->db->table('ad_spaces');
    }

    //update ad spaces
    public function updateAdSpaces($adSpace)
    {
        $uploadModel = new UploadModel();
        $data = [
            'ad_code_728' => inputPost('ad_code_728'),
            'ad_code_468' => inputPost('ad_code_468'),
            'ad_code_234' => inputPost('ad_code_234')
        ];
        $dataUrl = [
            'url_ad_code_728' => inputPost('url_ad_code_728'),
            'url_ad_code_468' => inputPost('url_ad_code_468'),
            'url_ad_code_234' => inputPost('url_ad_code_234')
        ];
        if ($adSpace == "sidebar_top" || $adSpace == "sidebar_bottom") {
            $data["ad_code_300"] = inputPost('ad_code_300');
            $urlAdCode300 = inputPost('url_ad_code_300');
            $file = $uploadModel->adUpload('file_ad_code_300');
            if (!empty($file) && !empty($file['path'])) {
                $data["ad_code_300"] = $this->createAdCode($urlAdCode300, $file['path']);
            }
        } else {
            $file = $uploadModel->adUpload('file_ad_code_728');
            if (!empty($file) && !empty($file['path'])) {
                $data["ad_code_728"] = $this->createAdCode($dataUrl["url_ad_code_728"], $file['path']);
            }
            $file = $uploadModel->adUpload('file_ad_code_468');
            if (!empty($file) && !empty($file['path'])) {
                $data["ad_code_468"] = $this->createAdCode($dataUrl["url_ad_code_468"], $file['path']);
            }
        }
        $file = $uploadModel->adUpload('file_ad_code_234');
        if (!empty($file) && !empty($file['path'])) {
            $data["ad_code_234"] = $this->createAdCode($dataUrl["url_ad_code_234"], $file['path']);
        }
        return $this->builder->where('ad_space', $adSpace)->update($data);
    }

    //get ads
    public function get_ads()
    {
        return $this->builder->get()->getResult();
    }

    //get ad spaces
    public function getAdSpaces()
    {
        return $this->builder->get()->getResult();
    }

    //get ad codes
    public function getAdCodes($adSpace)
    {
        return $this->builder->where('ad_space', removeSpecialCharacters($adSpace))->get()->getRow();
    }

    //create ad code
    public function createAdCode($url, $image_path)
    {
        return '<a href="' . $url . '"><img src="' . base_url($image_path) . '" alt=""></a>';
    }

    //update google adsense code
    public function updateGoogleAdsenseCode()
    {
        $data = [
            'google_adsense_code' => inputPost('google_adsense_code')
        ];
        return $this->db->table('general_settings')->where('id', 1)->update($data);
    }

}
