<?php


namespace framework\classes;


class SiteIndexing {

    private $user_agent;

    public function __construct()
    {
        $this->user_agent = $_SERVER['HTTP_USER_AGENT'] ?: false;
    }

    public function detectGuest(): string
    {
        return ($this->detectSearchBot() == 'unknown' && $this->detectAnalyzer() == 'unknown')
            ? 'Human'
            : 'Bot';
    }

    public function detectSearchBot($desc = false): string
    {
        if ($this->isGoogle()) {
            return 'Google';
        } elseif ($this->isYandex()) {
            return 'Yandex';
        } elseif ($this->isMailRu()) {
            return 'MailRu';
        } elseif ($this->isRambler()) {
            return 'Rambler';
        } elseif ($this->isYahoo()) {
            return 'YaHoo';
        } elseif ($this->isMSN()) {
            return 'MSN';
        } elseif ($this->isBing()) {
            return 'Bing';
        } elseif ($this->isSputnik()) {
            return 'Sputnik';
        } else {
            return $desc ? $this->user_agent : 'unknown';
        }
    }

    public function detectBrowser($desc = false): string
    {
        if ($this->isChrome()) {
            return 'Chrome';
        } elseif ($this->isYaBrowser()) {
            return 'Yandex';
        } elseif ($this->isSafari()) {
            return 'Safari';
        } elseif ($this->isFirefox()) {
            return 'FireFox';
        } elseif ($this->isOpera()) {
            return 'Opera';
        } elseif ($this->isOldIE()) {
            return 'Old IE';
        } elseif ($this->isIE()) {
            return 'IE 11';
        } elseif ($this->isEdge()) {
            return 'Edge';
        } else {
            return $desc ? $this->user_agent : 'unknown';
        }
    }

    public function detectDevice($desc = false): string
    {
        if ($this->isIphone() || $this->isIpad() || $this->isAndroid()) {
            return 'Mobile';
        } elseif ($this->isMacOs() || $this->isWindows() || $this->isLinux()) {
            return 'Desktop';
        } else {
            return $desc ? $this->user_agent : 'unknown';
        }
    }

    public function detectOS($desc = false): string
    {
        if ($this->isWindows()) {
            return 'Windows';
        } elseif ($this->isIphone() || $this->isIpad()) {
            return 'iOS';
        } elseif ($this->isAndroid()) {
            return 'Android';
        } elseif ($this->isMacOs()) {
            return 'MacOS';
        } elseif ($this->isLinux()) {
            return 'Linux';
        } else {
            return $desc ? $this->user_agent : 'unknown';
        }
    }

    public function detectAnalyzer($desc = false): string
    {
        if ($this->isAhrefs()) {
            return 'Ahrefs';
        } elseif ($this->isMajestic()) {
            return 'Majestic';
        } elseif ($this->isSMTBot()) {
            return 'SMTBot';
        } elseif ($this->islinkdex()) {
            return 'linkdex';
        } elseif ($this->isExabot()) {
            return 'Exabot';
        } elseif ($this->isStatOnline()) {
            return 'StatOnline';
        } else {
            return $desc ? $this->user_agent : 'unknown';
        }
    }



    private function isAhrefs()
    {
        return stripos($this->user_agent,"AhrefsBot") !== false;
    }

    private function isMajestic()
    {
        return stripos($this->user_agent,"MJ12bot") !== false;
    }

    private function isSMTBot()
    {
        return stripos($this->user_agent,"SMTBot") !== false;
    }

    private function islinkdex()
    {
        return stripos($this->user_agent,"linkdexbot") !== false;
    }

    private function isExabot()
    {
        return stripos($this->user_agent,"Exabot") !== false;
    }

    private function isStatOnline()
    {
        return stripos($this->user_agent,"StatOnlineRuBot") !== false;
    }



    private function isIphone()
    {
        return stripos($this->user_agent,"iPhone") !== false
            || stripos($this->user_agent, "MobileSafari") !== false;
    }

    private function isIpad()
    {
        return stripos($this->user_agent,"iPad") !== false;
    }

    private function isAndroid()
    {
        return stripos($this->user_agent,"Android ") !== false;
    }

    private function isMacOs()
    {
        return stripos($this->user_agent,"Mac OS X") !== false;
    }

    private function isWindows()
    {
        return stripos($this->user_agent,"Windows") !== false;
    }

    private function isLinux()
    {
        return stripos($this->user_agent,"Linux") !== false;
    }



    private function isChrome()
    {
        return stripos($this->user_agent,"Chrome") !== false;
    }

    private function isYaBrowser()
    {
        return stripos($this->user_agent,"YaBrowser") !== false;
    }

    private function isSafari()
    {
        return stripos($this->user_agent,"Safari") !== false;
    }

    private function isFirefox()
    {
        return stripos($this->user_agent,"Firefox") !== false;
    }

    private function isOpera()
    {
        return stripos($this->user_agent,"Opera") !== false;
    }

    private function isOldIE()
    {
        return stripos($this->user_agent,"MSIE") !== false;
    }

    private function isIE()
    {
        return stripos($this->user_agent,"Trident") !== false;
    }

    private function isEdge()
    {
        return stripos($this->user_agent,"Edge") !== false;
    }



    private function isGoogle()
    {
        return stripos($this->user_agent, 'Google') !== false;
    }

    private function isYandex()
    {
        return stripos($this->user_agent, 'Yandex') !== false;
    }

    private function isMailRu()
    {
        return stripos($this->user_agent, 'Mail.RU_Bot') !== false;
    }

    private function isRambler()
    {
        return stripos($this->user_agent, 'StackRambler') !== false;
    }

    private function isYahoo()
    {
        return stripos($this->user_agent, 'Yahoo') !== false;
    }

    private function isMSN()
    {
        return stripos($this->user_agent, 'msnbot') !== false;
    }

    private function isBing()
    {
        return stripos($this->user_agent, 'bingbot') !== false;
    }

    private function isSputnik()
    {
        return stripos($this->user_agent, 'SputnikBot') !== false;
    }
}
