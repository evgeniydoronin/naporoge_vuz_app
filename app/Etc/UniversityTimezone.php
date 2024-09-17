<?php

namespace App\Etc;

/**
 * Class UniversityTimezone
 * @author Evgene Doronin <evgenedoronin@gmail.com>
 * @package App\Etc
 */
class UniversityTimezone
{
    public function getTimezone(): array
    {
        return [
            'Europe/Kaliningrad' => 'MSK-1 (GMT+2:00)',
            'Europe/Moscow' => 'MSK (GMT+3:00)',
            'Europe/Samara' => 'MSK+1 (GMT+4:00)',
            'Asia/Yekaterinburg' => 'MSK+2 (GMT+5:00)',
            'Asia/Novosibirsk' => 'MSK+3 (GMT+6:00)',
            'Asia/Krasnoyarsk' => 'MSK+4 (GMT+7:00)',
            'Asia/Irkutsk' => 'MSK+5 (GMT+8:00)',
            'Asia/Yakutsk' => 'MSK+6 (GMT+9:00)',
            'Asia/Vladivostok' => 'MSK+7 (GMT+10:00)',
            'Asia/Magadan' => 'MSK+8 (GMT+11:00)',
            'Asia/Kamchatka' => 'MSK+9 (GMT+12:00)',
        ];
    }
}
