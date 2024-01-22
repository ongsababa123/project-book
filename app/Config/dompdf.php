<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Dompdf extends BaseConfig
{
    /**
     *--------------------------------------------------------------------------
     * DOMPDF settings
     *--------------------------------------------------------------------------
     *
     * The following settings can be used to configure DOMPDF according to your needs.
     * To learn more about the available options, please visit:
     * https://github.com/dompdf/dompdf/wiki/Usage#configuration
     *
     */

    // Add any DOMPDF configuration options you need here
    public $fontPath = ROOTPATH . 'public/fonts/';
}
